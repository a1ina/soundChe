<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
?>
<?php foreach ($this->items as $i => $item): ?>

    <?php if ($item->created_by) {

        $username = JFactory::getUser($item->created_by)->name;
    }
    //$ordering = ($listOrder == 'a.ordering');
    if ($item->published == 1) {
        $published = 'Опубліковано';
    } else {
        $published = ' Неопубліковано';
    }
    ?>
    <tr class="row<?php echo $i % 2; ?>">

        <td>
            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
        </td>
        <td>
            <?php
            echo JHtml::_('jgrid.published',$item->published,$i,'scboards.');
            //echo $published; ?>
        </td>

        <td>
            <?php echo $username; ?>
        </td>
        <td>

      <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&task=scboard.edit&id='. (int) $item->id) ?>">
          <?php echo $this->escape( $item->name); ?>
      </a>


        </td>
        <td>
            <?php echo $item->contacts; ?>
        </td>
        <td class="row 4">
            <?php echo mb_substr($item->info, 0, 200); ?>
        </td>
        <td>
            <?php echo JHTML::_('image', $item->photo, 'PHOTO', 'height="80" width="80"'); ?>
        </td>
    </tr>
<?php endforeach; ?>