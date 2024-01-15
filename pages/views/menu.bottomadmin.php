<?php 
use Templater\System\Engine\Application;
$string = substr(Application::$app->request->getUrl(),strlen(SITE_SHORT_NAME)+2);
$active = $this->data['page'];//preg_replace('/index(.php|.html|)/i', '', $string);
?>
    <div class="navigation bottom">
        <div class="part left">
            <!-- <div class="menu-holder flex-vertical">
                <span class="h3">Пользователям</span>
                <a class="menu-item<?=$active == 'plans' ? ' selected' : '' ?>" href="<?=HOME_URL.'plans'?>" id="plans"><span>Тарифы</span></a>
                <a class="menu-item<?=$active == 'payments' ? ' selected' : '' ?>" href="<?=HOME_URL.'payments'?>" id="payments"><span>Способы оплаты</span></a>
                <a class="menu-item<?=$active == 'terms' ? ' selected' : '' ?>" href="<?=HOME_URL.'terms'?>" id="terms"><span>Пользовательское соглашение</span></a>
                <a class="menu-item<?=$active == 'policy' ? ' selected' : '' ?>" href="<?=HOME_URL.'policy'?>" id="policy"><span>Политика конфиденциальности</span></a>
            </div> -->
        </div>
        <div class="part center">
            <!-- <div class="menu-holder flex-vertical">
                <span class="h3">Редактор</span>
                <a class="menu-item<?=$active == 'startuse' ? ' selected' : '' ?>" href="<?=HOME_URL.'startuse'?>" id="startuse"><span>Как начать работу</span></a>
                <a class="menu-item<?=$active == 'capabilities' ? ' selected' : '' ?>" href="<?=HOME_URL.'capabilities'?>" id="capabilities"><span>Возможности</span></a>
                <a class="menu-item<?=$active == 'templates' ? ' selected' : '' ?>" href="<?=HOME_URL.'templates'?>" id="templates"><span>Шаблоны</span></a>
                <a class="menu-item<?=$active == 'lists' ? ' selected' : '' ?>" href="<?=HOME_URL.'lists'?>" id="lists"><span>Связанные записи</span></a>
            </div> -->
        </div>
        <div class="part right">
            <!-- <div class="menu-holder flex-vertical">
                <span class="h3">Компания</span>
                <a class="menu-item<?=$active == 'about' ? ' selected' : '' ?>" href="<?=HOME_URL.'about'?>" id="about"><span>О нас</span></a>
                <a class="menu-item<?=$active == 'cooperation' ? ' selected' : '' ?>" href="<?=HOME_URL.'cooperation'?>" id="cooperation"><span>Сотрудничество</span></a>
                <a class="menu-item<?=$active == 'bankdetails' ? ' selected' : '' ?>" href="<?=HOME_URL.'bankdetails'?>" id="bankdetails"><span>Реквизиты</span></a>
                <a class="menu-item<?=$active == 'feedback' ? ' selected' : '' ?>" href="<?=HOME_URL.'feedback'?>" id="feedback"><span>Обратная связь</span></a>
            </div> -->
        </div>
        <div class="part wide center" style="border: none;">
            <div class="menu-holder">
                <a class="menu-item" href = "mailto: pvl.gigstudio@gmail.com">
                    <span style="margin-top: 6px; font-size: 12px; vertical-align: sub;" >©&nbsp;2023&nbsp;powered&nbsp;by&nbsp;</span>
                    <img src="<?=HOME_URL?>assets/images/gig_logo_text_white.png" style="display: inline-block; height: 28px;">
                </a>
            </div>
        </div>
    </div>
</div>
{{add_js}}