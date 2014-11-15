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

$doc->addScript('//code.jquery.com/jquery-1.10.2.js');

$doc->addStyleDeclaration('
.crewman-photo-container {
position: relative;

}
.crewman-photo-container img {
position:absolute;
}


.crewman-photo-container .joke_photo {
display:none;
}

');

$doc->addScriptDeclaration("

    $(document).ready(function () {

                    $('a').hover(

                        function () {

                            $(this).children('.joke_photo').stop().fadeIn('600', 'linear');

                        },

                        function () {
                            $(this).children('.joke_photo').stop().fadeOut('600', 'linear');

                        }
                    );

            }

    );


");

?>


<?php $show = false; ?>

<div class="content">
    <ol class="border">
        <?php foreach ($this->items as $item): ?>

            <?php if ($item->published == 1 || ($item->published == 0 && JFactory::getUser()->authorise('core.edit.own', ' com_soundche_circle.team.' . $item->id))):
                $show = true;?>



                <li class="crewman-photo-container">
                    <a href="#" class="team">
                        <?php
                        echo JHTML::_('image', $item->photo, 'ALT Картинки', 'class = "normal_photo"');
                        echo JHTML::_('image', $item->joke_photo, 'ALT Картинки', 'class = "joke_photo"');
                        ?></a>

                    <div class="inf">
                        <h2><?php echo $item->name ?></h2>
                        <span><?php echo $item->activity ?></span>

                        <p>
                            <?php echo $item->description ?>
                        </p>
                    </div>
                </li>

            <?php endif; ?>

        <?php endforeach; ?>
    </ol>
</div>

<!---->
<!---->
<!--<pre>--><?php
//
//    print_r($this->items)
//
?><!--</pre>-->
<!---->
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

