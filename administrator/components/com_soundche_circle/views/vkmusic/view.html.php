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
//


jimport('joomla.application.component.view');

/**
 * View class for a list of Soundche_circle.
 */
class Soundche_circleViewVkmusic extends JView
{

    /**
     * Display the view
     */
    // Overwriting JView display method
    function display($tpl = null)
    {






        ?>
        <form id="form" method="POST" action="<?php echo JURI::base() . '../vk/update_albums.php'; ?>">

            <input type="submit" value="Оновити список альбомів"/>
        </form>



        <script src="//code.jquery.com/jquery-1.9.1.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo JURI::base() . 'components/com_soundche_circle/assets/js/jquery.form.js' ?>"></script>
        <script type="text/javascript">
            // ожидаем загрузки всего документа
            $(document).ready(function() {
                // назначаем 'myForm' обрабатываемой формой и задаем ей простецкую функцию
                $('#form').ajaxForm(function() {
                    alert("Список альбомів оновлено!");
                });
            });
        </script>


       <?php
parent::display($tpl);
        // Set the submenu
        Soundche_circleHelper::addSubmenu('messages');
        }
}

?>
