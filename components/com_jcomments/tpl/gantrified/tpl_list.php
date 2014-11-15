<?php

(defined('_VALID_MOS') OR defined('_JEXEC')) or die;

require_once (JPATH_SITE . '/libraries/gantry/features/gantrified.php');

/*
 *
 * Flat comments list template
 *
 */
class jtt_tpl_list extends JoomlaTuneTemplate
{
	function render() 
	{
		$comments = $this->getVar('comments-items');

		if (isset($comments)) {
			// display full comments list with navigation and other stuff
			$this->getHeader();

			if ($this->getVar('comments-nav-top') == 1) {
?>
<div id="nav-top" class="pagination"><ul>&nbsp;<li><span>&laquo;</span></li><?php echo
 $this->getNavigation(); ?>&nbsp;<li><span>&raquo;</span></li></ul></div>
<?php
			}
?>
<div id="comments-list" class="comments-list">
<?php
			$i = 0;
			
			foreach($comments as $id => $comment) {
?>
	<div class="rt-block <?php echo (GantryFeatureGantrified::getModSuffixAlt() != NULL && $i%2 ? GantryFeatureGantrified::getModSuffixAlt() : GantryFeatureGantrified::getModSuffixMain()) ; ?>" id="comment-item-<?php echo $id; ?>"><?php echo $comment; ?></div>
<?php
				$i++;
			}
?>
</div>
<?php
			if ($this->getVar('comments-nav-bottom') == 1) {
?>
<div id="nav-bottom" class="pagination"><ul>&nbsp;<li><span>&laquo;</span></li><?php echo
 $this->getNavigation(); ?>&nbsp;<li><span>&raquo;</span></li></ul></div>
<?php
			}
?>
<div id="comments-list-footer"><?php echo $this->getFooter();?></div>
<?php
		} else {
			// display single comment item (works when new comment is added)

			$comment = $this->getVar('comment-item');

			if (isset($comment)) {
				$i = $this->getVar('comment-modulo');
				$id = $this->getVar('comment-id');

?>
	<div class=""rt-block <?php echo (GantryFeatureGantrified::getModSuffixAlt() != NULL && $i%2 ? GantryFeatureGantrified::getModSuffixAlt() : GantryFeatureGantrified::getModSuffixMain()) ; ?>" id="comment-item-<?php echo $id; ?>"><?php echo $comment; ?></div>
<?php
			} else {
?>
<div id="comments-list" class="comments-list"></div>
<?php
			}
		}
	}

	/*
	 *
	 * Display comments header and small buttons: rss and refresh
	 *
	 */
	function getHeader()
	{
		$object_id = $this->getVar('comment-object_id');
		$object_group = $this->getVar('comment-object_group');

		$btnRSS = '';
		$btnRefresh = '';
		
		if ($this->getVar('comments-refresh', 1) == 1) {
			$btnRefresh = '<a class="refresh" href="#" title="'.JText::_('BUTTON_REFRESH').'" onclick="jcomments.showPage('.$object_id.',\''. $object_group . '\',0);return false;"><span class="icon-refresh"></span></a>';
		}

		if ($this->getVar('comments-rss') == 1) {
			$link = $this->getVar('rssurl');
			if (!empty($link)) {
				$btnRSS = '<a class="rss" href="'.$link.'" title="'.JText::_('BUTTON_RSS').'" target="_blank"><span class="icon-rss"></span></a>';
			}
		}
?>
<h3><?php echo JText::_('COMMENTS_LIST_HEADER'); ?> <?php echo $btnRSS; ?><?php echo $btnRefresh; ?></h3>
<?php
	}

	/*
	 *
	 * Display RSS feed and/or Refresh buttons after comments list
	 *
	 */
	function getFooter()
	{
		$footer = '';

		$object_id = $this->getVar('comment-object_id');
		$object_group = $this->getVar('comment-object_group');

		$lines = array();

		if ($this->getVar('comments-refresh', 1) == 1) {
			$lines[] = '<span class="icon-refresh"><a class="refresh" href="#" title="'.JText::_('BUTTON_REFRESH').'" onclick="jcomments.showPage('.$object_id.',\''. $object_group . '\',0);return false;">'.JText::_('BUTTON_REFRESH').'</a></span>';
		}

		if ($this->getVar('comments-rss', 1) == 1) {
			$link = $this->getVar('rssurl');
			if (!empty($link)) {
				$lines[] = '<span class="icon-rss"><a class="rss" href="'.$link.'" title="'.JText::_('BUTTON_RSS').'" target="_blank">'.JText::_('BUTTON_RSS').'</a></span>';
			}
		}

		if ($this->getVar('comments-can-subscribe', 0) == 1) {
			$isSubscribed = $this->getVar('comments-user-subscribed', 0);

			$text = $isSubscribed ? JText::_('BUTTON_UNSUBSCRIBE') : JText::_('BUTTON_SUBSCRIBE');
			$func = $isSubscribed ? 'unsubscribe' : 'subscribe';

			$lines[] = '<span class="icon-envelope"><a id="comments-subscription" class="subscribe" href="#" title="' . $text . '" onclick="jcomments.' . $func . '('.$object_id.',\''. $object_group . '\');return false;">'. $text .'</a></span>';
		}

		if (count($lines)) {
			$footer = implode('<br />', $lines);			
		}

		return $footer;
	}

	/*
	 *
	 * Display comments pagination
	 *
	 */
	function getNavigation()
	{
		if ($this->getVar('comments-nav-top') == 1 
		||  $this->getVar('comments-nav-bottom') == 1) {
			$active_page = $this->getVar('comments-nav-active', 1);
			$first_page = $this->getVar('comments-nav-first', 0);
			$total_page = $this->getVar('comments-nav-total', 0);

			if ($first_page != 0 && $total_page != 0) {
				$object_id = $this->getVar('comment-object_id');
				$object_group = $this->getVar('comment-object_group');

				$content = '';

				// number of visible pages
				$pp = 10;

				$fp = $active_page - $pp/2;
				if ($fp <= 0) {
					$fp = 1;
				}

				$lp = $fp + $pp;
				if ($lp > $total_page) {
					$lp = $total_page;
				}

				if ($lp - $fp < $pp && $pp < $total_page) {
					$fp = $lp - $pp;
				}

				if ($fp > 1) {
					$content .= '<li><span onclick="jcomments.showPage('.$object_id.', \''.$object_group.'\', '.($active_page-1).');" class="pagenav">&laquo;</span></li>';
				}

				for ($i=$fp; $i <= $lp; $i++) {
					if ($i == $active_page) {
						$content .= '<li><span class="pagenav activepage">'.$i.'</span></li>';
					} else {
						$content .= '<li><a class="pagenav" onclick="jcomments.showPage('.$object_id.', \''.$object_group.'\', '.$i.');" class="pagenav">'.$i.'</a></li>';
					}
				}

				if ($lp < $total_page) {
					$content .= '<li><span onclick="jcomments.showPage('.$object_id.', \''.$object_group.'\', '.($lp+1).');" class="pagenav">&raquo;</span></li>';
				}

				return $content;
			}
		}
		return '';
	}
}
?>