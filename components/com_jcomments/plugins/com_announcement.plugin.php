<?php
(defined('_VALID_MOS') OR defined('_JEXEC')) or die;

class jc_com_announcement extends JCommentsPlugin {

    function getObjectTitle( $id ) {

        $db = JFactory::getDBO();
        // Загрузка из базы данных имени по заданному id
        $db->setQuery( "SELECT title FROM #__announcement WHERE id='$id'");
        return $db->loadResult();
    }

    function getObjectLink( $id ) {

        // Значение Itemid для нашего компонента
        $_Itemid = JCommentsPlugin::getItemid( 'com_announcement' );

        // создание ссылки для данного объекта по id
        $link = JRoute::_( 'index.php?option=com_announcement&task=view&id='. $id .'&Itemid='. $_Itemid );
        return $link;
    }

    function getObjectOwner( $id ) {

        $db = JFactory::getDBO();
        $db->setQuery( "SELECT created_by FROM #__announcement WHERE id='$id'");
        return $db->loadResult();
    }
}
?>