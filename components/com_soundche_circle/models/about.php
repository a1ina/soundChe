<?php
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');


/**
 * HelloWorld Model
 */
class Soundche_circleModelAbout extends JModelList
{


    public function __construct($config = array()) {

        parent::__construct($config);



    }





    public function getListQuery()
    {


        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__soundche_circle_about_us'));
        $query->where($db->quoteName('published')." = ".$db->quote('1'));

        return $query;

    }


}



