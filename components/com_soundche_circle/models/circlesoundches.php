<?php

/**
 * @version     1.0.0
 * @package     com_soundche_circle
 * @copyright   SoundЧe © 2014. Все права защищены.
 * @license     GNU General Public License версии 2 или более поздней; Смотрите LICENSE.txt
 * @author      Yuri Palii <ypalii2012@gmail.com> - http://
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Soundche_circle records.
 */
class Soundche_circleModelCirclesoundches extends JModelList
{

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
        // Set the pagination request variables
        $this->setState('limit', JRequest::getVar('limit', 6, '', 'int'));
        $this->setState('limitstart', JRequest::getVar('limitstart', 0, '', 'int'));
        // echo JRequest::getVar('limitstart');


    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since    1.6
     */
    protected function populateState($ordering = null, $direction = null)
    {

        // Initialise variables.
        $app = JFactory::getApplication();

        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);

        $limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
        $this->setState('list.start', $limitstart);


        if (empty($ordering)) {
            $ordering = 'a.ordering';
        }

        // List state information.
        parent::populateState($ordering, $direction);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return    JDatabaseQuery
     * @since    1.6
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $this->getState(
                'list.select', 'a.*'
            )
        );

        $query->from('`#__soundche_circle_` AS a');
        $query->where($db->quoteName('state') . " = " . $db->quote('1'));


//		// Join over the created by field 'created_by'
//		$query->select('created_by.name AS created_by');
//		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');
//
//
//        // Filter by search in title
//        $search = $this->getState('filter.search');
//        if (!empty($search)) {
//            if (stripos($search, 'id:') === 0) {
//                $query->where('a.id = ' . (int) mb_substr($search, 3));
//            } else {
//                $search = $db->Quote('%' . $db->escape($search, true) . '%');
//                $query->where('( a.title LIKE '.$search.'  OR  a.genre LIKE '.$search.' )');
//            }
//        }


        return $query;
    }

    public function getPagination()
    {
        jimport('joomla.html.pagination');
        $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));
        return $this->_pagination;
    }


    public function getGenre($gid)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__soundche_circle_genre');
        $query->where($db->quoteName('genre_id') . " = " . $db->quote($gid));
        $db->setQuery($query);
        $this->genre = $db->loadObject();

        return $this->genre;

    }


    public function getItems()
    {

    $items = parent::getItems();
        return $items;

    }

}
