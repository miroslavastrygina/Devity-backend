-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: devityDB
-- ------------------------------------------------------
-- Server version	8.0.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `assignment_grades`
--

DROP TABLE IF EXISTS `assignment_grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assignment_grades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `submission_id` bigint unsigned NOT NULL,
  `teacher_id` bigint unsigned NOT NULL,
  `score` double NOT NULL,
  `feedback` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assignment_grades_submission_id_foreign` (`submission_id`),
  KEY `assignment_grades_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `assignment_grades_submission_id_foreign` FOREIGN KEY (`submission_id`) REFERENCES `assignment_submissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `assignment_grades_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignment_grades`
--

LOCK TABLES `assignment_grades` WRITE;
/*!40000 ALTER TABLE `assignment_grades` DISABLE KEYS */;
INSERT INTO `assignment_grades` VALUES (1,1,4,100,'Норм','2025-07-01 18:36:41','2025-07-01 18:36:41');
/*!40000 ALTER TABLE `assignment_grades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assignment_submissions`
--

DROP TABLE IF EXISTS `assignment_submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assignment_submissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `assignment_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `file_url` text COLLATE utf8mb4_unicode_ci,
  `submitted_at` datetime NOT NULL DEFAULT '2025-06-30 05:56:40',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `assignment_submissions_assignment_id_foreign` (`assignment_id`),
  KEY `assignment_submissions_user_id_foreign` (`user_id`),
  CONSTRAINT `assignment_submissions_assignment_id_foreign` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `assignment_submissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignment_submissions`
--

LOCK TABLES `assignment_submissions` WRITE;
/*!40000 ALTER TABLE `assignment_submissions` DISABLE KEYS */;
INSERT INTO `assignment_submissions` VALUES (1,1,3,'http://localhost:8080/storage/submissions/VR26KUkQCTeKQhQTspAQ9ZBzRe6lWfE1xZS6ghxS.c','2025-07-01 18:35:57','2025-07-01 18:35:57','2025-07-01 18:36:41',1),(2,1,3,'http://localhost:8080/storage/submissions/q88pHZh89bl0l0yPdXMmdjZs2jPUAg0sPmCUisyp.c','2025-07-01 18:50:38','2025-07-01 18:50:38','2025-07-01 18:50:38',0);
/*!40000 ALTER TABLE `assignment_submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assignments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lesson_id` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `assignments_lesson_id_foreign` (`lesson_id`),
  CONSTRAINT `assignments_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` VALUES (1,1,'# ✅ Практическое задание: Переменные и типы данных\r\n\r\n## 🔧 Условие\r\nСоздай скрипт на C#, в котором ты объявишь и инициализируешь переменные следующих типов:\r\n\r\n- Целое число (`int`) — например, счёт игрока\r\n- Число с плавающей точкой (`float`) — скорость движения\r\n- Логическое значение (`bool`) — статус «игра окончена»\r\n- Строка (`string`) — имя игрока\r\n- Символ (`char`) — оценка (например, \'A\')\r\n\r\nПосле этого выведи значения всех переменных в консоль с помощью `Debug.Log()`.\r\n\r\n## 📝 Пример вывода\r\n```\r\nИмя игрока: Alex\r\nСчёт: 50\r\nСкорость: 5.5\r\nИгра окончена: False\r\nОценка: B\r\n```\r\n\r\n## 📎 Что отправить\r\nПрикрепи скрипт `.cs` с выполненным заданием. Название файла: `DataTypesTask.cs`','2025-07-01 18:34:52','2025-07-01 18:34:52','Практическое задание: Переменные и типы данных'),(2,6,'# ✅ Задание к уроку 1: Введение в Unity\r\n\r\n## 🎯 Цель\r\nПодготовить рабочее пространство для создания своей первой игры в Unity.\r\n\r\n## 📝 Инструкция\r\n1. Установи **Unity Hub** с официального сайта: [https://unity.com/](https://unity.com/)\r\n2. Через Unity Hub установи последнюю **LTS-версию Unity**\r\n3. Создай новый 3D-проект под названием `MyFirstGame`\r\n4. Убедись, что у тебя открылась сцена\r\n5. Сохрани сцену с именем `MainScene`\r\n6. Открой основные панели: `Scene`, `Game`, `Hierarchy`, `Inspector`, `Project`\r\n\r\n## 📌 Дополнительно (по желанию)\r\nСоздай папки в Project:\r\n- `Scripts`\r\n- `Prefabs`\r\n- `Materials`\r\n- `Scenes`\r\n\r\n## ✅ Критерии завершения\r\n- Установлен Unity Hub и Unity\r\n- Создан и открыт проект `MyFirstGame`\r\n- Сцена сохранена как `MainScene`\r\n- Панели редактора найдены и поняты','2025-07-01 19:03:39','2025-07-01 19:03:39','Задание к уроку 1: Введение в Unity'),(3,7,'# ✅ Задание к уроку 2: Сцена и объекты\r\n\r\n## 🎯 Цель\r\nНаучиться создавать и располагать объекты на сцене Unity.\r\n\r\n## 📝 Инструкция\r\n1. Открой сцену `MainScene` в своём проекте Unity.\r\n2. Добавь на сцену следующие объекты:\r\n   - **Plane** (земля)\r\n   - **Cube** (игровой объект)\r\n   - **Sphere** (второй объект для взаимодействия)\r\n3. Расположи их по координатам:\r\n   - Plane: (0, 0, 0)\r\n   - Cube: (0, 0.5, 0)\r\n   - Sphere: (0, 1.5, 0)\r\n4. Измени масштаб и поворот Sphere в Inspector:\r\n   - Scale: (1.5, 1.5, 1.5)\r\n   - Rotation: (0, 45, 0)\r\n\r\n## 📌 Подсказка\r\n- Для быстрой ориентации используй инструмент **Move (W)** и **Rotate (E)**.\r\n\r\n## ✅ Критерии завершения\r\n- В сцене присутствуют 3 объекта: плоскость, куб и сфера\r\n- Объекты правильно расположены и настроены\r\n- Объекты имеют визуально отличимые размеры и ориентацию','2025-07-01 19:10:21','2025-07-01 19:10:21','Задание к уроку 2: Сцена и объекты'),(4,8,'# ✅ Задание к уроку 3: Компоненты и инспектор\r\n\r\n## 🎯 Цель\r\nПонять, как компоненты влияют на поведение объектов и научиться добавлять их вручную.\r\n\r\n## 📝 Инструкция\r\n1. Создай **новый куб** на сцене (GameObject > 3D Object > Cube)\r\n2. Добавь к кубу следующие компоненты:\r\n   - `Rigidbody`\r\n   - `Box Collider` (если он удалён)\r\n3. Удали компонент `Box Collider`, а затем добавь снова через кнопку **Add Component**\r\n4. Запусти сцену — куб должен упасть на плоскость (не забудь добавить `Plane` под ним)\r\n5. Измени параметры Rigidbody:\r\n   - Mass: `2`\r\n   - Drag: `1`\r\n\r\n## 📌 Подсказка\r\n- Компонент `Rigidbody` отвечает за физику. Без него объект не будет подчиняться гравитации.\r\n\r\n## ✅ Критерии завершения\r\n- Куб падает на плоскость при запуске сцены\r\n- В Inspector присутствуют компоненты: Transform, Box Collider, Rigidbody\r\n- Параметры Rigidbody изменены вручную','2025-07-01 19:11:12','2025-07-01 19:11:12','Задание к уроку 3: Компоненты и инспектор'),(5,9,'# ✅ Задание к уроку 4: Материалы и цвета\r\n\r\n## 🎯 Цель\r\nНаучиться создавать материалы и применять их к объектам на сцене.\r\n\r\n## 📝 Инструкция\r\n1. Создай новый материал:\r\n   - Назови его `RedMat`\r\n   - Задай базовый цвет: красный\r\n2. Создай второй материал `GlossyBlue`:\r\n   - Цвет: синий\r\n   - Metallic: `0.7`\r\n   - Smoothness: `0.9`\r\n3. Примените:\r\n   - `RedMat` к **Cube**\r\n   - `GlossyBlue` к **Sphere**\r\n4. Добавь текстуру:\r\n   - Импортируй изображение (например, кирпичи)\r\n   - Создай материал `Brick`\r\n   - В поле Albedo перетащи изображение\r\n   - Назначь его **Plane**\r\n\r\n## 📌 Подсказка\r\n- Если текстура не видна — проверь настройки шейдера: `Standard` или `URP/Lit`\r\n\r\n## ✅ Критерии завершения\r\n- 3 разных материала\r\n- Все материалы применены к объектам\r\n- Текстура успешно отображается на плоскости','2025-07-01 19:12:08','2025-07-01 19:12:08','Задание к уроку 4: Материалы и цвета'),(6,10,'# ✅ Задание к уроку 5: Камера и освещение\r\n\r\n## 🎯 Цель\r\nНастроить камеру и источники света в сцене, создать правильную видимость и атмосферу.\r\n\r\n## 📝 Инструкция\r\n1. Удали объект `Directional Light` из сцены\r\n2. Добавь `Point Light` (GameObject > Light > Point Light)\r\n3. Размести его над объектами (например, Position: 0, 3, 0)\r\n4. Измени параметры:\r\n   - Intensity: `2`\r\n   - Range: `10`\r\n   - Color: синий\r\n5. Выбери `Main Camera` и измени угол обзора:\r\n   - Field of View: `60`\r\n   - Поверни камеру так, чтобы она смотрела на все 3 объекта (используй `Scene` вид)\r\n\r\n## 📌 Подсказка\r\n- Для точной настройки камеры используй вкладку **Game View** — это то, что увидит игрок\r\n\r\n## ✅ Критерии завершения\r\n- В сцене есть синий точечный свет, влияющий на объекты\r\n- Камера направлена на центр сцены\r\n- Угол обзора камеры настроен','2025-07-01 19:13:33','2025-07-01 19:13:33','Задание к уроку 5: Камера и освещение'),(7,11,'# ✅ Задание к уроку 6: Перемещение и вращение объектов\r\n\r\n## 🎯 Цель\r\nНаучиться двигать и вращать объекты с помощью скриптов.\r\n\r\n## 📝 Инструкция\r\n1. Создай новый C# скрипт `Mover.cs`\r\n2. Вставь в него код:\r\n```csharp\r\npublic class Mover : MonoBehaviour\r\n{\r\n    public float speed = 5f;\r\n\r\n    void Update()\r\n    {\r\n        transform.Translate(Vector3.forward * speed * Time.deltaTime);\r\n    }\r\n}\r\n```\r\n3. Привяжи этот скрипт к кубу\r\n4. Измени `speed` в Inspector на `3`\r\n5. Добавь вращение объекта:\r\n```csharp\r\nvoid Update()\r\n{\r\n    transform.Rotate(0, 45 * Time.deltaTime, 0);\r\n}\r\n```\r\n(объедините с кодом выше)\r\n\r\n## 📌 Подсказка\r\n- Объект будет двигаться вперёд по локальной оси Z\r\n- Чтобы он двигался по нажатиям клавиш, добавь `Input.GetAxis()`\r\n\r\n## ✅ Критерии завершения\r\n- Скрипт прикреплён к объекту\r\n- При запуске объект движется и вращается\r\n- Параметры редактируются в Inspector','2025-07-01 19:15:01','2025-07-01 19:15:01','Задание к уроку 6: Перемещение и вращение объектов'),(8,12,'# ✅ Задание к уроку 7: Создание префабов\r\n\r\n## 🎯 Цель\r\nНаучиться создавать префабы и использовать их для спауна объектов.\r\n\r\n## 📝 Инструкция\r\n1. Создай объект `Enemy` (можно взять куб, настроить цвет, добавить Rigidbody и Collider)\r\n2. Перетащи `Enemy` из Hierarchy в папку `Prefabs` — теперь это префаб\r\n3. Удали объект `Enemy` из сцены\r\n4. Создай скрипт `Spawner.cs` и прикрепи его к пустому объекту `Spawner`\r\n5. Добавь в скрипт:\r\n```csharp\r\npublic class Spawner : MonoBehaviour\r\n{\r\n    public GameObject enemyPrefab;\r\n\r\n    void Start()\r\n    {\r\n        Instantiate(enemyPrefab, new Vector3(0, 1, 0), Quaternion.identity);\r\n    }\r\n}\r\n```\r\n6. Перетащи префаб в поле `Enemy Prefab` в Inspector\r\n\r\n## 📌 Подсказка\r\n- Используй `Resources.Instantiate` или `Instantiate` из переменной — второй способ предпочтительнее\r\n\r\n## ✅ Критерии завершения\r\n- Префаб создан и настроен\r\n- Объект создаётся автоматически при запуске сцены\r\n- Используется скрипт `Spawner.cs`','2025-07-01 19:16:31','2025-07-01 19:16:31','Задание к уроку 7: Создание префабов'),(9,13,'# ✅ Задание к уроку 8: Основы UI\r\n\r\n## 🎯 Цель\r\nСоздать базовый пользовательский интерфейс с кнопкой и обработчиком событий.\r\n\r\n## 📝 Инструкция\r\n1. Добавь UI-элемент `Button` на сцену:\r\n   - `GameObject > UI > Button`\r\n   - Canvas и EventSystem будут созданы автоматически\r\n2. Создай новый скрипт `UIHandler.cs`\r\n```csharp\r\nusing UnityEngine;\r\n\r\npublic class UIHandler : MonoBehaviour\r\n{\r\n    public void OnButtonClick()\r\n    {\r\n        Debug.Log(\"Кнопка нажата!\");\r\n    }\r\n}\r\n```\r\n3. Привяжи скрипт к объекту `Canvas` или любому другому пустому объекту\r\n4. Назначь метод `OnButtonClick` в `OnClick()` события кнопки (через `+` в Inspector)\r\n\r\n## 📌 Подсказка\r\n- Обязательно сохранить сцену перед запуском\r\n- Проверь консоль на сообщение при нажатии\r\n\r\n## ✅ Критерии завершения\r\n- Кнопка видна на экране\r\n- Нажатие вызывает метод и выводит сообщение в консоль','2025-07-01 19:17:27','2025-07-01 19:17:27','Задание к уроку 8: Основы UI'),(10,14,'# ✅ Задание к уроку 9: Первый сбор проекта\r\n\r\n## 🎯 Цель\r\nСобрать готовую игру в виде исполняемого файла для запуска без Unity.\r\n\r\n## 📝 Инструкция\r\n1. Сохрани все изменения и сцену `MainScene`\r\n2. Перейди в меню `File > Build Settings`\r\n3. Нажми **Add Open Scenes**, чтобы добавить текущую сцену\r\n4. Убедись, что выбрана платформа `PC, Mac & Linux Standalone`\r\n5. Нажми `Player Settings` и:\r\n   - Укажи имя продукта\r\n   - Установи разрешение экрана (например, 1280x720)\r\n6. Нажми `Build`, выбери папку `Builds`, дождись завершения\r\n7. Перейди в папку и запусти `.exe` файл\r\n\r\n## 📌 Подсказка\r\n- Не ставь галочку `Development Build`, если делаешь финальную версию\r\n\r\n## ✅ Критерии завершения\r\n- Собранный файл запускается\r\n- Игра работает как в редакторе\r\n- Внутри сборки есть `.exe` и папка `Data`','2025-07-01 19:18:08','2025-07-01 19:18:08','Задание к уроку 9: Первый сбор проекта'),(11,15,'# ✅ Задание к уроку 1: Создание игрового уровня\r\n\r\n## 🎯 Цель\r\nПостроить базовую игровую арену с платформами, землёй и границами.\r\n\r\n## 📝 Инструкция\r\n1. Создай новую сцену `Level1`\r\n2. Добавь следующие объекты:\r\n   - **Plane** — земля (позиция: 0, 0, 0)\r\n   - **Cube** — как минимум 3 платформы (на высоте Y = 1 и выше)\r\n   - **Cube** — 4 стены по краям уровня (широкие и высокие)\r\n   - **Directional Light** — источник света (если не добавлен автоматически)\r\n3. Создай пустой объект `Level` и перемести внутрь все объекты уровня\r\n4. Добавь к каждой платформе уникальный материал (цвет, текстура)\r\n\r\n## 📌 Подсказка\r\n- Платформы можно масштабировать по оси X и Z, чтобы сделать их длиннее или шире\r\n- Стены должны быть достаточно высокими, чтобы игрок не мог перепрыгнуть\r\n\r\n## ✅ Критерии завершения\r\n- Игрок не может покинуть пределы арены\r\n- Уровень аккуратно структурирован в Hierarchy\r\n- Все основные объекты присутствуют и хорошо различимы','2025-07-01 19:20:28','2025-07-01 19:20:28','Создание игрового уровня'),(12,18,'# ✅ Задание к уроку 2: Управление игроком\r\n\r\n## 🎯 Цель\r\nРеализовать движение персонажа по горизонтали и прыжок.\r\n\r\n## 📝 Инструкция\r\n1. Создай объект `Player` из капсулы или куба\r\n2. Добавь к нему компоненты:\r\n   - `Rigidbody`\r\n   - `Collider` (если ещё нет)\r\n3. Создай новый скрипт `PlayerController.cs`\r\n4. Вставь код:\r\n```csharp\r\npublic class PlayerController : MonoBehaviour {\r\n    public float speed = 5f;\r\n    public float jumpForce = 5f;\r\n    private Rigidbody rb;\r\n\r\n    void Start() {\r\n        rb = GetComponent<Rigidbody>();\r\n    }\r\n\r\n    void Update() {\r\n        float move = Input.GetAxis(\"Horizontal\");\r\n        rb.velocity = new Vector3(move * speed, rb.velocity.y, 0);\r\n\r\n        if (Input.GetKeyDown(KeyCode.Space)) {\r\n            rb.AddForce(Vector3.up * jumpForce, ForceMode.Impulse);\r\n        }\r\n    }\r\n}\r\n```\r\n5. Привяжи скрипт к `Player` и установи значения `speed` и `jumpForce`\r\n\r\n## 📌 Подсказка\r\n- Проверь, чтобы `Ground` имел `Collider` и не был триггером\r\n- Используй `Freeze Rotation` в Rigidbody, чтобы игрок не переворачивался\r\n\r\n## ✅ Критерии завершения\r\n- Игрок двигается влево и вправо по нажатию A/D или стрелок\r\n- Прыгает по нажатию `Space`\r\n- Не падает сквозь землю','2025-07-01 19:26:16','2025-07-01 19:26:16','Управление игроком'),(13,2,'# ✅ Практическое задание: Арифметические и логические операторы\r\n\r\n## 🔧 Условие\r\nСоздай скрипт на C#, в котором реализуй следующее:\r\n\r\n1. Объяви две переменные `a` и `b` типа `int` и задай им значения.\r\n2. Выполни и выведи в консоль результаты операций:\r\n   - Сложение\r\n   - Вычитание\r\n   - Умножение\r\n   - Деление\r\n   - Остаток от деления\r\n\r\n3. Используй логические операторы:\r\n   - Проверь, равны ли `a` и `b`\r\n   - Проверь, больше ли `a`, чем `b`\r\n   - Объедини два условия (например: `a > 0 && b > 0`)\r\n\r\nИспользуй `Debug.Log()` для вывода результатов.\r\n\r\n## 📝 Пример вывода\r\n```\r\na + b = 12\r\na - b = 2\r\na * b = 35\r\na / b = 1\r\na % b = 2\r\na == b: False\r\na > b: True\r\na > 0 && b > 0: True\r\n```\r\n\r\n## 📎 Что отправить\r\nПрикрепи файл `OperatorsTask.cs` с кодом, где ты выполнил все указанные действия.','2025-07-01 19:32:28','2025-07-01 19:32:28','Практическое задание: Арифметические и логические операторы'),(14,3,'# ✅ Практическое задание: Циклы for, while, foreach\r\n\r\n## 🔧 Условие\r\nСоздай скрипт на C#, в котором:\r\n\r\n1. С помощью цикла **for** выведи числа от 1 до 10\r\n2. С помощью цикла **while** выведи все чётные числа от 2 до 20\r\n3. Создай массив строк с 5 именами и перебери его через **foreach**, выводя каждое имя в консоль\r\n\r\nИспользуй `Debug.Log()` для всех выводов.\r\n\r\n## 📝 Пример вывода\r\n```\r\nFOR: 1 2 3 4 5 6 7 8 9 10\r\nWHILE: 2 4 6 8 10 12 14 16 18 20\r\nFOREACH: Alex, Bob, Kate, John, Max\r\n```\r\n\r\n## 📎 Что отправить\r\nФайл `LoopsTask.cs` с кодом трёх реализованных циклов','2025-07-01 19:33:14','2025-07-01 19:33:14','Практическое задание: Циклы for, while, foreach'),(15,4,'# ✅ Практическое задание: Условия if, else, switch\r\n\r\n## 🔧 Условие\r\nСоздай скрипт на C#, в котором реализуй:\r\n\r\n1. Объяви переменную `int score = 75;`\r\n2. Используй `if-else`, чтобы вывести:\r\n   - \"Отлично\", если score >= 90\r\n   - \"Хорошо\", если score >= 70 и < 90\r\n   - \"Удовлетворительно\", если score >= 50 и < 70\r\n   - \"Неудовлетворительно\" во всех остальных случаях\r\n\r\n3. Используй `switch`, чтобы ввести переменную `char grade = \'B\';` и по значению вывести:\r\n   - \'A\' — \"Супер!\"\r\n   - \'B\' — \"Хорошо\"\r\n   - \'C\' — \"Можно лучше\"\r\n   - Всё остальное — \"Оценка неизвестна\"\r\n\r\n## 📝 Пример вывода\r\n```\r\nОценка по баллам: Хорошо\r\nОценка по букве: Хорошо\r\n```\r\n\r\n## 📎 Что отправить\r\nФайл `ConditionsTask.cs` с реализацией логики через if-else и switch','2025-07-01 19:33:51','2025-07-01 19:33:51','Практическое задание: Условия if, else, switch'),(16,5,'# ✅ Практическое задание: Методы и параметры\r\n\r\n## 🔧 Условие\r\nСоздай скрипт на C#, в котором реализуй 3 метода:\r\n\r\n1. Метод `SayHello`, который принимает имя (`string`) и выводит в консоль приветствие.\r\n2. Метод `AddNumbers`, который принимает два числа (`int`) и возвращает их сумму.\r\n3. Метод `IsEven`, который принимает число и возвращает `true`, если оно чётное, и `false` — если нечётное.\r\n\r\nВ `Start()` вызови все три метода и выведи их результаты в консоль.\r\n\r\n## 📝 Пример вывода\r\n```\r\nПривет, Alex!\r\nСумма: 13\r\nЧисло 8 чётное: True\r\n```\r\n\r\n## 📎 Что отправить\r\nФайл `MethodsTask.cs` с кодом всех трёх методов и вызовами в `Start()`','2025-07-01 19:35:19','2025-07-01 19:35:19','Практическое задание: Методы и параметры');
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachmentable`
--

DROP TABLE IF EXISTS `attachmentable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attachmentable` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `attachmentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachmentable_id` int unsigned NOT NULL,
  `attachment_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attachmentable_attachmentable_type_attachmentable_id_index` (`attachmentable_type`,`attachmentable_id`),
  KEY `attachmentable_attachment_id_foreign` (`attachment_id`),
  CONSTRAINT `attachmentable_attachment_id_foreign` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachmentable`
--

LOCK TABLES `attachmentable` WRITE;
/*!40000 ALTER TABLE `attachmentable` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachmentable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attachments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint NOT NULL DEFAULT '0',
  `sort` int NOT NULL DEFAULT '0',
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `alt` text COLLATE utf8mb4_unicode_ci,
  `hash` text COLLATE utf8mb4_unicode_ci,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `user_id` bigint unsigned DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blocks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blocks_course_id_foreign` (`course_id`),
  CONSTRAINT `blocks_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocks`
--

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` VALUES (1,'Основы С# для Юнити.','В этом блоке вы изучите базовые элементы языка Ся, которые необходимы для создания логики игры в Unity. Без знания этих основ невозможно нажать скрит управлять объектами или реализовать взаимодействие в игре. Каждый урок направлен на понимание ключевых конструкций языка, с которыми вы будете заботить почти в каждом Unity-проекте. Вы научитесь. Объявлять переменные и использовать разные типы данных Выполнять вычисления и логические операции Сомалиять условия и ветвления Использовать циклы для повторяющихся действий Писать собственные методы и передавать в них параметры Работать с классамиздавать объекты.',1,'2025-07-01 16:44:53','2025-07-01 16:44:53'),(2,'Основы Unity','Знакомство с движком Unity: интерфейс, панель сцены, инспектор, иерархия объектов. Разберёшься, как создавать и настраивать GameObject\'ы, работать с компонентами, камерами и материалами. Научишься ориентироваться в редакторе и собирать простые сцены.',1,'2025-07-01 16:48:28','2025-07-01 16:48:28'),(3,'Создание игры на Unity','Применение полученных знаний на практике — от идеи до рабочего прототипа. Соберёшь полноценную мини-игру: настройка логики, интерфейса, анимаций и уровней. Научишься организовывать структуру проекта и работать по этапам разработки.',1,'2025-07-01 16:48:59','2025-07-01 16:48:59');
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('devity_cache_412a22b0c80fea47c7a2ea2dda96bab6357db455','i:1;',1751450201),('devity_cache_412a22b0c80fea47c7a2ea2dda96bab6357db455:timer','i:1751450201;',1751450201),('laravel_cache_412a22b0c80fea47c7a2ea2dda96bab6357db455','i:1;',1751265162),('laravel_cache_412a22b0c80fea47c7a2ea2dda96bab6357db455:timer','i:1751265162;',1751265162);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'Обучение Unity с нуля','Этот курс поможет тебе с нуля освоить основы программирования на C#, разобраться в интерфейсе Unity и создать свою первую простую игру. Он идеально подойдет начинающим, которые никогда не работали с Unity и не имеют опыта в разработке игр.','2025-06-30 06:31:56','2025-07-01 16:41:46');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_members`
--

DROP TABLE IF EXISTS `group_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `group_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `group_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `joined_at` datetime NOT NULL DEFAULT '2025-06-30 05:56:40',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_members_group_id_foreign` (`group_id`),
  KEY `group_members_user_id_foreign` (`user_id`),
  CONSTRAINT `group_members_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `group_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_members`
--

LOCK TABLES `group_members` WRITE;
/*!40000 ALTER TABLE `group_members` DISABLE KEYS */;
INSERT INTO `group_members` VALUES (1,1,3,'2025-06-30 05:56:40','2025-07-01 17:52:07','2025-07-01 17:52:07');
/*!40000 ALTER TABLE `group_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teacher_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groups_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `groups_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'МКИС31','МКИС31 - 2 человека','2025-07-01 17:51:59','2025-07-01 17:51:59',4);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lessons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `block_id` bigint unsigned NOT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lessons_block_id_foreign` (`block_id`),
  CONSTRAINT `lessons_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons`
--

LOCK TABLES `lessons` WRITE;
/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;
INSERT INTO `lessons` VALUES (1,'Переменные и типы данных','# 🧩 Урок 1: Переменные и типы данных\r\n\r\n---\r\n\r\n## 📘 Описание\r\nВ этом уроке мы изучим основные типы данных в C# и научимся объявлять переменные. Переменные позволяют хранить информацию, которую можно использовать в программе.\r\n\r\n---\r\n\r\n## 🔹 1. Что такое переменная?\r\nПеременная — это область памяти, в которой хранится значение. Каждая переменная имеет:\r\n- **имя** — чтобы обращаться к ней в коде;\r\n- **тип** — чтобы определить, какие данные она может хранить;\r\n- **значение** — сами данные, которые хранятся.\r\n\r\nПример:\r\n```csharp\r\nint score = 10;\r\n```\r\n\r\n---\r\n\r\n## 🔹 2. Типы данных в C#\r\nC# — строго типизированный язык. Это значит, что каждая переменная должна быть определённого типа.\r\n\r\n### Основные типы данных:\r\n| Тип     | Назначение                      | Пример                      |\r\n|---------|----------------------------------|-----------------------------|\r\n| `int`   | Целое число                     | `int score = 10;`          |\r\n| `float` | Число с плавающей точкой        | `float speed = 5.5f;`      |\r\n| `bool`  | Логическое значение (true/false)| `bool isGameOver = false;` |\r\n| `string`| Строка текста                   | `string playerName = \"Alex\";` |\r\n| `char`  | Один символ                     | `char grade = \'A\';`        |\r\n\r\n---\r\n\r\n## 🔹 3. Пример объявления переменных\r\n```csharp\r\nint lives = 3;\r\nfloat jumpHeight = 2.5f;\r\nbool hasKey = true;\r\nstring greeting = \"Привет, Unity!\";\r\nchar symbol = \'@\';\r\n```\r\n\r\n---\r\n\r\n## 🔹 4. Изменение значений\r\n```csharp\r\nlives = lives - 1;\r\njumpHeight += 0.3f;\r\nhasKey = false;\r\ngreeting = \"Добро пожаловать!\";\r\n```\r\n\r\n---\r\n\r\n## 🔹 5. Практика\r\nПопробуй создать следующие переменные:\r\n- Целое число `int coins = 100;`\r\n- Строку с именем игрока `string name = \"Player1\";`\r\n- Логическую переменную `bool isWinner = true;`\r\n\r\nЗатем выведи их значения с помощью `Debug.Log()`:\r\n```csharp\r\nDebug.Log(coins);\r\nDebug.Log(name);\r\nDebug.Log(isWinner);\r\n```\r\n\r\n---\r\n\r\n## ✅ Итоги\r\nТеперь ты знаешь:\r\n- Что такое переменные\r\n- Какие бывают типы данных в C#\r\n- Как объявлять и изменять переменные',1,NULL,'2025-07-01 16:52:04','2025-07-01 17:08:55'),(2,'Арифметические и логические операторы','# 🧩 Урок 2: Арифметические и логические операторы\r\n\r\n---\r\n\r\n## 📘 Описание\r\n\r\nВ этом уроке мы познакомимся с основными арифметическими и логическими операторами в C#. Операторы позволяют выполнять вычисления, проверять условия и управлять логикой программы.\r\n\r\n---\r\n\r\n## 🔹 1. Арифметические операторы\r\n\r\nАрифметические операторы используются для выполнения математических операций над числами.\r\n\r\n| Оператор | Описание           | Пример (`a = 10`, `b = 3`) |\r\n| -------- | ------------------ | -------------------------- |\r\n| `+`      | Сложение           | `a + b` → `13`             |\r\n| `-`      | Вычитание          | `a - b` → `7`              |\r\n| `*`      | Умножение          | `a * b` → `30`             |\r\n| `/`      | Деление            | `a / b` → `3`              |\r\n| `%`      | Остаток от деления | `a % b` → `1`              |\r\n\r\nПример:\r\n\r\n```csharp\r\nint a = 10;\r\nint b = 3;\r\nint sum = a + b;\r\nDebug.Log(\"Сумма: \" + sum); // 13\r\n```\r\n\r\n---\r\n\r\n## 🔹 2. Логические операторы\r\n\r\nЛогические операторы используются для работы с булевыми значениями (`true` / `false`).\r\n\r\n| Оператор | Название | Пример          | Результат |        |   |         |        |\r\n| -------- | -------- | --------------- | --------- | ------ | - | ------- | ------ |\r\n| `&&`     | И (AND)  | `true && false` | `false`   |        |   |         |        |\r\n| \\`       |          | \\`              | ИЛИ (OR)  | \\`true |   | false\\` | `true` |\r\n| `!`      | НЕ (NOT) | `!true`         | `false`   |        |   |         |        |\r\n\r\nПример:\r\n\r\n```csharp\r\nbool isAlive = true;\r\nbool hasWeapon = false;\r\n\r\nif (isAlive && hasWeapon)\r\n{\r\n    Debug.Log(\"Герой готов к бою\");\r\n}\r\nelse\r\n{\r\n    Debug.Log(\"Герой не готов\");\r\n}\r\n```\r\n\r\n---\r\n\r\n## 🔹 3. Комбинирование операторов\r\n\r\nТы можешь комбинировать арифметику и логику:\r\n\r\n```csharp\r\nint health = 50;\r\nint damage = 60;\r\nbool isDead = (health - damage) <= 0;\r\nDebug.Log(\"Игрок мёртв? \" + isDead); // true\r\n```\r\n\r\n---\r\n\r\n## 🔹 4. Практика\r\n\r\n1. Создай переменные:\r\n\r\n   - `int x = 7;`\r\n   - `int y = 4;`\r\n   - `bool result = (x % y == 3) && (x > y);`\r\n\r\n2. Выведи результат:\r\n\r\n```csharp\r\nDebug.Log(result); // true\r\n```\r\n\r\n3. Попробуй изменить `x` или `y` и посмотри, как это повлияет на `result`.\r\n\r\n---\r\n\r\n## ✅ Итоги\r\n\r\nТеперь ты знаешь:\r\n\r\n- Как выполнять математические действия в C#\r\n- Как сравнивать и проверять условия\r\n- Как использовать логические конструкции в коде\r\n\r\nСледующий шаг — изучить условные конструкции (`if`, `else`) и принять решения в коде!',1,NULL,'2025-07-01 17:10:11','2025-07-01 17:10:11'),(3,'Урок 3: Циклы — for, while, foreach','# 🧩 Урок 3: Циклы — for, while, foreach\r\n\r\n---\r\n\r\n## 📘 Описание\r\n\r\nВ этом уроке ты изучишь основные циклы в C#: `for`, `while`, и `foreach`. Циклы позволяют многократно выполнять один и тот же участок кода, пока выполняется определённое условие.\r\n\r\n---\r\n\r\n## 🔹 1. Цикл `for`\r\n\r\nЦикл `for` используется, когда известна точная количество повторений.\r\n\r\n```csharp\r\nfor (int i = 0; i < 5; i++)\r\n{\r\n    Debug.Log(\"Итерация: \" + i);\r\n}\r\n```\r\n\r\n➡️ Выведет:\r\n\r\n```\r\nИтерация: 0\r\nИтерация: 1\r\nИтерация: 2\r\nИтерация: 3\r\nИтерация: 4\r\n```\r\n\r\n---\r\n\r\n## 🔹 2. Цикл `while`\r\n\r\nЦикл `while` выполняется, пока условие истинно.\r\n\r\n```csharp\r\nint count = 0;\r\nwhile (count < 3)\r\n{\r\n    Debug.Log(\"Счёт: \" + count);\r\n    count++;\r\n}\r\n```\r\n\r\n---\r\n\r\n## 🔹 3. Цикл `foreach`\r\n\r\n`foreach` применяется для перебора элементов в коллекциях (например, в массивах или списках).\r\n\r\n```csharp\r\nstring[] fruits = { \"Яблоко\", \"Банан\", \"Апельсин\" };\r\n\r\nforeach (string fruit in fruits)\r\n{\r\n    Debug.Log(\"Фрукт: \" + fruit);\r\n}\r\n```\r\n\r\n➡️ Выведет:\r\n\r\n```\r\nФрукт: Яблоко\r\nФрукт: Банан\r\nФрукт: Апельсин\r\n```\r\n\r\n---\r\n\r\n## 🔹 4. Выход из цикла: `break` и `continue`\r\n\r\n- `break` — прерывает выполнение цикла.\r\n- `continue` — пропускает текущую итерацию и переходит к следующей.\r\n\r\n```csharp\r\nfor (int i = 0; i < 5; i++)\r\n{\r\n    if (i == 2) continue;\r\n    if (i == 4) break;\r\n    Debug.Log(i);\r\n}\r\n```\r\n\r\n➡️ Выведет:\r\n\r\n```\r\n0\r\n1\r\n3\r\n```\r\n\r\n---\r\n\r\n## 🔹 5. Практика\r\n\r\n1. Создай массив чисел от 1 до 5 и выведи их с помощью `foreach`.\r\n2. Используй цикл `for`, чтобы вывести квадраты чисел от 0 до 4.\r\n3. Используй `while`, чтобы уменьшать значение переменной от 10 до 0, шагом -2.\r\n\r\n---\r\n\r\n## ✅ Итоги\r\n\r\nТеперь ты знаешь:\r\n\r\n- Как работает цикл `for`, когда нужна точная итерация\r\n- Как использовать `while` при неизвестном количестве повторений\r\n- Как перебирать элементы с `foreach`\r\n- Как управлять потоком цикла с `break` и `continue`\r\n\r\nДальше — используем циклы и условия вместе, чтобы строить более сложную логику!',1,NULL,'2025-07-01 17:10:48','2025-07-01 17:10:48'),(4,'Урок 4: Условия — if, else, switch','# 🧩 Урок 4: Условия — if, else, switch\r\n\r\n---\r\n\r\n## 📘 Описание\r\n\r\nУсловия позволяют программе **принимать решения**. С их помощью ты можешь проверять, выполнены ли определённые условия, и в зависимости от этого выполнять разные блоки кода. В этом уроке мы подробно разберём конструкции `if`, `else if`, `else` и оператор `switch`.\r\n\r\n---\r\n\r\n## 🔹 1. Конструкция `if`\r\n\r\n`if` проверяет условие и выполняет код, если оно истинно.\r\n\r\n```csharp\r\nint score = 80;\r\nif (score >= 60)\r\n{\r\n    Debug.Log(\"Тест пройден!\");\r\n}\r\n```\r\n\r\n➡️ Если `score` больше или равен 60, то в консоль выведется: `Тест пройден!`\r\n\r\n---\r\n\r\n## 🔹 2. Блок `else`\r\n\r\nЕсли условие не выполнено — используется `else`.\r\n\r\n```csharp\r\nint score = 45;\r\nif (score >= 60)\r\n{\r\n    Debug.Log(\"Тест пройден!\");\r\n}\r\nelse\r\n{\r\n    Debug.Log(\"Попробуй ещё раз.\");\r\n}\r\n```\r\n\r\n➡️ В этом случае, выведется: `Попробуй ещё раз.`\r\n\r\n---\r\n\r\n## 🔹 3. Блок `else if`\r\n\r\nКогда нужно проверить **несколько условий**, используется `else if`:\r\n\r\n```csharp\r\nint health = 70;\r\n\r\nif (health > 80)\r\n{\r\n    Debug.Log(\"Здоровье отличное\");\r\n}\r\nelse if (health > 50)\r\n{\r\n    Debug.Log(\"Здоровье нормальное\");\r\n}\r\nelse\r\n{\r\n    Debug.Log(\"Здоровье критическое\");\r\n}\r\n```\r\n\r\n➡️ Выведет: `Здоровье нормальное`\r\n\r\n---\r\n\r\n## 🔹 4. Сравнение значений\r\n\r\nДля условий часто используются **операторы сравнения**:\r\n\r\n| Оператор | Значение         | Пример   |\r\n| -------- | ---------------- | -------- |\r\n| `==`     | Равно            | `a == b` |\r\n| `!=`     | Не равно         | `a != b` |\r\n| `>`      | Больше           | `a > b`  |\r\n| `<`      | Меньше           | `a < b`  |\r\n| `>=`     | Больше или равно | `a >= b` |\r\n| `<=`     | Меньше или равно | `a <= b` |\r\n\r\n---\r\n\r\n## 🔹 5. Конструкция `switch`\r\n\r\n`switch` удобно использовать, когда нужно проверить **много возможных значений одной переменной**.\r\n\r\n```csharp\r\nstring weapon = \"bow\";\r\n\r\nswitch (weapon)\r\n{\r\n    case \"sword\":\r\n        Debug.Log(\"Вы выбрали меч\");\r\n        break;\r\n    case \"bow\":\r\n        Debug.Log(\"Вы выбрали лук\");\r\n        break;\r\n    case \"staff\":\r\n        Debug.Log(\"Вы выбрали посох\");\r\n        break;\r\n    default:\r\n        Debug.Log(\"Неизвестное оружие\");\r\n        break;\r\n}\r\n```\r\n\r\n➡️ Выведет: `Вы выбрали лук`\r\n\r\n---\r\n\r\n## 🔹 6. Вложенные условия\r\n\r\nТы можешь использовать условия внутри других условий:\r\n\r\n```csharp\r\nint age = 20;\r\nbool hasID = true;\r\n\r\nif (age >= 18)\r\n{\r\n    if (hasID)\r\n    {\r\n        Debug.Log(\"Доступ разрешён\");\r\n    }\r\n    else\r\n    {\r\n        Debug.Log(\"Нужен документ\");\r\n    }\r\n}\r\nelse\r\n{\r\n    Debug.Log(\"Доступ запрещён\");\r\n}\r\n```\r\n\r\n---\r\n\r\n## 🔹 7. Практика\r\n\r\n1. Напиши условие, которое проверяет, больше ли переменная `score` 90. Если да — вывести `Отлично!`, иначе — `Можно лучше.`\r\n2. Используй `switch`, чтобы по значению переменной `day` (`\"Mon\"`, `\"Tue\"`, …) вывести день недели на русском.\r\n3. Попробуй вложенные `if` для проверки: есть ли ключ, и открыт ли сундук.\r\n\r\n---\r\n\r\n## ✅ Итоги\r\n\r\nТеперь ты умеешь:\r\n\r\n- Проверять условия с помощью `if`, `else if`, `else`\r\n- Использовать оператор `switch` для множественного выбора\r\n- Понимать, как работают вложенные условия\r\n- Применять операторы сравнения в логике игры\r\n\r\nУсловия — это фундамент принятия решений в игре. Дальше ты научишься объединять условия с циклами и событиями!',1,NULL,'2025-07-01 17:11:15','2025-07-01 17:11:15'),(5,'Урок 5: Методы и параметры','# 🧩 Урок 5: Методы и параметры\r\n\r\n\r\n---\r\n\r\n## 📘 Описание\r\n\r\nМетоды (или функции) — это **блоки кода**, которые можно вызывать многократно. Они помогают структурировать код, повторно использовать логику и делают программы понятными и чистыми. В этом уроке ты узнаешь, как объявлять и вызывать методы, передавать параметры и возвращать значения.\r\n\r\n---\r\n\r\n## 🔹 1. Что такое метод?\r\n\r\nМетод — это именованный набор инструкций, который можно вызывать в любом месте программы.\r\n\r\nПростой метод:\r\n\r\n```csharp\r\nvoid SayHello()\r\n{\r\n    Debug.Log(\"Привет, игрок!\");\r\n}\r\n```\r\n\r\nВызов метода:\r\n\r\n```csharp\r\nSayHello();\r\n```\r\n\r\n---\r\n\r\n## 🔹 2. Параметры методов\r\n\r\nПараметры позволяют передавать значения в метод. Это делает метод гибким и переиспользуемым.\r\n\r\n```csharp\r\nvoid GreetPlayer(string name)\r\n{\r\n    Debug.Log(\"Привет, \" + name + \"!\");\r\n}\r\n\r\nGreetPlayer(\"Alex\");\r\n```\r\n\r\n➡️ Выведет: `Привет, Alex!`\r\n\r\n---\r\n\r\n## 🔹 3. Возвращаемое значение\r\n\r\nМетод может **возвращать результат**, используя ключевое слово `return` и указание типа вместо `void`.\r\n\r\n```csharp\r\nint Add(int a, int b)\r\n{\r\n    return a + b;\r\n}\r\n\r\nint result = Add(3, 5);\r\nDebug.Log(result); // 8\r\n```\r\n\r\n---\r\n\r\n## 🔹 4. Несколько параметров\r\n\r\nМожно передавать сколько угодно параметров (через запятую):\r\n\r\n```csharp\r\nvoid ShowStats(string name, int level, float health)\r\n{\r\n    Debug.Log(name + \": ур. \" + level + \", HP: \" + health);\r\n}\r\n\r\nShowStats(\"Knight\", 3, 95.5f);\r\n```\r\n\r\n---\r\n\r\n## 🔹 5. Зачем использовать методы?\r\n\r\n- Повторное использование логики\r\n- Чистый и читаемый код\r\n- Изоляция поведения (проще тестировать)\r\n- Упрощение отладки\r\n\r\n---\r\n\r\n## 🔹 6. Практика\r\n\r\n1. Создай метод `PrintDouble`, который принимает `int` и выводит его \\* 2.\r\n2. Сделай метод `IsEven`, который принимает число и возвращает `true`, если оно чётное.\r\n3. Сделай метод `ShowWeapon`, который принимает имя оружия и уровень, и выводит строку вида: `Оружие: Меч (ур. 5)`.\r\n\r\n---\r\n\r\n## ✅ Итоги\r\n\r\nТеперь ты умеешь:\r\n\r\n- Создавать методы с и без параметров\r\n- Возвращать значения из методов\r\n- Делать код модульным и переиспользуемым\r\n\r\nМетоды — это ключ к масштабируемому и поддерживаемому проекту. Дальше ты научишься вызывать методы из других классов и использовать события!',1,NULL,'2025-07-01 17:11:45','2025-07-01 17:11:45'),(6,'Введение в Unity','# 🧩 Урок 1: Введение в Unity\r\n\r\n📅 **Создан:** 2025-04-02\r\n\r\n---\r\n\r\n## 📘 Описание\r\nВ этом вводном уроке ты познакомишься с движком **Unity** — одной из самых популярных платформ для создания игр. Мы установим Unity Hub, создадим первый проект, изучим структуру редактора и узнаем, какие инструменты предоставляет Unity для работы с 2D и 3D сценами.\r\n\r\n---\r\n\r\n## 🔹 Что ты узнаешь:\r\n- Как установить Unity и Unity Hub\r\n- Как создать новый проект\r\n- Разницу между 2D и 3D режимами\r\n- Что такое сцена и зачем она нужна\r\n- Как устроен интерфейс Unity: Scene, Game, Hierarchy, Inspector, Project\r\n\r\n---\r\n\r\n## 🔹 Пошаговые действия:\r\n1. Скачай и установи **Unity Hub** с официального сайта\r\n2. Через Unity Hub установи последнюю LTS-версию Unity\r\n3. Создай новый проект (желательно в 3D)\r\n4. Открой проект и посмотри на основные панели интерфейса\r\n\r\n---\r\n\r\n## 🛠️ Советы:\r\n- Используй LTS-версию Unity — она стабильнее для новичков\r\n- Дай проекту осмысленное имя: `MyFirstGame` или `TestProject`\r\n- Храни проекты на диске D:/ или в отдельной папке, чтобы избежать проблем с доступами\r\n\r\n---\r\n\r\n## ✅ Итоги\r\nТы установил Unity, создал свой первый проект и теперь ориентируешься в базовом интерфейсе. Следующий шаг — добавим объекты в сцену и начнём строить свой игровой мир!',2,NULL,'2025-07-01 18:57:32','2025-07-01 18:57:32'),(7,'Сцена и объекты','# 🧩 Урок 2: Сцена и объекты\r\n\r\n📅 **Создан:** 2025-04-02\r\n\r\n---\r\n\r\n## 📘 Описание\r\nТеперь, когда ты открыл Unity и видишь интерфейс, пора познакомиться с понятием **сцены** и **объектов**, из которых она состоит. В этом уроке ты узнаешь, как добавлять объекты, перемещать их, масштабировать и вращать. Это основа любого мира в Unity — от 2D платформера до 3D RPG.\r\n\r\n---\r\n\r\n## 🔹 Что такое сцена?\r\nСцена (Scene) — это как уровень или игровое пространство. Она содержит все объекты, которые ты видишь во время игры: персонажи, декорации, враги, освещение, UI и т.д.\r\n\r\n---\r\n\r\n## 🔹 GameObject: основа всего\r\nКаждый элемент в сцене — это **GameObject**. Он может быть:\r\n- Кубом, сферой или плоскостью\r\n- Камерой или источником света\r\n- Пустым объектом (Empty), к которому прикрепляются другие компоненты\r\n\r\n```csharp\r\n// Добавление объекта через меню:\r\nGameObject > 3D Object > Cube\r\n```\r\n\r\n---\r\n\r\n## 🔹 Transform: позиция, масштаб, поворот\r\nКаждый объект имеет компонент Transform, который отвечает за:\r\n- Положение (Position)\r\n- Вращение (Rotation)\r\n- Масштаб (Scale)\r\n\r\nТы можешь:\r\n- Перетаскивать объект в сцене мышкой\r\n- Изменять координаты вручную в **Inspector**\r\n\r\n---\r\n\r\n## 🔹 Практика\r\n1. Создай 3 объекта: куб, сферу и плоскость\r\n2. Размести их на сцене так, чтобы куб и сфера стояли на плоскости\r\n3. Измени масштаб сферы, чтобы она стала больше\r\n4. Поверни куб на 45 градусов по оси Y\r\n\r\n---\r\n\r\n## ✅ Итоги\r\nТеперь ты понимаешь, что сцена — это игровой мир, а GameObject — кирпичики, из которых он построен. Умеешь добавлять и настраивать объекты, что понадобится на каждом этапе создания игры.',2,NULL,'2025-07-01 18:58:21','2025-07-01 18:58:21'),(8,'Компоненты и инспектор','# 🧩 Урок 3: Компоненты и инспектор\r\n\r\n📅 **Создан:** 2025-04-02\r\n\r\n---\r\n\r\n## 📘 Описание\r\nВ Unity каждый GameObject состоит из **компонентов**, которые определяют его поведение и свойства. А панель **Inspector** позволяет редактировать эти компоненты. В этом уроке ты узнаешь, как работают компоненты и как использовать инспектор для их настройки.\r\n\r\n---\r\n\r\n## 🔹 Что такое компонент?\r\nКомпонент — это модуль, который добавляет функциональность объекту.\r\nНапример:\r\n- `Transform` — определяет положение, вращение и масштаб\r\n- `Mesh Renderer` — отображает 3D-модель\r\n- `Collider` — добавляет физические границы\r\n- `Rigidbody` — включает физику\r\n\r\nGameObject без компонентов — это просто пустой контейнер.\r\n\r\n---\r\n\r\n## 🔹 Inspector: твой редактор свойств\r\nInspector показывает все компоненты выбранного объекта. Здесь можно:\r\n- Менять параметры вручную (например, координаты или цвет)\r\n- Добавлять и удалять компоненты\r\n- Изменять порядок компонентов\r\n\r\n---\r\n\r\n## 🔹 Как добавить компонент\r\n1. Выбери объект на сцене\r\n2. В панели Inspector нажми **Add Component**\r\n3. Введи название компонента (например, `Box Collider`) и выбери его\r\n\r\n---\r\n\r\n## 🔹 Практика\r\n1. Создай куб и добавь к нему компонент `Rigidbody` — теперь он будет падать\r\n2. Удали `Box Collider` — куб провалится сквозь землю\r\n3. Верни `Box Collider` — куб будет сталкиваться с другими объектами\r\n\r\n---\r\n\r\n## ✅ Итоги\r\nКомпоненты делают объект интерактивным. Ты научился добавлять и настраивать их через Inspector — это основной инструмент работы с объектами в Unity.',2,NULL,'2025-07-01 18:58:54','2025-07-01 18:58:54'),(9,'Материалы и цвета','# 🧩 Урок 4: Материалы и цвета\r\n\r\n📅 **Создан:** 2025-04-02\r\n\r\n---\r\n\r\n## 📘 Описание\r\nЧтобы объекты на сцене выглядели красиво и реалистично, им назначаются **материалы**. Материал определяет цвет, текстуру и отражательные свойства поверхности объекта. В этом уроке ты научишься создавать и настраивать материалы в Unity.\r\n\r\n---\r\n\r\n## 🔹 Что такое материал?\r\nМатериал (Material) — это шаблон внешнего вида объекта. Он может быть:\r\n- Цветным\r\n- С текстурой\r\n- С глянцем или матовой поверхностью\r\n- С эффектом свечения или прозрачности\r\n\r\n---\r\n\r\n## 🔹 Как создать материал\r\n1. В панели **Project** щёлкни правой кнопкой > Create > Material\r\n2. Назови его, например, `RedMat`\r\n3. В Inspector настрой:\r\n   - **Color** — базовый цвет\r\n   - **Shader** — модель отображения (обычно Standard или URP Lit)\r\n   - **Metallic / Smoothness** — блеск и отражение\r\n\r\n---\r\n\r\n## 🔹 Как применить материал\r\n- Перетащи материал на объект в сцене\r\n- Или задай его в компоненте `Mesh Renderer` в поле **Materials**\r\n\r\n---\r\n\r\n## 🔹 Работа с текстурами\r\nМатериал может содержать изображение (текстуру):\r\n1. Импортируй файл PNG/JPG в Unity\r\n2. Перетащи его в слот **Albedo** у материала\r\n\r\n---\r\n\r\n## 🔹 Практика\r\n1. Создай три материала: красный, синий и блестящий\r\n2. Назначь их кубу, сфере и плоскости\r\n3. Добавь текстуру кирпичей на один из объектов\r\n\r\n---\r\n\r\n## ✅ Итоги\r\nТеперь ты умеешь:\r\n- Создавать и настраивать материалы\r\n- Назначать их объектам\r\n- Работать с цветом и текстурами\r\n\r\nМатериалы — это основа визуального стиля игры. Следующий шаг — свет и камера!',2,NULL,'2025-07-01 18:59:40','2025-07-01 18:59:40'),(10,'Камера и освещение','# 🧩 Урок 5: Камера и освещение\r\n\r\n📅 **Создан:** 2025-04-02\r\n\r\n---\r\n\r\n## 📘 Описание\r\nБез камеры игрок ничего не увидит. Без света — увидит, но тьму. В этом уроке мы разберём, как настроить камеру, чтобы она показывала сцену с нужного ракурса, и как использовать освещение, чтобы создавать атмосферу и делать объекты видимыми.\r\n\r\n---\r\n\r\n## 🔹 Камера\r\nКамера — это \"глаза\" игрока в мире игры. Каждый проект начинается с основной камеры (Main Camera).\r\n\r\n### Основные параметры:\r\n- **Position / Rotation** — где она находится и куда смотрит\r\n- **Field of View** — угол обзора\r\n- **Clipping Planes** — расстояние до видимых объектов (Near/Far)\r\n\r\n### Как управлять камерой:\r\n- Перемещай её как обычный объект\r\n- Настраивай параметры в **Inspector**\r\n- Можно написать скрипт, чтобы камера следила за игроком\r\n\r\n---\r\n\r\n## 🔹 Освещение\r\nВ Unity есть разные типы источников света:\r\n\r\n| Тип света     | Назначение                               |\r\n|---------------|-------------------------------------------|\r\n| Directional   | Солнечный свет, освещает всё равномерно  |\r\n| Point         | Точка, излучающая свет во все стороны    |\r\n| Spot          | Луч света, как фонарик                    |\r\n| Area          | Только для рендеринга (не в реальном времени) |\r\n\r\n### Компоненты света:\r\n- **Intensity** — яркость\r\n- **Color** — цвет света\r\n- **Range** — радиус действия (для точечных источников)\r\n\r\n---\r\n\r\n## 🔹 Практика\r\n1. Удали Directional Light и добавь Point Light рядом с кубом\r\n2. Измени цвет света на синий и понаблюдай за тенями\r\n3. Настрой камеру, чтобы она смотрела на куб сверху\r\n\r\n---\r\n\r\n## 🛠️ Советы:\r\n- Никогда не оставляй сцену без света — объекты будут чёрными\r\n- Используй комбинированное освещение для лучшего визуального эффекта\r\n- Настраивай тени, если производительность позволяет\r\n\r\n---\r\n\r\n## ✅ Итоги\r\nТеперь ты умеешь управлять главным «глазом» игры и создавать освещение, которое влияет на настроение и видимость сцены. Это важный шаг на пути к визуально завершённой игре.',2,NULL,'2025-07-01 19:00:09','2025-07-01 19:00:09'),(11,'Перемещение и вращение объектов','# 🧩 Урок 6: Перемещение и вращение объектов\r\n\r\n📅 **Создан:** 2025-04-02\r\n\r\n---\r\n\r\n## 📘 Описание\r\nВ этом уроке ты научишься оживлять сцену: перемещать и вращать объекты с помощью скриптов. Это базовая механика, которая нужна практически в каждой игре — от управления игроком до анимации врагов или предметов.\r\n\r\n---\r\n\r\n## 🔹 Движение через скрипт\r\n1. Создай C#-скрипт `Mover.cs`\r\n2. Пример простого перемещения:\r\n\r\n```csharp\r\npublic class Mover : MonoBehaviour\r\n{\r\n    public float speed = 5f;\r\n\r\n    void Update()\r\n    {\r\n        transform.Translate(Vector3.forward * speed * Time.deltaTime);\r\n    }\r\n}\r\n```\r\n➡️ Объект будет двигаться вперёд каждый кадр\r\n\r\n---\r\n\r\n## 🔹 Вращение\r\n\r\n```csharp\r\nvoid Update()\r\n{\r\n    transform.Rotate(0, 45 * Time.deltaTime, 0);\r\n}\r\n```\r\n➡️ Вращает объект вокруг оси Y со скоростью 45 градусов в секунду\r\n\r\n---\r\n\r\n## 🔹 Управление с клавиатуры\r\n```csharp\r\nvoid Update()\r\n{\r\n    float moveX = Input.GetAxis(\"Horizontal\");\r\n    float moveZ = Input.GetAxis(\"Vertical\");\r\n\r\n    Vector3 direction = new Vector3(moveX, 0, moveZ);\r\n    transform.Translate(direction * speed * Time.deltaTime);\r\n}\r\n```\r\n➡️ Управление с помощью стрелок или WASD\r\n\r\n---\r\n\r\n## 🔹 Практика\r\n1. Привяжи скрипт `Mover.cs` к кубу\r\n2. Измени скорость перемещения в инспекторе\r\n3. Добавь вращение, если объект — башня или камера\r\n\r\n---\r\n\r\n## ✅ Итоги\r\nТы научился перемещать и вращать объекты в Unity через код. Это фундамент интерактивности. Следующий шаг — сделать объекты повторно используемыми через **префабы**!',2,NULL,'2025-07-01 19:00:39','2025-07-01 19:00:39'),(12,'Создание префабов','# 🧩 Урок 7: Создание префабов\r\n\r\n📅 **Создан:** 2025-04-02\r\n\r\n---\r\n\r\n## 📘 Описание\r\nПрефабы (Prefabs) — это шаблоны объектов. Они позволяют создавать клоны одного и того же объекта со всеми компонентами и настройками. Это основа для создания врагов, пуль, предметов и любого другого повторяющегося контента.\r\n\r\n---\r\n\r\n## 🔹 Зачем нужны префабы?\r\n- Повторное использование\r\n- Лёгкое обновление всех экземпляров\r\n- Создание объектов в реальном времени (через код)\r\n\r\n---\r\n\r\n## 🔹 Как создать префаб\r\n1. Настрой объект в сцене (например, врага или монету)\r\n2. Перетащи его из Hierarchy в папку `Prefabs` в Project\r\n3. Объект окрасится в синий цвет — значит, он стал префабом\r\n\r\n---\r\n\r\n## 🔹 Работа с префабами\r\n- Двойной клик — откроет режим редактирования префаба\r\n- Изменения в префабе автоматически применятся ко всем его копиям\r\n\r\n---\r\n\r\n## 🔹 Создание из кода\r\n```csharp\r\npublic GameObject enemyPrefab;\r\n\r\nvoid Start()\r\n{\r\n    Instantiate(enemyPrefab, new Vector3(0, 0, 0), Quaternion.identity);\r\n}\r\n```\r\n➡️ Создаст объект из префаба в указанной позиции\r\n\r\n---\r\n\r\n## 🔹 Практика\r\n1. Сделай префаб врага, добавь к нему Rigidbody и Collider\r\n2. Добавь скрипт для спавна врагов\r\n3. Попробуй изменить префаб — все враги на сцене изменятся автоматически\r\n\r\n---\r\n\r\n## ✅ Итоги\r\nТеперь ты умеешь создавать и использовать префабы — важнейший инструмент при создании динамических сцен и повторяющихся объектов.',2,NULL,'2025-07-01 19:01:17','2025-07-01 19:01:17'),(13,'Основы UI','# 🧩 Урок 8: Основы UI\r\n\r\n📅 **Создан:** 2025-04-02\r\n\r\n---\r\n\r\n## 📘 Описание\r\n\r\nUI (User Interface) — это интерфейс, с которым взаимодействует игрок: текст, кнопки, индикаторы здоровья и прочее. В этом уроке ты узнаешь, как работать с системой UI в Unity: создавать канвас, размещать элементы и взаимодействовать с ними через код.\r\n\r\n---\r\n\r\n## 🔹 Canvas: холст интерфейса\r\n\r\n- Все UI-элементы размещаются внутри **Canvas**\r\n- Создаётся автоматически, если добавить любой UI-элемент\r\n- Работает в экранных координатах, а не в мире\r\n\r\n---\r\n\r\n## 🔹 Элементы UI\r\n\r\n- **Text (TextMeshPro)** — отображение текста\r\n- **Button** — интерактивная кнопка\r\n- **Image** — изображение или иконка\r\n- **Slider** — ползунок, например, для HP\r\n- **Panel** — фоновая область\r\n\r\n---\r\n\r\n## 🔹 Как создать UI\r\n\r\n1. `GameObject > UI > Button` (создаст кнопку + Canvas)\r\n2. Настраивай размер, цвет, текст в **Inspector**\r\n3. В `OnClick()` можно назначить метод, который выполнится при нажатии\r\n\r\n---\r\n\r\n## 🔹 Подключение скрипта\r\n\r\n```csharp\r\npublic class UIHandler : MonoBehaviour\r\n{\r\n    public void OnButtonClick()\r\n    {\r\n        Debug.Log(\"Кнопка нажата!\");\r\n    }\r\n}\r\n```\r\n\r\n➡️ Назначь метод `OnButtonClick` в инспекторе кнопки\r\n\r\n---\r\n\r\n## 🔹 Практика\r\n\r\n1. Создай кнопку «Начать игру»\r\n2. Выведи в `Debug.Log()` сообщение при её нажатии\r\n3. Добавь текст заголовка и фон (Panel)\r\n\r\n---\r\n\r\n## ✅ Итоги\r\n\r\nТеперь ты умеешь создавать интерфейсы и взаимодействовать с ними. UI — это то, что делает игру понятной для игрока. Следующий шаг — сборка готового проекта!',2,NULL,'2025-07-01 19:01:56','2025-07-01 19:01:56'),(14,'Первый сбор проекта','# 🧩 Урок 9: Первый сбор проекта\r\n\r\n📅 **Создан:** 2025-04-02\r\n\r\n---\r\n\r\n## 📘 Описание\r\nПоздравляю! Ты прошёл базовый путь от сцены до интерфейса. В этом уроке ты научишься собирать свой проект в исполняемый файл, чтобы делиться игрой с другими или запускать её на своём компьютере без Unity.\r\n\r\n---\r\n\r\n## 🔹 Подготовка к сборке\r\n1. Убедись, что сцена сохранена (`File > Save Scenes`)\r\n2. Добавь текущую сцену в билд:\r\n   - `File > Build Settings`\r\n   - Нажми **Add Open Scenes**\r\n3. Выбери платформу (по умолчанию — PC, Mac & Linux Standalone)\r\n\r\n---\r\n\r\n## 🔹 Настройка\r\nВ Build Settings:\r\n- Нажми **Player Settings**\r\n- Укажи имя проекта, иконку, разрешение окна и другие параметры\r\n\r\n---\r\n\r\n## 🔹 Сборка\r\n1. Нажми **Build**\r\n2. Выбери папку, куда сохранить сборку\r\n3. Подожди — Unity соберёт `.exe` (или другой формат под выбранную платформу)\r\n\r\n---\r\n\r\n## 🔹 Что внутри сборки?\r\n- `.exe` файл (Windows)\r\n- Папка `Data` — содержит все сцены, ассеты и код\r\n\r\n---\r\n\r\n## 🛠️ Советы\r\n- Не собирай в папку проекта — создай отдельную `Builds`\r\n- Не забудь отключить `Development Build` в настройках перед релизом\r\n- Проверяй финальный билд на целевом устройстве\r\n\r\n---\r\n\r\n## ✅ Итоги\r\nТеперь ты умеешь собирать свой проект и делиться им с друзьями. Это заключительный шаг блока \"Основы Unity\" — но лишь начало твоего пути как разработчика игр!',2,NULL,'2025-07-01 19:02:31','2025-07-01 19:02:31'),(15,'Создание игрового уровня','# 🧩 Урок 1: Создание игрового уровня\r\n\r\n## 🎓 Цель урока\r\nНаучиться создавать простой уровень в Unity: добавлять землю, платформы, границы, использовать материалы и работать с иерархией объектов.\r\n\r\n---\r\n\r\n## 🔍 Что такое уровень в Unity?\r\n\r\nУровень — это сцена (Scene), на которой размещаются все игровые объекты: земля, стены, враги, игрок, UI и т.д. В Unity сцена отображается как визуальное пространство, и ты сам решаешь, как оно будет выглядеть.\r\n\r\nUnity позволяет собирать уровень из примитивных объектов (Cube, Plane), а также использовать готовые ассеты и префабы. Но сначала мы потренируемся на простых элементах.\r\n\r\n---\r\n\r\n## 🧱 Строим сцену шаг за шагом\r\n\r\n### Шаг 1: Создаём сцену\r\n1. Перейди в меню `File > New Scene`\r\n2. Сохрани её: `File > Save As` → `Assets/Scenes/Level1.unity`\r\n\r\n### Шаг 2: Добавляем землю\r\n1. `Hierarchy > + > 3D Object > Plane`\r\n2. Назови объект `Ground`\r\n3. Установи его в позицию (0, 0, 0)\r\n\r\n**Plane** — это большая плоская поверхность, идеально подходящая для земли.\r\n\r\n### Шаг 3: Добавляем платформы\r\n1. `+ > 3D Object > Cube`\r\n2. Измени **Scale**:\r\n   - X = 4, Y = 0.5, Z = 2\r\n3. Установи позицию: (0, 0.25, 4)\r\n4. Продублируй (CTRL+D) и размести ещё 2 платформы\r\n\r\n### Шаг 4: Добавляем границы уровня\r\n1. Создай 4 куба по периметру сцены\r\n2. Масштаб:\r\n   - Стены по бокам: X = 0.5, Y = 3, Z = 20\r\n   - Передняя и задняя: X = 20, Y = 3, Z = 0.5\r\n3. Позиции:\r\n   - \"Wall_Left\": (-10, 1.5, 0)\r\n   - \"Wall_Right\": (10, 1.5, 0)\r\n   - \"Wall_Front\": (0, 1.5, 10)\r\n   - \"Wall_Back\": (0, 1.5, -10)\r\n\r\n### Шаг 5: Создаём родительский объект\r\n1. `+ > Create Empty` → назови `Level`\r\n2. Перетащи все объекты уровня внутрь `Level`\r\n\r\n### Шаг 6: Назначаем материалы\r\n1. `Assets > Create > Material` → назови `GroundMat`\r\n2. В Inspector выбери цвет, например, зелёный\r\n3. Перетащи материал на `Ground`\r\n4. Повтори для платформ и стен (разные цвета)\r\n\r\n---\r\n\r\n## 🧪 Закрепляем знания: проверь себя\r\n- Стены не дают игроку выйти за пределы сцены?\r\n- Платформы находятся на разной высоте?\r\n- Все объекты организованы в иерархии `Level`?\r\n- У каждого типа объектов — свой цвет?\r\n\r\n---\r\n\r\n## ✅ Результат\r\nТы создал полноценную игровую арену из примитивов, структурировал сцену и применил визуальные материалы. Это станет основой для всех следующих этапов разработки игры.\r\n\r\nСледующий шаг — добавить **игрока** и реализовать **управление**.',3,NULL,'2025-07-01 19:19:09','2025-07-01 19:19:09'),(16,'Камера, следящая за игроком','# 🧩 Урок 3: Камера, следящая за игроком\r\n\r\n## 🎓 Цель урока\r\nСделать так, чтобы камера следовала за игроком и показывала происходящее в реальном времени, создавая эффект присутствия и комфорта при управлении.\r\n\r\n---\r\n\r\n## 🔍 Зачем это нужно?\r\nВ большинстве игр камера не статична — она двигается вместе с персонажем. Это позволяет игроку видеть, что происходит вокруг и куда он движется. Плохая или неподвижная камера может испортить даже отличную механику.\r\n\r\n---\r\n\r\n## 🛠 Реализация слежения\r\n\r\n### Шаг 1: Привязка камеры\r\n1. Выдели `Main Camera`\r\n2. Перетащи её внутрь объекта `Player` в `Hierarchy`\r\n\r\nТеперь она будет двигаться вместе с игроком, но всегда смотреть с одной позиции — это самый простой способ.\r\n\r\n### Шаг 2 (альтернатива): Слежение через скрипт\r\nСоздай скрипт `CameraFollow.cs`:\r\n```csharp\r\nusing UnityEngine;\r\n\r\npublic class CameraFollow : MonoBehaviour\r\n{\r\n    public Transform target;\r\n    public Vector3 offset = new Vector3(0, 5, -10);\r\n    public float smoothSpeed = 0.125f;\r\n\r\n    void LateUpdate()\r\n    {\r\n        Vector3 desiredPosition = target.position + offset;\r\n        Vector3 smoothedPosition = Vector3.Lerp(transform.position, desiredPosition, smoothSpeed);\r\n        transform.position = smoothedPosition;\r\n\r\n        transform.LookAt(target);\r\n    }\r\n}\r\n```\r\n\r\n1. Присвой скрипт `Main Camera`\r\n2. В поле `target` укажи объект `Player`\r\n\r\n---\r\n\r\n## 📌 Пояснение к коду\r\n- `LateUpdate` используется для работы после перемещения игрока\r\n- `Vector3.Lerp` плавно перемещает камеру к нужной позиции\r\n- `LookAt` направляет камеру на игрока\r\n\r\n---\r\n\r\n## 💡 Советы\r\n- Можно экспериментировать с offset и smoothSpeed для разного поведения\r\n- Камера не должна проходить сквозь стены — в будущем можно добавить коллайдеры или ограничения\r\n\r\n---\r\n\r\n## ✅ Результат\r\nТеперь камера движется за игроком и всегда показывает его сзади или сверху. Это улучшает игровой опыт и помогает игроку ориентироваться на уровне.',3,NULL,'2025-07-01 19:21:50','2025-07-01 19:21:50'),(17,'Сбор предметов и счёт','# 🧩 Урок 4: Сбор предметов и счёт\r\n\r\n## 🎓 Цель урока\r\nНаучиться создавать интерактивные предметы, которые можно собирать, и вести счёт собранных объектов через UI.\r\n\r\n---\r\n\r\n## 🔍 Что такое собираемые предметы?\r\nСобираемые объекты — это элементы, которые игрок может подобрать, прикоснувшись к ним. Это может быть монета, кристалл, ключ и т.д. В Unity для этого используются **триггеры** и **UI элементы**.\r\n\r\n---\r\n\r\n## 🛠 Шаги по реализации\r\n\r\n### Шаг 1: Создай предмет\r\n1. `Hierarchy > + > 3D Object > Sphere`\r\n2. Назови её `Pickup`\r\n3. Установи позицию на платформу\r\n4. В Inspector:\r\n   - Удали `Mesh Collider` (если есть)\r\n   - Добавь `Box Collider`, поставь галочку `Is Trigger`\r\n   - Добавь компонент `Rigidbody`, включи `Is Kinematic`\r\n\r\n### Шаг 2: Назначь тег и материал\r\n- Задай тег `Pickup`\r\n- Создай материал, например, жёлтый, и перетащи на объект\r\n\r\n### Шаг 3: Создай UI-счётчик\r\n1. `Hierarchy > + > UI > Text - TextMeshPro`\r\n2. Назови `ScoreText`\r\n3. Отцентрируй и увеличь шрифт\r\n\r\n### Шаг 4: Скрипт сбора предметов\r\nСоздай `PlayerScore.cs` и прикрепи к игроку:\r\n```csharp\r\nusing UnityEngine;\r\nusing TMPro;\r\n\r\npublic class PlayerScore : MonoBehaviour\r\n{\r\n    public int score = 0;\r\n    public TextMeshProUGUI scoreText;\r\n\r\n    void OnTriggerEnter(Collider other)\r\n    {\r\n        if (other.CompareTag(\"Pickup\"))\r\n        {\r\n            Destroy(other.gameObject);\r\n            score++;\r\n            scoreText.text = \"Счёт: \" + score;\r\n        }\r\n    }\r\n}\r\n```\r\n\r\n1. Присвой `ScoreText` из Canvas в поле `scoreText`\r\n2. Скопируй и размести несколько `Pickup` на сцене\r\n\r\n---\r\n\r\n## 📌 Пояснение к коду\r\n- `OnTriggerEnter` срабатывает при касании объекта с `IsTrigger`\r\n- `Destroy` удаляет объект со сцены\r\n- `scoreText.text` обновляет UI\r\n\r\n---\r\n\r\n## ✅ Результат\r\nИгрок может собирать объекты, а на экране отображается обновляющийся счёт. Это добавляет мотивацию и цель в игру!',3,NULL,'2025-07-01 19:22:48','2025-07-01 19:22:48'),(18,'Управление игроком','# 🧩 Урок 2: Управление игроком\r\n\r\n## 🎓 Цель урока\r\nДобавить на сцену игрового персонажа и реализовать базовое управление — передвижение влево/вправо и прыжок. Это основа взаимодействия игрока с миром игры.\r\n\r\n---\r\n\r\n## 🔍 Что такое управление персонажем?\r\n\r\nИгрок — это объект, которым управляет пользователь. Управление реализуется через обработку ввода с клавиатуры или геймпада. В Unity для перемещения часто используется компонент `Rigidbody`, а ввод — через `Input.GetAxis` и `Input.GetKeyDown`.\r\n\r\nМы сделаем:\r\n- движение по оси X с учётом нажатия клавиш\r\n- прыжок по клавише `Space`\r\n- добавим простую физику\r\n\r\n---\r\n\r\n## 🛠 Пошаговое создание игрока\r\n\r\n### Шаг 1: Добавь персонажа на сцену\r\n1. В `Hierarchy` выбери `+ > 3D Object > Capsule`\r\n2. Назови объект `Player`\r\n3. Установи позицию: (0, 1, 0)\r\n\r\n### Шаг 2: Настрой Rigidbody\r\n1. Выдели `Player`\r\n2. Добавь компонент `Rigidbody`\r\n3. Установи:\r\n   - `Mass`: 1\r\n   - `Drag`: 0\r\n   - `Angular Drag`: 0.05\r\n   - `Use Gravity`: включено\r\n   - `Constraints`: поставь галочку `Freeze Rotation X`, `Y`, `Z` (чтобы не крутился)\r\n\r\n### Шаг 3: Добавь скрипт управления\r\n1. Создай скрипт `PlayerController.cs` и вставь код:\r\n```csharp\r\nusing UnityEngine;\r\n\r\npublic class PlayerController : MonoBehaviour\r\n{\r\n    public float speed = 5f;\r\n    public float jumpForce = 7f;\r\n    private Rigidbody rb;\r\n    private bool isGrounded = true;\r\n\r\n    void Start()\r\n    {\r\n        rb = GetComponent<Rigidbody>();\r\n    }\r\n\r\n    void Update()\r\n    {\r\n        float move = Input.GetAxis(\"Horizontal\");\r\n        rb.velocity = new Vector3(move * speed, rb.velocity.y, 0);\r\n\r\n        if (Input.GetKeyDown(KeyCode.Space) && isGrounded)\r\n        {\r\n            rb.AddForce(Vector3.up * jumpForce, ForceMode.Impulse);\r\n            isGrounded = false;\r\n        }\r\n    }\r\n\r\n    void OnCollisionEnter(Collision collision)\r\n    {\r\n        if (collision.gameObject.CompareTag(\"Ground\"))\r\n        {\r\n            isGrounded = true;\r\n        }\r\n    }\r\n}\r\n```\r\n2. Присвой `Ground` тег `Ground` (вверху Inspector у Plane)\r\n3. Прикрепи скрипт к объекту `Player`\r\n\r\n---\r\n\r\n## 📌 Пояснение к коду\r\n- `Input.GetAxis(\"Horizontal\")` считывает A/D или стрелки ← →\r\n- `rb.velocity` обновляет скорость по оси X\r\n- `AddForce` применяется для прыжка\r\n- `isGrounded` не даёт прыгать в воздухе\r\n- `OnCollisionEnter` возвращает игрока на землю\r\n\r\n---\r\n\r\n## 🧪 Проверка\r\n- Персонаж двигается по оси X, когда нажимаешь A или D?\r\n- Прыжок работает один раз, пока не коснёшься земли?\r\n- При поворотах и столкновениях игрок не переворачивается?\r\n\r\n---\r\n\r\n## ✅ Результат\r\nТеперь у тебя есть управляемый персонаж, который двигается и прыгает с помощью клавиатуры. В следующем уроке ты научишься закрепить за ним камеру, которая будет следовать за движением.',3,NULL,'2025-07-01 19:23:28','2025-07-01 19:24:11'),(19,'Победа и перезапуск уровня','# 🧩 Урок 5: Победа и перезапуск уровня\r\n\r\n## 🎓 Цель урока\r\nДобавить в игру финальную цель: победу при сборе всех предметов, а также возможность перезапустить уровень.\r\n\r\n---\r\n\r\n## 🔍 Зачем это нужно?\r\nЛюбая игра должна иметь цель. Например, собрать все объекты или дойти до выхода. Также важна возможность попробовать снова — для этого нужен перезапуск сцены.\r\n\r\n---\r\n\r\n## 🛠 Реализация\r\n\r\n### Шаг 1: Логика победы\r\nДобавим в скрипт `PlayerScore` проверку на победу:\r\n```csharp\r\npublic int totalPickups = 5; // Задай вручную в инспекторе\r\npublic GameObject winPanel;\r\n\r\nvoid OnTriggerEnter(Collider other)\r\n{\r\n    if (other.CompareTag(\"Pickup\"))\r\n    {\r\n        Destroy(other.gameObject);\r\n        score++;\r\n        scoreText.text = \"Счёт: \" + score;\r\n\r\n        if (score >= totalPickups)\r\n        {\r\n            winPanel.SetActive(true);\r\n        }\r\n    }\r\n}\r\n```\r\n\r\n1. Создай `Canvas > Panel`, назови `WinPanel`, сделай его скрытым\r\n2. Добавь текст «Вы победили!» и кнопку «Заново»\r\n3. Свяжи `winPanel` в инспекторе\r\n\r\n### Шаг 2: Перезапуск уровня\r\nСоздай новый скрипт `RestartGame.cs`:\r\n```csharp\r\nusing UnityEngine;\r\nusing UnityEngine.SceneManagement;\r\n\r\npublic class RestartGame : MonoBehaviour\r\n{\r\n    public void RestartLevel()\r\n    {\r\n        SceneManager.LoadScene(SceneManager.GetActiveScene().name);\r\n    }\r\n}\r\n```\r\n\r\n1. Добавь его на кнопку в `WinPanel`\r\n2. В `Button > OnClick()` назначь `RestartGame.RestartLevel`\r\n\r\n---\r\n\r\n## 💡 Советы\r\n- Убедись, что все предметы собраны до победы\r\n- Используй `Time.timeScale = 0` при победе, если хочешь остановить движение\r\n\r\n---\r\n\r\n## ✅ Результат\r\nПосле сбора всех предметов появляется экран победы с кнопкой. Нажатие перезапускает игру, позволяя пройти уровень ещё раз.',3,NULL,'2025-07-01 19:25:09','2025-07-01 19:25:09');
/*!40000 ALTER TABLE `lessons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_03_18_170616_create_courses_table',1),(5,'2025_03_18_170929_create_blocks_table',1),(6,'2025_03_18_171238_create_lessons_table',1),(7,'2025_03_18_171430_create_tests_table',1),(8,'2025_03_18_171704_create_test_questions_table',1),(9,'2025_03_18_172110_create_test_results_table',1),(10,'2025_03_18_172722_create_assignments_table',1),(11,'2025_03_18_172916_create_assignment_submissions_table',1),(12,'2025_03_18_174709_create_assignment_grades_table',1),(13,'2025_03_18_175311_create_groups_table',1),(14,'2025_03_18_175526_create_group_members_table',1),(15,'2025_03_18_184434_create_personal_access_tokens_table',1),(16,'2015_04_12_000000_create_orchid_users_table',2),(17,'2015_10_19_214424_create_orchid_roles_table',2),(18,'2015_10_19_214425_create_orchid_role_users_table',2),(19,'2016_08_07_125128_create_orchid_attachmentstable_table',2),(20,'2017_09_17_125801_create_notifications_table',2),(21,'2025_04_13_125412_add_permissions_fiels_in_users_table',2),(22,'2025_05_11_094817_add_timer_field_in_tests_table',2),(23,'2025_05_13_181123_create_test_user_result_table',2),(24,'2025_05_18_121303_add_name_field_in_assignments_table',2),(25,'2025_05_19_174217_add_teacher_id_field_in_groups_table',2),(26,'2025_05_20_155806_add_status_field_in_assignment_submissions_table',2),(27,'2025_06_30_062849_add_default_value_for_user_fields',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',2,'auth_token','88b17ad27f452c855f090c58f7a28e2e607b3538fe909b171cc8f4429b92c35e','[\"*\"]','2025-06-30 06:34:54',NULL,'2025-06-30 06:34:54','2025-06-30 06:34:54'),(2,'App\\Models\\User',3,'auth_token','21279e7c6d1149e476fb1fa59276208fdc8e1c3194e317f23cb56be360d7095f','[\"*\"]','2025-06-30 10:36:19',NULL,'2025-06-30 09:09:47','2025-06-30 10:36:19'),(3,'App\\Models\\User',3,'auth_token','623a237d334d82ea762d5cd682f12ca91fff12322fe3209ef11dd13d008fac23','[\"*\"]','2025-06-30 10:37:31',NULL,'2025-06-30 10:37:00','2025-06-30 10:37:31'),(4,'App\\Models\\User',3,'auth_token','8025e1f1e70bb72ed05c1682cb4144c8f00eb1e9ba24df16bf42d1ee89420d6f','[\"*\"]','2025-06-30 10:38:13',NULL,'2025-06-30 10:38:13','2025-06-30 10:38:13'),(5,'App\\Models\\User',3,'auth_token','510dcf9b2c69cdbd8ff32cf000713c33189145159789bb863b98ac0fa77deeb3','[\"*\"]','2025-06-30 10:39:03',NULL,'2025-06-30 10:39:03','2025-06-30 10:39:03'),(6,'App\\Models\\User',3,'auth_token','d74909dbe033f6f08558bbd8edb93f00b6c23df57cd76b6237fc0547c209c0be','[\"*\"]','2025-06-30 11:10:13',NULL,'2025-06-30 10:46:29','2025-06-30 11:10:13'),(7,'App\\Models\\User',3,'auth_token','38e73264ea4698efa14eded3bd489182e5d52e9ab1248833ac6e38cb45d80447','[\"*\"]','2025-07-01 20:08:33',NULL,'2025-07-01 18:35:00','2025-07-01 20:08:33'),(8,'App\\Models\\User',3,'auth_token','2cf7f435e45ab515efacf462c0351eba83553f9892a09c5fd09772ec5040b5a0','[\"*\"]','2025-07-02 11:39:19',NULL,'2025-07-02 07:03:12','2025-07-02 11:39:19');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_users` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_users_role_id_foreign` (`role_id`),
  CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_users`
--

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
INSERT INTO `role_users` VALUES (1,1),(4,2);
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Администратор','{\"platform.index\": \"1\", \"platform.blocks\": \"1\", \"platform.groups\": \"1\", \"platform.courses\": \"1\", \"platform.lessons\": \"1\", \"platform.statistics\": \"1\", \"platform.systems.roles\": \"1\", \"platform.systems.users\": \"1\", \"platform.systems.attachment\": \"1\", \"platform.assignment-submissions\": \"1\"}','2025-07-01 17:46:16','2025-07-01 17:46:16'),(2,'teacher','Учитель','{\"platform.index\": \"0\", \"platform.blocks\": \"0\", \"platform.groups\": \"1\", \"platform.courses\": \"0\", \"platform.lessons\": \"0\", \"platform.statistics\": \"1\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\", \"platform.assignment-submissions\": \"1\"}','2025-07-01 17:46:34','2025-07-02 07:05:45');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('qmYdc5uTqvXFlZZxh3H755CJ9wdOUjRlaeh1edxz',1,'172.20.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiQ1hLY3dGWUUwUE1ZWm5HaGw5TkVQaHd0N2tpWDlJcXR1OGh0bWJoSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC9hZG1pbi9hc3NpZ25tZW50cy9jcmVhdGUiO31zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE4OiJ0b2FzdF9ub3RpZmljYXRpb24iO2E6MDp7fX0=',1751456496);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_questions`
--

DROP TABLE IF EXISTS `test_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_id` bigint unsigned NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_questions_test_id_foreign` (`test_id`),
  CONSTRAINT `test_questions_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_questions`
--

LOCK TABLES `test_questions` WRITE;
/*!40000 ALTER TABLE `test_questions` DISABLE KEYS */;
INSERT INTO `test_questions` VALUES (3,'1. Что такое переменная?\r\nA. Команда для запуска игры\r\nB. Имя метода в Unity\r\nC. Область памяти, где хранится значение\r\nD. Компонент объекта в Unity',1,'C','2025-07-01 19:49:43','2025-07-01 19:50:32'),(4,'2. Какой тип данных используется для хранения целого числа?\r\nA. float\r\n✅ B. int\r\nC. bool\r\nD. string',1,'B','2025-07-01 19:50:26','2025-07-01 19:50:26'),(5,'3. Как правильно записать число с плавающей точкой в C#?\r\nA. float speed = 2.5;\r\nB. float speed = 2.5f;\r\nC. float speed = \"2.5\";\r\nD. float = 2.5f;',1,'B','2025-07-01 19:51:03','2025-07-01 19:51:03'),(6,'4. Что верно для типа bool?\r\nA. Может хранить только числа\r\nB. Может хранить символы\r\nC. Может хранить значения true или false\r\nD. Используется только в классах',1,'C','2025-07-01 19:51:26','2025-07-01 19:51:26'),(7,'5. Какой тип данных используется для строки текста?\r\nA. char\r\nB. bool\r\nC. string\r\nD. text',1,'C','2025-07-01 19:51:47','2025-07-01 19:51:47'),(8,'6. Как изменить значение переменной lives, уменьшив его на 1?\r\nA. lives = -1;\r\nB. lives = lives - 1;\r\nC. lives == lives - 1;\r\nD. int lives - 1;',1,'B','2025-07-01 19:52:08','2025-07-01 19:52:08'),(9,'7. Что делает команда Debug.Log(name); в Unity?\r\nA. Удаляет переменную\r\nB. Выводит значение переменной в консоль\r\nC. Меняет имя объекта\r\nD. Создаёт новую переменную',1,'B','2025-07-01 19:52:30','2025-07-01 19:52:30'),(10,'1. Что вернёт выражение 10 % 3?\r\nA. 0\r\nB. 3\r\nC. 1\r\nD. 10',3,'C','2025-07-01 19:55:07','2025-07-01 19:55:07'),(11,'1. Что такое Unity Hub?\r\nA. Программа для монтажа видео\r\nB. Панель настроек внутри Unity\r\nC. Менеджер установки и управления проектами Unity\r\nD. Графический редактор для 2D-арта',7,'C','2025-07-01 19:58:31','2025-07-01 19:58:31'),(12,'2. Какую версию Unity рекомендуется использовать новичкам?\r\nA. Самую старую\r\nB. Версию для разработчиков\r\nC. Любую, какая понравится\r\nD. Последнюю LTS-версию',7,'D','2025-07-01 19:58:53','2025-07-01 19:58:53'),(13,'3. Какое расширение имеет Unity-проект?\r\nA. .unityproj\r\nB. .game\r\nC. У него нет одного конкретного расширения\r\nD. .scene',7,'C','2025-07-01 19:59:18','2025-07-01 19:59:18'),(14,'4. Что такое сцена в Unity?\r\nA. Файл настроек игры\r\n✅ B. Место, где происходит визуальное построение игрового мира\r\nC. Панель настроек камеры\r\nD. Инструмент тестирования кода',7,'B','2025-07-01 19:59:40','2025-07-01 19:59:40'),(15,'5. Какая панель показывает объекты в текущей сцене?\r\nA. Inspector\r\nB. Project\r\nC. Hierarchy\r\nD. Game',7,'C','2025-07-01 20:00:02','2025-07-01 20:00:02'),(16,'6. Где ты можешь редактировать свойства выбранного объекта?\r\nA. Scene\r\nB. Inspector\r\nC. Project\r\nD. Hierarchy',7,'B','2025-07-01 20:00:42','2025-07-01 20:00:42'),(17,'7. Что лучше указать при создании проекта, чтобы избежать проблем с доступами?\r\nA. Хранить проект в корне диска C:/\r\nB. Использовать облачное хранилище\r\nC. Хранить на диске D:/ или в отдельной папке\r\nD. Сохранять прямо на рабочем столе',7,'C','2025-07-01 20:01:09','2025-07-01 20:01:09');
/*!40000 ALTER TABLE `test_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_results`
--

DROP TABLE IF EXISTS `test_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_results` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `user_answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_results_question_id_foreign` (`question_id`),
  KEY `test_results_user_id_foreign` (`user_id`),
  CONSTRAINT `test_results_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `test_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `test_results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_results`
--

LOCK TABLES `test_results` WRITE;
/*!40000 ALTER TABLE `test_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `test_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_user_results`
--

DROP TABLE IF EXISTS `test_user_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_user_results` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `test_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `avg_points` double NOT NULL,
  `avg_percent` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_user_results_test_id_foreign` (`test_id`),
  KEY `test_user_results_user_id_foreign` (`user_id`),
  CONSTRAINT `test_user_results_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `test_user_results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_user_results`
--

LOCK TABLES `test_user_results` WRITE;
/*!40000 ALTER TABLE `test_user_results` DISABLE KEYS */;
INSERT INTO `test_user_results` VALUES (1,1,3,0,0,'2025-07-01 18:35:29','2025-07-01 18:35:29');
/*!40000 ALTER TABLE `test_user_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `timer` double NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `tests_lesson_id_foreign` (`lesson_id`),
  CONSTRAINT `tests_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` VALUES (1,'Переменные и типы данных',1,'2025-07-01 17:12:41','2025-07-01 17:12:41',10),(3,'Арифметические и логические операторы',2,'2025-07-01 19:54:25','2025-07-01 19:55:48',10),(4,'Циклы — for, while, foreach',3,'2025-07-01 19:56:24','2025-07-01 19:56:24',10),(5,'Условия — if, else, switch',4,'2025-07-01 19:57:02','2025-07-01 19:57:02',10),(6,'Методы и параметры',5,'2025-07-01 19:57:33','2025-07-01 19:57:33',10),(7,'Bведение в Unity',6,'2025-07-01 19:58:08','2025-07-01 19:58:08',10),(8,'Сцена и объекты',7,'2025-07-01 20:04:42','2025-07-01 20:04:42',10),(9,'Компоненты и инспектор',8,'2025-07-01 20:05:19','2025-07-01 20:05:19',10),(10,'Материалы и цвета',9,'2025-07-01 20:06:02','2025-07-01 20:06:02',10),(11,'Камера и освещение',10,'2025-07-01 20:06:22','2025-07-01 20:06:22',10),(12,'Перемещение и вращение объектов',11,'2025-07-01 20:06:49','2025-07-01 20:06:49',10),(13,'Создание префабов',12,'2025-07-01 20:07:15','2025-07-01 20:07:15',10),(14,'Основы UI',13,'2025-07-01 20:07:38','2025-07-01 20:07:38',10),(15,'Первый сбор проекта',14,'2025-07-01 20:07:56','2025-07-01 20:07:56',10);
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patronymic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permissions` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin',NULL,NULL,NULL,'admin@admin.com',NULL,'$2y$12$2Mgdte9g.OXl4Bjtp01Sfe47LcDOmRjC0LBOv0K9y99pEqiUn6C4.','cceMKCRJ2eN7DbyYe8aNZePzp1INJp8mx4caervMzSn4a6pmDhBETnQ8l1ip','2025-06-30 06:31:36','2025-07-01 17:48:16','{\"platform.index\": \"1\", \"platform.blocks\": \"1\", \"platform.groups\": \"1\", \"platform.courses\": \"1\", \"platform.lessons\": \"1\", \"platform.statistics\": \"1\", \"platform.systems.roles\": \"1\", \"platform.systems.users\": \"1\", \"platform.systems.attachment\": \"1\", \"platform.assignment-submissions\": \"1\"}'),(2,'Тестовый','тестовый','testsdsdsd','78991233221','test@mail.ru',NULL,'$2y$12$H6livQrOb2s4QRl6B82S8utIz5fQGXtmUueWF98k3FuhkvyaXfMCG',NULL,'2025-06-30 06:34:54','2025-06-30 06:34:54',NULL),(3,'Мирослава','Стрыгина','Олеговна','79001369383','mstrygina13@gmail.com',NULL,'$2y$12$H0Cdz21egA/8r3D5Eyx6ju.2Nn3HbyWd07pZtCFP3fTLloYEx1P5a',NULL,'2025-06-30 09:09:47','2025-06-30 09:09:47',NULL),(4,'Иванов Иван Иванович',NULL,NULL,NULL,'teacher@mail.ru',NULL,'$2y$12$sfSKlW/dDwZI50Z1jVtO1.VCAPFuFWUnKr8LRG.QZP6.SzUOQmrQm',NULL,'2025-07-01 17:49:50','2025-07-01 17:51:18','{\"platform.index\": \"1\", \"platform.blocks\": \"0\", \"platform.groups\": \"0\", \"platform.courses\": \"0\", \"platform.lessons\": \"0\", \"platform.statistics\": \"0\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"0\", \"platform.assignment-submissions\": \"0\"}');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-27 11:33:54
