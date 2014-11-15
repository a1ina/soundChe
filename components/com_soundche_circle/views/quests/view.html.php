<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');


class Soundche_circleViewQuests extends JView {

    // Overwriting JView display method
    function display($tpl = null)
    {
        // Assign data to the view
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');


        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('catid','title','videocode','filename','id'));
        $query->from($db->quoteName('#__phocagallery'));
        $query->where($db->quoteName('published')." = ".$db->quote('1'));
        $db->setQuery($query);
        $this->phoca = $db->loadObjectList();


        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
            return false;
        }
        // Display the view
        parent::display($tpl);
    }
}