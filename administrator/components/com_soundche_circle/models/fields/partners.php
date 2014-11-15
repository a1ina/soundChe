<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldPartners extends JFormField {

    protected $type = 'Partners';

    // getLabel() left out

    public function getInput() {
        $partner = array();

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__soundche_circle_partners');
        $db->setQuery($query);
        $result = $db->loadObjectList();
        $partner[] = '<select multiple id="'.$this->id.'" name="'.$this->name.'">';
        $partner[] = '<option multiple="multiple" value="0">'.JText::_('COM_SOUNDCHE_CIRCLE_SELECT_PARTNER').'</option>';
        foreach ($result as $item ) {
            $partner[] =  '<option value="'.$item->id.'" >'.$item->name.'</option>';
        }

        $partner[] = '</select>';
    return implode($partner);


    }


}