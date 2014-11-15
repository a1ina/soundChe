<?php

// no direct access
defined('_JEXEC') or die;

$document = JFactory::getDocument();
$document->addScript('/components/com_soundche_circle/assets/js/base.js');
$document->addScript('/components/com_soundche_circle/assets/js/easyPlayer.js');
$document->addScript('//code.jquery.com/jquery-1.10.2.js');
$app = JFactory::getApplication();
$menu = $app->getMenu()->getActive();

if ($menu->id == 166) {
    echo '

<script type="text/javascript">
    $( ".item-122" ).addClass( "active" );
</script>

    ';
}

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_soundche_circle', JPATH_ADMINISTRATOR);
$canEdit = JFactory::getUser()->authorise('core.edit', 'com_soundche_circle.' . $this->item->id);
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_soundche_circle' . $this->item->id)) {
    $canEdit = JFactory::getUser()->id == $this->item->created_by;
}
if ($this->item) : ?>


    <form class="searchbar"
          action="      <?php echo JURI::base() . 'index.php?option=com_soundche_circle&view=circlesoundchetracks&Itemid=166'; ?>"
          method="post">
        <h3>Пошук</h3>
        <span>Ім'я</span>
        <input type="text" name="artist" class="name_search" size="28" value="<?php echo $_POST['artist']?>">
        <?php
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(' * ');
        $query->from('#__soundche_circle_genre');
        $db->setQuery($query);
        $genres = $db->loadObjectList();?>
        <span>Жанр</span>
        <select name="genre" onchange="">
            <option value="">Виберіть жанр</option>
            <?php
            foreach ($genres as $genre):?>
                <option <?php if ($_POST['genre'] == $genre->genre_id) echo 'selected="selected"' ?> value="<?php echo $genre->genre_id ?>"><?php echo $genre->title ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Знайти" class="submit">

    </form>

    <div class="content">

        <ul class="border">
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
                        'owner_id' => '-29836620'

                    )
                );


                foreach ($resp->audio as $track) :?>


                <?php  if (empty($_POST['artist']) &&  empty($_POST['genre'])){
                  ?>

                <script type="text/javascript">
                    playerGroup.addPlayer({
                        url: '<?php echo $track->url; ?>',
                        title: '<?php echo '<span class="artist">'.addslashes($track->artist).'</span> - '.addslashes($track->title) ?>',
                        getId3Title: false,
                        cssClass: 'player1',
                        stopButton: true,
                        volume: 0.5,
                        box: 'playerHolder'
                    });
                </script>

                <?php }

                elseif (empty($_POST['genre'])) {

                        if   (mb_strpos(strtolower($track->artist),strtolower( $_POST['artist'])) === false ){

                continue;}
                else {
                 ?>

                <script type="text/javascript">
                    playerGroup.addPlayer({
                        url: '<?php echo $track->url; ?>',
                        title: '<?php echo '<span class="artist">'.addslashes($track->artist).'</span> - '.addslashes($track->title)?>',
                        getId3Title: false,
                        cssClass: 'player1',
                        stopButton: true,
                        volume: 0.5,
                        box: 'playerHolder'
                    });
                </script>

                    <?php    }   };

                    if (!empty($_POST['genre']) && !empty($_POST['artist'])) {

                        if (mb_strpos(strtolower($track->artist),strtolower( $_POST['artist'])) === false  ){

                            continue;}

                    elseif ((int)$_POST['genre'] == (int)$track->genre) {
                       ?>

                    <script type="text/javascript">
                        playerGroup.addPlayer({
                            url: '<?php echo $track->url; ?>',
                            title: '<?php echo '<span class="artist">'.addslashes($track->artist).'</span> - '.addslashes($track->title) ?>',
                            getId3Title: false,
                            cssClass: 'player1',
                            stopButton: true,
                            volume: 0.5,
                            box: 'playerHolder'
                        });
                    </script>

                <?php

                }
                }

                if (empty($_POST['artist']) && !empty($_POST['genre'])) {

                if   ((int)$_POST['genre'] != $track->genre ){

                    continue;}
                else {

                ?>

                    <script type="text/javascript">
                        playerGroup.addPlayer({
                            url: '<?php echo $track->url; ?>',
                            title: '<?php  echo '<span class="artist">'.addslashes($track->artist).'</span> - '.addslashes($track->title) ?>',
                            getId3Title: false,
                            cssClass: 'player1',
                            stopButton: true,
                            volume: 0.5,
                            box: 'playerHolder'
                        });
                    </script>

                <?php    }   }

                endforeach;
                ?>

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

