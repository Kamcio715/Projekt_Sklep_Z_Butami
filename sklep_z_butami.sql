-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2026 at 06:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sklep_z_butami`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_18_111519_create_shoes_table', 1),
(5, '2026_03_18_114132_create_orders_table', 1),
(6, '2026_03_20_095825_dodaj_kolumne_admin_do_users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_klienta` bigint(20) UNSIGNED DEFAULT NULL,
  `imie_klienta` varchar(255) NOT NULL,
  `email_klienta` varchar(255) NOT NULL,
  `telefon_klienta` varchar(255) DEFAULT NULL,
  `adres` varchar(255) NOT NULL,
  `kwota` decimal(10,2) NOT NULL,
  `przedmioty` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`przedmioty`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shoes`
--

CREATE TABLE `shoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `marka` varchar(255) NOT NULL,
  `kategoria` varchar(255) NOT NULL,
  `rodzaj` varchar(255) NOT NULL,
  `rozmiar` decimal(4,1) NOT NULL,
  `cena` decimal(8,2) NOT NULL,
  `kolor` varchar(255) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `zdjecie` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shoes`
--

INSERT INTO `shoes` (`id`, `nazwa`, `marka`, `kategoria`, `rodzaj`, `rozmiar`, `cena`, `kolor`, `opis`, `zdjecie`, `created_at`, `updated_at`) VALUES
(1, 'Breaknet Sleek', 'Adidas', 'Sportowe', 'Damskie', 39.0, 239.99, 'Niebieski', 'Przedstawiamy stylowe buty Breaknet Sleek. Zainspirowane ponadczasową elegancją klasycznych butów sportowych dodają wyrafinowanego charakteru codziennym stylizacjom. Niezależnie od tego, czy zwiedzasz ulice miasta, czy spędzasz dzień na świeżym powietrzu, są idealnym wyborem, jeśli zależy Ci na swobodnym stylu.', 'zdj/BreaknetSleek_01.jpg', '2026-04-26 15:16:32', '2026-04-26 15:16:32'),
(2, 'Carina 2.0', 'Puma', 'Sportowe', 'Damskie', 38.0, 209.99, 'Biały', 'Te stylowe buty to połączenie najwyższej jakości skóry i skóry syntetycznej, które zostały wykonane z materiałów pochodzących z recyklingu. Ich podeszwa środkowa i zewnętrzna z gumy zapewniają doskonałą trwałość i przyczepność. Dodatkowo, wkładka SoftFoam+ gwarantuje nie tylko doskonałą amortyzację, ale także optymalny komfort na każdym kroku. To buty, które łączą styl, jakość wykonania i troskę o środowisko naturalne.', 'zdj/Carina2.0_01.jpg', '2026-04-26 15:29:28', '2026-04-26 15:29:28'),
(3, 'CHARGE', 'Rebook', 'Sportowe', 'Damskie', 40.0, 279.99, 'Beżowy jasny', 'Stylowe damskie sneakersy marki Reebok to połączenie modnego designu z niezrównanym komfortem. Wykonane z wysokiej jakości skóry naturalnej zamszowej i materiału włókienniczego, oferują trwałość i wyjątkowy wygląd. Gruba podeszwa zapewnia doskonałą amortyzację, a klasyczne sznurowanie umożliwia idealne dopasowanie do stopy. Dzięki zastosowanym technologiom Ortholite i Comfort Footbed, każdy krok staje się niezwykle wygodny i przyjemny. Okrągły nosek dodaje uniwersalności, a sportowy styl sprawia, że buty będą świetnym uzupełnieniem codziennych, miejskich stylizacji. Postaw na komfort w sportowym wydaniu!', 'zdj/Charge_01.jpg', '2026-04-26 15:41:14', '2026-04-26 15:41:14'),
(4, 'Czółenka', 'Gino Rossi', 'Eleganckie', 'Damskie', 39.0, 299.99, 'Czarny', 'Dodaj swojej stylizacji nutę elegancji z damskimi czółenkami Gino Rossi. Wykonane z wysokiej jakości skóry naturalnej, te buty łączą w sobie klasę i wyrafinowanie, które doskonale dopełnią każdą wizytową kreację. Smukła szpilka dodaje sylwetce lekkości i podkreśla jej kobiecą zmysłowość, a szpiczasty nosek nadaje całości subtelności i szyku. Idealne na wyjątkowe okazje i wieczorowe wyjścia, czółenka Gino Rossi to nie tylko oznaka dobrego gustu, ale także gwarancja wygody dzięki starannemu wykonaniu i najwyższej jakości materiałom. Wybierz klasykę w nowoczesnym wydaniu i poczuj się pewnie przy każdym kroku!', 'zdj/Czolenka_01.jpg', '2026-04-26 15:45:06', '2026-04-26 15:45:06'),
(5, 'Day One', 'Converse', 'Sportowe', 'Męskie', 40.0, 219.99, 'Czarny', 'Męskie tenisówki Converse to prawdziwa klasyka w sportowym wydaniu. Wykonane z wysokiej jakości materiału włókienniczego, są lekkie, przewiewne i zapewniają komfort przez cały dzień. To idealny wybór na co dzień – zarówno do casualowych, jak i bardziej streetwearowych stylizacji. Ich minimalistyczny, a zarazem ponadczasowy design doskonale wpisuje się w każdą garderobę, dodając jej miejskiego charakteru. Szukasz wygody, która idzie w parze z kultowym stylem? Te tenisówki są stworzone właśnie dla Ciebie! Idealne na spacer po mieście, spotkanie z przyjaciółmi czy weekendowy wypad za miasto – niezawodność i styl w jednym. Postaw na klasyczną jakość i poczuj się świetnie w każdej sytuacji.', 'zdj/DayOne_01.jpg', '2026-04-26 15:49:43', '2026-04-26 15:49:43'),
(6, 'Enzo 2', 'Puma', 'Sportowe', 'Męskie', 42.0, 299.99, 'Czarny', 'Wybierz męskie buty sportowe Puma i ciesz się komfortem na najwyższym poziomie. Wykonane z włókienniczego materiału, zapewniają odpowiednią przewiewność i lekkość. Płaska, elastyczna podeszwa gwarantuje stabilność, a zastosowane technologie SoftFoam i EVA dbają o wyjątkową wygodę i amortyzację. Pianka SoftFoam skutecznie redukuje nacisk na stopy, zwiększając komfort podczas długiego noszenia, natomiast podeszwa EVA zapewnia lekkość i sprężystość każdego kroku. Postaw na niezawodność i styl marki Puma!', 'zdj/Enzo_01.jpg', '2026-04-26 15:53:21', '2026-04-26 15:53:21'),
(7, 'Milton', 'Vans', 'Sportowe', 'Męskie', 41.0, 239.99, 'Czarny', 'Dodaj do swojej kolekcji niezawodne męskie tenisówki od kultowej marki Vans! Wykonane ze skóry, łączą trwałość z ponadczasowym stylem, dzięki któremu doskonale sprawdzą się zarówno na co dzień, jak i w bardziej casualowych stylizacjach. To idealne połączenie wygody i modnego designu, które odpowiada wymaganiom nowoczesnych mężczyzn. Postaw na Vans i ciesz się komfortem każdego kroku!', 'zdj/Milton_01.jpg', '2026-04-26 15:55:33', '2026-04-26 15:55:33'),
(8, 'Nebzed Basic', 'Adidas', 'Sportowe', 'Męskie', 40.0, 239.99, 'Biały', 'Buty do biegania adidas to idealny wybór dla mężczyzn, którzy czerpią radość z aktywności fizycznej. Wykonane z wytrzymałego i lekkiego materiału tekstylnego, zapewniają optymalny komfort i wsparcie przy każdym kroku. Ich sportowy charakter sprawia, że świetnie sprawdzą się zarówno podczas intensywnych treningów, jak i rekreacyjnych biegów. Precyzyjne dopasowanie oraz oddychalność materiału przyczyniają się do maksymalnej wygody, dzięki czemu możesz w pełni skupić się na swoich celach. Postaw na jakość, która dotrzyma Ci kroku na każdej trasie!', 'zdj/NebzedBasic_01.jpg', '2026-04-26 15:57:17', '2026-04-26 15:57:17'),
(9, 'Półbuty skórzane', 'Gino Rossi', 'Eleganckie', 'Męskie', 42.0, 299.99, 'Czarny', 'Szukasz elegancji w klasycznym wydaniu? Męskie półbuty marki Gino Rossi to kwintesencja stylu i ponadczasowego szyku. Wykonane z wysokiej jakości skóry naturalnej, prezentują się wyjątkowo elegancko, a jednocześnie zapewniają trwałość i komfort noszenia. Ich okrągły nosek nadaje subtelną, uniwersalną formę, która doskonale wpisze się w wizytowe stylizacje. Te półbuty to idealny wybór na specjalne okazje, ale także na co dzień, kiedy chcesz dodać swojemu wyglądowi klasy. Postaw na niezawodną jakość i ponadczasowy design – Twoje stopy zasługują na to, co najlepsze!', 'zdj/Polbuty_01.jpg', '2026-04-26 16:00:05', '2026-04-26 16:00:05'),
(10, 'Rickie Classic V PS', 'Puma', 'Sportowe', 'Dziewczęce', 33.0, 139.99, 'Różowy', 'Szukasz idealnych butów sportowych dla Twojego dziecka? Postaw na różowe buty sportowe marki Puma! Wykonane z wysokogatunkowego tworzywa syntetycznego, te buty zapewniają trwałość i wygodę podczas każdej aktywności. Dzięki zapięciu na rzep, zakładanie i zdejmowanie jest szybkie i łatwe, co sprawia, że są idealne dla małych, aktywnych użytkowników. Okrągły nosek zapewnia dodatkowy komfort i ochronę dla małych stóp. Te stylowe i funkcjonalne buty sportowe to doskonały wybór na codzienne przygody i sportowe wyzwania. Wybierz jakość i styl z marką Puma!', 'zdj/Rickie_01.jpg', '2026-04-26 16:09:22', '2026-04-26 16:09:22'),
(11, 'Run 70s 2.0', 'Adidas', 'Sportowe', 'Damskie', 39.0, 299.99, 'Beżowy', 'Wzbogać swoją garderobę o stylowe damskie sneakersy adidas, które łączą w sobie modny design i funkcjonalność. Wykonane z zamszu i materiału tekstylnego, zapewniają trwałość i przewiewność, dzięki czemu Twoje stopy pozostaną świeże przez cały dzień. Te sneakersy to idealny wybór dla kobiet, które cenią sobie połączenie sportowego stylu z oryginalną estetyką. Doskonale sprawdzą się zarówno w casualowych, jak i bardziej wyrafinowanych stylizacjach. Wybierz obuwie, które podkreśli Twój unikalny gust i zapewni wygodę każdego kroku!', 'zdj/Run70s2.0_01.jpg', '2026-04-26 16:14:03', '2026-04-26 16:14:03'),
(12, 'VL Move EL C', 'Adidas', 'Sportowe', 'Chłopięce', 35.0, 129.99, 'Czarny', 'Te chłopięce sneakersy adidas to połączenie wygody, stylu i nowoczesnych technologii. Wykonane z trwałego materiału włókienniczego i wysokogatunkowego tworzywa syntetycznego, gwarantują lekkość i oddychalność przez cały dzień. Okrągły nosek zapewnia komfort noszenia, a praktyczne zapięcie na rzep w połączeniu z elastycznymi sznurówkami ułatwia szybkie zakładanie i zdejmowanie. Dzięki technologii Cloudfoam, buty oferują lekką amortyzację, doskonałą miękkość i komfort przy każdym kroku – idealne na aktywne dni w szkole czy podczas spacerów.', 'zdj/VLMOVE_01.jpg', '2026-04-26 16:17:07', '2026-04-26 16:17:07'),
(13, 'VS Switch 3', 'Adidas', 'Sportowe', 'Chłopięce', 27.0, 129.99, 'Niebieski', 'Szukasz stylowych i wygodnych butów dla swojego dziecka? Postaw na sportowe sneakersy marki adidas! Wykonane z wysokogatunkowego tworzywa syntetycznego, gwarantują trwałość i komfort noszenia każdego dnia. Okrągły nosek zapewnia wygodę, a zapięcie na rzep ułatwia szybkie zakładanie i zdejmowanie butów, co docenią zarówno dzieci, jak i ich rodzice. Sportowy styl tych sneakersów sprawia, że świetnie sprawdzą się zarówno podczas aktywności fizycznej, jak i w codziennych stylizacjach. Idealny wybór na każdy dzień pełen zabawy i ruchu!', 'zdj/VsSwitch_01.jpg', '2026-04-26 16:19:13', '2026-04-26 16:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_id_klienta_foreign` (`id_klienta`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shoes`
--
ALTER TABLE `shoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoes`
--
ALTER TABLE `shoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_id_klienta_foreign` FOREIGN KEY (`id_klienta`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
