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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_soundche_circle', JPATH_ADMINISTRATOR);
?>

<!-- Styling for making front end forms look OK -->
<!-- This should probably be moved to the template CSS file -->
<style>
    .front-end-edit ul {
        padding: 0 !important;
    }
    .front-end-edit li {
        list-style: none;
        margin-bottom: 6px !important;
    }
    .front-end-edit label {
        margin-right: 10px;
        display: block;
        float: left;
        text-align: center;
        width: 200px !important;
    }
    .front-end-edit .radio label {
        float: none;
    }
    .front-end-edit .readonly {
        border: none !important;
        color: #666;
    }
    .front-end-edit #editor-xtd-buttons {
        height: 50px;
        width: 600px;
        float: left;
    }
    .front-end-edit .toggle-editor {
        height: 50px;
        width: 120px;
        float: right;
    }

    #jform_rules-lbl{
        display:none;
    }

    #access-rules a:hover{
        background:#f5f5f5 url('../images/slider_minus.png') right  top no-repeat;
        color: #444;
    }

    fieldset.radio label{
        width: 50px !important;
    }
</style>
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
            js('#form-board').submit(function(event){

            });


        });
    });

</script>

<div class="board-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit <?php echo $this->item->id; ?></h1>
    <?php else: ?>
        <h1>Add</h1>
    <?php endif; ?>

    <form id="form-board" action="<?php echo JRoute::_('index.php?option=com_soundche_circle&task=board.save'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
        <ul>
            <li><?php echo $this->form->getLabel('id'); ?>
                <?php echo $this->form->getInput('id'); ?></li>
            <?php $canState = false; ?>
            <?php if($this->item->id): ?>
                <?php $canState = $canState = JFactory::getUser()->authorise('core.edit.state','com_soundche_circle.board'); ?>
            <?php else: ?>
                <?php $canState = JFactory::getUser()->authorise('core.edit.state','com_soundche_circle.board.'.$this->item->id); ?>
            <?php endif; ?>				<?php if(!$canState): ?>
                <li><?php echo $this->form->getLabel('state'); ?>
                    <?php
                    $state_string = 'Unpublish';
                    $state_value = 0;
                    if($this->item->state == 1):
                        $state_string = 'Publish';
                        $state_value = 1;
                    endif;
                    echo $state_string; ?></li>
                <input type="hidden" name="jform[state]" value="<?php echo $state_value; ?>" />				<?php else: ?>					<li><?php echo $this->form->getLabel('state'); ?>
                <?php echo $this->form->getInput('state'); ?></li>
            <?php endif; ?>				<li><?php echo $this->form->getLabel('created_by'); ?>
                <?php echo $this->form->getInput('created_by'); ?></li>
            <li><?php echo $this->form->getLabel('name'); ?>
                <?php echo $this->form->getInput('name'); ?></li>
            <li><?php echo $this->form->getLabel('contacts'); ?>
                <?php echo $this->form->getInput('contacts'); ?></li>
            <li><?php echo $this->form->getLabel('info'); ?>
                <?php echo $this->form->getInput('info'); ?></li>
            <li><?php echo $this->form->getLabel('photo'); ?>
                <?php echo $this->form->getInput('photo'); ?></li>
            <div class="width-100 fltlft" <?php if (!JFactory::getUser()->authorise('core.admin','soundche_circle')): ?> style="display:none;" <?php endif; ?> >
                <?php echo JHtml::_('sliders.start', 'permissions-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
                         </div>
            <?php if (!JFactory::getUser()->authorise('core.admin','soundche_circle')): ?>
                <script type="text/javascript">
                    jQuery.noConflict();
                    jQuery('#rules select').each(function(){
                        var option_selected = jQuery(this).find(':selected');
                        var input = document.createElement("input");
                        input.setAttribute("type", "hidden");
                        input.setAttribute("name", jQuery(this).attr('name'));
                        input.setAttribute("value", option_selected.val());
                        console.log(input);
                        document.getElementById("form-board").appendChild(input);
                        jQuery(this).attr('disabled',true);
                    });
                </script>
            <?php endif; ?>
        </ul>

        <div class="send">
            <button type="submit" class="validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>

            <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&task=board.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>

            <input type="hidden" name="option" value="com_soundche_circle" />
            <input type="hidden" name="task" value="boardform.save" alt="save" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </form>
</div>
