<?php
/**
 * TagCloud Module Entry Point
 * 
 * @package    Joomla 1.5.0
 * @subpackage Modules
 * @license        GNU/GPL, see LICENSE.php
 * mod_tagcloud is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
 
// include the helper file
require_once(dirname(__FILE__).DS.'helper.php');

$text = $params->get('text');
$text_bottom = $params->get('text_bottom');
$no_results = $params->get('no_results');
$category = $params->get('category');
$searchphrase = $params->get('searchphrase');
$ordering = $params->get('ordering');
$limit = $params->get('limit');
$moduleclass_sfx = $params->get('moduleclass_sfx');
$width_input = $params->get('width_input',150);
$width_suggestions = $params->get('width_suggestions',280);
$delay_timer = $params->get('delay_timer',500);

$document	=& JFactory::getDocument();
$document->addStyleSheet(JURI::root().'modules/mod_ajaxsearch/css/ajaxsearch.css');

 
// include the template for display
require(JModuleHelper::getLayoutPath('mod_ajaxsearch'));

?>

			
				