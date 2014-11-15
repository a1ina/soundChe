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

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::core();
?>

<?php $show = false;?>

<div class="content">
    <p class="p_marg">
        На цій сторінці Ви можете залишити оголошення про будь-що, що стосується музики. Ваше оголошення буде опубліковано після прочитання Адміністратором.
            <span id="add_ann" class="hover right  ">   <a class="button margin offer" href="<?php echo JRoute::_('index.php?option=com_soundche_circle&task=board.edit&id=0'); ?>"><?php echo JText::_("Дати оголошеня"); ?></a> </span>
    </p>


    <ul class="c_marg">
<?php foreach ($this->items as $item):?>

<?php if ($item->published == 1 || ($item->published == 0 && JFactory::getUser()->authorise('core.edit.own', ' com_soundche_circle.board.' . $item->id))):
$show = true;?>


                <li>
                    <span class="event"><?php echo JHTML::_('image', $item->photo, 'ALT Картинки'); ?></span>
                    <div class="inf">
                        <h2><?php echo $item->name?>    </h2>
                        <span><?php echo $item->contacts?></span>
                        <p>
                         <?php echo $item->info?>
                        </p>
                    </div>
                </li>


<?php endif;?>

<?php endforeach;?>

    </ul>
</div>

<?php
if (!$show):
    echo JText::_('COM_SOUNDCHE_CIRCLE_NO_ITEMS');
endif;

if ($show): ?>
<div class="pagination">
    <p class="counter">
        <?php //echo $this->pagination->getPagesCounter(); ?>
    </p>
    <?php echo $this->pagination->getPagesLinks(); ?>
</div>
<?php endif; ?>

<?php

$user = JFactory::getUser();
If (!$user->id){?>

    <script type="text/javascript">
        (function($){
            $(document).ready(function(){
                $('#add_ann a').replaceWith( "<span class='not-reg button margin offer'>Додати оголошення</span>" );
            });

        })(jQuery)
    </script>

<?php }
?>

