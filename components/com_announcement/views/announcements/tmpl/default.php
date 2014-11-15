<?php
/**
 * @version     1.0.0
 * @package     com_announcement
 * @copyright   © 2013. Все права защищены.
 * @license     GNU General Public License версии 2 или более поздней; Смотрите LICENSE.txt
 * @author      Yuri <y-palii@mail.ru> - http://
 */
// no direct access
defined('_JEXEC') or die;

require_once (JPATH_SITE.DS.'libraries'.DS.'joomla'.DS.'html'.DS.'html.php');

?>
<script type="text/javascript" xmlns="http://www.w3.org/1999/html">
    function deleteItem(item_id) {
        if (confirm("<?php echo JText::_('COM_ANNOUNCEMENT_DELETE_MESSAGE'); ?>")) {
            document.getElementById('form-announcement-delete-' + item_id).submit();
        }
    }
</script>

<div class="content">
    <!---->
    <!--    --><?php //if (JFactory::getUser()->authorise('core.create', 'com_announcement')): ?><!--<a-->
    <!--        href="-->
    <?php //echo JRoute::_('index.php?option=com_announcement&task=announcement.edit&id=0'); ?><!--">-->
    <?php //echo JText::_("COM_ANNOUNCEMENT_ADD_ITEM"); ?><!--</a>-->
    <!--    --><?php //endif; ?>
    <ul class="border">
        <?php $show = false; ?>
        <?php foreach ($this->items as $item) : ?>


            <?php
            if ($item->state == 1 || ($item->state == 0 && JFactory::getUser()->authorise('core.edit.own', ' com_announcement.announcement.' . $item->id))):
                $show = true;
                ?>
                <li>
                    <a href="<?php echo JRoute::_('index.php?option=com_announcement&view=announcement&id=' . (int)$item->id); ?>"
                       class="event">  <?php echo "<img src=" . $item->image . ">"; ?> </a>

                    <div class="inf">
                        <h2>
                            <a href="<?php echo JRoute::_('index.php?option=com_announcement&view=announcement&id=' . (int)$item->id); ?>"><?php echo $item->title ?> </a>
                        </h2>
                        <span> <?php echo JHtml::_('date',$item->date,JText::_('d F Y, H:i')) ; ?></span>

                        <p>    <?php echo

                                mb_substr($item->description, 0, 500, 'UTF-8') . "..."; ?></p>
                        <div>
                            <a class="readmore"
                               href="<?php echo JRoute::_('index.php?option=com_announcement&view=announcement&id=' . (int)$item->id); ?>">Докладніше...</a>
                        </div>
                    </div>

                </li>

<!--                --><?php
//                if (JFactory::getUser()->authorise('core.edit.state', 'com_announcement.announcement.' . $item->id)):
//                    ?>
<!--                    <a href="javascript:document.getElementById('form-announcement-state---><?php //echo $item->id; ?><!--').submit()">--><?php //if ($item->state == 1): echo JText::_("COM_ANNOUNCEMENT_UNPUBLISH_ITEM");
//                        else: echo JText::_("COM_ANNOUNCEMENT_PUBLISH_ITEM"); endif; ?><!--</a>-->
<!--                    <form id="form-announcement-state---><?php //echo $item->id ?><!--" style="display:inline"-->
<!--                          action="--><?php //echo JRoute::_('index.php?option=com_announcement&task=announcement.save'); ?><!--"-->
<!--                          method="post"-->
<!--                          class="form-validate" enctype="multipart/form-data">-->
<!--                        <input type="hidden" name="jform[id]" value="--><?php //echo $item->id; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[ordering]" value="--><?php //echo $item->ordering; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[state]" value="--><?php //echo (int)!((int)$item->state); ?><!--"/>-->
<!--                        <input type="hidden" name="jform[checked_out]" value="--><?php //echo $item->checked_out; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[checked_out_time]"-->
<!--                               value="--><?php //echo $item->checked_out_time; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[title]" value="--><?php //echo $item->title; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[date]" value="--><?php //echo $item->date; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[image]" value="--><?php //echo $item->image; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[description]" value="--><?php //echo $item->description; ?><!--"/>-->
<!--                        <input type="hidden" name="option" value="com_announcement"/>-->
<!--                        <input type="hidden" name="task" value="announcement.save"/>-->
<!--                        --><?php //echo JHtml::_('form.token'); ?>
<!--                    </form>-->
<!---->
<!---->
<!---->
<!---->
<!--                --><?php
//                endif;
//                if (JFactory::getUser()->authorise('core.delete', 'com_announcement.announcement.' . $item->id)):
//                    ?>
<!--                    <a href="javascript:deleteItem(--><?php //echo $item->id; ?><!--);">--><?php //echo JText::_("COM_ANNOUNCEMENT_DELETE_ITEM"); ?><!--</a>-->
<!--                    <form id="form-announcement-delete---><?php //echo $item->id; ?><!--" style="display:inline"-->
<!--                          action="--><?php //echo JRoute::_('index.php?option=com_announcement&task=announcement.remove'); ?><!--"-->
<!--                          method="post"-->
<!--                          class="form-validate" enctype="multipart/form-data">-->
<!--                        <input type="hidden" name="jform[id]" value="--><?php //echo $item->id; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[ordering]" value="--><?php //echo $item->ordering; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[state]" value="--><?php //echo $item->state; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[checked_out]" value="--><?php //echo $item->checked_out; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[checked_out_time]"-->
<!--                               value="--><?php //echo $item->checked_out_time; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[created_by]" value="--><?php //echo $item->created_by; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[title]" value="--><?php //echo $item->title; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[date]" value="--><?php //echo $item->date; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[image]" value="--><?php //echo $item->image; ?><!--"/>-->
<!--                        <input type="hidden" name="jform[description]" value="--><?php //echo $item->description; ?><!--"/>-->
<!--                        <input type="hidden" name="option" value="com_announcement"/>-->
<!--                        <input type="hidden" name="task" value="announcement.remove"/>-->
<!--                        --><?php //echo JHtml::_('form.token'); ?>
<!--                    </form>-->
<!--                --><?php
//                endif;
//                ?>

            <?php endif; ?>

        <?php endforeach; ?>


        <?php
        if (!$show):
            echo JText::_('COM_ANNOUNCEMENT_NO_ITEMS');
        endif;
        ?>
</div>
</ul>

<?php //if ($show): ?>
<div class="pagination">
    <p class="counter">
        <?php //echo $this->pagination->getPagesCounter(); ?>
    </p>
    <?php echo $this->pagination->getPagesLinks(); ?>
</div>
<?php // endif; ?>

