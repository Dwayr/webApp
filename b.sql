-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2017 at 08:29 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dwayr`
--

-- --------------------------------------------------------

--
-- Table structure for table `companie_list`
--

CREATE TABLE `companie_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(11) NOT NULL,
  `name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info@example.com',
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `headquarters` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `establishment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companie_list`
--

INSERT INTO `companie_list` (`id`, `owner_id`, `name`, `url`, `logo`, `site`, `email`, `specialization`, `headquarters`, `establishment`, `about`, `created_at`, `updated_at`) VALUES
(1, 6, 'Digital Tags', 'digitaltags', 'd243924a1a5d17cae0f301a126166c20.png', 'http://digitaltags.net/', 'info@example.com', 'advertising & marketing Agency', 'loran', '2015', 'We are a creative advertising & marketing agency, with years of experience, providing integrated communication solutions, designing high quality professional graphics & advertising materials to our clients.', '2017-11-01 18:02:42', '2017-11-01 18:02:42'),
(2, 7, 'ConnJabu', 'connjabu', '6b8b64d8d45f4db9a77c780e131dc420.png', 'https://www.facebook.com/ConnJabu', 'info@example.com', 'Digital Marketing Agency', 'Feleming, Alexandria', '2017', 'Mission: Aim to connect the business world and customer\'s world by \nDifferent means, also we aim to connect between the manager\'s world \nand the employee\'s world.\n\nVision: Become a worldwide company that connect the world together. \n\nFounded in 2017 which aim to facilitate the business through our customers and their customers.', '2017-11-01 21:15:10', '2017-11-01 21:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `companie_reat`
--

CREATE TABLE `companie_reat` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `companie_id` int(11) NOT NULL,
  `reat_value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companie_rss`
--

CREATE TABLE `companie_rss` (
  `id` int(10) UNSIGNED NOT NULL,
  `companie_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companie_team`
--

CREATE TABLE `companie_team` (
  `id` int(10) UNSIGNED NOT NULL,
  `companie_id` int(11) NOT NULL,
  `user_public_code` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_position` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_start_history` date NOT NULL,
  `work_end_history` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dwayr_options`
--

CREATE TABLE `dwayr_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `options_collection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dwayr_options`
--

INSERT INTO `dwayr_options` (`id`, `options_collection`, `options_name`) VALUES
(1, 'cities', 'الاسكندرية'),
(2, 'type_job', 'دوام كامل'),
(3, 'type_job', 'دوام جزئى'),
(4, 'type_job', 'outsource'),
(5, 'type_job', 'مستقل');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `co_id` int(10) UNSIGNED NOT NULL,
  `years_experience` int(11) NOT NULL,
  `average_salary` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `type_work` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `skills` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_apply`
--

CREATE TABLE `job_apply` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_08_04_145638_users', 1),
(2, '2017_08_13_151351_companie_list', 1),
(3, '2017_08_13_153130_companie_project', 1),
(4, '2017_08_13_154208_companie_team', 1),
(5, '2017_08_13_154225_companie_rss', 1),
(6, '2017_09_14_001551_companie_reat', 1),
(7, '2017_09_15_222818_sessions', 1),
(8, '2017_09_22_150700_profiles', 1),
(9, '2017_10_01_224030_jobs', 1),
(10, '2017_10_10_175103_projects', 1),
(11, '2017_10_16_073712_user_setting_job', 1),
(12, '2017_10_17_212852_notifications', 1),
(13, '2017_10_22_143504_user_setting_communication', 1),
(14, '2017_11_01_160838_dwayr_options', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `notification_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `type`, `url`, `created_at`, `updated_at`) VALUES
(1, 2, 'komicho1996', '2017-10-23 21:29:54', '2017-10-23 21:29:54'),
(2, 2, 'hammadmousa', '2017-10-23 23:06:12', '2017-10-23 23:06:12'),
(3, 2, '3bdoelnaggar', '2017-10-24 09:36:12', '2017-10-24 09:36:12'),
(4, 2, 'mo.said', '2017-10-25 15:43:45', '2017-10-25 15:43:45'),
(5, 2, 'Omar_sayed', '2017-10-25 20:51:34', '2017-10-25 20:51:34'),
(6, 2, 'Mohamed', '2017-11-01 11:01:32', '2017-11-01 11:01:32'),
(7, 1, 'digitaltags', '2017-11-01 18:02:42', '2017-11-01 18:02:42'),
(8, 2, 'SafyEldin', '2017-11-01 20:44:37', '2017-11-01 20:44:37'),
(9, 1, 'connjabu', '2017-11-01 21:15:10', '2017-11-01 21:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects_companie`
--

CREATE TABLE `projects_companie` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `companie_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects_team`
--

CREATE TABLE `projects_team` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(10) UNSIGNED NOT NULL,
  `user_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `user_token`, `session_key`, `session_value`, `created_at`, `updated_at`) VALUES
(2, '23d58df656031f1342cf6ab491f6ef4a', 'user_id', '5', '2017-10-25 20:51:34', '2017-10-25 20:51:34'),
(3, 'fd85093e8f584800127565875f5c36bb', 'user_id', '6', '2017-11-01 11:01:32', '2017-11-01 11:01:32'),
(5, '9ee007e34da1e9ba86eb2fdf39dd7960', 'user_id', '6', '2017-11-01 17:56:29', '2017-11-01 17:56:29'),
(7, '9e6c2a5268a32892ad7e451890c5ff3a', 'user_id', '7', '2017-11-01 20:44:37', '2017-11-01 20:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `public_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_verify` int(11) NOT NULL DEFAULT '0',
  `is_activated` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `public_code`, `first_name`, `last_name`, `username`, `email`, `avatar`, `password`, `country_code`, `about`, `user_verify`, `is_activated`, `created_at`, `updated_at`) VALUES
(1, '26KDuUXDecS', 'كريم', 'محمد', 'komicho1996', 'komicho1996@gmail.com', '', 'KomichO', 'EG', 'about', 0, 0, '2017-10-23 21:29:54', '2017-10-23 21:29:54'),
(2, 'sOpyeMUygFn', 'Hammad', 'Mousa', 'hammadmousa', 'hammad.yho97@gmail.com', '', 'T.i.w.s.A', 'JO', 'about', 0, 0, '2017-10-23 23:06:12', '2017-10-23 23:06:12'),
(3, 'b9gTkO76QKN', 'Abdalla', 'Elnaggar', '3bdoelnaggar', '3bdoelnaggar@gmail.com', '', 'binbongfree', 'EG', 'Android developer with mid-level experience', 0, 0, '2017-10-24 09:36:12', '2017-10-24 09:38:31'),
(4, '1vkrNb5JpQT', 'Mohamed', 'said', 'mo.said', 'mo@rubikal.com', '', '123456', 'EG', 'about', 0, 0, '2017-10-25 15:43:45', '2017-10-25 15:43:45'),
(5, 'qwYpOZxn5Kg', 'Omar', 'Sayed', 'Omar_sayed', 'omr.sayed@gmail.com', '', 'Admin2014', 'EG', 'about', 0, 0, '2017-10-25 20:51:34', '2017-10-25 20:51:34'),
(6, 'pPRah64hToI', 'Mohamed', 'moanes', 'Mohamed', 'mo7amedmo2nes@gmail.com', '', 'Mohamed', 'EG', 'about', 0, 0, '2017-11-01 11:01:32', '2017-11-01 11:01:32'),
(7, 'KQFTG5Fod2g', 'Safy Eldin', 'Ahmed', 'SafyEldin', 'safyeldin.ahmed@gmail.com', '', 'safy2017', 'EG', 'about', 0, 0, '2017-11-01 20:44:37', '2017-11-01 20:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `user_setting_communication`
--

CREATE TABLE `user_setting_communication` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `github_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_setting_communication`
--

INSERT INTO `user_setting_communication` (`id`, `user_id`, `email`, `phone_number`, `github_link`, `facebook_link`, `created_at`, `updated_at`) VALUES
(1, 1, 'komicho1996@gmail.com', '01142843165', 'https://github.com/komicho', 'https://www.facebook.com/komicho1996', '2017-10-24 18:26:48', '2017-10-24 18:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_setting_job`
--

CREATE TABLE `user_setting_job` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_work` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skills` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_setting_job`
--

INSERT INTO `user_setting_job` (`id`, `user_id`, `city`, `type_work`, `skills`, `created_at`, `updated_at`) VALUES
(1, 3, 'Alexandria', '3', '[\"Android\",\"Java\"]', '2017-10-24 09:39:16', '2017-10-24 09:39:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companie_list`
--
ALTER TABLE `companie_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companie_reat`
--
ALTER TABLE `companie_reat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companie_rss`
--
ALTER TABLE `companie_rss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companie_team`
--
ALTER TABLE `companie_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dwayr_options`
--
ALTER TABLE `dwayr_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_co_id_foreign` (`co_id`);

--
-- Indexes for table `job_apply`
--
ALTER TABLE `job_apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects_companie`
--
ALTER TABLE `projects_companie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_companie_project_id_foreign` (`project_id`),
  ADD KEY `projects_companie_companie_id_foreign` (`companie_id`);

--
-- Indexes for table `projects_team`
--
ALTER TABLE `projects_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_team_project_id_foreign` (`project_id`),
  ADD KEY `projects_team_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_setting_communication`
--
ALTER TABLE `user_setting_communication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_setting_job`
--
ALTER TABLE `user_setting_job`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companie_list`
--
ALTER TABLE `companie_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `companie_reat`
--
ALTER TABLE `companie_reat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `companie_rss`
--
ALTER TABLE `companie_rss`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `companie_team`
--
ALTER TABLE `companie_team`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dwayr_options`
--
ALTER TABLE `dwayr_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_apply`
--
ALTER TABLE `job_apply`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects_companie`
--
ALTER TABLE `projects_companie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects_team`
--
ALTER TABLE `projects_team`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_setting_communication`
--
ALTER TABLE `user_setting_communication`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_setting_job`
--
ALTER TABLE `user_setting_job`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_co_id_foreign` FOREIGN KEY (`co_id`) REFERENCES `companie_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects_companie`
--
ALTER TABLE `projects_companie`
  ADD CONSTRAINT `projects_companie_companie_id_foreign` FOREIGN KEY (`companie_id`) REFERENCES `companie_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_companie_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects_team`
--
ALTER TABLE `projects_team`
  ADD CONSTRAINT `projects_team_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_team_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
