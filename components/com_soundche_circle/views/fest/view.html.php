<?php

/**
 * @version     1.0.0
 * @package     com_soundche_circle
 * @copyright   SoundЧe © 2014. Все права защищены.
 * @license     GNU General Public License версии 2 или более поздней; Смотрите LICENSE.txt
 * @author      Yuri Palii <ypalii2012@gmail.com> - http://
 */
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View to edit
 */
class Soundche_circleViewFest extends JView {


    protected $item;

    protected $params;

    /**
     * Display the view
     */
    public function display($tpl = null) {
        
		$app	= JFactory::getApplication();

        $items = $this->get('Items');
        $this->params = $app->getParams('com_soundche_circle');

        if (isset($_POST['slider'])) {
            $current_year = $_POST['slider'];
            $_SESSION['cur_year'] = $_POST['slider'];
        } elseif (!empty($_SESSION['cur_year'])) {
            $current_year  = $_SESSION['cur_year'];
        } else  {
            $current_year = date('Y');
        }

        foreach ($items as $row) {
            if ($current_year == date('Y', strtotime($row->date))) {


                $video_id = $row->video_category;
            }}


        if (!empty($video_id)) {


            $db = JFactory::getDbo();
            $query = $db->getQuery(true);

            $query

                ->select(array('a.*'))
                ->from('#__phocagallery AS a')
                ->where('a.catid = '.$video_id.' ');

            $db->setQuery($query);
            $this->videos = $db->loadObjectList();

        } else {
           $this->video = false;
        }


//        echo '<pre>';
//        var_dump($this->videos);
//        echo '</pre>';
//        exit;



        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }

        $this->item = $items;
        $this->_prepareDocument();

        parent::display($tpl);
    }


	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$app	= JFactory::getApplication();
		$menus	= $app->getMenu();
		$title	= null;

		// Because the application sets a default page title,
		// we need to get it from the menu item itself
		$menu = $menus->getActive();
		if($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		} else {
			$this->params->def('page_heading', JText::_('COM_SOUNDCHE_CIRCLE_DEFAULT_PAGE_TITLE'));
		}
		$title = $this->params->get('page_title', '');
		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}
		$this->document->setTitle($title);

		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
	}        
    
}


?>



