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

$doc->addStyleSheet('components/com_soundche_circle/assets/css/carousel.css');
$doc->addStyleDeclaration('


        #accordion .cont {
            display: none
        }

        #accordion .cont .detail {

            text-align: left
        }

        #accordion .cont span {

            padding: 15px;
            font-size: 1.3em
        }

        #accordion li {
            min-height: 0
        }

        #accordion ul {
            margin: 0;
        }

        #accordion ul li {
            margin: 0;
            padding: 0;
            border: none;
        }

        #accordion .head .arrow {

            height: 40px;

            background: url(' . JURI::base() . 'images/icon/arrow-down.png) no-repeat top;
            background-size: 30px 30px;
        }

        #accordion .head:hover {
            cursor: pointer;
        }

        #accordion .head:hover .arrow {
            background: url(' . JURI::base() . 'images/icon/arrow-down.png) no-repeat bottom;
            background-size: 30px 30px;

        }

');



?>


<div class="sidebar">
    <ul>
        <li>
            <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=project_abouts&id=' . (int)$this->item->id); ?>"><?php echo JText::_("COM_SOUNDCHE_CIRCLE_PROJECT_ABOUT"); ?></a>
        </li>

        <li>
            <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=team&id=' . (int)$this->item->id . '&layout=default_project'); ?>"><?php echo JText::_("COM_SOUNDCHE_CIRCLE_TEAM"); ?></a>

        </li>

        <li>
            <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=partners&id=' . (int)$this->item->id . '&layout=default_project'); ?>"><?php echo JText::_("COM_SOUNDCHE_CIRCLE_PARTNERS"); ?></a>
        </li>

        <li>
            <a class="now"
               href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=quests&id=' . (int)$this->item->id . '&layout=default_project'); ?>"><?php echo JText::_("COM_SOUNDCHE_CIRCLE_GUESTS"); ?></a>
        </li>
    </ul>

</div>

<?php $show = false; ?>



<div class="content">

    <ul id="accordion" class="border">
        <?php foreach ($this->items as $item): ?>

            <?php if ($item->published == 1 || ($item->published == 0 && JFactory::getUser()->authorise('core.edit.own', ' com_soundche_circle.quests.' . $item->id))):
                $show = true;?>



                <li class="">
                    <ul class="tab">
                        <li class="head">
                            <span class="event">
                                <?php echo JHTML::_('image', $item->image, JText::_('COM_SOUNDCHE_CIRCLE_IMAGE_ALT'), 'class = ""'); ?>
                            </span>

                            <div class="inf">
                                <h2><?php echo $item->title;?></h2>

                                <p class="height">
                                    <?php echo $item->description ?>
                                </p>
                                    <p class="date_created">
                                        <span>Дата створення:</span>
                                        <?php
                                        $jdate = new JDate($item->created);
                                        $created_date = $jdate->format(JText::_('DATE_FORMAT_LC3'));

                                        echo $created_date ; ?>
                                    </p>

                            </div>

                            <div id="fb-root"></div>
                            <script type="text/javascript" src="//yandex.st/share/share.js"
                                    charset="utf-8"></script>
                            <div class="yashare-auto-init" data-yashareL10n="ru"
                                 data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir"
                                 data-yashareTheme="counter"

                                ></div>
                            <div class="arrow"></div>
                        </li>

                        <li class="cont">
                            <?php if (!empty($item->video_category)): ?>
<!--                                <div class="guest_title">-->
<!--                                    <h2>Відео</h2>-->
<!--                                </div>-->
                                <?php
                                $content = '';
                                $content .= '<div class="guest_video_container" >';

                                foreach ($this->phoca as $video) {
                                    if ($video->catid == $item->video_category) {

                                        $url = parse_url($video->videocode);
                                        parse_str($url['query'], $vid);

                                        $content .= '<div class="video_container" >';
                                        $content .= '<div class="mask_hover"></div>';
                                        $content .= '<div class="video_footer"></div>';
                                        $content .= '<span class="play">' . JHtml::_('image', 'images/icon/play.png', 'image', 'class="cl" title="' . $video->title . '" vid="' . $video->id . '" youtube_url="' . $vid['v'] . '"') . '</span>';
                                        $content .= JHtml::_('image', 'images/phocagallery/thumbs/phoca_thumb_l_' . $video->filename . '', 'image');
                                        $content .= '</div>';

                                    }
                                }
                                $content .= '</div>';
                                echo $content;

                            else:
                                echo "<div>Відео відсутні</div>"; ?>
                            <?php endif; ?>

                            <?php if (!empty($item->img_category)): ?>
<!--                                <div class="guest_title">-->
<!--                                    <h2>Фото</h2>-->
<!--                                </div>-->
                                <div class="carousel">

                                    <div class="carousel-button-left"><a href="javascript:void(0);">&nbsp;</a></div>
                                    <div class="carousel-button-right"><a href="javascript:void(0);">&nbsp;</a></div>
                                    <div class="carousel-wrapper">
                                        <?php echo JHTML::_('content.prepare', ' {phocagallery view=category|categoryid=' . (int)$item->img_category . '|displaycommentimg=1| limitstart=0|limitcount=50|detail=5|displayname=0| displaydetail=0|displaydownload=0|imageshadow=shadow1|displaybuttons=0}'); ?>
                                    </div>
                                </div>

                            <?php
                            else:
                                echo "<div>Фото відсутні</div>"; ?>
                            <?php endif ?>

                        </li>
                    </ul>
                </li>

            <?php endif; ?>

        <?php endforeach; ?>
    </ul>
</div>

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


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!--<script src="http://tj-s.ru/demo/carusel/carousel.js"></script>-->
<script src="components/com_soundche_circle/assets/js/carousel.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<script type="text/javascript">

    (function($) {

        $(document).ready(function () {
                $('.head ').click(function () {
                    var display = $(this).parent().children('.cont').css('display');
                    if (display == 'none') {
                        $('.cont').not(this).slideUp('slow');
                        $('.arrow').css('backgroundImage', 'url(<?php echo JURI::base()?>images/icon/arrow-down.png)')
                        $(this).parent().children('.cont').slideToggle('slow');
                        $(this).children('.arrow').css('backgroundImage', 'url(<?php echo JURI::base()?>images/icon/arrow-up.png)');
                    } else {
                        $(this).parent().children('.cont').slideToggle('slow');
                        $(this).children('.arrow').css('backgroundImage', 'url(<?php echo JURI::base()?>images/icon/arrow-down.png)');
                    }
                });
            }
        );

    })(jQuery);


</script>
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



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>

    (function($) {

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

            $('#wrap-popup .comment').hide();
            $('.popup-info ul').prepend('<li class="show_comment">Показати коментарі</li>');
            $('.title').append('<h2>' + title + '</h2>');
            $('#player').append('<iframe width="640" height="390" src="//www.youtube.com/embed/' + youtube_url + '?showinfo=0" frameborder="0" allowfullscreen></iframe>');

            return false;

        });

        $(document).on('click', '.close', function () {
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
            $('#wrap-popup .comment').slideDown(400);
            return false;
        });

        $(document).on('click', '.hide_comment', function () {
            $('.hide_comment').remove();
            $('.popup-info ul').prepend('<li class="show_comment">Показати коментарі</li>');
            $('#wrap-popup .comment').slideUp(400);
            return false;
        });
    });


    })(jQuery);

</script>


