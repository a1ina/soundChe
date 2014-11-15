<?php defined('_JEXEC') or die('Restricted access');

?>

<!---->
    <div id="popupbox" class="popup-info">
<!--        <div class="title"><h2>--><?php //echo $this->item->title?><!--</h2></div>-->
<!---->
<!--        <div id="player" class="video">-->

            <?php
            if ($this->item->download	 == 1) {
                echo $this->loadTemplate('download');
            } else {

                if ($this->item->videocode != '') {
                    $this->item->linkimage = $this->item->videocode;
                }

                if ($this->item->nextbuttonhref != '') {
                    echo '<a href="'.$this->item->nextbuttonhref.'">'.$this->item->linkimage.'</a>';
                } else {
                    echo '<span >'.$this->item->linkimage.'</span>';
                }

//                echo $this->item->prevbutton;
//                echo $this->item->nextbutton;
            }

            ?>


<!--        </div>-->
<!---->
<!--        <div class="info">-->
<!---->
<!--            <ul>-->
<!---->
<!--                <li class="comment">-->
<!--                    <h4>Ваш коментар</h4>-->
<!--                    <a id="addcomments" href="#addcomments"></a>-->
<!--                    <form id="comments-form" name="comments-form" action="javascript:void(null);">-->
<!--                        <p>-->
<!--	<span>-->
<!--		<textarea placeholder="Коментувати..." id="comments-form-comment" name="comment" cols="65" rows="8" tabindex="5"></textarea>-->
<!--	</span>-->
<!--                        </p>-->
<!--                        <p>-->
<!--	<span>-->
<!--		<input class="checkbox" id="comments-form-subscribe" type="checkbox" name="subscribe" value="1" tabindex="5" />-->
<!--		<label for="comments-form-subscribe">Подписаться на уведомления о новых комментариях</label><br />-->
<!--	</span>-->
<!--                        </p>-->
<!--                        <div id="comments-form-buttons">-->
<!--                            <div class="btn" id="comments-form-send"><div><a href="#" tabindex="7" onclick="jcomments.saveComment();return false;" title="Отправить (Ctrl+Enter)">Отправить</a></div></div>-->
<!--                            <div class="btn" id="comments-form-cancel" style="display:none;"><div><a href="#" tabindex="8" onclick="return false;" title="Отменить">Отменить</a></div></div>-->
<!--                            <div style="clear:both;"></div>-->
<!--                        </div>-->
<!--                </li>-->
<!---->
<!--            </ul>-->
<!---->
<!--        </div>-->
<!---->
    </div>