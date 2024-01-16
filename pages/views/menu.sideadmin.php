<?php
use Templater\System\Engine\Application;
$string = substr(Application::$app->request->getUrl(),strlen(SITE_SHORT_NAME)+2);
$active = $this->data['page'];
?>

<input type="checkbox" class="hidden" name="compactsidemenu" id="compactsidemenu">
<ul class="navigation sideadmin">
<?php if(file_exists(PATH_ASSETS . 'images/ttypelight.png')): 
    echo '<li>
        <a class="menu-item" id="logosmall" href="' . HOME_URL . '">
        </a></li>';
    endif ?>
    <hr class="line-divider">
<?php 
if(array_key_exists('sidemenuitems', $this->data)){
    foreach($this->data['sidemenuitems'] as $item){
        echo '<li><a href="'.HOME_URL.$item['name'].'" class="menu-item'.($active == $item['name'] ? ' selected' : '').'">'.(isset($item['icon'])?'<i class="'.$item['icon'].'"></i>':'').'<span>'.$item['title'].'</span></a></li>';
    }
}
?>
</ul>
<div class="compactcontrol">
    <label for="compactsidemenu"><i class="fa-solid fa-chevron-left"></i></label>
</div>