<div class="block header">
    <div class="searchblock">
        <div class="search-header">Найти мои сертификаты</div>
        <form class="menu-holder search-holder" method="get" title="Введите свои данные для поиска выданных Вам документов">
            <input class="search-box pull-right" name="find" type="text" placeholder="Имя Фамилия">
        </form>
    </div>
    <div class="table"></div>
    <div class="tableborder" id="scrolltocontent">
        <div class="arrow big"></div>
            <div class="toscroll lines">
            <?php
            for ($i=0; $i < 3; $i++) { 
                echo '<div class="flashdot line" style="animation-delay:'.(-1.6 + $i*0.3).'s;"></div>';
            }
            ?>
        </div>

    </div>
</div>
