<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.tooltip');
JHTML::_('behavior.formvalidation');

?>
<form class="form-validate" id="circlesoundche-form"
      action="<?php echo JRoute::_('index.php?option=com_soundche_circle&layout=edit&id=' . (int)$this->item->id); ?>"
      method="post" name="adminForm" >
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_SOUNDCHE_FEST_DETAILS'); ?></legend>
            <ul class="adminformlist">
                <?php foreach ($this->form->getFieldset() as $field): ?>
                    <li><?php echo $field->label;
                        echo $field->input; ?></li>
                <?php endforeach; ?>
            </ul>
        </fieldset>
        <div>
            <input type="hidden" name="task" value="fest.edit"/>
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </div>

</form>



<script type="text/javascript">
    function getScript(url,success) {
        var script = document.createElement('script');
        script.src = url;
        var head = document.getElementsByTagName('head')[0],
            done = false;
        // Attach handlers for all browsers
        script.onload = script.onreadystatechange = function() {
            if (!done && (!this.readyState
                || this.readyState == 'loaded'
                || this.readyState == 'complete')) {
                done = true;
                success();
                script.onload = script.onreadystatechange = null;
                head.removeChild(script);
            }
        };
        head.appendChild(script);
    }
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',function() {
        js = jQuery.noConflict();
        js(document).ready(function(){


            Joomla.submitbutton = function(task)
            {
                if (task == 'fest.cancel') {
                    Joomla.submitform(task, document.getElementById('circlesoundche-form'));
                }
                else{

                    if (task != 'fest.cancel' && document.formvalidator.isValid(document.id('circlesoundche-form'))) {

                        Joomla.submitform(task, document.getElementById('circlesoundche-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
                }
            }
        });
    });
</script>

