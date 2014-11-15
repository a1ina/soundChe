<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_joomprosubs
 * @copyright   Copyright (C) 2011 Mark Dexter and Louis Landry. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$id = (int) $this->item->id;
$name = $this->escape(JFactory::getUser()->get('name'));
$title = $this->escape($this->item->title);
$duration = (int) $this->item->duration;
$itemid = JRequest::getInt('Itemid');
?>
<?php if ($id) :?>
	<h1><?php echo JText::sprintf('COM_JOOMPROSUBS_THANK_YOU_NAME', $name)?></h1>
	<p><?php echo JText::sprintf('COM_JOOMPROSUBS_THANK_YOU_TITLE', $title)?></p> 
	<p><?php echo JText::sprintf('COM_JOOMPROSUBS_THANK_YOU_DURATION', $duration)?></p>
<?php else : ?>
	<p><?php echo JText::sprintf('COM_JOOMPROSUBS_THANK_YOU_ERROR')?></p>
<?php endif; ?>
<br/>
<a href="<?php echo JRoute::_('index.php?option=com_joomprosubs&Itemid=' . $itemid); ?>" >
<?php echo JText::_('COM_JOOMPROSUBS_RETURN_TO_LIST')?></a>


