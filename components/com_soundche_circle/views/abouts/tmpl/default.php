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
?>


<?php $show = false;?>

<div class="content">
<?php foreach ($this->items as $item):?>

    <?php if ($item->published == 1 || ($item->published == 0 && JFactory::getUser()->authorise('core.edit.own', ' com_soundche_circle.about.' . $item->id))):
        $show = true;?>



            <ul class="press">
                <li>

                    <div class="inf">
                        <h2><a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=about&id=' . (int)$item->id);?>"><?php echo $item->name?></a></h2>

                        <p>
                            <?php echo $item->description?>
                        </p>
                    </div>
                </li>
            </ul>


    <?php endif;?>

<?php endforeach;?>

</div>
<!---->
<!---->
<!--<pre>--><?php
//
//    print_r($this->items)
//    ?><!--</pre>-->
<!---->
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

