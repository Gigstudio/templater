<?php
use Templater\System\Engine\Application;
$string = substr(Application::$app->request->getUrl(),strlen(SITE_SHORT_NAME)+2);
$active = $this->data['page'];
?>
<ul class="navigation side">
<?php 
if(array_key_exists('sidemenuitems', $this->data)){
    foreach($this->data['sidemenuitems'] as $item){
        echo '<a href="'.HOME_URL.$item['name'].'" class="menu-item'.($active == $item['name'] ? ' selected' : '').'">'.$item['title'].'</a>';
    }
}
?>
</ul>