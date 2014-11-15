<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');

/**
 * HelloWorldList Model
 */
class Soundche_circleModelAbouts extends JModelList
{
    /**
     * Method to build an SQL query to load the list data.
     *
     * @return      string  An SQL query
     */

    public function __construct($config = array())
    {

        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'name', 'a.name',
                'published', 'a.published',
                'description', 'a.description',
                'access', 'a.access',
                'created', 'a.create',
                'create_by', 'a.create_by',
            );
        }
        parent::__construct($config);
    }

    protected function populateState($ordering = null, $direction = null)
    {

        //initialize variables
        $app = JFactory::getApplication('administrator');

        // load filter condition

        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        $accessId = $this->getUserStateFromRequest($this->context . '.filter.access', 'filter_access', null, 'int');
        $this->setState('filter.access', $accessId);

        $published = $this->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
        $this->setState('filter.state', $published);

        //load params
        $params = JComponentHelper::getParams('com_soundche_circle');
        $this->setState('params', $params);

        parent::populateState('a.name', 'asc');
    }

    protected function getStoreId($id = '')
    {

        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.access');
        $id .= ':' . $this->getState('filter.state');

        return parent::getStoreId($id);
    }


    protected function getListQuery()
    {
        // Create a new query object.
        $db		= $this->getDbo();
        $query	= $db->getQuery(true);

        // Select the required fields from the table.
        $query->select('a.*');
        $query->from($db->quoteName('#__soundche_circle_about_us').' AS a');

//        // Filter by access level.
        if ($access = $this->getState('filter.access')) {
            $query->where('a.access = '.(int) $access);
        }

        // Filter by published state
        $published = $this->getState('filter.state');
        if (is_numeric($published)) {
            $query->where('a.published = '.(int) $published);
        } else if ($published === '') {
            $query->where('(a.published IN (0, 1))');
        }

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = '.(int) substr($search, 3));
            } else {
                $search = $db->Quote('%'.$db->getEscaped($search, true).'%');
                $query->where('(a.name LIKE '.$search.')');
            }
        }



        // Add the list ordering clause.
        $orderCol	= $this->state->get('list.ordering');
        $orderDirn	= $this->state->get('list.direction');
        $query->order($db->getEscaped($orderCol.' '.$orderDirn));

        return $query;
    }
}