<?php
defined('_JEXEC') or die('Restricted access');
$comments = JPATH_SITE.DS.'components'.DS.'com_jcomments'.DS.'jcomments.php';
if (is_file($comments)) {
    require_once($comments);
    echo JComments::showComments($this->category->id, 'com_phocagallery', $this->category->title);
}
?>