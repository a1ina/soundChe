<?php
/**
 * @version   $Id: totop.php 2487 2012-08-17 22:04:06Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */

defined('JPATH_BASE') or die();
$lang = JFactory::getLanguage();
$lang->load('com_gantry_gantrified', JPATH_ADMINISTRATOR);

require_once (JPATH_SITE . '/libraries/gantry/gantry.php');

gantry_import('core.gantryfeature');

/**
 * @package     gantry
 * @subpackage  features
 */
class GantryFeatureGantrified extends GantryFeature
{
	var $_feature_name = 'gantrified';

	public static function getModSuffixMain()
	{
		/** @var $gantry Gantry */
		global $gantry;

		if ($gantry->get('gantrified-enabled')) {
			$modSuffixMain	= $gantry->get('gantrified-suffixmain') ;
		}
		return $modSuffixMain;
	}

	public static function getModSuffixAlt()
	{
		global $gantry;

		if($gantry->get('gantrified-suffixalt') != '') {
			$modSuffixAlt = $gantry->get('gantrified-suffixalt') ;
		} else {
			$modSuffixAlt = NULL;
		}
		return $modSuffixAlt;
	}

	// main body style detection - light or dark, not used, just a sample how to read Gantry params
	/* public static function getMainBodyStyle()
	{
		global $gantry;

		if($gantry->get('main-body') != '') {
			$mainBodyStyle = $gantry->get('main-body') ;
		}
			//echo '<div class="modSuffixMain">'.'mainBodyStyle: '.$mainBodyStyle.'</div>' ;
		return $mainBodyStyle;
	} */
}