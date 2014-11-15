<?php

// no direct access
defined('_JEXEC') or die;


//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_soundche_circle', JPATH_ADMINISTRATOR);


?>
<div class="sidebar">
    <ul>
        <li> <a class="now" href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=fest') ?>">Програма фесту</a></li>
        <li><a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=fest&layout=photo') ?>">Фото</a>
        </li>
        <li><a href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=fest&layout=video') ?>">Відео</a>
        </li>
        <li>
            <a   href="<?php echo JRoute::_('index.php?option=com_soundche_circle&view=partners&layout=partner'); ?>">Патртнери</a>
        </li>
    </ul>
</div>

<div class="content">

    <ul class="year_slider">
        <li>2011</li>
        <li>2012</li>
        <li>2013</li>
        <li>2014</li>
        <li>2015</li>
        <li>2016</li>
    </ul>

    <form id="slider_form" name="slider_form"
          action="<?php echo JURI::base() ?>index.php?option=com_soundche_circle&view=fest&layout=default&Itemid=124"
          method="post">
        <input name="slider" type="text" id="amount" style="border:0; visibility: hidden; color:#f6931f; font-weight:bold;">
        <input type="submit" value="submit" style="visibility: hidden">
    </form>


    <div id="slider"></div>

<?php if ($this->item) : ?>


    <?php
    if (isset($_POST['slider'])) {
        $current_year = $_POST['slider'];
        $_SESSION['cur_year'] = $_POST['slider'];
    } elseif (!empty($_SESSION['cur_year'])) {
        $current_year  = $_SESSION['cur_year'];
    } else  {
        $current_year = date('Y');
    }


    foreach ($this->item as $row):

        if ($current_year == date('Y', strtotime($row->date))) {
  ?>

                <h2 class="h2_mod"><?php echo $row->title; ?></h2>
                <p><?php echo $row->description; ?></p>


            </div>


        <?php

        };
    endforeach;

else:
    echo JText::_('COM_SOUNDCHE_CIRCLE_ITEM_NOT_LOADED');
endif;



?>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


<script>
    $(function () {
        $("#slider").slider({
            value:<?php echo $current_year?>,
            min: 2011,
            max: 2016,
            step: 1,
            slide: function (event, ui) {
                $("#amount").val(+ui.value);
            },
            change: function (event, ui) {

                $("#slider_form").submit();

            }

        });

        $("#amount").val($("#slider").slider("value"));
    });
</script>


