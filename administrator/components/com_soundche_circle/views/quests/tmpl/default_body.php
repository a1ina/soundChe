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
            echo JHtml::_('jgrid.published',$item->published,$i,'quests.');
            //echo $published; ?>
        </td>

        <td>
            <?php echo $username; ?>
        </td>
        <td>

      <a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&task=quest.edit&id='. (int) $item->id) ?>">
          <?php echo $this->escape( $item->title); ?>
      </a>


        </td>

        <td class="row 4">
            <?php echo mb_substr($item->description, 0, 200); ?>
        </td>

    </tr>
<?php endforeach; ?>