<?php
/**
 * @version     1.0.0
 * @package     com_soundche_circle
 * @copyright   SoundЧe © 2014. Все права защищены.
 * @license     GNU General Public License версии 2 или более поздней; Смотрите LICENSE.txt
 * @author      Yuri Palii <ypalii2012@gmail.com> - http://
 */


// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHTML::_('script','system/multiselect.js',false,true);
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_soundche_circle/assets/css/soundche_circle.css');


?>

<form action="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=vkmusic'); ?>" method="post" name="adminForm" id="adminForm">




	<div class="clr"> </div>


</form>