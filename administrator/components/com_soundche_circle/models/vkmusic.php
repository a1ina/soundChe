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
class Soundche_circleModelVkmusic extends JModelList {


    public function getVkowner() {
        // Create a new query object.
        $db = & JFactory::getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(' owner_id ');
        $query->from('#__vkmusic_owner');
        $db->setQuery( $query );
       $this->res=$db->loadObjectList();

        // Join over the users for the checked out user.
//        $query->select('uc.name AS editor');
        print_r($res);
        return        $this->res;
    }


}
