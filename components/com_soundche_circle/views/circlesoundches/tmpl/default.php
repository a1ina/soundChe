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

$doc = JFactory::getDocument();
$doc->addScript('//code.jquery.com/jquery-1.10.2.js');
$app = JFactory::getApplication();
$menu = $app->getMenu()->getActive();

if ($menu->id == 122) {
    echo '

<script type="text/javascript">
    $( ".item-165" ).addClass( "active" );
</script>

    ';
} elseif ($menu->id == 165) {
    echo '

<script type="text/javascript">
    $( ".item-122" ).addClass( "active" );
</script>

    ';
}
?>



<script type="text/javascript">
    function deleteItem(item_id) {
        if (confirm("<?php echo JText::_('COM_SOUNDCHE_CIRCLE_DELETE_MESSAGE'); ?>")) {
            document.getElementById('form-circlesoundche-delete-' + item_id).submit();
        }
    }
</script>
<!---->
<!---->
<!--<form class="searchbar"-->
<!--      action="      --><?php //echo JURI::base() . 'index.php?option=com_soundche_circle&view=circlesoundches&Itemid=166'; ?><!--"-->
<!--      method="post">-->
<!--    <h3>Пошук</h3>-->
<!--    <span>Ім'я</span>-->
<!--    <input type="text" name="artist" class="name_search" size="28" value="--><?php //echo $_POST['artist'] ?><!--">-->
<!--    --><?php
//    $db = JFactory::getDbo();
//    $query = $db->getQuery(true);
//    $query->select(' * ');
//    $query->from('#__soundche_circle_genre');
//    $db->setQuery($query);
//    $genres = $db->loadObjectList();?>
<!--    <span>Жанр</span>-->
<!--    <select name="genre" onchange="">-->
<!--        <option value="">Виберіть жанр</option>-->
<!--        --><?php
//        foreach ($genres as $genre):?>
<!--            <option --><?php //if ($_POST['genre'] == $genre->genre_id) echo 'selected="selected"' ?>
<!--                value="--><?php //echo $genre->genre_id ?><!--">--><?php //echo $genre->title ?><!--</option>-->
<!--        --><?php //endforeach; ?>
<!--    </select>-->
<!---->
<!--    <input type="submit" value="Знайти" class="submit">-->
<!---->
<!--</form>-->
<!---->

<div class="content">

    <ul class="border">
        <?php $show = false; ?>
        <?php foreach ($this->items as $item) : ?>


            <?php


            if ($item->state == 1 || ($item->state == 0 && JFactory::getUser()->authorise('core.edit.own', ' com_soundche_circle.circlesoundche.' . $item->id))):
                $show = true;
                ?>
                <li>
                    <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=circlesoundchebio&id=' . (int)$item->id); ?>"
                       class="event"><?php echo  JHtml::_('image',JURI::base().$item->img_artist,'image');; ?></a>

                    <div class="inf">
                        <h2>
                            <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=circlesoundchebio&id=' . (int)$item->id); ?>"><?php echo $item->title; ?></a>
                        </h2>

                        <?php

                        if ($item->genre > 0) :?>

                            <span>
                                <?php
                                $genre = $this->getModel('Circlesoundches')->getGenre($item->genre)->title;
                                echo $genre;?>
                            </span>
                        <?php
                        endif;
                        ?>

                        <p>    <?php echo

                                mb_substr($item->body, 0, 390, 'UTF-8') . "..."; ?></p>
                        <div>
                            <a class="readmore"
                               href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=circlesoundchebio&id=' . (int)$item->id); ?>">Докладніше...</a>
                        </div>


                    </div>
                    <!--                    --><?php
                    //                    if (JFactory::getUser()->authorise('core.edit.state', 'com_soundche_circle.circlesoundche.' . $item->id)):
                    //
                    ?>
                    <!--                        <a href="javascript:document.getElementById('form-circlesoundche-state--->
                    <?php //echo $item->id; ?><!--').submit()">-->
                    <?php //if ($item->state == 1): echo JText::_("COM_SOUNDCHE_CIRCLE_UNPUBLISH_ITEM");
                    //                            else: echo JText::_("COM_SOUNDCHE_CIRCLE_PUBLISH_ITEM"); endif;
                    ?><!--</a>-->
                    <!--                        <form id="form-circlesoundche-state--->
                    <?php //echo $item->id ?><!--" style="display:inline"-->
                    <!--                              action="-->
                    <?php //echo JRoute::_('index.php?option=com_soundche_circle&task=circlesoundche.save'); ?><!--"-->
                    <!--                              method="post" class="form-validate" enctype="multipart/form-data">-->
                    <!--                            <input type="hidden" name="jform[id]" value="-->
                    <?php //echo $item->id; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[ordering]" value="-->
                    <?php //echo $item->ordering; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[state]"-->
                    <!--                                   value="-->
                    <?php //echo (int)!((int)$item->state); ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[checked_out]"-->
                    <!--                                   value="--><?php //echo $item->checked_out; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[checked_out_time]"-->
                    <!--                                   value="--><?php //echo $item->checked_out_time; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[title]" value="-->
                    <?php //echo $item->title; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[genre]" value="-->
                    <?php //echo $item->genre; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[body]" value="-->
                    <?php //echo $item->body; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[img_artist]"-->
                    <!--                                   value="--><?php //echo $item->img_artist; ?><!--"/>-->
                    <!--                            <input type="hidden" name="option" value="com_soundche_circle"/>-->
                    <!--                            <input type="hidden" name="task" value="circlesoundche.save"/>-->
                    <!--                            --><?php //echo JHtml::_('form.token'); ?>
                    <!--                        </form>-->
                    <!--                    --><?php
                    //                    endif;
                    //                    if (JFactory::getUser()->authorise('core.delete', 'com_soundche_circle.circlesoundche.' . $item->id)):
                    //
                    ?>
                    <!--                        <a href="javascript:deleteItem(--><?php //echo $item->id; ?><!--);">-->
                    <?php //echo JText::_("COM_SOUNDCHE_CIRCLE_DELETE_ITEM"); ?><!--</a>-->
                    <!--                        <form id="form-circlesoundche-delete--->
                    <?php //echo $item->id; ?><!--" style="display:inline"-->
                    <!--                              action="-->
                    <?php //echo JRoute::_('index.php?option=com_soundche_circle&task=circlesoundche.remove'); ?><!--"-->
                    <!--                              method="post" class="form-validate" enctype="multipart/form-data">-->
                    <!--                            <input type="hidden" name="jform[id]" value="-->
                    <?php //echo $item->id; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[ordering]" value="-->
                    <?php //echo $item->ordering; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[state]" value="-->
                    <?php //echo $item->state; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[checked_out]"-->
                    <!--                                   value="--><?php //echo $item->checked_out; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[checked_out_time]"-->
                    <!--                                   value="--><?php //echo $item->checked_out_time; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[created_by]"-->
                    <!--                                   value="--><?php //echo $item->created_by; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[title]" value="-->
                    <?php //echo $item->title; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[genre]" value="-->
                    <?php //echo $item->genre; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[body]" value="-->
                    <?php //echo $item->body; ?><!--"/>-->
                    <!--                            <input type="hidden" name="jform[img_artist]"-->
                    <!--                                   value="--><?php //echo $item->img_artist; ?><!--"/>-->
                    <!--                            <input type="hidden" name="option" value="com_soundche_circle"/>-->
                    <!--                            <input type="hidden" name="task" value="circlesoundche.remove"/>-->
                    <!--                            --><?php //echo JHtml::_('form.token'); ?>
                    <!--                        </form>-->
                    <!--                    --><?php
                    //                    endif;
                    //
                    ?>
                </li>
            <?php endif; ?>

        <?php endforeach; ?>
        <?php
        if (!$show):
            echo JText::_('COM_SOUNDCHE_CIRCLE_NO_ITEMS');
        endif;
        ?>

    </ul>


</div>



<?php
if ($show): ?>
    <div class="pagination">
        <p class="counter">
            <?php //echo $this->pagination->getPagesCounter(); ?>
        </p>
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
<?php endif; ?>



