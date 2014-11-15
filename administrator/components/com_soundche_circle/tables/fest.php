<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

/**
 * Hello Table class
 */
class Soundche_circleTableFest extends JTable
{
    /**
     * Constructor
     *
     * @param object Database connector object
     */

    public function check() {
        if (property_exists($this, 'ordering') && $this->id == 0) {
            $this->ordering = self::getNextOrder();
        }
        $this->partner = implode(',',$this->partner);
        return parent::check();
    }


    function __construct(&$db)

    {
        parent::__construct('#__soundche_circle_fest', 'id', $db);
    }
}