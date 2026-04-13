# Devity — платформа для обучения разработке игр на Unity

![License](https://img.shields.io/badge/license-MIT-green)
![Laravel](https://img.shields.io/badge/Laravel-11.x-red)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0-blue)

Devity — это образовательная платформа для изучения разработки игр на Unity и программирования на C#. Платформа предоставляет полный курс, структурированный по блокам и урокам, с возможностью прохождения тестов и выполнения практических заданий.

## 📋 Содержание

- [Основные возможности](#основные-возможности)
- [Технологический стек](#технологический-стек)
- [Требования](#требования)
- [Развертывание](#развертывание)
- [Доступы пользователей](#доступы-пользователей)
- [Содержание курса](#содержание-курса)
- [Структура БД](#структура-бд)
- [API документация](#api-документация)
- [Полезные команды](#полезные-команды)

---

## ✨ Основные возможности

- **📚 Полноценный курс** "Обучение Unity с нуля" (3 блока, 19 уроков)
- **📝 Тесты** для проверки знаний (15 тестов с вопросами)
- **✅ Практические задания** с возможностью сабмита файлов
- **⭐ Система оценок** для заданий от преподавателей
- **👥 Управление группами** студентов
- **🔐 Аутентификация** через Sanctum API tokens
- **🎛️ Админ-панель** на основе Orchid Platform
- **📊 Статистика** по прогрессу студентов

---

## 🛠️ Технологический стек

**Backend:**
- Laravel 11.x (PHP 8.2+)
- MySQL 8.0
- Eloquent ORM
- Laravel Sanctum (API)
- Orchid Platform (Admin Panel)
- Vite (Asset bundling)

**Infrastructure:**
- Docker & Docker Compose
- PHPUnit (тестирование)

---

## 📦 Требования

- Docker & Docker Compose
- или
- PHP 8.2+
- MySQL 8.0+
- Composer

---

## 🚀 Развертывание

### Вариант 1: С помощью Docker (рекомендуется)

#### 1. Клонирование репозитория
```bash
git clone <repository-url>
cd Devity-backend
```

#### 2. Настройка окружения
```bash
cp .env.example .env  # если нужно
# или используйте существующий .env
```

**Ключевые переменные в .env:**
```env
APP_NAME=Devity
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database (Docker)
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=devityDB
DB_USERNAME=user
DB_PASSWORD=test1234

# Locale
APP_LOCALE=ru
APP_FALLBACK_LOCALE=ru

# Сессии
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Cache
CACHE_STORE=database

# Очереди
QUEUE_CONNECTION=database
```

#### 3. Сборка и запуск контейнеров
```bash
docker compose up -d
```

Проверьте статус:
```bash
docker compose ps
```

Должны быть 2 контейнера: `laravel-app` и `mysql-db`

#### 4. Установка зависимостей
```bash
docker compose exec app composer install
```

#### 5. Генерирование ключа приложения
```bash
docker compose exec app php artisan key:generate
```

#### 6. Миграции БД
```bash
docker compose exec app php artisan migrate
```

#### 7. Заполнение БД тестовыми данными
```bash
docker compose exec app php artisan db:seed --class=DevitySeeder
```

#### 8. Готово!
Приложение доступно по адресу: **http://localhost:8080**

---

### Вариант 2: Локальная установка (без Docker)

#### 1. Установка зависимостей
```bash
composer install
```

#### 2. Генерирование ключа
```bash
php artisan key:generate
```

#### 3. Миграции и сидирование
```bash
php artisan migrate
php artisan db:seed --class=DevitySeeder
```

#### 4. Запуск сервера
```bash
php artisan serve
```

Приложение будет доступно по адресу: **http://localhost:8000**

---

## 👤 Доступы пользователей

### Администратор
| Параметр | Значение |
|----------|----------|
| **Email** | `admin@admin.com` |
| **Пароль** | `admin` |
| **Роль** | Administrator |
| **Доступ** | Полный доступ ко всем функциям |
| **Панель** | `/admin` |
| **Права** | platform.index, platform.blocks, platform.groups, platform.courses, platform.lessons, platform.statistics и др. |

### Преподаватель
| Параметр | Значение |
|----------|----------|
| **Email** | `teacher@mail.ru` |
| **Пароль** | (задать при первом входе или использовать) |
| **Роль** | Teacher |
| **Доступ** | Управление своей группой, проверка заданий |
| **Группа** | МКИС31 |
| **Возможности** | platform.index, platform.groups, platform.statistics, platform.assignment-submissions |

### Студент #1
| Параметр | Значение |
|----------|----------|
| **Email** | `mstrygina13@gmail.com` |
| **ФИО** | Мирослава Олеговна Стрыгина |
| **Телефон** | +79001369383 |
| **Роль** | Student (без специальной роли) |
| **Группа** | МКИС31 |
| **Возможности** | Доступ только к учебным материалам |

### Студент #2
| Параметр | Значение |
|----------|----------|
| **Email** | `test@mail.ru` |
| **ФИО** | Тестовый тестовый |
| **Телефон** | +78991233221 |
| **Роль** | Student |
| **Доступ** | Тестовый аккаунт для демонстрации |

---

## 📚 Содержание курса

### Главный курс
**"Обучение Unity с нуля"** — полный путь от новичка до создания собственной игры

#### Блок 1: Основы C# для Unity (5 уроков + 5 практик)
1. **Переменные и типы данных** 
   - Основные типы: int, float, bool, string, char
   - Объявление и инициализация переменных
   - Изменение значений
   - Практика: создание переменных и вывод в консоль

2. **Арифметические и логические операторы**
   - Вычисления: +, -, *, /, %
   - Логические операции: &&, ||, !
   - Сравнение значений
   - Практика: расчеты и проверка условий

3. **Циклы — for, while, foreach**
   - Цикл for: использование и примеры
   - Цикл while: условие выхода
   - Foreach для коллекций
   - break и continue
   - Практика: перебор данных и выполнение повторяющихся операций

4. **Условия — if, else, switch**
   - Конструкция if-else
   - Множественные условия (else if)
   - Оператор switch
   - Вложенные условия
   - Практика: развет логики в programa

5. **Методы и параметры**
   - Объявление и вызов методов
   - Параметры и возвращаемые значения
   - Переиспользование логики
   - Практика: создание методов для разных операций

#### Блок 2: Основы Unity (9 уроков + 8 практик)
1. **Введение в Unity**
   - Установка Unity Hub и редактора
   - Создание нового проекта
   - Структура проекта
   - Интерфейс редактора

2. **Сцена и объекты**
   - Что такое GameObject
   - Создание и размещение объектов
   - Трансформация (Position, Rotation, Scale)
   - Иерархия объектов в сцене

3. **Компоненты и инспектор**
   - Система компонентов в Unity
   - Встроенные компоненты (Transform, Renderer, Collider)
   - Добавление и удаление компонентов
   - Редактирование свойств в Inspector

4. **Материалы и цвета**
   - Создание материалов
   - Работа с цветом и текстурами
   - Шейдеры (Standard, URP Lit)
   - Применение материалов к объектам

5. **Камера и освещение**
   - Настройка основной камеры
   - Типы источников света (Directional, Point, Spot)
   - Параметры света (intensity, range, color)
   - Создание правильной освещённости сцены

6. **Перемещение и вращение объектов**
   - Использование transform для движения
   - Вращение объектов
   - Управление с клавиатуры (Input.GetAxis)
   - Использование Time.deltaTime

7. **Создание префабов**
   - Что такое префаб и зачем он нужен
   - Создание префабов из объектов
   - Спаун объектов (Instantiate)
   - Управление жизненным циклом объектов

8. **Основы UI**
   - Canvas и система координат
   - Элементы UI: Text, Button, Image, Slider
   - Обработка событий (OnClick и т.д.)
   - Подключение скриптов к UI элементам

9. **Первый сбор проекта**
   - Подготовка к билду
   - Build Settings и Player Settings
   - Экспорт под разные платформы
   - Проверка готового приложения

#### Блок 3: Создание игры на Unity (5 уроков + 5 практик)
1. **Создание игрового уровня**
   - Элементы уровня: земля, платформы, стены
   - Масштабирование и расположение объектов
   - Организация иерархии уровня
   - Применение материалов и визуального стиля

2. **Управление игроком**
   - Создание персонажа (Capsule)
   - Компонент Rigidbody и физика
   - Скрипт управления движением
   - Реализация прыжка
   - Проверка касания земли

3. **Камера, следящая за игроком**
   - Привязка камеры к игроку
   - Плавное следование (Vector3.Lerp)
   - Настройка угла обзора
   - Направление камеры (LookAt)

4. **Сбор предметов и счёт**
   - Создание собираемых объектов
   - Использование триггеров (IsTrigger)
   - Обработка столкновений
   - UI счётчик и обновление счёта
   - Уничтожение объектов (Destroy)

5. **Победа и перезапуск уровня**
   - Логика победы (условие завершения)
   - Экран победы
   - Перезагрузка сцены (SceneManager)
   - Улучшение user experience

**Итого: 19 уроков + 15 тестов + 16 практических заданий**

---

## 🗄️ Структура БД

### Основные таблицы

#### Пользователи (`users`)
- **Кол-во записей:** 4
- **Поля:** id, name, surname, patronymic, phone, email, password, permissions (JSON), created_at, updated_at

#### Курсы (`courses`)
- **Кол-во записей:** 1
- **Содержание:** "Обучение Unity с нуля"

#### Блоки (`blocks`)
- **Кол-во записей:** 3
- **Структура:**
  1. Основы C# для Unity
  2. Основы Unity
  3. Создание игры на Unity

#### Уроки (`lessons`)
- **Кол-во записей:** 19
- **Содержание:** Полный контент на Markdown для каждого урока

#### Тесты (`tests`)
- **Кол-во записей:** 15
- **Вопросы:** Множественный выбор (A, B, C, D)
- **Таймер:** 10 минут на прохождение

#### Задания (`assignments`)
- **Кол-во записей:** 16
- **Тип:** Практические задания с сабмитом файлов

#### Групповые структуры
- **Группы:** 1 группа "МКИС31"
- **Члены группы:** 2 студента (включая одного преподавателя)

---

## 🔌 API Документация

### Аутентификация

#### Получение токена
```bash
POST http://localhost:8080/api/auth/login
Content-Type: application/json

{
  "email": "mstrygina13@gmail.com",
  "password": "password"
}

# Ответ (200)
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
  "type": "Bearer"
}
```

#### Использование токена в запросах
```bash
GET http://localhost:8080/api/courses
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
```

### Основные эндпоинты

#### Курсы
```
GET    /api/courses              # Список всех курсов
GET    /api/courses/{id}         # Один курс с блоками и уроками
```

#### Блоки
```
GET    /api/blocks               # Список блоков
GET    /api/blocks/{id}          # Один блок с уроками
GET    /api/courses/{id}/blocks  # Блоки курса
```

#### Уроки
```
GET    /api/lessons              # Список всех уроков
GET    /api/lessons/{id}         # Просмотр урока
GET    /api/blocks/{id}/lessons  # Уроки блока
```

#### Тесты
```
GET    /api/tests                # Список доступных тестов
GET    /api/tests/{id}           # Вопросы теста
POST   /api/tests/{id}/submit    # Отправка ответов
GET    /api/test-results         # История прохождения тестов
```

**Пример сабмита теста:**
```json
POST /api/tests/1/submit
{
  "answers": [
    {"question_id": 3, "answer": "A"},
    {"question_id": 4, "answer": "B"},
    {"question_id": 5, "answer": "C"}
  ]
}
```

#### Задания
```
GET    /api/assignments          # Список всех заданий
GET    /api/assignments/{id}     # Описание задания
POST   /api/assignments/{id}/submit # Сабмит файла
GET    /api/assignments/{id}/submissions # Статус сабмитов пользователя
GET    /api/submissions/{id}/grade     # Оценка (для преподавателя)
```

**Пример сабмита файла:**
```bash
POST /api/assignments/1/submit
Content-Type: multipart/form-data

file: <binary file>
```

#### Статистика (для студента)
```
GET    /api/stats/progress       # Прогресс пользователя
GET    /api/stats/tests          # Результаты тестов
GET    /api/stats/assignments    # Статус заданий
```

#### Группы (для преподавателя)
```
GET    /api/groups               # Мои группы
GET    /api/groups/{id}          # Информация о группе
GET    /api/groups/{id}/members  # Список членов группы
GET    /api/groups/{id}/stats    # Статистика группы
POST   /api/groups/{id}/stats/export # Экспорт оценок
```

---

## 📋 Полезные команды

### Миграции БД
```bash
# Применить все ожидающие миграции
docker compose exec app php artisan migrate

# Откатить последний батч миграций
docker compose exec app php artisan migrate:rollback

# Откатить все миграции
docker compose exec app php artisan migrate:reset

# Откатить все и применить заново
docker compose exec app php artisan migrate:fresh

# С тестовыми данными
docker compose exec app php artisan migrate:fresh --seed --seeder=DevitySeeder

# Статус миграций
docker compose exec app php artisan migrate:status
```

### Сидирование БД
```bash
# Заполнить БД тестовыми данными
docker compose exec app php artisan db:seed

# Запустить конкретный сидер
docker compose exec app php artisan db:seed --class=DevitySeeder

# Сбросить и заполнить заново
docker compose exec app php artisan migrate:fresh --seed
```

### Работа с Tinker REPL
```bash
docker compose exec app php artisan tinker

# В tinker:
>>> User::count()
4
>>> Course::with('blocks.lessons')->first()
>>> Assignment::where('lesson_id', 1)->get()
>>> exit
```

### Очистка кэша и конфига
```bash
docker compose exec app php artisan cache:clear
docker compose exec app php artisan route:clear
docker compose exec app php artisan view:clear
docker compose exec app php artisan config:clear
docker compose exec app php artisan optimize:clear
```

### Логи
```bash
# Логи контейнера app
docker compose logs app

# Логи БД
docker compose logs db

# Следить за логами в реальном времени
docker compose logs -f app

# Последние 50 строк
docker compose logs --tail=50 app
```

### Управление контейнерами
```bash
# Статус контейнеров
docker compose ps

# Запустить контейнеры
docker compose up -d

# Остановить контейнеры
docker compose down

# Пересоздать контейнеры
docker compose restart

# Полная очистка
docker compose down -v  # удалит все данные!
```

### Доступ к контейнерам
```bash
# Bash в контейнере app
docker compose exec app bash

# MySQL CLI в контейнере db
docker compose exec db mysql -u user -p -D devityDB

# Выполнить одну команду
docker compose exec app php -v
```

---

## 🔍 Структура проекта

```
Devity-backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── CourseController.php
│   │   │   ├── LessonController.php
│   │   │   ├── TestController.php
│   │   │   ├── AssignmentController.php
│   │   │   └── GroupController.php
│   │   └── Requests/
│   │       └── (Form Request классы)
│   ├── Models/
│   │   ├── User.php
│   │   ├── Course.php
│   │   ├── Block.php
│   │   ├── Lesson.php
│   │   ├── Test.php
│   │   ├── TestQuestion.php
│   │   ├── TestUserResult.php
│   │   ├── Assignment.php
│   │   ├── AssignmentSubmission.php
│   │   ├── AssignmentGrade.php
│   │   ├── Group.php
│   │   ├── GroupMember.php
│   │   └── (другие модели)
│   ├── Services/
│   │   ├── CourseService.php
│   │   ├── AssignmentService.php
│   │   ├── TestService.php
│   │   ├── AssignmentSubmissionService.php
│   │   ├── GroupService.php
│   │   └── (другие сервисы)
│   ├── Orchid/
│   │   ├── PlatformProvider.php
│   │   ├── Filters/
│   │   ├── Layouts/
│   │   ├── Presenters/
│   │   └── Screens/
│   └── Providers/
│       ├── AppServiceProvider.php
│       └── (другие провайдеры)
├── database/
│   ├── migrations/ (27 файлов)
│   │   ├── create_users_table.php
│   │   ├── create_courses_table.php
│   │   ├── create_blocks_table.php
│   │   ├── create_lessons_table.php
│   │   ├── create_tests_table.php
│   │   ├── create_assignments_table.php
│   │   ├── create_groups_table.php
│   │   └── (и другие)
│   ├── seeders/
│   │   ├── DatabaseSeeder.php
│   │   └── DevitySeeder.php (основной сидер)
│   └── factories/
│       └── UserFactory.php
├── routes/
│   ├── api.php (REST API endpoints)
│   ├── web.php (Web routes)
│   ├── platform.php (Orchid админ-панель)
│   └── console.php (Artisan commands)
├── config/
│   ├── app.php
│   ├── database.php
│   ├── cache.php
│   ├── session.php
│   ├── sanctum.php
│   └── (другие конфиги)
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
├── storage/
│   ├── app/ (file storage)
│   ├── framework/
│   └── logs/
├── tests/
│   ├── Feature/
│   ├── Unit/
│   └── TestCase.php
├── bootstrap/
├── public/
│   ├── index.php
│   └── (static files)
├── docker-compose.yml
├── Dockerfile
├── docker-compose.yml
├── .env
├── .gitignore
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── phpunit.xml
└── README.md
```

---

## 🐛 Решение проблем

### Проблема: Контейнеры не запускаются

**Решение:**
```bash
# Проверьте статус
docker compose ps

# Просмотрите логи в полном объеме
docker compose logs app

# Пересоздайте контейнеры
docker compose down
docker compose up -d --build
```

### Проблема: "Cannot drop column: needed in a foreign key constraint"

**Причина:** При откате миграции foreign key не удаляется перед столбцом.

**Решение:** В методе `down()` миграции сначала удалите foreign key:
```php
public function down(): void
{
    Schema::table('table_name', function (Blueprint $table) {
        $table->dropForeign(['column_id']);  // Сначала удалить FK
        $table->dropColumn('column_id');     // Потом столбец
    });
}
```

### Проблема: БД не инициализирована или таблицы отсутствуют

**Решение:**
```bash
# Полная переинициализация
docker compose exec app php artisan migrate:fresh --seed --seeder=DevitySeeder

# Проверьте статус миграций
docker compose exec app php artisan migrate:status
```

### Проблема: 419 при отправке форм | CSRF token mismatch

**Причина:** Сессия истекла или CSRF token невалиден.

**Решение:**
```bash
# Очистите сессии
docker compose exec app php artisan session:table
docker compose exec app php artisan migrate

# Или очистите кэш
docker compose exec app php artisan cache:clear
```

### Проблема: Файлы не загружаются

**Решение:**
```bash
# Проверьте права доступа на папку storage
docker compose exec app chmod -R 775 storage bootstrap/cache

# Или переразверните
docker compose restart app
```

### Проблема: 500 ошибка при запуске

```bash
# Проверьте логи
docker compose logs app | tail -50

# Очистите все кэши
docker compose exec app php artisan optimize:clear

# Пересоздайте ключ
docker compose exec app php artisan key:generate
```

---

## 📞 Контакты и поддержка

**Техническая поддержка:**
- Email: admin@devity.local
- Документация: /admin/documentation
- API docs: /api/documentation (если реализовано)

**Разработка и внесение изменений:**
1. Создайте feature branch
2. Внесите изменения
3. Напишите тесты
4. Create pull request

**Сообщение об ошибках:**
Используйте Issues в GitHub с тегами:
- `bug` — ошибки
- `feature` — новые функции
- `docs` — документация
- `devops` — инфраструктура

---

## 📝 Лицензия

Проект распространяется под лицензией MIT. Для подробностей смотрите файл [LICENSE](LICENSE).

---

**Версия:** 1.0.0  
**Последнее обновление:** 13 апреля 2026 г.  
**Разработчик:** Devity Team  

Спасибо за использование Devity! 🎉
