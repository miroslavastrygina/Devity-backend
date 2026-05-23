# Настройка окружения Devity (backend + frontend)

Документ описывает переменные `.env` и типовой порядок запуска для **Devity-backend** и **Devity-frontend**. Актуальные ключи см. в `.env.example` каждого репозитория.

## Быстрый старт (Docker, рекомендуется)

1. **Backend**
   ```bash
   cd Devity-backend
   cp .env.example .env
   docker compose up -d
   docker compose exec app php artisan key:generate
   docker compose exec app php artisan migrate
   docker compose exec app php artisan db:seed --class=DevitySeeder
   ```
   API: `http://localhost:8080`, Reverb (снаружи): `http://127.0.0.1:8081` (WebSocket на том же хосте/порту).

2. **Frontend**
   ```bash
   cd Devity-frontend
   cp .env.example .env
   npm install
   npm run dev
   ```
   Убедитесь, что `VITE_APP_BACKEND` указывает на запущенный API (для Docker обычно `http://localhost:8080/api`).

3. **Совпадение ключей Reverb**  
   `REVERB_APP_KEY`, `REVERB_APP_SECRET`, `REVERB_APP_ID` в backend `.env` должны совпадать с настройками процесса Reverb (в `docker-compose` сервис `reverb` они заданы явно). На фронте `VITE_WS_APP_KEY` = `REVERB_APP_KEY`.

## Backend (`Devity-backend/.env`)

| Группа | Назначение |
|--------|------------|
| `APP_*` | Имя приложения, ключ (`php artisan key:generate`), URL (`APP_URL` — база для ссылок и Sanctum). |
| `DB_*` | В Docker: `DB_HOST=db` и учётные данные как в `docker-compose.yml`. На хосте: `127.0.0.1` и свой MySQL. |
| `BROADCAST_CONNECTION=reverb` | Вещание через Reverb. |
| `REVERB_*` | Приложение Reverb: ключи и **публичный** хост/порт для клиентов (браузер). Для Guzzle из контейнера см. ниже. |
| `BROADCAST_REVERB_*` | (Опционально) Явный хост/порт HTTP-запросов Laravel к процессу Reverb. Если не заданы, в Docker в `config/broadcasting.php` используются `reverb` и `8080`. |
| `SANCTUM_STATEFUL_DOMAINS` | Origin SPA (например `localhost:5173`, `localhost:3000`), иначе cookie-сессии для админки могут вести себя непредсказуемо. |
| `SESSION_*`, `CACHE_*`, `QUEUE_*` | Как в `.env.example`; для Docker обычно `database`. |

После правок конфигурации в контейнере:

```bash
docker compose exec app php artisan config:clear
```

Не коммитьте файл `.env` с продакшен-секретами.

## Frontend (`Devity-frontend/.env`)

| Переменная | Назначение |
|------------|------------|
| `VITE_APP_BACKEND` | URL API с суффиксом `/api` (например `http://localhost:8080/api`). |
| `VITE_WS_HOST` / `VITE_WS_PORT` | Хост и порт Reverb **с точки зрения браузера** (часто `127.0.0.1` и `8081` при маппинге из docker-compose). |
| `VITE_WS_TLS` | `false` для локального `ws://`. |
| `VITE_WS_APP_KEY` | Тот же ключ, что `REVERB_APP_KEY` на бэкенде. |

Переменные `VITE_*` вшиваются на этапе сборки: после изменения `.env` перезапустите `npm run dev` или пересоберите образ (`docker compose build`).

## Блоки с компилятором C# в уроках

1. В админке (Orchid) в уроке заполните **«Блоки компилятора (JSON)»** — массив вида:
   ```json
   [
     { "code": "using System;\nclass Program {\n  static void Main() {\n    Console.WriteLine(\"Hi\");\n  }\n}" }
   ]
   ```
2. В **markdown-контенте** вставьте маркеры `[[compiler:0]]`, `[[compiler:1]]`, … (индекс = позиция в JSON-массиве).
3. В `.env` бэкенда задайте `JDOODLE_CLIENT_ID` и `JDOODLE_CLIENT_SECRET` (аккаунт и API dashboard на [JDoodle](https://www.jdoodle.com/docs/compiler-apis/jdoodle-api-quickstart/getting-started/)). При необходимости поправьте `JDOODLE_CSHARP_VERSION_INDEX` под вашу версию C# в JDoodle.
4. Студент на странице урока запускает код кнопкой «Запустить»; запрос идёт на `POST /api/compiler/execute` (Sanctum), сервер вызывает JDoodle — ключи не попадают в браузер.

## Docker Compose и порты

**Backend** (`Devity-backend/docker-compose.yml`):

- `app` — Laravel, порт **8080**.
- `db` — MySQL **3306**.
- `reverb` — WebSocket-сервер внутри контейнера на **8080**, снаружи **8081**.

**Frontend** (`Devity-frontend/docker-compose.yml`):

- Сборка с build-args из `.env`; приложение отдаётся на порту **3000** (см. compose).

## Локальный запуск без Docker (кратко)

- MySQL на `127.0.0.1`, в `.env` бэкенда `DB_HOST=127.0.0.1` и свои `DB_DATABASE` / пользователь / пароль.
- `php artisan serve` (часто порт **8000**) — тогда `APP_URL` и `VITE_APP_BACKEND` переведите на `http://localhost:8000`.
- Reverb: `php artisan reverb:start` на машине; `REVERB_PORT` и `VITE_WS_PORT` должны совпадать с тем, что слушает процесс.

## Проверка Reverb

```bash
docker compose logs -f reverb
```

В логах не должно быть падений при старте; с браузера в DevTools → Network должен быть `101 Switching Protocols` на `ws://127.0.0.1:8081/...`.

## Где искать проблемы

| Симптом | Куда смотреть |
|---------|----------------|
| `success: false`, `Pusher error`, `cURL` на `127.0.0.1:8081` | Серверный `broadcast()`: Laravel в Docker должен ходить на сервис `reverb:8080` (авто или `BROADCAST_REVERB_*`). |
| WebSocket не коннектится | `VITE_WS_*` и проброс порта Reverb; ключ `VITE_WS_APP_KEY`. |
| CORS / 419 | `APP_URL`, `SANCTUM_STATEFUL_DOMAINS`, origin фронта. |

Подробнее о курсе, API и командах — в [README.md](README.md).
