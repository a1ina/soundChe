<?php

// no direct access
defined('_JEXEC') or die;


//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_soundche_circle', JPATH_ADMINISTRATOR);
$canEdit = JFactory::getUser()->authorise('core.edit', 'com_soundche_circle.' . $this->item->id);
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_soundche_circle' . $this->item->id)) {
    $canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>



<?php if ($this->item) : ?>
    <div class="sidebar">
        <ul>
            <li>
                <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=circlesoundchebio&id=' . (int)$this->item->id); ?>"><?php echo JText::_("COM_SOUNDCHE_CIRCLE_BIOGRAPHY"); ?></a>
            </li>

            <li>
                <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=circlesoundchemusic&id=' . (int)$this->item->id); ?>"><?php echo JText::_("COM_SOUNDCHE_CIRCLE_MUSIC"); ?></a>
            </li>

            <li>
                <a class="now"
                   href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=circlesoundchevideo&id=' . (int)$this->item->id); ?>"><?php echo JText::_("COM_SOUNDCHE_CIRCLE_VIDEO"); ?></a>
            </li>

            <li>
                <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=circlesoundchefoto&id=' . (int)$this->item->id); ?>"><?php echo JText::_("COM_SOUNDCHE_CIRCLE_FOTO"); ?></a>
            </li>
        </ul>

    </div>


    <div class="content">

        <ul class="c_marg">
            <li>


                <?php
                $content = '';

                foreach ($this->video as $video) {
                    $url = parse_url($video->videocode);
                    parse_str($url['query'], $vid);


                    $content .= '<div class="video_container" >';
                    $content .= '<div class="mask_hover"></div>';
                    $content .= '<div class="video_footer"></div>';
                    $content .= '<span class="play">'.JHtml::_('image','images/icon/play.png','image', 'class="cl" title="' . $video->title . '" vid="'.$video->id.'" youtube_url="' . $vid['v'] . '"').'</span>';
                    $content .= JHtml::_('image', 'images/phocagallery/thumbs/phoca_thumb_l_' . $video->filename . '', 'image');
                    $content .= '</div>';

                }
                echo $content;

                ?>




                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                <script>

                    $(document).ready(function () {

                        $('.video_container').hover(function(){
                                var title = $('.play img',this).attr('title');
                                $('.play' ,this).stop().fadeIn(200).show();
                            $('.mask_hover' ,this).stop().fadeIn(200);
                                $('.video_footer', this).stop().slideDown('200');
                                $('.video_footer',this).append('<h2>' + title + '</h2>');

                        },
                            function(){
                                $('.play').stop().fadeOut(200);
                                $('.mask_hover').stop().fadeOut(200);
                                $('.video_footer', this).stop().slideUp('600');
                                $('.video_footer h2').remove();
                            }
                        );

                        $('.play img').click(function () {
                            var popupBox = '#popup-box';
                            var youtube_url = $(this).attr('youtube_url');
                            var title = $(this).attr('title');
                            var vid = $(this).attr('vid');
                            $( "#com" ).load( '<?php echo JURI::base()?>index.php/spivoche-kolo/1?view=circlesoundchevideo&layout=com&tmpl=component&title='+encodeURIComponent(title)+'&vid='+vid+'');
                            $('#wrap-popup').fadeIn(400);
                            $('body').css({'overflow':'hidden'});
                            $('.wrapper').wrap('<div class="wrap2"/>');

                            $(popupBox).fadeIn(400);
                            var popMargTop = ($(popupBox).height() - 200) / 2;
                            var popMargLeft = ($(popupBox).width() + 24) / 2;
                            $(popupBox).css({
                                'margin-top': -popMargTop,
                                'margin-left': -popMargLeft
                            });

                            $('.comment').hide();
                            $('.popup-info ul').prepend('<li class="show_comment">Показати коментарі</li>');
                            $('.title').append('<h2>' + title + '</h2>');
                            $('#player').append('<iframe width="640" height="390" src="//www.youtube.com/embed/' + youtube_url + '?showinfo=0" frameborder="0" allowfullscreen></iframe>');

                            return false;

                        });

                        $(document).on('click', 'button.close, #wrap-popup', function () {
                            $('#wrap-popup, .popup-info').fadeOut(400, function () {
                                $('.title h2,.show_comment, .hide_comment, iframe').remove();
                            });
                            setTimeout(function(){
                                $('.wrapper').unwrap();
                                $('body').css('overflow-y','auto'); },400);

                            return false;

                        });

                        $(document).on('click', '.show_comment', function () {
                            $('.show_comment').remove();
                            $('.popup-info ul').prepend('<li class="hide_comment">Приховати коментарі</li>');
                            $('.comment').slideDown(400);
                            return false;
                        });

                        $(document).on('click', '.hide_comment', function () {
                            $('.hide_comment').remove();
                            $('.popup-info ul').prepend('<li class="show_comment">Показати коментарі</li>');
                            $('.comment').slideUp(400);
                            return false;
                        });
                    });


                </script>


            </li>
        </ul>

        <div id="wrap-popup">
            <div class="popup-scroll">
            <div id="popup-box" class="popup-info">
                <span class="close">Закрити</span>
                <div class="title"></div>

                <div id="player" class="video"></div>

                <div class="info">

                    <ul>

                        <li class="comment">
                            <div id="com"></div>

                        </li>

                    </ul>

                </div>
            </div>
            </div>
        </div>

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

