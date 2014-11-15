<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHTML::_('behavior.formvalidation');
?>
<form class="form-validate"
      action="<?php echo JRoute::_('index.php?option=com_soundche_circle&layout=edit&id=' . (int)$this->item->id); ?>"
      method="post" name="adminForm" id="adminForm">
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_SOUNDCHE_PROJECT_ABOUT_DETAILS'); ?></legend>
            <ul class="adminformlist">
                <?php foreach ($this->form->getFieldset() as $field): ?>
                    <li><?php echo $field->label;
                        echo $field->input; ?></li>
                <?php endforeach; ?>
            </ul>
        </fieldset>
        <div>
            <input type="hidden" name="task" value="project_about.edit"/>
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </div>
</form>