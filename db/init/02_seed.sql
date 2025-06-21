-- Категории
INSERT INTO categories (name) VALUES
('Чехлы'), ('Пленки и стекла'), ('Зарядные устройства'), ('Кабели'), ('Наушники'), ('Колонки'), ('Держатели'), ('Память и карты'), ('Портативные аккумуляторы'), ('Адаптеры');

-- Товары (примерные данные)
INSERT INTO products (name, description, price, category_id, image, popular) VALUES
('Чехол Silicone Case для iPhone 13', 'Мягкий силиконовый чехол для iPhone 13', 1290.00, 1, 'case_iphone13.jpg', 1),
('Защитное стекло для Samsung S21', 'Прочное стекло для защиты экрана', 790.00, 2, 'glass_s21.jpg', 1),
('Зарядка USB-C 20W', 'Быстрая зарядка для современных устройств', 1490.00, 3, 'charger_20w.jpg', 1),
('Кабель Lightning 1м', 'Оригинальный кабель для iPhone', 990.00, 4, 'cable_lightning.jpg', 1),
('Беспроводные наушники TWS', 'Компактные и удобные наушники', 2990.00, 5, 'tws_earbuds.jpg', 1),
('Портативная колонка Mini', 'Лёгкая и громкая колонка', 1990.00, 6, 'mini_speaker.jpg', 1),
('Держатель в авто', 'Надёжный держатель для смартфона', 890.00, 7, 'car_holder.jpg', 0),
('Карта памяти 64GB', 'Высокоскоростная карта памяти', 1590.00, 8, 'sd_64gb.jpg', 0),
('Power Bank 10000mAh', 'Компактный внешний аккумулятор', 2490.00, 9, 'powerbank_10k.jpg', 1),
('Переходник USB-C на Jack', 'Для подключения наушников', 690.00, 10, 'adapter_usbjack.jpg', 0),
('Чехол для AirPods', 'Силиконовый чехол для AirPods', 590.00, 1, 'case_airpods.jpg', 0),
('Защитная плёнка для iPad', 'Антибликовая плёнка', 990.00, 2, 'film_ipad.jpg', 0),
('Сетевое зарядное устройство 2A', 'Надёжная зарядка для дома', 1190.00, 3, 'charger_2a.jpg', 0),
('Кабель USB-microUSB', 'Для старых устройств', 390.00, 4, 'cable_micro.jpg', 0),
('Проводные наушники', 'Классические наушники с разъёмом Jack', 790.00, 5, 'wired_earphones.jpg', 0),
('Bluetooth колонка', 'Беспроводная колонка с хорошим звуком', 2590.00, 6, 'bt_speaker.jpg', 0),
('Держатель на велосипед', 'Для крепления смартфона на руль', 990.00, 7, 'bike_holder.jpg', 0),
('MicroSD карта 128GB', 'Для расширения памяти', 2490.00, 8, 'msd_128gb.jpg', 0),
('Power Bank 20000mAh', 'Большой запас энергии', 3490.00, 9, 'powerbank_20k.jpg', 0),
('Переходник Lightning-3.5mm', 'Для iPhone без разъёма Jack', 990.00, 10, 'adapter_lightjack.jpg', 0);

-- Пользователи
INSERT INTO users (email, password, name, role) VALUES
('admin@example.com', '$2y$10$2b2b2b2b2b2b2b2b2b2b2uQ7tZpK6p8j8w8l8m8n8o8p8q8r8s8t8', 'Админ', 'admin'),
('user1@example.com', '$2y$10$2b2b2b2b2b2b2b2b2b2b2uQ7tZpK6p8j8w8l8m8n8o8p8q8r8s8t8', 'Иван', 'user'),
('user2@example.com', '$2y$10$2b2b2b2b2b2b2b2b2b2b2uQ7tZpK6p8j8w8l8m8n8o8p8q8r8s8t8', 'Мария', 'user');

-- Заказы
INSERT INTO orders (user_id, status, total) VALUES
(2, 'completed', 4280.00),
(3, 'paid', 990.00),
(2, 'new', 1990.00);

-- Позиции в заказах
INSERT INTO order_items (order_id, product_id, quantity) VALUES
(1, 1, 1), (1, 4, 2),
(2, 5, 1),
(3, 6, 1);
