<?php

// no direct access
defined('_JEXEC') or die;


//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_soundche_circle', JPATH_ADMINISTRATOR);

 if ($this->item) : ?>

        <div class="content" >
                <ul class="c_marg">
                    <li>
                        <div class="inf">
                            <h2><?php echo $this->item[0]->name; ?></h2>
                            <p><?php echo $this->item[0]->description; ?></p>
                        </div>
                    </li>
                </ul>
        </div>

    <?php
    else:
        echo JText::_('COM_SOUNDCHE_CIRCLE_ITEM_NOT_LOADED');
    endif;
    ?>
