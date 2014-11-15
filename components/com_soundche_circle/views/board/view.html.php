<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');


class Soundche_circleViewBoard extends JView
{


    protected $state;
    protected $items;
    protected $pagination;

    // Overwriting JView display method
    function display($tpl = null)
    {

        $app = JFactory::getApplication();
        $params = $app->getParams();

        // Assign data to the view
        $items = $this->get('Items');
        $state = $this->get('State');
        $pagination = $this->get('Pagination');


        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
            return false;
        }

        $this->items = $items;
        $this->state = $state;
        $this->pagination = $pagination;


        //$this->_prepareDocument();


        // Display the view
        parent::display($tpl);
    }


}