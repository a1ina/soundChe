<?php
(defined('_VALID_MOS') OR defined('_JEXEC')) or die;
 
class jc_com_soundche_circle extends JCommentsPlugin {
 
  function getObjectTitle( $id ) {
    
    $db = & JCommentsFactory::getDBO();
    // Загрузка из базы данных имени по заданному id 
    $db->setQuery( "SELECT title FROM #__phocagallery WHERE id='$id'");
    return $db->loadResult();
  }
 
  function getObjectLink( $id ) {

    // Значение Itemid для нашего компонента
    $_Itemid = JCommentsPlugin::getItemid( 'com_soundche_circle' );

    // создание ссылки для данного объекта по id
      $link = JRoute::_( 'index.php?option=com_soundche_circle&task=view&id='. $id .'&Itemid='. $_Itemid );

    return $link;
  }
 
  function getObjectOwner( $id ) {
    
    $db = & JCommentsFactory::getDBO();
    $db->setQuery( "SELECT userid FROM #__phocagallery WHERE id='$id'");
    return $db->loadResult();
  }
}
?>