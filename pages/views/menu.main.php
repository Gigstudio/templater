<?php 
use Templater\System\Engine\Application;

$string = substr(Application::$app->request->getUrl(),strlen(SITE_SHORT_NAME)+2);
$page = $this->data['page'];
$active[0] = in_array($page, ['plans', 'payments', 'terms', 'policy']);
$active[1] = in_array($page, ['startuse', 'capabilities', 'templates', 'lists']);
$active[2] = in_array($page, ['about', 'cooperation', 'bankdetails', 'feedback']);
?>

<nav id="mainmenu" class="part main-menu">
    <div class="row hide_1050"></div>
    <div class="row">
        <a class="menu-item" id="hamburger" title=""><span>&nbsp;</span><i class="fa-solid fa-bars"></i></a>
        <div class="menu-holder" id="main_links">
            <a class="menu-item<?=$active[0] ? ' selected' : '' ?>" href="<?=HOME_URL.'plans'?>" id="plans"><span>Пользователям</span></a>
            <a class="menu-item<?=$active[1] ? ' selected' : '' ?>" href="<?=HOME_URL.'startuse'?>" id="startuse"><span>Возможности</span></a>
            <a class="menu-item<?=$active[2] ? ' selected' : '' ?>" href="<?=HOME_URL.'about'?>" id="about"><span>О сервисе</span></a>
        </div>
    </div>
</nav>