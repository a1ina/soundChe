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
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_soundche_circle/assets/css/soundche_circle.css');
?>
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
                if (task == 'circlesoundche.cancel') {
                    Joomla.submitform(task, document.getElementById('circlesoundche-form'));
                }
                else{
                    
                    if (task != 'circlesoundche.cancel' && document.formvalidator.isValid(document.id('circlesoundche-form'))) {
                        
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

<form action="<?php echo JRoute::_('index.php?option=com_soundche_circle&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="circlesoundche-form" class="form-validate">
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_SOUNDCHE_CIRCLE_LEGEND_CIRCLESOUNDCHE'); ?></legend>
            <ul class="adminformlist">

                				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
				<li><?php echo $this->form->getLabel('state'); ?>
				<?php echo $this->form->getInput('state'); ?></li>
				<li><?php echo $this->form->getLabel('created_by'); ?>
				<?php echo $this->form->getInput('created_by'); ?></li>
				<li><?php echo $this->form->getLabel('title'); ?>
				<?php echo $this->form->getInput('title'); ?></li>
                <li><?php echo $this->form->getLabel('album'); ?>
                <?php echo $this->form->getInput('album'); ?>  </li>
                <li><?php echo $this->form->getLabel('genre'); ?>
				<?php echo $this->form->getInput('genre'); ?></li>
                <li><?php echo $this->form->getLabel('img_category'); ?>
				<?php echo $this->form->getInput('img_category'); ?>  </li>
                <li><?php echo $this->form->getLabel('video_artist'); ?>
				<?php echo $this->form->getInput('video_artist'); ?>  </li>
                <li><?php echo $this->form->getLabel('body'); ?>
				<?php echo $this->form->getInput('body'); ?></li>
				<li><?php echo $this->form->getLabel('img_artist'); ?>
				<?php echo $this->form->getInput('img_artist'); ?></li>


            </ul>

        </fieldset>
    </div>

    <div class="clr"></div>

<?php if (JFactory::getUser()->authorise('core.admin','soundche_circle')): ?>
	<div class="width-100 fltlft">
		<?php echo JHtml::_('sliders.start', 'permissions-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
		<?php echo JHtml::_('sliders.panel', JText::_('ACL Configuration'), 'access-rules'); ?>
		<fieldset class="panelform">
			<?php echo $this->form->getLabel('rules'); ?>
			<?php echo $this->form->getInput('rules'); ?>
		</fieldset>
		<?php echo JHtml::_('sliders.end'); ?>
	</div>
<?php endif; ?>

    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>

    <style type="text/css">
        /* Temporary fix for drifting editor fields */
        .adminformlist li {
            clear: both;
        }
    </style>
</form>