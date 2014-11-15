<?php
/**
 * @subpackage	com_joomprosubs
 * @copyright	Copyright (C) 2011 Mark Dexter and Louis Landry. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
// Code to support edit links for joomaprosubs
// Create a shortcut for params.

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::core();

// Get the user object.
$user = JFactory::getUser();
// Check if user is allowed to add/edit based on joomprosubs permissions.
$canEdit = $user->authorise('core.edit', 'com_joomprosubs.category.' . $this->category->id);

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$listFilter = $this->state->get('list.filter');
?>

<?php if (empty($this->items) && ($listFilter == '')) : ?>
	<p> <?php echo JText::_('COM_JOOMPROSUBS_NO_JOOMPROSUBS'); ?></p>
<?php else : ?>

<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" 
	method="post" name="adminForm" id="adminForm">
	<fieldset class="filters">
	<legend class="hidelabeltxt"><?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?></legend>
	<div class="filter-search">
		<label class="filter-search-lbl" for="filter-search"
			><?php echo JText::_('COM_JOOMPROSUBS_FILTER_LABEL').'&#160;'; ?></label>
		<input type="text" name="filter-search" id="filter-search" 
			value="<?php echo $this->escape($this->state->get('list.filter')); ?>" 
			class="inputbox" onchange="document.adminForm.submit();" 
			title="<?php echo JText::_('COM_CONTENT_FILTER_SEARCH_DESC'); ?>" />
	</div>
	<div class="display-limit">
		<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>&#160;
		<?php echo $this->pagination->getLimitBox(); ?>
	</div>
	</fieldset>

	<table class="category">
		<thead><tr>
			<th class="title">
				<?php echo JHtml::_('grid.sort',  'COM_JOOMPROSUBS_GRID_TITLE', 
					'a.title', $listDirn, $listOrder); ?>
			</th>
			<th class="group">
				<?php echo JHtml::_('grid.sort', 'COM_JOOMPROSUBS_GRID_GROUP', 
					'g.title', $listDirn, $listOrder); ?>
			</th>
			<th class="duration">
				<?php echo JHtml::_('grid.sort', 'COM_JOOMPROSUBS_GRID_DURATION', 
					'a.duration', $listDirn, $listOrder); ?>
			</th>
		</tr></thead>
	<tbody>
	<?php foreach ($this->items as $i => $item) : ?>
		<tr class="cat-list-row<?php echo $i % 2; ?>" >
		<td class="title">
			<?php if ($canEdit) : ?>
				<a href="<?php echo JRoute::_('index.php?option=com_joomprosubs&task=subscription.edit&sub_id='.$item->id.'&catid='.$item->catid); ?>">
				<?php echo $item->title; ?></a>
			<?php else: ?>
				<?php echo $item->title;?>
			<?php endif; ?>
			<?php if ($this->params->get('show_description')) : ?>
				<?php echo nl2br($item->description); ?>
			<?php endif; ?>
		</td>
		<td class="item-group">
			<?php echo $item->group_title; ?>
		</td>	
		<td class="item-duration">
			<?php echo $item->duration; ?>
		</td>		
		</tr>
	<?php endforeach; ?>
</tbody>
</table>
<div class="pagination">
	<p class="counter">
	<?php echo $this->pagination->getPagesCounter(); ?>
	</p>
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
<div>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
</div>
</form>
<?php endif; ?>