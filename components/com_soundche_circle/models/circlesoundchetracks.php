<?php
/**
 * @version     1.0.0
 * @package     com_soundche_circle
 * @copyright   SoundЧe © 2014. Все права защищены.
 * @license     GNU General Public License версии 2 или более поздней; Смотрите LICENSE.txt
 * @author      Yuri Palii <ypalii2012@gmail.com> - http://
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');
jimport('joomla.html.pagination');
jimport('vkapi.init');

/**
 * Soundche_circle model.
 */
class Soundche_circleModelCirclesoundchetracks extends JModelForm
{
    
    var $_item = null;
    var $_pagination = null;
    var $_total = null;

    function __construct()
    {
        parent::__construct();
        // Set the pagination request variables
        $this->setState('limit', JRequest::getVar('limit', 15, '', 'int'));
        $this->setState('limitstart', JRequest::getVar('limitstart', 0, '', 'int'));
    }

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication('com_soundche_circle');

		// Load state from the request userState on edit or from the passed variable on default
        if (JFactory::getApplication()->input->get('layout') == 'edit') {
            $id = JFactory::getApplication()->getUserState('com_soundche_circle.edit.circlesoundche.id');
        } else {
            $id = JFactory::getApplication()->input->get('id');
            JFactory::getApplication()->setUserState('com_soundche_circle.edit.circlesoundche.id', $id);
        }
		$this->setState('circlesoundche.id', $id);

		// Load the parameters.
		$params = $app->getParams();
        $params_array = $params->toArray();
        if(isset($params_array['item_id'])){
            $this->setState('circlesoundche.id', $params_array['item_id']);
        }
		$this->setState('params', $params);

	}
        

	/**
	 * Method to get an ojbect.
	 *
	 * @param	integer	The id of the object to get.
	 *
	 * @return	mixed	Object on success, false on failure.
	 */
	public function &getData($id = null)
	{
		if ($this->_item === null)
		{
            $VK = new vkapi();

            $resp = $VK->api('audio.get',
                array(
                    'owner_id' => '-29836620',
                    'count'    => $this->getState('limit'),
                    'offset'   => $this->getState('limitstart'),
                )
            );

            $audio = $resp->audio;
            $this->_total = $resp->count;
            $this->_item = $audio;
		}

		return $this->_item;
	}

    public function getTotal(){
        return $this->_total;
    }

    public function getPagination(){
        $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'),  $this->getState('limit'));
        return $this->_pagination;
    }

	public function getTable($type = 'Circlesoundche', $prefix = 'Soundche_circleTable', $config = array())
	{   
        $this->addTablePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');
        return JTable::getInstance($type, $prefix, $config);
	}     

    

	/**
	 * Method to get the profile form.
	 *
	 * The base form is loaded from XML 
     * 
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_soundche_circle.circlesoundche', 'circlesoundche', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		$data = $this->getData(); 
        
        return $data;
	}


    
}