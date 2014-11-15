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

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_announcement', JPATH_ADMINISTRATOR);
$canEdit = JFactory::getUser()->authorise('core.edit', 'com_announcement.' . $this->item->id);
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_announcement' . $this->item->id)) {
    $canEdit = JFactory::getUser()->id == $this->item->created_by;
}

$doc =& JFactory::getDocument();
$doc->addStyleSheet('/administrator/components/com_announcement/assets/css/site.css');
$doc->setMetaData('image',$this->item->image);
$doc->setMetaData('title',$this->item->title);
$doc->setMetaData('description itemprop="description"',mb_substr($this->item->description,0,300));
?>
<?php if ($this->item) : ?>

    <div class="content">

        <ul class="c_marg">

            <li>
                <a class="event" href="#"><img itemprop="image" src="<?php echo $this->item->image; ?>" alt="image of event"></a>

                <div class="inf">
                    <h2  itemprop="name"><a href="#"><?php echo $this->item->title; ?></a></h2>

                    <span>
                        <?php echo JHtml::_('date',$this->item->date,JText::_('d F Y, H:i')); ?>
                    </span>

                    <p itemprop="description">
                        <?php //echo JText::_('COM_ANNOUNCEMENT_FORM_LBL_ANNOUNCEMENT_DESCRIPTION'); ?>
                        <?php echo $this->item->description; ?>
                    </p>

                </div>
                <div style="float: right; color: #555;margin-right: 100px;font-style: italic; margin-top: 20px">
                    <?php echo JText::_('COM_ANNOUNCEMENT_FORM_LBL_ANNOUNCEMENT_CREATED_BY'); ?>:
                    <?php if ($this->item->created_by) {
                      echo JFactory::getUser($this->item->created_by)->name;
                    }?>
                </div>

                <span id="my_ya_share"></span>

            </li>


        </ul>



    </div>
    <?php if ($canEdit): ?>
        <a href="<?php echo JRoute::_('index.php?option=com_announcement&task=announcement.edit&id=' . $this->item->id); ?>"><?php echo JText::_("COM_ANNOUNCEMENT_EDIT_ITEM"); ?></a>
    <?php endif; ?>
    <?php if (JFactory::getUser()->authorise('core.delete', 'com_announcement.announcement.' . $this->item->id)):
        ?>
        <a href="javascript:document.getElementById('form-announcement-delete-<?php echo $this->item->id ?>').submit()"><?php echo JText::_("COM_ANNOUNCEMENT_DELETE_ITEM"); ?></a>
        <form id="form-announcement-delete-<?php echo $this->item->id; ?>" style="display:inline"
              action="<?php echo JRoute::_('index.php?option=com_announcement&task=announcement.remove'); ?>"
              method="post" class="form-validate" enctype="multipart/form-data">
            <input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>"/>
            <input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>"/>
            <input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>"/>
            <input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>"/>
            <input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>"/>
            <input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>"/>
            <input type="hidden" name="jform[title]" value="<?php echo $this->item->title; ?>"/>
            <input type="hidden" name="jform[date]" value="<?php echo $this->item->date; ?>"/>
            <input type="hidden" name="jform[image]" value="<?php echo $this->item->image; ?>"/>
            <input type="hidden" name="jform[description]" value="<?php echo $this->item->description; ?>"/>
            <input type="hidden" name="option" value="com_announcement"/>
            <input type="hidden" name="task" value="announcement.remove"/>
            <?php echo JHtml::_('form.token'); ?>
        </form>
    <?php
    endif;
    ?>
<?php
else:
    echo JText::_('COM_ANNOUNCEMENT_ITEM_NOT_LOADED');
endif;


?>

    <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8">
    </script> <!-- Подключили API Яндекс-блока -->
    <script type="text/javascript">
        new Ya.share({
            element: 'my_ya_share',
            elementStyle: {
                /* В виде кнопок, также доступны: icon, link, none */
                'type': 'button',
                /* Показывать рамку */
                'border': true,
                /* Кнопки по умолчанию */
                'quickServices': ['vkontakte',
                    /* Коды для вставки, помните? */
                    'twitter',
                    'facebook',
                    'odnoklassniki',
                    'gplus']
        },
            theme:'counter',
        link: <?php echo "'".JFactory::getURI()."'"?>,
            title: <?php echo "'".$this->item->title."'"?>,
            description: <?php echo "'".mb_substr($this->item->description,0,300)."'"?>,
            image: <?php echo "'".$this->item->image."'"?>,
            /* Во всплывающем меню покажем остальные */
            popupStyle: {
            blocks: {
                'Добавь в закладки!': ['moikrug', 'greader',
                    'linkedin', /* */
                    'liveinternet',

                'digg',
                    'blogger']
            },
            /* Также покажем поле с прямой ссылкой  */
            copyPasteField: true
        }
        });
    </script>
