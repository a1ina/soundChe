<?php
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');


/**
 * HelloWorld Model
 */
class Soundche_circleModelPartners extends JModelList
{


    public function __construct($config = array()) {

        parent::__construct($config);


        $this->setState('limitstart', JRequest::getUInt('limitstart', 0));


        $this->setState('limit', '200');

    }




    public function getPagination()
    {
        jimport('joomla.html.pagination');
        $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));
        return $this->_pagination;
    }



    public function getListQuery()
    {


        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__soundche_circle_partners'));
        $query->where($db->quoteName('published')." = ".$db->quote('1'));

        return $query;

    }


    public function getItems()   {

        $db = JFactory::getDbo();
        $query = $db->setQuery($query);
        $query = "SELECT * FROM #__soundche_circle_partners";
        $db->setQuery($query, $this->getState('limitstart'), $this->getState('limit'));
        $this->items = $db->loadObjectList();
        return $this->items;

    }

}



