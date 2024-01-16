<?php
// use Templater\System\Engine\Application;
// $string = substr(Application::$app->request->getUrl(),strlen(SITE_SHORT_NAME)+2);
// $active = $this->data['page'];

?>
<div class="landing-row" style="padding-top: 124px;">
    <div class="land-info" style="max-width: 210px; min-width: 210px; padding-top: 32px;">
        <span class="h2">Информация для пользователей</span>
        {{sidemenu}}
    </div>
    <div class="land-info border">
        <span class="info-header">Политика конфиденциальнсти</span>
        <!-- text block -->
        <span class="info">Текст политики...</span>
        <!--  -->
    </div>
</div>
<div class="landing-row">
    <div class="land-info center">
        <a class="menu-item" id="biglogo" href="<?=HOME_URL?>">
            <span></span>
            <img src="<?=HOME_URL . 'assets/images/' . MAIN_LOGO_FILE?>">
        </a>
        <span class="info-header">Быстро, профессионально, персонально: <BR>Ваш путь к эффектным документам!</span>
        <a href="<?=HOME_URL.'login?action=register'?>" class="button green" id="signup_button">
            <span>Стать лучшим!</span>
            <i class="fa-solid fa-arrow-pointer"></i>
        </a>
    </div>
</div>