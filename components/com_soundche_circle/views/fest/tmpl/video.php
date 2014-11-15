<?php

// no direct access
defined('_JEXEC') or die;


//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_soundche_circle', JPATH_ADMINISTRATOR);

?>
<div class="sidebar">
    <ul>
        <li><a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=fest') ?>">Програма фесту</a></li>
        <li><a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=fest&layout=photo') ?>">Фото</a>
        </li>
        <li><a class="now"
               href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=fest&layout=video') ?>">Відео</a>
        </li>
        <li>
            <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=partners&layout=partner') ?>">Патртнери</a>
        </li>
    </ul>
</div>


<div class="content">

<ul class="year_slider">
    <li>2011</li>
    <li>2012</li>
    <li>2013</li>
    <li>2014</li>
    <li>2015</li>
    <li>2016</li>
</ul>

<form id="slider_form" name="slider_form"
      action="<?php echo JURI::base() ?>index.php?option=com_soundche_circle&view=fest&layout=video&Itemid=124"
      method="post">
    <input name="slider" type="text" id="amount" style="border:0; visibility: hidden; color:#f6931f; font-weight:bold;">
    <input type="submit" value="submit" style="visibility: hidden">
</form>


<div id="slider"></div>

    <?php
    if (isset($_POST['slider'])) {
        $current_year = $_POST['slider'];
        $_SESSION['cur_year'] = $_POST['slider'];
    } elseif (!empty($_SESSION['cur_year'])) {
        $current_year  = $_SESSION['cur_year'];
    } else  {
        $current_year = date('Y');
    }

    ?>


    <?php if ($this->item && $this->videos ) : ?>
    <ul class="c_marg">
    <li>

    <?php
    $content = '';

        foreach ($this->videos as $video ){
            $url = parse_url($video->videocode);
            parse_str($url['query'], $vid);

            $content .= '
            <div class="video_container">';
                $content .= '
                <div class="mask_hover"></div>
                ';
                $content .= '
                <div class="video_footer"></div>
                ';
                $content .= '<span class="play">'.JHtml::_('image','images/icon/play.png','image', 'class="cl" title="' . $video->title . '" vid="'.$video->id.'" youtube_url="' . $vid['v'] . '"').'</span>';
                $content .= JHtml::_('image', 'images/phocagallery/thumbs/phoca_thumb_l_' . $video->filename . '',
                'image');
                $content .= '
            </div>';

                  }
                  echo $content;
       else:

           echo '<div class="no_content">';
           echo JText::_('Контент відсутній!');
           echo '</div>';
        endif;
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
















<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


<script>
    $(function () {
        $("#slider").slider({
            value:<?php echo $current_year?>,
            min: 2011,
            max: 2016,
            step: 1,
            slide: function (event, ui) {
                $("#amount").val(+ui.value);
            },
            change: function (event, ui) {

                $("#slider_form").submit();

            }

        });

        $("#amount").val($("#slider").slider("value"));
    });
</script>
