<?php
/**
 * @package                Joomla.Site
 * @subpackage	Templates.SOUNDCHE
 * @copyright        Copyright (C) 2014 . All rights reserved.
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.filesystem.file');


// disconnect mootools scripts
//unset($this->_scripts[$this->baseurl.'/media/system/js/mootools-core.js'],
//$this->_scripts[$this->baseurl.'/media/system/js/mootools-more.js'],
//$this->_scripts[$this->baseurl.'/media/system/js/core.js'],
//$this->_scripts[$this->baseurl.'/media/system/js/modal.js'],
//$this->_scripts[$this->baseurl.'/media/system/js/caption.js']);

$doc = JFactory::getDocument();

$doc->addScript('//code.jquery.com/jquery-1.9.1.js');
$doc->addScript('//code.jquery.com/ui/1.10.4/jquery-ui.js');
$doc->addScript('http://vk.com/js/api/share.js?90');


$doc->addStyleSheet($this->baseurl.'/templates/system/css/system.css');
$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/styles/style.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/styles/helveticaneuecyr-light.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/styles/pagination.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/styles/player.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/styles/jquery-ui.css', $type = 'text/css', $media = 'screen,projection');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>

    <meta property="og:title" content="<?php echo htmlspecialchars($doc->getMetaData('title'))?>"/>
    <meta property="og:image" content="<?php echo htmlspecialchars($doc->getMetaData('image'))?>"/>
    <meta property="og:description" content="<?php echo htmlspecialchars($doc->getMetaData('description'))?>"/>
    <jdoc:include type="head" />

    <style type="text/css">
        #sbox-window {background-color:#6b6b6b;padding:2px}
        #sbox-overlay {background-color:#000000;}


    </style>
    <script type="text/javascript">//<![CDATA[
//        hs.graphicsDir = '/components/com_phocagallery/assets/js/highslide/graphics/';//]]>
//  //<![CDATA[
//        var phocaZoom = {
//            objectLoadTime : 'after', wrapperClassName: '', outlineWhileAnimating : true, enableKeyListener : false, minWidth : 500, minHeight : 560, dimmingOpacity: 0.8,  fadeInOut : true, contentId: 'detail', objectType: 'iframe', objectWidth: 500, objectHeight: 560 };hs.registerOverlay({
//            html: '<div class=\u0022closebutton\u0022 onclick=\u0022return hs.close(this)\u0022 title=\u0022Close Window\u0022></div>',
//            position: 'top right',
//            fade: 2
//        }); if (hs.addSlideshow) hs.addSlideshow({
//            slideshowGroup: 'groupC0',
//            interval: 5000,
//            repeat: false,
//            useControls: true,
//            fixedControls: true,
//            overlayOptions: {
//                opacity: 1,
//                position: 'top center',
//                hideOnMouseOut: true
//            }
//        });
        //]]>
    </script>
    <script type="text/javascript">
        (function($) {
            $(document).ready(function(){
                $(document).on('click', '#write_us', function () {
                    $('#contact_us').show();
                    return false;
                });
                $(document).on('click', '.close, submit', function () {
                    $('#contact_us').hide();
                    return false;
                });
            });
        })(jQuery);
    </script>


</head>


<body itemscope itemtype="http://schema.org/Event">

<div class="wrapper">
    <div class="header">
        <img src="<?php echo $this->baseurl.'/templates/'.$this->template.'/images/clouds.png'?>" alt="clouds" class="absolute" />
        <h1>Sound4e<a href="<?php echo JURI::base();?>"><img src="<?php echo $this->baseurl.'/templates/'.$this->template.'/images/logo.png'?>" alt="logo" /></a></h1>
                <ul class="reg">
            <li><a href="#" id="write_us" class="button write left">Напишiть нам</a></li>
<!--            <li><a href="#" class="button b_reg">Зареєструватися</a></li>-->
<!--            <li><a href="#" class="button in margin_minus">Увійти</a></li>-->

                    <jdoc:include type="modules" name="position-2" />
        </ul>


        <jdoc:include type="modules" name="position-1" />
<!--        <span class="hover"><a href="#" class="button margin offer">Запропонувати анонс</a></span>-->
<!--        <p>-->

            <jdoc:include type="modules" name="position-3" />
<!--            <input class="subm" type="submit" value="Отправить" />-->
<!--            <input class="search" name="search" value="" size="40" type="text" />-->
<!--        </p>-->
  </div>
  <div style="clear: both"></div>
    <div class="container">
           <jdoc:include type="message" />
           <jdoc:include type="component" />

    </div>
</div>
<div class="footer">
    <div class="box">


        <jdoc:include type="modules" name="position-5" />

<!--        <ul>-->
<!--            <li><a href="#">Головна</a></li>-->
<!--            <li><a href="#">СпiвоЧе коло</a></li>-->
<!--            <li><a href="#">ТВ/Радiо проект СаундЧе</a></li>-->
<!--            <li><a href="#">СаундЧе фест</a></li>-->
<!--            <li><a href="#">Дошка оголошень</a></li>-->
<!--            <li><a href="#">Команда</a></li>-->
<!--            <li><a href="#">Преса про нас</a></li>-->
<!--            <li><a href="#">Партнери</a></li>-->
<!--        </ul>-->
        <span>Copyright &copy; SoundChe 2011-2014 All Rights Reserved</span>
    </div>
</div>
<div id="contact_us"><div class="close"></div><jdoc:include type="modules" name="position-7" style="xhtml"/></div>
</body>

</html>

<?php

$user = JFactory::getUser();
If (!$user->id){?>

    <script type="text/javascript">
        (function($){
            $(document).ready(function(){
                $('body').append('<div id="announcement_dialog" class="dialog">Тільки зареєстровані користувачі можуть залишати оголошення!</div>');
                $('.menuhover a').replaceWith( "<span class='not-reg button margin offer'>Запропонувати анонс</span>" );
            });
            $(document).on('click','.not-reg',function(){

                $('#announcement_dialog').dialog();
            });
        })(jQuery)
    </script>

<?php }
?>