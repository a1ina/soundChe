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

/**
 * Soundche_circle helper.
 */
class Soundche_circleHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
        JSubMenuHelper::addEntry(
            JText::_('COM_SOUNDCHE_CIRCLE_TITLE_CIRCLESOUNDCHES'),
            'index.php?option=com_soundche_circle&view=circlesoundches',
            $vName == 'circlesoundches'
        );


        JSubMenuHelper::addEntry(
            JText::_('COM_SOUNDCHE_CIRCLE_TITLE_VKMUSIC'),
            'index.php?option=com_soundche_circle&view=vkmusic',
            $vName == 'VK_music'
        );

        JSubMenuHelper::addEntry(
            JText::_('COM_SOUNDCHE_CIRCLE_TITLE_BOARD'),
            'index.php?option=com_soundche_circle&view=scboards',
            $vName == 'SCBOARDS'
        );
        JSubMenuHelper::addEntry(
            JText::_('COM_SOUNDCHE_CIRCLE_TITLE_TEAM'),
            'index.php?option=com_soundche_circle&view=teams',
            $vName == 'TEAMS'
        );
        JSubMenuHelper::addEntry(
            JText::_('COM_SOUNDCHE_CIRCLE_TITLE_PARTNERS'),
            'index.php?option=com_soundche_circle&view=partners',
            $vName == 'PARTNERS'
        );
        JSubMenuHelper::addEntry(
            JText::_('COM_SOUNDCHE_CIRCLE_TITLE_ABOUT'),
            'index.php?option=com_soundche_circle&view=abouts',
            $vName == 'ABOUT_US'
        );
        JSubMenuHelper::addEntry(
            JText::_('COM_SOUNDCHE_CIRCLE_TITLE_PROJECT_ABOUT'),
            'index.php?option=com_soundche_circle&view=project_abouts',
            $vName == 'PROJECT_ABOUT_US'
        );

        JSubMenuHelper::addEntry(
            JText::_('COM_SOUNDCHE_CIRCLE_TITLE_QUESTS'),
            'index.php?option=com_soundche_circle&view=quests',
            $vName == 'QUESTS'
        );

        JSubMenuHelper::addEntry(
            JText::_('COM_SOUNDCHE_CIRCLE_TITLE_FEST'),
            'index.php?option=com_soundche_circle&view=fests',
            $vName == 'FESTS'
        );


    }

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_soundche_circle';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}
