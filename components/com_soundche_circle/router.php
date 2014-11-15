<?php
/**
 * @version     1.0.0
 * @package     com_soundche_circle
 * @copyright   SoundЧe © 2014. Все права защищены.
 * @license     GNU General Public License версии 2 или более поздней; Смотрите LICENSE.txt
 * @author      Yuri Palii <ypalii2012@gmail.com> - http://
 */

// No direct access
defined('_JEXEC') or die;

/**
 * @param	array	A named array
 * @return	array
 */
function Soundche_circleBuildRoute(&$query)
{
	$segments = array();
    
	if (isset($query['task'])) {
		$segments[] = implode('/',explode('.',$query['task']));
		unset($query['task']);
	}
	if (isset($query['id'])) {
		$segments[] = $query['id'];
		unset($query['id']);
	}

	return $segments;
}

/**
 * @param	array	A named array
 * @param	array
 *
 * Formats:
 *
 * index.php?/soundche_circle/task/id/Itemid
 *
 * index.php?/soundche_circle/id/Itemid
 */
function Soundche_circleParseRoute($segments)
{
	$vars = array();
    
	// view is always the first element of the array
	$count = count($segments);
    
    if ($count)
	{
		$count--;
		$segment = array_pop($segments) ;
		if (is_numeric($segment)) {
			$vars['id'] = $segment;
		}
        else{
            $count--;
            $vars['task'] = array_pop($segments) . '.' . $segment;
        }
	}

	if ($count)
	{   
        $vars['task'] = implode('.',$segments);
	}
	return $vars;
}
