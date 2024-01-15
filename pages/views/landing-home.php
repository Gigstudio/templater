<?php
?>
<div class="landing-row inline" style="background-image: url('<?=HOME_URL."assets/images/bg01.png"?>');">
    <div class="adv plate w400 white">
        <div class="plate-icon big" style="background-image: url('<?=HOME_URL."assets/images/icons/searchstars.png"?>');"></div>
<!-- HARDCODED -->
        <span class="plate-info">Ваши документы всегда у Вас под рукой</span>
    </div>
    <div class="adv plate w400 white">
        <div class="plate-icon big" style="background-image: url('<?=HOME_URL."assets/images/icons/graphic_tablet.png"?>');"></div>
<!-- HARDCODED -->
        <span class="plate-info">Простой и удобный редактор шаблонов</span>
    </div>
    <div class="adv plate w400 white">
        <div class="plate-icon big" style="background-image: url('<?=HOME_URL."assets/images/icons/pictures.png"?>');"></div>
<!-- HARDCODED -->
        <span class="plate-info">Большой выбор готовых шаблонов</span>
    </div>
    <div class="adv plate w400 white">
        <div class="plate-icon big" style="background-image: url('<?=HOME_URL."assets/images/icons/archivecab.png"?>');"></div>
<!-- HARDCODED -->
        <span class="plate-info">Удобная организация списка получателей</span>
    </div>
</div>
<div class="landing-row dark">
    <div class="adv info-plate white" style="background-image: url('<?=HOME_URL."assets/images/diplomas.jpg"?>');"></div>
    <div class="land-info">
        <span class="info-header">Поздравляем!<BR>Вы получили сертификат!</span>
        <span class="info">Вы получили сертификат, диплом, грамоту? Поздравляем! В нашем сервисе Вы можете найти, скачать выданные Вам документы в высоком разрешении. Хотите поставить их в рамочку на столе? Не проблема! Мы распечатаем их для Вас и отправим по почте!</span>
        <div class="landing-row inline">
            <div class="adv plate w400 border skewed">
                <span class="h3">Быстрый поиск</span>
                <i class="fa-solid fa-folder-tree"></i>
                <span class="info">Благодря современным технологиям поиск Ваших документов занимает доли секунд!</span>
            </div>
            <div class="adv plate w400 border skewed">
                <span class="h3">Доступно</span>
                <i class="fa-solid fa-server"></i>
                <span class="info">Все Ваши документы в полной сохранности и доступны 24/7</span>
           </div>
        </div>
    </div>
</div>
<div class="landing-row">
    <div class="land-info">
        <span class="info-header">Ваши документы<BR>всегда под рукой</span>
        <span class="info">В нашем сервисе все документы хранятся вечно*. Получив письмо от нашего сервиса, Вы можете в любой момент  и из любой точки земного шара открыть уникальную ссылку, содержащуюся в сообщении, скачать готовый документ, или же можете отправить ссылку потенциальному работодателю. Ну или друзьям - пусть порадуются за Вас!При этом нет никакой необходимости регистрироваться в системе, сервису не требуются Ваши персональные данные. И все это совершенно бесплатно!</span>
        <span class="info additional">*  организация, выпустившая документ, имеет возможность его отозвать. В этом случае Вам будет предоставлено письменное уведомление и предложено связаться с лицом, выдавшим документ.</span>
    </div>
    <div class="adv info-plate white" style="background-image: url('<?=HOME_URL."assets/images/AI_generated/girl_cartoteka.jpg"?>');"></div>
</div>
<div class="landing-row inline" style="background-image: url('<?=HOME_URL."assets/images/blue_marbl.jpg"?>');">
    <div class="adv plate horizontal white">
        <div class="plate-icon" style="background-image: url('<?=HOME_URL."assets/images/icons/speed.png"?>');"></div>
<!-- HARDCODED -->
        <span class="plate-info">Быстро</span>
    </div>
    <div class="adv plate horizontal white">
        <div class="plate-icon" style="background-image: url('<?=HOME_URL."assets/images/icons/earth_globe.png"?>');"></div>
<!-- HARDCODED -->
        <span class="plate-info">Доступно</span>
    </div>
    <div class="adv plate horizontal white">
        <div class="plate-icon" style="background-image: url('<?=HOME_URL."assets/images/icons/nocard.png"?>');"></div>
<!-- HARDCODED -->
        <span class="plate-info">Бесплатно</span>
    </div>
</div>
<div class="landing-row">
    <div class="adv info-plate white" style="background-image: url('<?=HOME_URL."assets/images/handshake_color.jpg"?>');"></div>
    <div class="land-info">
        <span class="info-header">Ваш личный онлайн-секрет безупречных документов!</span>
        <span class="info">Вы работаете в компании, которая занимается обучением? Порадуйте своих клиентов качественными сертификатами, дипломами, грамотами! После регистрации на нашей платформе Вы моментально получаете возможность за считанные минуты создать проект, выбрать, настроить или создать новый шаблон документа, автоматизировать его выпуск и уведомить Ваших клиентов о получении ими подтверждения их новой квалификации!</span>
        <a href="<?=HOME_URL.'login?action=register'?>" class="button green">
            <span>Зарегистрироваться</span>
            <i class="fa-solid fa-arrow-pointer"></i>
        </a>
    </div>
</div>
<div class="landing-row dark inline" style="background-image: url('<?=HOME_URL."assets/images/blue_marbl.jpg"?>'); padding: 0;">
    <div class="adv" style="padding: 24px 0;">
        <span class="info-header center">Большое количество готовых шаблонов</span>
        <?php if(array_key_exists('slides', $this->data)){ ?>
        <div class="slider">
            <?php
            for ($i=0; $i < 2; $i++) { 
                echo '<div class="slideshow">';
                foreach($this->data['slides'] as $file){
                    echo "<img class=\"miniature\" src=\"$file\">";
                }
                echo '</div>';
            }
            ?>
        </div>
        <?php } ?>
    </div>
</div>
<div class="landing-row">
    <div class="land-info">
        <span class="info-header">Простой, но мощный редактор шаблонов</span>
        <span class="info">Редактор имеет полный набор инструментов и функций, необходимых для быстрого создания шаблонов любой сложности. Меняйте готовые образцы по своему вкусу либо создавайте их с нуля! Рисуйте с помощью встроенных инструментов или вставляйте готовые картинки - Вас может ограничить только Ваша фантазия! Большой набор разнообразных интегрированных шрифтов, порадует своей универсальностью, а использование контрастных цветов сделает любой текст читаемым.</span>
        <a href="<?=HOME_URL.'login?action=register'?>" class="button green">
            <span>Создать шаблон</span>
            <i class="fa-solid fa-arrow-pointer"></i>
        </a>
    </div>
    <div class="adv info-plate white" style="background-image: url('<?=HOME_URL."assets/images/ar_editor.jpg"?>');"></div>
</div>
<div class="landing-row dark" style="background-image: url('<?=HOME_URL."assets/images/blue_marbl.jpg"?>'); box-shadow: 0px 0px 300px 0px rgba(0, 0, 0, 1) inset;">
    <div class="adv info-plate white" style="background-image: url('<?=HOME_URL."assets/images/tons_of_paper.jpg"?>');"></div>
    <div class="land-info">
        <span class="info-header">Избавьтесь от бумажной волокиты</span>
        <span class="info" style="color: var(--c01);">Сервис позволяет с легкостью создавать и управлять списками получателей документов. У Вас уже имеются наработки в другом табличном редакторе? Просто импортируйте их в своё рабочее пространство. Вы можете теперь создать шаблон на основе такого списка, или же можете начать с дизайна шаблона и уже на его основе создать список получателей - все зависит от Вас! Добавляйте получателей, переносите их данные между списками, меняйте шаблоны - Templater Ваш лучший помощник!</span>
        <a href="<?=HOME_URL.'login?action=register'?>" class="button green">
            <span>Создать список получателей</span>
            <i class="fa-solid fa-arrow-pointer"></i>
        </a>
    </div>
</div>
<div class="landing-row">
    <div class="land-info center">
        <a class="menu-item" id="biglogo" href="<?=HOME_URL?>">
            <span></span>
            <img src="<?=HOME_URL . 'assets/images/' . MAIN_LOGO_FILE?>">
        </a>
        <span class="info-header">Быстро, профессионально, персонально: <BR>Ваш путь к эффектным документам!</span>
        <a href="<?=HOME_URL.'login?action=register'?>" class="button green">
            <span>Стать лучшим!</span>
            <i class="fa-solid fa-arrow-pointer"></i>
        </a>
    </div>
</div>