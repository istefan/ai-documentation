-- AI Documentation Generator - Database Setup
-- Version: 1.0
-- https://www.example.com
--
-- This script creates the database and the necessary tables for the application.

-- The SET commands are standard practice for SQL dumps to ensure compatibility.
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ai_documentation`
--
-- This command creates the database if it doesn't already exist.
-- It uses utf8mb4_unicode_ci for full character support, including emojis.
--
CREATE DATABASE IF NOT EXISTS `ai_documentation` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `ai_documentation`;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--
-- This table stores all the information about the documented projects.
--

CREATE TABLE `projects` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `folder_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for table `projects`
--
-- This sets the `id` column as the Primary Key, which is crucial for
-- identifying records uniquely and for performance.
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `projects`
--
-- This ensures that the `id` for each new project is automatically
-- generated and incremented.
--
ALTER TABLE `projects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;