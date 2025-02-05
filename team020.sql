-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2024 at 09:56 PM
-- Server version: 5.5.68-MariaDB
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team020`
--

-- --------------------------------------------------------

--
-- Table structure for table `Forum Responses`
--

CREATE TABLE `Forum Responses` (
  `Response ID` int(255) NOT NULL,
  `Question ID` int(255) NOT NULL,
  `Response Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Response Author` int(255) NOT NULL,
  `Response Data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Knowledge Area`
--

CREATE TABLE `Knowledge Area` (
  `knowledge_id` int(255) NOT NULL,
  `knowledge_section` enum('Technical','Non-Technical','','') NOT NULL,
  `Heading` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Knowledge Area`
--

INSERT INTO `Knowledge Area` (`knowledge_id`, `knowledge_section`, `Heading`) VALUES
(1, 'Technical', 'Software Configuration'),
(2, 'Technical', 'Hardware Configurations'),
(3, 'Technical', 'Technical Issue Resolution'),
(4, 'Technical', 'Developmental Practices'),
(5, 'Technical', 'Cloud/ Network Infrastucture'),
(6, 'Non-Technical', 'Admin Tasks'),
(7, 'Non-Technical', 'HR and Employee Management'),
(8, 'Non-Technical', 'Internal Communication and Collaboration'),
(9, 'Non-Technical', 'Finance and Procurement'),
(10, 'Non-Technical', 'Legal and Compliance');

-- --------------------------------------------------------

--
-- Table structure for table `Knowledge Entries`
--

CREATE TABLE `Knowledge Entries` (
  `Post ID` int(255) NOT NULL,
  `Creation Date` datetime(6) NOT NULL,
  `Author` int(255) NOT NULL,
  `Post Title` text NOT NULL,
  `Post Preview` text NOT NULL,
  `Post Data` longtext NOT NULL,
  `Tags` set('General IT','Windows Updates','Health and Safety','Technical Setup') NOT NULL,
  `knowledge section` enum('Technical','Non Technical','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Login Table`
--

CREATE TABLE `Login Table` (
  `Email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `User ID` int(255) NOT NULL,
  `hashed password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Notifications`
--

CREATE TABLE `Notifications` (
  `User ID` int(255) NOT NULL,
  `Notification ID` int(255) NOT NULL,
  `Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Notification Colour` varchar(50) NOT NULL,
  `Notification Text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Personal Todos`
--

CREATE TABLE `Personal Todos` (
  `Item ID` int(255) NOT NULL,
  `User ID` int(255) NOT NULL,
  `Creation Date` datetime(6) NOT NULL,
  `Due Date` datetime(6) NOT NULL,
  `Description` text NOT NULL,
  `Status` enum('Active','Completed','','') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `creation_date` date NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_manager` int(11) DEFAULT NULL,
  `project_leader` int(11) DEFAULT NULL,
  `project_creator` int(11) DEFAULT NULL,
  `project_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tags` (
  `tagId` INT(255) NOT NULL AUTO_INCREMENT,
  `tagName` VARCHAR(255) NOT NULL,
  `tagType` ENUM('Technical', 'Non-Technical') NOT NULL,
  PRIMARY KEY (`tagId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `creation_date`, `project_name`, `project_manager`, `project_leader`, `project_creator`, `project_status`) VALUES
(1, '2024-01-10', 'How to build a dragon?', 4, 5, 4, 'active'),
(2, '2024-02-15', 'Project Runway', 8, 9, 8, 'active'),
(3, '2024-03-20', 'Games design', 11, 14, 11, 'active'),
(4, '2024-04-05', 'Web Application', 17, 19, 17, 'active'),
(5, '2024-05-15', 'Crypto Chain', 23, 24, 23, 'inactive'),
(6, '2024-06-01', 'Price Comparison Tool', 27, 29, 27, 'active'),
(7, '2024-07-10', 'Data Analytics Dashboard', 30, 3, 30, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `Questions`
--

CREATE TABLE `Questions` (
  `Question ID` int(255) NOT NULL,
  `Creation Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Author` int(255) NOT NULL,
  `Question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Tasks`
--

CREATE TABLE `Tasks` (
  `Task ID` int(255) NOT NULL,
  `Assigned To` int(255) NOT NULL,
  `Assigned By` int(255) NOT NULL,
  `Project ID` int(255) NOT NULL,
  `Creation Date` datetime(6) NOT NULL,
  `Due Date` datetime(6) NOT NULL,
  `Task Description` varchar(255) NOT NULL,
  `Status` enum('Active','Completed','','') NOT NULL DEFAULT 'Active',
  `Date Completed` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `User Preferences`
--

CREATE TABLE `User Preferences` (
  `User ID` int(255) NOT NULL,
  `Background colour` varchar(50) NOT NULL DEFAULT 'White',
  `Font` varchar(50) NOT NULL DEFAULT 'Arial',
  `Font Size` int(50) NOT NULL DEFAULT '12'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`user_id`, `email`, `first_name`, `last_name`, `contact_number`, `status`) VALUES
(1, 'j.doe@make-it-all.com', 'John', 'Doe', '07456 789012', 'Active'),
(2, 'a.smith@make-it-all.com', 'Alice', 'Smith', '+44 7911 234567', 'Active'),
(3, 'm.jones@make-it-all.com', 'Michael', 'Jones', '07734 567890', 'Active'),
(4, 'l.brown@make-it-all.com', 'Laura', 'Brown', '+44 7925 678901', 'Active'),
(5, 'k.wilson@make-it-all.com', 'Kevin', 'Wilson', '07567 890123', 'Active'),
(6, 's.miller@make-it-all.com', 'Susan', 'Miller', '+44 7931 234567', 'Active'),
(7, 't.davis@make-it-all.com', 'Tom', 'Davis', '07789 012345', 'Active'),
(8, 'c.martin@make-it-all.com', 'Charlie', 'Martin', '+44 7912 345678', 'Active'),
(9, 'r.jackson@make-it-all.com', 'Rachel', 'Jackson', '07890 123456', 'Active'),
(10, 'e.white@make-it-all.com', 'Ethan', 'White', '+44 7701 234567', 'Active'),
(11, 'p.lee@make-it-all.com', 'Peter', 'Lee', '07512 345678', 'Active'),
(12, 'h.evans@make-it-all.com', 'Hannah', 'Evans', '+44 7913 456789', 'Active'),
(13, 'g.wright@make-it-all.com', 'George', 'Wright', '07756 789012', 'Active'),
(14, 'n.harris@make-it-all.com', 'Nicole', 'Harris', '+44 7922 345678', 'Active'),
(15, 'a.clark@make-it-all.com', 'Adam', 'Clark', '07893 234567', 'Active'),
(16, 'l.lewis@make-it-all.com', 'Lily', 'Lewis', '+44 7918 765432', 'Active'),
(17, 'o.martin@make-it-all.com', 'Olivia', 'Martin', '07423 654789', 'Active'),
(18, 'j.green@make-it-all.com', 'Jack', 'Green', '+44 7709 876543', 'Active'),
(19, 'm.thomas@make-it-all.com', 'Megan', 'Thomas', '07524 567890', 'Inactive'),
(20, 'f.roberts@make-it-all.com', 'Finn', 'Roberts', '+44 7934 567890', 'Active'),
(21, 'b.morris@make-it-all.com', 'Bella', 'Morris', '07865 432109', 'Active'),
(22, 'r.garcia@make-it-all.com', 'Ryan', 'Garcia', '+44 7923 876543', 'Active'),
(23, 'j.martinez@make-it-all.com', 'Julia', 'Martinez', '07789 123456', 'Active'),
(24, 'l.hughes@make-it-all.com', 'Liam', 'Hughes', '+44 7910 234567', 'Active'),
(25, 's.owens@make-it-all.com', 'Samuel', 'Owens', '07459 876543', 'Active'),
(26, 'k.rogers@make-it-all.com', 'Karen', 'Rogers', '+44 7908 765432', 'Inactive'),
(27, 'p.hall@make-it-all.com', 'Paul', 'Hall', '07513 678901', 'Active'),
(28, 'd.james@make-it-all.com', 'Daisy', 'James', '+44 7916 234567', 'Active'),
(29, 'c.perez@make-it-all.com', 'Chris', 'Perez', '07876 123456', 'Active'),
(30, 't.walker@make-it-all.com', 'Theo', 'Walker', '+44 7914 567890', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `user_knowledge`
--

CREATE TABLE `user_knowledge` (
  `user_id` int(255) NOT NULL,
  `knowledge_id` int(255) NOT NULL,
  `heading` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_knowledge`
--

INSERT INTO `user_knowledge` (`user_id`, `knowledge_id`, `heading`) VALUES
(3, 1, 'Software Configuration'),
(5, 3, 'Technical Issue Resolution'),
(7, 5, 'Cloud/ Network Infrastucture'),
(11, 7, 'HR and Employee Management'),
(14, 9, 'Finance and Procurement'),
(19, 10, 'Legal and Compliance');

-- --------------------------------------------------------

--
-- Table structure for table `user_projects`
--

CREATE TABLE `user_projects` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `project_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_projects`
--

INSERT INTO `user_projects` (`user_id`, `project_id`) VALUES
(1, 1),
(1, 6),
(2, 1),
(2, 6),
(3, 7),
(4, 1),
(4, 6),
(5, 1),
(5, 6),
(6, 1),
(6, 7),
(7, 1),
(7, 7),
(8, 2),
(8, 7),
(9, 2),
(9, 7),
(10, 2),
(11, 2),
(11, 3),
(12, 2),
(13, 2),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(17, 4),
(18, 3),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(23, 5),
(24, 5),
(25, 5),
(26, 5),
(27, 5),
(27, 6),
(28, 5),
(29, 6),
(30, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL,
  `role` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role`) VALUES
(1, 'member'),
(2, 'member'),
(3, 'member'),
(4, 'manager'),
(5, 'member'),
(6, 'member'),
(7, 'member'),
(8, 'manager'),
(9, 'member'),
(10, 'member'),
(11, 'manager'),
(12, 'member'),
(13, 'member'),
(14, 'member'),
(15, 'member'),
(16, 'member'),
(17, 'manager'),
(18, 'member'),
(19, 'member'),
(20, 'member'),
(21, 'member'),
(22, 'member'),
(23, 'manager'),
(24, 'member'),
(25, 'member'),
(26, 'member'),
(27, 'manager'),
(28, 'member'),
(29, 'member'),
(30, 'manager');

-- For admin passwords
INSERT INTO `Login Table` (`Email`, `User ID`, `hashed password`) VALUES
('admin1@make-it-all.com', 3, '$2y$10$EkC715mJIc.jqV1EiJh55.g4.1iZW86cj7Jf/p8/zLObbkVzjJ8Bq'),
('admin2@make-it-all.com', 5, '$2y$10$EkC715mJIc.jqV1EiJh55.g4.1iZW86cj7Jf/p8/zLObbkVzjJ8Bq'),
('admin3@make-it-all.com', 7, '$2y$10$EkC715mJIc.jqV1EiJh55.g4.1iZW86cj7Jf/p8/zLObbkVzjJ8Bq'),
('admin4@make-it-all.com', 11, '$2y$10$EkC715mJIc.jqV1EiJh55.g4.1iZW86cj7Jf/p8/zLObbkVzjJ8Bq'),
('admin5@make-it-all.com', 14, '$2y$10$EkC715mJIc.jqV1EiJh55.g4.1iZW86cj7Jf/p8/zLObbkVzjJ8Bq'),
('admin6@make-it-all.com', 19, '$2y$10$EkC715mJIc.jqV1EiJh55.g4.1iZW86cj7Jf/p8/zLObbkVzjJ8Bq');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `Forum Responses`
--
ALTER TABLE `Forum Responses`
  ADD PRIMARY KEY (`Response ID`),
  ADD KEY `Response Author` (`Response Author`);

--
-- Indexes for table `Knowledge Area`
--
ALTER TABLE `Knowledge Area`
  ADD PRIMARY KEY (`knowledge_id`);

--
-- Indexes for table `Knowledge Entries`
--
ALTER TABLE `Knowledge Entries`
  ADD PRIMARY KEY (`Post ID`),
  ADD KEY `Author` (`Author`);

--
-- Indexes for table `Login Table`
--
ALTER TABLE `Login Table`
  ADD PRIMARY KEY (`Email`),
  ADD KEY `User ID` (`User ID`);

--
-- Indexes for table `Notifications`
--
ALTER TABLE `Notifications`
  ADD PRIMARY KEY (`Notification ID`),
  ADD KEY `User ID` (`User ID`);

--
-- Indexes for table `Personal Todos`
--
ALTER TABLE `Personal Todos`
  ADD PRIMARY KEY (`Item ID`),
  ADD KEY `User ID` (`User ID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `Questions`
--
ALTER TABLE `Questions`
  ADD PRIMARY KEY (`Question ID`),
  ADD KEY `Author` (`Author`);

--
-- Indexes for table `Tasks`
--
ALTER TABLE `Tasks`
  ADD PRIMARY KEY (`Task ID`),
  ADD KEY `Assigned To` (`Assigned To`),
  ADD KEY `Assigned By` (`Assigned By`),
  ADD KEY `Project ID` (`Project ID`);

--
-- Indexes for table `User Preferences`
--
ALTER TABLE `User Preferences`
  ADD PRIMARY KEY (`User ID`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_knowledge`
--
ALTER TABLE `user_knowledge`
  ADD PRIMARY KEY (`user_id`,`knowledge_id`),
  ADD KEY `knowledge_id` (`knowledge_id`);

--
-- Indexes for table `user_projects`
--
ALTER TABLE `user_projects`
  ADD PRIMARY KEY (`user_id`,`project_id`),
  ADD KEY `user_projects_ibfk_2` (`project_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Forum Responses`
--
ALTER TABLE `Forum Responses`
  MODIFY `Response ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Knowledge Area`
--
ALTER TABLE `Knowledge Area`
  MODIFY `knowledge_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Notifications`
--
ALTER TABLE `Notifications`
  MODIFY `Notification ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Personal Todos`
--
ALTER TABLE `Personal Todos`
  MODIFY `Item ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Questions`
--
ALTER TABLE `Questions`
  MODIFY `Question ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tasks`
--
ALTER TABLE `Tasks`
  MODIFY `Task ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `User Preferences`
--
ALTER TABLE `User Preferences`
  MODIFY `User ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Forum Responses`
--
ALTER TABLE `Forum Responses`
  ADD CONSTRAINT `Forum Responses_ibfk_1` FOREIGN KEY (`Response Author`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Knowledge Entries`
--
ALTER TABLE `Knowledge Entries`
  ADD CONSTRAINT `Knowledge Entries_ibfk_1` FOREIGN KEY (`Author`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Login Table`
--
ALTER TABLE `Login Table`
  ADD CONSTRAINT `Login Table_ibfk_1` FOREIGN KEY (`User ID`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Notifications`
--
ALTER TABLE `Notifications`
  ADD CONSTRAINT `Notifications_ibfk_1` FOREIGN KEY (`User ID`) REFERENCES `users_info` (`user_id`);

--
-- Constraints for table `Personal Todos`
--
ALTER TABLE `Personal Todos`
  ADD CONSTRAINT `Personal Todos_ibfk_1` FOREIGN KEY (`User ID`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Questions`
--
ALTER TABLE `Questions`
  ADD CONSTRAINT `Questions_ibfk_1` FOREIGN KEY (`Author`) REFERENCES `users_info` (`user_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Tasks`
--
ALTER TABLE `Tasks`
  ADD CONSTRAINT `Tasks_ibfk_3` FOREIGN KEY (`Project ID`) REFERENCES `Projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Tasks_ibfk_1` FOREIGN KEY (`Assigned To`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Tasks_ibfk_2` FOREIGN KEY (`Assigned By`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `User Preferences`
--
ALTER TABLE `User Preferences`
  ADD CONSTRAINT `User Preferences_ibfk_1` FOREIGN KEY (`User ID`) REFERENCES `users_info` (`user_id`);

--
-- Constraints for table `user_knowledge`
--
ALTER TABLE `user_knowledge`
  ADD CONSTRAINT `user_knowledge_ibfk_1` FOREIGN KEY (`knowledge_id`) REFERENCES `Knowledge Area` (`knowledge_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_knowledge_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_projects`
--
ALTER TABLE `user_projects`
  ADD CONSTRAINT `user_projects_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

ALTER TABLE `Knowledge Entries`
MODIFY `Post ID` INT(255) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Knowledge Entries` DROP COLUMN `Tags`;

ALTER TABLE `Knowledge Entries`
ADD COLUMN `tagId` INT(255) NOT NULL,
ADD CONSTRAINT `fk_knowledge_tags`
FOREIGN KEY (`tagId`) REFERENCES `tags`(`tagId`)
ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Knowledge Entries`
MODIFY `knowledge section` ENUM('Technical', 'Non-Technical') NOT NULL;

INSERT INTO `tags` (`tagName`, `tagType`) VALUES
('General IT', 'Technical'),
('Windows Updates', 'Technical'),
('Health and Safety', 'Non-Technical'),
('Technical Setup', 'Technical');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
