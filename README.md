## Базовые Требования и Ограничения
* Версия PHP: 7.4 (Минимальная)
* Версия Laravel: 5.7 (Минимальная). Чем меньше зависимость от фреймворка, тем лучше.
* Примерная Оценка Времени: 8 рабочих часов. После получения задания можно задавать уточняющие вопросы.
* Приоритет: Архитектура и Качество Кода (Чистый код, SOLID, паттерны). Небольшой, но хорошо структурированный и тестируемый код важнее полноты реализации. Overengineering в разумных пределах приветствуется.

## Описание Задачи
Необходимо запрограммировать полный ETL-процесс (Extract, Transform, Load) для ежедневного обновления биржевых данных из внешнего CSV-файла, включая всю необходимую инфраструктуру для автоматического запуска.

Источник Данных: Ежедневно в одно и то же время на внешнем сайте появляется CSV-файл с данными о торгах (EOD) и фундаментальными данными за предыдущий день — для примера файл лежит здесь http://eodhd.com/dev-test/m2-daily-stock-txn-subscriber_2025-09-26_000.csv

Данные в Файле: Тикер, EOD-данные (OHLC, Volume), Фундаментальные данные (Market Cap, Shares Outstanding).

## Требуемая Реализация и Структура
В первую очередь нужно прописать End-to-End Flow и структуру кода, детали реализации могут быть заменены заглушками, комментариями или вызовами нереализованных методов.
1. Основной Flow (Процесс):
    1. Скачивание: Получение CSV-файла с внешнего ресурса.
    2. Парсинг/Трансформация: Чтение файла, валидация и преобразование данных в структурированный формат.
    3. Обновление БД:
        * Создание недостающих тикеров в таблице tickers.
        * Обновление EOD-данных (Open, High, Low, Close, Volume)
        * Обновление фундаментальных данных (Market Cap, Shares Outstanding).
2. Инфраструктура:
    1. Создать Консольную команду Laravel (Artisan command) для запуска всего процесса.
    2. Настроить Расписание (Laravel Scheduler) для ежедневного запуска этой команды.

## Предопределенные Классы
Предполагается, что следующие классы существуют, но их реализация не требуется

### Классы-модели: Ticker, Exchange, DayData (EOD), Fundamentals.

### Обновление eod надо встроить в существующий процесс
```PHP
final class SingleTickerDayDataUpdater
public function setSourceStrategy(SourceStrategy $sourceStrategy): void;
public function update(Ticker $ticker): void;
```

```PHP
final class GivenSourceStrategy implements SourceStrategy
/** @param ITickerDayDataSrc[] $sources */
public function __construct(array $sources)
```

```PHP
interface TickerDayDataSrc
/** @return array{Date,Open,High,Low,Close,Volume,Adj_Close} **/
public function getData(Ticker $ticker, $startDate, $endDate = null): array;
```