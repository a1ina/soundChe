<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));


?>

<tr>
    <th width="20">
        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
    </th>

    <th width="5">

        <?php echo JHtml::_('grid.sort','JSTATUS','a.published',$listDirn,$listOrder)?>
    </th>

    <th>
        <?php echo JText::_('COM_SOUNDCHE_CIRCLE_HEADING_CREATED_BY'); ?>
    </th>
    <th class="title">
        <?php echo JHtml::_('grid.sort','JGLOBAL_TITLE','a.name',$listDirn,$listOrder)?>
<!---->
<!--        //echo JText::_('COM_SOUNDCHE_CIRCLE_HEADING_NAME'); ?>-->

    </th>
    <th>
        <?php echo JText::_('COM_SOUNDCHE_CIRCLE_HEADING_CONTACTS'); ?>
    </th>
    <th width="700">
        <?php echo JText::_('COM_SOUNDCHE_CIRCLE_HEADING_INFO'); ?>
    </th>
    <th width="100" >
        <?php echo JText::_('COM_SOUNDCHE_CIRCLE_HEADING_PHOTO'); ?>
    </th>
</tr>