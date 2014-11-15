<?php

// no direct access
defined('_JEXEC') or die;



$comments = JPATH_SITE . '/components/com_jcomments/jcomments.php';
if (file_exists($comments)) {
    require_once($comments);
    echo JComments::show($_GET['vid'], 'com_soundche_circle', $_GET['title']);
//
//   echo $_GET['vid'].'<br>';
//   echo $_GET['title'].'<br>';

//    print_r($_GET);
}