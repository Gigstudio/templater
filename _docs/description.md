## 1. Цели и задачи сервиса
- подготовка и выпуск бланков и сертификатов любой направленности;
- поиск готовых сертификатов в базе сервиса;
- получение готовых документов по уникальной ссылке;
- *`верификация`*.

## 2. Целевая аудитория
- физические лица;
- юридические лица;
- *`контролирующие органы`*;
- *`сертифицирующие органы`*.

## 3. Правовая основа
*`необходимо провести исследование законодательных актов в области сертификации в РК (и РФ?)`*

## 4. Описание процесса
### Точки входа пользователей
- **Прямой доступ.**

Сервис доступен для всех посетителей, адрес ресурса - <http://templater.kz>. Главная страница ресурса представляет собой лэндинг с описанием сервиса и ссылками на регистрацию и документы общего характера: Политика в области обработки персональных данных; Политика конфиденциальности; Пользовательское соглашение и т.п.

- **Персональная ссылка**

Сервис получает запрос, содержащий данные, необходимые для генерирования документа, формирует pdf-документ и открывает его в браузере посетителя.

- **Вход зарегистрированного пользователя**

Зарегистрированный пользователь перенаправляется в личный кабинет, на главном экране которого список (миниатюры) созданных им шаблонов документов.

## 5. Роли
- администратор сервиса (supervisor);
- зарегистрированный пользователь (director);
- дизайнер (designer);
- менеджер (manager);
- пользователь-гость (visitor).

## 6. Основные функции сервиса
**- visitor**
- просмотр и скачивание готового документа по уникальной ссылке;
- поиск выпущенных сертификатов по получателю (имя фамилия).

**- manager**
- ведение списка получателей;
- формирование и отправка уникальных ссылок на готовые документы.

**- designer**
- создание шаблона (редактор шаблонов);
- *`загрузка и адаптация сторонних шаблонов`*.

**- director**
- просмотр, "приобретение" готовых шаблонов;
- создание шаблона (редактор шаблонов);
- *`загрузка и адаптация сторонних шаблонов`*.
- ведение списка получателей;
- формирование и отправка уникальных ссылок на готовые сертификаты;
- формирование отчетов;
- приглашение, отстранение менеджеров;

**- supervisor**
- управление пользователями сервиса;
- управление полномочиями пользователей;
- управление базой данных;
- *`мониторинг состояния, производительности`*;
- поддержка обратной связи с пользователями сервиса.

## 7. Используемые технологии
- backend: PHP;
- frontend: HTML, CSS, JavaScript;
- data store: MySQL, JSON, CSV;
- *`payment`*

## 8. Запросы к генератору изображений
- грустная девушка-бухгалтер: `cinematic photo, sad beutiful russian girl sitting at an accountant's workplace, throws papers up, high detailed skin, skin pores. 35mm photograph, film, professional, 4k, highly detailed`
- яркая "шапка", всплеск красок: `little explosion of bright paints over clear scheet of paper, light background. 35mm photograph, film, professional, 4k, highly detailed`

## 9. Примеры заголовков лэндинга
- `Templater: Ваш онлайн-секрет безупречных документов`. Акцент на доверие к компании, у которой все бланки выглядят безупречно
- `Создавайте профессиональные документы за минуты: Ваш личный онлайн-секрет` - акцент на экономии времени при оформлении типизированных документов
- 
