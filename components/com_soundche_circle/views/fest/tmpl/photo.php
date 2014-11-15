<?php

// no direct access
defined('_JEXEC') or die;


//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_soundche_circle', JPATH_ADMINISTRATOR);


?>
<div class="sidebar">
    <ul>
        <li><a  href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=fest')?>" >Програма фесту</a></li>
        <li><a class="now" href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=fest&layout=photo')?>">Фото</a></li>
        <li><a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=fest&layout=video')?>">Відео</a></li>
        <li><a   href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=partners&layout=partner')?>">Патртнери</a></li>
    </ul>
</div>


    <div id="gallery" class="content">

    <ul class="year_slider">
        <li>2011</li>
        <li>2012</li>
        <li>2013</li>
        <li>2014</li>
        <li>2015</li>
        <li>2016</li>
    </ul>

    <form id="slider_form" name="slider_form"
          action="<?php echo JURI::base() ?>index.php?option=com_soundche_circle&view=fest&layout=photo&Itemid=124"
          method="post">
        <input name="slider" type="text" id="amount" style="border:0; visibility: hidden; color:#f6931f; font-weight:bold;">
        <input type="submit" value="submit" style="visibility: hidden">
    </form>


    <div id="slider"></div>


    <?php
    if (isset($_POST['slider'])) {
        $current_year = $_POST['slider'];
        $_SESSION['cur_year'] = $_POST['slider'];
    } elseif (!empty($_SESSION['cur_year'])) {
        $current_year  = $_SESSION['cur_year'];
    } else  {
        $current_year = date('Y');
    }

   if ($this->item) :


    foreach ($this->item as $row):

        if ($current_year == date('Y', strtotime($row->date))) {

            ?>

                <ul class="c_marg">


                    <li>
<?php echo JHTML::_('content.prepare', '   {phocagallery view=category|categoryid=' . $row->img_category . '|displaycommentimg=1| limitstart=0|limitcount=10|detail=5|displayname=0| displaydetail=1|displaydownload=0|imageshadow=shadow1|displaybuttons=1}'); ?>

                    </li>
                </ul>

            </div>


        <?php


      //  }
//        else {
//
//            if($i < 1) {
//                $i=0;
//                echo '<div class="no_content">';
//                echo JText::_('Контент відсутній!');
//                echo '</div>';
//                $i++;
//            }

     };
    endforeach;

else:
    echo JText::_('COM_SOUNDCHE_CIRCLE_ITEM_NOT_LOADED');
endif;



?>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


<script>
    $(function () {
        $("#slider").slider({
            value:<?php echo $current_year?>,
            min: 2011,
            max: 2016,
            step: 1,
            slide: function (event, ui) {
                $("#amount").val(+ui.value);
            },
            change: function (event, ui) {

                $("#slider_form").submit();

            }

        });

        $("#amount").val($("#slider").slider("value"));
    });
</script>
