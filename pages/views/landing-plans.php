<?php
use Templater\System\Engine\Application;
$string = substr(Application::$app->request->getUrl(),strlen(SITE_SHORT_NAME)+2);
$active = $this->data['page'];
?>

<div class="landing-row" style="padding-top: 124px;">
    <div class="land-info" style="max-width: 400px; min-width: 400px; padding-top: 32px;">
        <span class="h2">Информация для пользователей</span>
        {{sidemenu}}
    </div>
    <div class="land-info border">
        <span class="info-header">ТАРИФНЫЕ ПЛАНЫ</span>
        <span class="info">Тариф “Базовый” позволяет создавать и сопровождать 2 проекта, пользуясь всеми основными функциями сервиса. Нужно больше? Добавьте себе такую возможность за символическую плату!</span>
        <div class="landing-row inline" style="padding: 12px;">
            <div class="adv plate white plate3d" style="min-width: 300px;">
                <div class="land-info" style="gap: 10px;">
                    <span class="h2">Базовый</span>
                    <span class="info additional">&nbsp;</span>
                    <span class="bignum">0,00 тг</span>
                    <span class="info">Включает все основные функции сервиса.<BR>Количество сопровождаемых проектов - 2</span>
                </div>
                <a href="<?=HOME_URL.'login?action=register'?>" class="button green">
                    <span>подключить</span>
                    <i class="fa-solid fa-check"></i>
                </a>
             </div>
            <div class="adv plate white plate3d" style="min-width: 300px;">
                <div class="land-info" style="gap: 10px;">
                    <span class="h2">Продвинутый</span>
                    <span class="info additional">годовая подписка</span>
                    <span class="bignum">12 790 тг</span>
                    <span class="info">Включает все основные функции сервиса<BR>Количество сопровождаемых проектов - 10<BR>Возможность использования сторонних шрифтов</span>
                </div>
                <a href="<?=HOME_URL.'login?action=register'?>" class="button green">
                    <span>подключить</span>
                    <i class="fa-solid fa-check"></i>
                </a>
            </div>
        </div>
        <div class="landing-row inline" style="padding: 12px;">
            <div class="adv plate white plate3d">
                <span class="h2">В любой момент Вы можете начать дополнительные проекты.</span>
                <span class="h2" style="color: var(--c28);">Расчет стоимости:</span>
                <div class="landing-row inline">
                    <div class="land-info" style="gap: 12px; justify-content: space-between; padding: 16px 0; flex-grow: 0; min-width: 250px;">
                        <span class="info additional" style="width: 100%; text-align: right; font-size: 12px;">Количество доступных проектов:</span>
                        <span class="info additional" style="width: 100%; text-align: right; font-size: 12px;">Стоимость годовой подписки:</span>
                    </div>
                    <form class="adv border" id="counterform" name="paycalc">
                        <div class="counter" style="border-radius: 12px 12px 0 0;">
                            <button class="counter-control number-minus disabled" type="button">-</button>
                            <input class="input-counter" type="number" value="12" name="quantity" min="2" max="20" />
                            <button class="counter-control number-plus" type="button">+</button>
                        </div>
                        <input class="input-text" type="text" value="0" name="total" disabled style="border-radius: 0 0 12px 12px;"/>
                    </form>
                </div>
                <a href="<?=HOME_URL.'login?action=register'?>" class="button green">
                    <span>подключить</span>
                    <i class="fa-solid fa-check"></i>
                </a>
            </div>
        </div>
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