<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

//get the module params
$database =& JFactory::getDBO();
$query = "SELECT params"
. "\n FROM #__modules "
. "\n WHERE module = 'mod_ajaxsearch'";
$database->setQuery( $query );
$row = $database->loadResult();
$app	= JFactory::getApplication();
jimport( 'joomla.html.parameter' );
$params = new JParameter( $row );
$text_bottom = $params->get('text_bottom');
$no_results = $params->get('no_results');
$category = $params->get('category');
$moduleclass_sfx = $params->get('moduleclass_sfx');
$title_maxlenght = (int) $params->get('title_maxlenght',35);
$description_maxlenght = (int) $params->get('description_maxlenght',80);
$search_itemid = $params->get('search_itemid');

//Get Request
$searchword = JRequest::getVar('searchword','');
$ordering = JRequest::getVar('ordering');
$limit = JRequest::getInt('limit',"5");
$searchphrase = JRequest::getVar('searchphrase','');
?>
<div id="tmp_ajax_results">
    <ul id="searchresults">
    <?php 
    $section = "";
    $counter = count( $this->results );
    if ($counter > $limit) {$counter=$limit;}
    for ($i=0, $n=$counter; $i < $n; $i++)	{
        $result = &$this->results[$i];
        
        if($category=="1") {
            if($result->section != $section) { // check if the category changed
                echo '<li class="category">'.$this->escape($result->section).'</li>';
                $section = $result->section;
            }
        }
        
        echo  "<li>";
            if ($result->browsernav == 1 ) : 
                echo '<a href="'.JRoute::_($result->href).'" target="_blank" >';
            else : 
                echo '<a href="'.JRoute::_($result->href).'">';
            endif; 	
        
                $name =  $this->escape($result->title);
                if(strlen($name) > $title_maxlenght) { 
                    $name = substr($name, 0, $title_maxlenght) . "...";
                }	 
                $description = $result->text;
                if(strlen($description) > $description_maxlenght) { 
                    $description = substr($description, 0, $description_maxlenght) . "...";
                }
                
                echo "<div class='txt'>";
                    echo "<span>$name</span><br />";
                    echo $description;
                echo "</div>";
        
            echo  "</a>";
    
        echo "</li>";	
    } 
    
    if($counter==0) {
        echo '<li class="no_results">'.$no_results .'</li>';
    }
	
	$full_link = 'index.php?option=com_search&searchword='.$this->escape($searchword).'&ordering='.$ordering .'&searchphrase='.$searchphrase;
	if($search_itemid) $full_link .= '&Itemid='.$search_itemid;
	
    echo '<li class="advanced_search"><a href="'.$full_link.'" title="Search">'.$text_bottom.'</a></li>';
    ?>
    
    </ul>
</div><span>END</span>