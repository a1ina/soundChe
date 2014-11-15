<?php
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');


/**
 * HelloWorld Model
 */
class Soundche_circleModelProject_abouts extends JModelList
{


    protected $_item = null;



    public function __construct($config = array()) {

            if (empty($config['filter_fields'])) {

                $config['filter_fields'] = array(
                    'id','a.id',
                    'title','a.title',
                    'duration','a.duration',
                );
            }


        parent::__construct($config);


//        $this->setState('limitstart', JRequest::getUInt('limitstart', 0));
//
//
//        $this->setState('limit', '2');

    }





//
//    public function getPagination()
//    {
//        jimport('joomla.html.pagination');
//        $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));
//        return $this->_pagination;
//    }



    public function getListQuery()
    {

        $user = JFactory::getUser();
        $groups = implode('',$user->getAuthorisedViewLevels());


        //create new query object



        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select($this->getState('list.select','a.*'));
        $query->from($db->quoteName('#__soundche_circle_project_about').' AS a');


        $cpublished = $this->getState('filter.c.published');
        if (is_numeric($cpublished)) {
            $query->where('c.published  = ' . (int) $cpublished );
        }
//
//
//
//        $published = $this->getState('filter.state');
//        if (is_numeric($published)) {
//
//
//            $query->where('a.published  = '.  (int) $published);
//
//        }


        $state = $this->getState('filter.state');
        if (is_numeric($state)){

            $query->where('a.published = ' . (int) $state);

        }

        //filter search

        if ( $this->getState('list.filter') != ''){
            $filter = JString::strtolower($this->getState('list.filter'));
            $filter = $db->quote('%'.$filter.'%',true ) ;
            $query->where('a.title LIKE' . $filter);
        }

        return $query;

    }


    protected function popularState($ordering = null, $direction = null){


        //initialize variables
        $app = JFactory::getApplication();
        $params = JComponentHelper::getParams('com_soundche_circle');

        // limit list
        $limit = $app-> getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit',2);

        $limitstart  = JRequest::getVar('limitstart' ,0,'','int');
        $this->setState('list.start',$limitstart);


        $user = JFactory::getUser();
        if ((!$user->authorise('core.edit.state','com_soundche_circle')) && (!$user->authorise('core.edit','com_soundche_circle'))) {

            $this->setState('filter.state',1);

        };




    }
//
//    public function getItems()   {
//
//        $db = JFactory::getDbo();
//        $query = $db->setQuery($query);
//        $query = "SELECT * FROM #__soundche_circle_board";
//        $db->setQuery($query, $this->getState('limitstart'), $this->getState('limit'));
//        $this->items = $db->loadObjectList();
//        return $this->items;
//
//    }

}



