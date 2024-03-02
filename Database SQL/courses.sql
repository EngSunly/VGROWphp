-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2024 at 02:04 AM
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
-- Database: `testdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `image_path` text NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `rating`, `image_path`, `price`) VALUES
(15, 'Mastering Android Development', 'Dive into the world of Android app development with this comprehensive course, covering fundamentals, UI/UX, Kotlin, and more.', 4.8, 'sources/Courses/android.jpg', 99.99),
(16, 'CSS Fundamentals and Beyond', 'Learn the essential CSS skills to style your web pages like a pro, from basic syntax to advanced layouts and animations.', 4.7, 'sources/Courses/CSS.jpg', 49.99),
(17, 'CSS with Sass and Preprocessors', 'Take your CSS to the next level with Sass, a popular preprocessor that streamlines coding and enhances maintainability.', 4.6, 'sources/Courses/CSS.png', 29.99),
(18, 'Flutter for Cross-Platform App Development', 'Build beautiful and high-performance apps for iOS and Android with Flutter, a modern framework from Google.', 4.9, 'sources/Courses/Flutter.jpg', 79.99),
(19, 'HTML5: The Building Blocks of the Web', 'Master the foundational language of the web, HTML5, and create engaging and interactive web pages.', 4.5, 'sources/Courses/HTML.png', 24.99),
(20, 'Java Programming: From Beginner to Pro', 'Learn Java, a powerful and versatile language used for web, desktop, mobile, and more. Covers core concepts, advanced topics, and practical projects.', 4.9, 'sources/Courses/Java.jpeg', 129.99),
(21, 'JavaScript: The Language of the Web', 'Unlock the power of JavaScript to create dynamic and interactive web experiences. Explore core concepts, libraries, frameworks, and more.', 4.8, 'sources/Courses/JavaScript.jpg', 99.99),
(22, 'JavaScript Development with React', 'Learn React, a popular JavaScript library for building efficient and reusable user interfaces.', 4.7, 'sources/Courses/Javascript.png', 69.99),
(23, 'Kotlin for Android Development', 'Kotlin is becoming the preferred language for Android development. Learn syntax, object-oriented concepts, and practical skills.', 4.8, 'sources/Courses/kotlin.jpg', 59.99),
(24, 'PHP Web Development: Back-End Fundamentals', 'Build dynamic websites and web applications with PHP, a popular server-side scripting language.', 4.6, 'sources/Courses/PHP.jpg', 39.99),
(25, 'Python Programming: Beginner to Data Science', 'Master Python, a versatile language used for web development, data science, machine learning, and more.', 4.9, 'sources/Courses/Python.jpg', 149.99),
(26, 'React for Web Development: Build Modern UIs', 'Learn React, a popular JavaScript library for building efficient and reusable user interfaces.', 4.7, 'sources/Courses/React.jpg', 69.99),
(27, 'React Native for Mobile Development', 'Build native mobile apps for iOS and Android with React Native, a framework using JavaScript and React.', 4.8, 'sources/Courses/react_native.png', 89.99),
(28, 'Swift Programming: Build iOS Apps', 'Learn Swift, the official language for developing iOS apps on Apple devices, and bring your app ideas to life.', 4.9, 'sources/Courses/swift.jpg', 99.99),
(35, 'kle2', 'kle2', 3.0, 'sources/Courses/klee.jpg', 99.99),
(36, '14242', '412412', 3.0, 'sources/Courses/1650608002225.jpg', 55.50),
(37, '444', '444', 5.0, 'sources/Courses/f2p.png', 5.55);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
