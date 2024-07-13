-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 09:01 PM
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
-- Database: `db_muskan_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `itineraries`
--

CREATE TABLE `itineraries` (
  `id` int(11) NOT NULL,
  `itinerary_name` varchar(255) NOT NULL,
  `itinerary_discription` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itineraries`
--

INSERT INTO `itineraries` (`id`, `itinerary_name`, `itinerary_discription`, `created_at`, `updated_at`) VALUES
(1, 'MEALS', 'Lunch Dinner', '2024-07-02 00:31:08', '2024-07-02 00:31:08'),
(5, 'CAB', 'Cab', '2024-07-10 23:50:51', '2024-07-10 23:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `media_data`
--

CREATE TABLE `media_data` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `content_name` varchar(255) NOT NULL,
  `object_id` int(11) NOT NULL,
  `object_type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media_data`
--

INSERT INTO `media_data` (`id`, `content`, `content_name`, `object_id`, `object_type`, `created_at`, `updated_at`) VALUES
(5, '773d66f85e9aba5b9901c01b19372078.jpg', 'Rain Sepcial', 5, 'package', '2024-07-11 17:45:08', '2024-07-11 17:45:08'),
(8, '47426e8ba2ed809eb2839abfe83f227f.jpg', 'Rain Sepcial', 3, 'day', '2024-07-13 18:04:36', '2024-07-13 18:04:36'),
(9, '902df034a10aee530242531154cf928c.jpg', 'Rain Sepcial', 7, 'day', '2024-07-13 18:12:15', '2024-07-13 18:12:15'),
(10, '4775ec6b518b8a09e2e6cf0c68f76948.jpg', 'Monsoon', 6, 'package', '2024-07-13 18:18:27', '2024-07-13 18:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `package_details` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_name`, `package_details`, `is_active`, `published`, `created_at`, `updated_at`) VALUES
(5, 'Rain Sepcial', 'Testing', 1, 0, '2024-07-11 17:45:08', '2024-07-11 17:45:08'),
(6, 'Monsoon', 'TESTING PACKAGE FULL', 1, 0, '2024-07-13 18:18:27', '2024-07-13 18:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `package_days_visiting_details`
--

CREATE TABLE `package_days_visiting_details` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `day_name` varchar(255) NOT NULL,
  `day_description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_days_visiting_details`
--

INSERT INTO `package_days_visiting_details` (`id`, `package_id`, `day_name`, `day_description`, `created_at`, `updated_at`) VALUES
(3, 5, 'day 1', 'Testing', '2024-07-13 16:52:02', '2024-07-13 16:52:02'),
(4, 5, 'day 5', 'vdf', '2024-07-13 16:52:02', '2024-07-13 16:52:02'),
(7, 5, 'day 4', 'TESTING 4', '2024-07-13 23:42:15', '2024-07-13 23:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `package_details`
--

CREATE TABLE `package_details` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_location_id` int(11) NOT NULL,
  `receiving_location` varchar(255) NOT NULL,
  `departure_location` varchar(255) NOT NULL,
  `receiving_timing` time NOT NULL,
  `departure_time` time NOT NULL,
  `package_days` int(11) NOT NULL,
  `package_nights` int(11) NOT NULL,
  `package_price` int(11) NOT NULL,
  `package_person_count` int(11) NOT NULL,
  `package_age_bar` int(11) NOT NULL,
  `package_required_docs` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_details`
--

INSERT INTO `package_details` (`id`, `package_id`, `package_location_id`, `receiving_location`, `departure_location`, `receiving_timing`, `departure_time`, `package_days`, `package_nights`, `package_price`, `package_person_count`, `package_age_bar`, `package_required_docs`, `created_at`, `updated_at`) VALUES
(4, 5, 8, 'Delhi', 'Delhi', '23:14:00', '23:14:00', 5, 4, 0, 2, 18, 'Adhar Card, PEN', '2024-07-11 23:15:08', '2024-07-11 23:15:08'),
(5, 6, 8, 'Delhi', 'Delhi', '06:00:00', '19:00:00', 5, 4, 0, 2, 18, 'Adhar Card, PEN, DL', '2024-07-13 23:48:27', '2024-07-13 23:48:27');

-- --------------------------------------------------------

--
-- Table structure for table `package_itinerary_mapping`
--

CREATE TABLE `package_itinerary_mapping` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `itinerary_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_itinerary_mapping`
--

INSERT INTO `package_itinerary_mapping` (`id`, `package_id`, `itinerary_id`, `created_at`, `updated_at`) VALUES
(7, 5, 5, '2024-07-11 23:15:08', '2024-07-11 23:15:08'),
(8, 5, 1, '2024-07-11 23:15:08', '2024-07-11 23:15:08'),
(9, 6, 1, '2024-07-13 23:48:27', '2024-07-13 23:48:27'),
(10, 6, 5, '2024-07-13 23:48:27', '2024-07-13 23:48:27');

-- --------------------------------------------------------

--
-- Table structure for table `package_locations`
--

CREATE TABLE `package_locations` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_locations`
--

INSERT INTO `package_locations` (`id`, `location`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Rajasthan', 1, '2024-06-30 23:33:09', '2024-06-30 23:33:09'),
(2, 'Golden Triangle', 1, '2024-06-30 23:33:24', '2024-06-30 23:33:24'),
(3, 'Jammu-Kashmir', 1, '2024-06-30 23:33:42', '2024-06-30 23:33:42'),
(4, 'Darjelling-Sikkim', 1, '2024-06-30 23:33:57', '2024-06-30 23:33:57'),
(5, 'Leh-Ladkh', 1, '2024-06-30 23:34:15', '2024-06-30 23:34:15'),
(6, 'Himachal Pardesh', 1, '2024-06-30 23:34:29', '2024-06-30 23:34:29'),
(7, 'Goa', 1, '2024-06-30 23:34:40', '2024-06-30 23:34:40'),
(8, 'Kerala', 1, '2024-06-30 23:34:51', '2024-06-30 23:34:51'),
(9, 'Maharshtra', 1, '2024-06-30 23:35:07', '2024-06-30 23:35:07'),
(10, 'Uttarakhand', 1, '2024-06-30 23:35:12', '2024-06-30 23:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `package_services`
--

CREATE TABLE `package_services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `service_description` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_subscribers`
--

CREATE TABLE `package_subscribers` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subscription_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, '2024-06-25 22:01:55', '2024-06-25 22:01:55'),
(2, 'user', 1, '2024-06-25 22:02:04', '2024-06-25 22:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(90) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin', 'admin', '$2y$10$VB2XK8VwYLPqjCVIHfIyCeca6d0DBVng401RqMm.7FbolvQJaumES', '2024-06-22 08:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_mapping`
--

CREATE TABLE `user_role_mapping` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role_mapping`
--

INSERT INTO `user_role_mapping` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-06-25 22:02:19', '2024-06-25 22:02:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itineraries`
--
ALTER TABLE `itineraries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_data`
--
ALTER TABLE `media_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_days_visiting_details`
--
ALTER TABLE `package_days_visiting_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_details`
--
ALTER TABLE `package_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_itinerary_mapping`
--
ALTER TABLE `package_itinerary_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_locations`
--
ALTER TABLE `package_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_services`
--
ALTER TABLE `package_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_subscribers`
--
ALTER TABLE `package_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role_mapping`
--
ALTER TABLE `user_role_mapping`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itineraries`
--
ALTER TABLE `itineraries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `media_data`
--
ALTER TABLE `media_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `package_days_visiting_details`
--
ALTER TABLE `package_days_visiting_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `package_details`
--
ALTER TABLE `package_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `package_itinerary_mapping`
--
ALTER TABLE `package_itinerary_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `package_locations`
--
ALTER TABLE `package_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `package_services`
--
ALTER TABLE `package_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_subscribers`
--
ALTER TABLE `package_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_role_mapping`
--
ALTER TABLE `user_role_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
