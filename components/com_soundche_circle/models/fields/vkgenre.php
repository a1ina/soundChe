<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldVkgenre extends JFormField {

    protected $type = 'Vkgenre';

    // getLabel() left out

    public function getInput() {
        $genre = array();

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__soundche_circle_genre');
        $db->setQuery($query);
        $result = $db->loadObjectList();

        $options = array();

        foreach ($result as $item ) {
            $options[$item->genre_id] =$item->title;
        }

        return JHtml::_('select.genericlist', $options, $this->name, null, 'value', 'text', $this->value, $this->id);


    }


}