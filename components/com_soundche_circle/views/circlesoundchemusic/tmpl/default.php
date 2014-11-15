<?php

// no direct access
defined('_JEXEC') or die;


$document = JFactory::getDocument();
$document->addScript('/components/com_soundche_circle/assets/js/base.js');
$document->addScript('/components/com_soundche_circle/assets/js/easyPlayer.js');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_soundche_circle', JPATH_ADMINISTRATOR);
$canEdit = JFactory::getUser()->authorise('core.edit', 'com_soundche_circle.' . $this->item->id);
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_soundche_circle' . $this->item->id)) {
    $canEdit = JFactory::getUser()->id == $this->item->created_by;
}
if ($this->item) : ?>

    <div class="sidebar">
        <ul>
            <li>
                <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=circlesoundchebio&id=' . (int)$this->item->id); ?>"><?php echo JText::_("COM_SOUNDCHE_CIRCLE_BIOGRAPHY"); ?></a>
            </li>

            <li>
                <a class="now" href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=circlesoundchemusic&id=' . (int)$this->item->id); ?>"><?php echo JText::_("COM_SOUNDCHE_CIRCLE_MUSIC"); ?></a>
            </li>

            <li>
                <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=circlesoundchevideo&id=' . (int)$this->item->id); ?>"><?php echo JText::_("COM_SOUNDCHE_CIRCLE_VIDEO"); ?></a>
            </li>

            <li>
                <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=circlesoundchefoto&id=' . (int)$this->item->id); ?>"><?php echo JText::_("COM_SOUNDCHE_CIRCLE_FOTO"); ?></a>
            </li>
        </ul>

    </div>

    <div class="content">

            <ul class="c_marg">
               <li>



                   <script type="text/javascript">
                       var playerGroup = new easyPlayerManager();
                   </script>


                   <?php
                   require_once 'vkapi.class.php';

                   $api_id = '4069648'; // Insert here id of your application
                   $vk_id = '40704529'; // Insert here you vk id

                   $VK = new vkapi($api_id, $vk_id);

                   $resp = $VK->api('audio.get',
                       array(
                           'owner_id' => '-29836620',
                       'album_id' => $this->item->album

                       )
                   );

                    if ($this->item->album != 0 ):
                   foreach ($resp->audio as $track) :?>

                   <script type="text/javascript">
                       playerGroup.addPlayer({
                           url: '<?php echo $track->url; ?>',
                           title: '<?php echo '<span class="artist">'.$track->artist.'</span> - '.$track->title?>',
                           getId3Title: false,
                           cssClass: 'player1',
                           stopButton: true,
                           volume: 0.5,
                           box: 'playerHolder'
                       });
                   </script>
                    <?php endforeach ;

                    else:
                        echo "Записи відсутні";
                  endif;?>
               </li>
            </ul>

    </div>
    <?php if ($canEdit && $this->item->checked_out == 0): ?>
        <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&task=circlesoundche.edit&id=' . $this->item->id); ?>"><?php echo JText::_("COM_SOUNDCHE_CIRCLE_EDIT_ITEM"); ?></a>
    <?php endif; ?>
    <?php if (JFactory::getUser()->authorise('core.delete', 'com_soundche_circle.circlesoundche.' . $this->item->id)):
        ?>
        <a href="javascript:document.getElementById('form-circlesoundche-delete-<?php echo $this->item->id ?>').submit()"><?php echo JText::_("COM_SOUNDCHE_CIRCLE_DELETE_ITEM"); ?></a>
        <form id="form-circlesoundche-delete-<?php echo $this->item->id; ?>" style="display:inline"
              action="<?php echo JRoute::_('index.php?option=com_soundche_circle&task=circlesoundche.remove'); ?>"
              method="post" class="form-validate" enctype="multipart/form-data">
            <input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>"/>
            <input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>"/>
            <input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>"/>
            <input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>"/>
            <input type="hidden" name="jform[checked_out_time]"
                   value="<?php echo $this->item->checked_out_time; ?>"/>
            <input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>"/>
            <input type="hidden" name="jform[title]" value="<?php echo $this->item->title; ?>"/>
            <input type="hidden" name="jform[genre]" value="<?php echo $this->item->genre; ?>"/>
            <input type="hidden" name="jform[body]" value="<?php echo $this->item->body; ?>"/>
            <input type="hidden" name="jform[img_artist]" value="<?php echo $this->item->img_artist; ?>"/>
            <input type="hidden" name="option" value="com_soundche_circle"/>
            <input type="hidden" name="task" value="circlesoundche.remove"/>
            <?php echo JHtml::_('form.token'); ?>
        </form>
    <?php
    endif;
    ?>
<?php
else:
    echo JText::_('COM_SOUNDCHE_CIRCLE_ITEM_NOT_LOADED');
endif;
?>

