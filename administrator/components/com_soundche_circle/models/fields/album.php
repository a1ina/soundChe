<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldAlbum extends JFormField {

    protected $type = 'Album';

    // getLabel() left out

    public function getInput() {
        $album = array();

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__vkmusic_albums');
        $db->setQuery($query);
        $res = $db->loadObjectList();


        $options = array();
        foreach ($res as $key => $item ) {
            $options[$item->aid] = $item->title;
        }

        return JHtml::_('select.genericlist', $options, $this->name, null, 'value', 'text', $this->value, $this->id);


    }


}