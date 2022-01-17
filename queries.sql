-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2022 at 08:55 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queries`
--

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` int(11) NOT NULL,
  `code` varchar(1024) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `config` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`id`, `code`, `date`, `user_id`, `type`, `config`) VALUES
(3, '(div>dl>(dt+dd)*3)+footer>p', '2022-01-06', 21, 'emmet', ''),
(4, 'div>(header>ul>li*2>a)+footer>p', '2022-01-06', 21, 'emmet', ''),
(5, '<div>     <header>         <ul>             <li>                 <a></a>             </li>             <li>                 <a></a>             </li>         </ul>     </header>     <footer>         <p></p>     </footer> </div>', '2022-01-06', 21, 'xml', ''),
(6, '<div id=\"h\" class=\"p1 p2\">     <dl>         <dt></dt>         <dd id=\"h\" class=\"p1 p2\"></dd>         <dt></dt>         <dd id=\"h\" class=\"p1 p2\"></dd>         <dt></dt>         <dd id=\"h\" class=\"p1 p2\"></dd>     </dl> </div> lma <footer>     xd     <p></p> </footer>', '2022-01-07', 21, 'xml', ''),
(7, 'div>(header#d>ul>li*2>a)+footer>p', '2022-01-07', 21, 'emmet', ''),
(8, 'div>(header#de>ul>li*2>a)+footer>p', '2022-01-07', 21, 'emmet', ''),
(9, 'div>(header#des>ul>li*2>a)+footer>p', '2022-01-07', 21, 'emmet', ''),
(10, 'div>(header#deps>ul>li*2>a)+footer>p', '2022-01-07', 21, 'emmet', ''),
(11, 'div>(header#depas>ul>li*2>a)+footer>p', '2022-01-07', 21, 'emmet', ''),
(12, 'div>(header#depacs>ul>li*2>a)+footer>p', '2022-01-07', 21, 'emmet', ''),
(13, 'div>(header#depaces>ul>li*2>a)+footer>p', '2022-01-07', 21, 'emmet', ''),
(14, 'div>(header>ul#d>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(15, 'div>(header>ul#dd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(16, 'div>(header>ul#ddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(17, 'div>(header>ul#dddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(18, 'div>(header>ul#ddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(19, 'div>(header>ul#dddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(20, 'div>(header>ul#ddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(21, 'div>(header>ul#dddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(22, 'div>(header>ul#ddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(23, 'div>(header>ul#dddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(24, 'div>(header>ul#ddddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(25, 'div>(header>ul#dddddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(26, 'div>(header>ul#ddddddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(27, 'div>(header>ul#dddddddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(28, 'div>(header>ul#ddddddddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(29, 'div>(header>ul#dddddddddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(30, 'div>(header>ul#ddddddddddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(31, 'div>(header>ul#dddddddddddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(32, 'div>(header>ul#ddddddddddddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(33, 'div>(header>ul#dddddddddddddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(34, 'div>(header>ul#ddddddddddddddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(35, 'div>(header>ul#dddddddddddddddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(36, 'div>(header>ul#ddddddddddddddddddddddd>li*2>a)+footer#d>p', '2022-01-07', 21, 'emmet', ''),
(37, 'div>(header#dds.p1.2p>ul>li*2>a)+footer>p', '2022-01-08', 21, 'emmet', ''),
(38, 'div>(headedddr>ul>li*2>a)+footer>p', '2022-01-10', 21, 'emmet', ''),
(39, 'div>(headasdasdder>ul>li*2>a)+footer>p', '2022-01-10', 21, 'emmet', ''),
(40, '<div>     <headasdasdder>         <ul>             <li>                 <a></a>             </li>             <li>                 <a></a>             </li>         </ul>     </headasdasdder>     <footer>         <p></p>     </footer> </div>', '2022-01-10', 21, 'xml', ''),
(41, 'div>(headder>ul>li*2>a)+footer>p', '2022-01-10', 21, 'emmet', ''),
(42, 'div>(headdder>ul>li*2>a)+footer>p', '2022-01-10', 21, 'emmet', ''),
(43, 'div>(headddder>ul>li*2>a)+footer>p', '2022-01-10', 21, 'emmet', ''),
(44, 'div>(headddder>ullllll>li*2>a)+footer>p', '2022-01-10', 21, 'emmet', ''),
(45, 'div>(header>ul>li*2>a)+fodsadoter>p', '2022-01-10', 21, 'emmet', ''),
(46, 'div>(header>ul>li*2>a)+fodsdsadoter>p', '2022-01-10', 21, 'emmet', ''),
(47, 'div>(header>ul>li*2>a)+foioter>p', '2022-01-10', 21, 'emmet', ''),
(48, 'div>(d:header>ul>li*2>a)+footer>p', '2022-01-10', 21, 'emmet', ''),
(49, 'm:div>(d:l:header>x:ul>li*2>a)+footer>p', '2022-01-10', 21, 'emmet', ''),
(50, 'm:div>(d:l:header>xx:ul>li*2>a)+footer>p', '2022-01-10', 21, 'emmet', ''),
(51, '<m:div>     <d:l:header>         <x:ul>             <li>                 <a></a>             </li>             <li>                 <a></a>             </li>         </ul>     </header>     <footer>         <p></p>     </footer> </div>', '2022-01-10', 21, 'xml', ''),
(52, 'm:div>(d:l:header>xx:ul>d:li*2>a)+footer>p', '2022-01-10', 21, 'emmet', ''),
(53, 'div>(header>ul>li*2>a)+footer>p', '2022-01-10', 21, 'emmet', '{\"id\":\"true\", \"class\":false, \"content\":\"true\"}'),
(54, 'div>(header>ul>li*2>a)+footer>p>div>(header>ul>li*2>a)+footer>p>div>(header>ul>li*2>a)+footer>p>div>(header>ul>li*2>a)+footer>p', '2022-01-10', 21, 'emmet', '{\"id\":\"true\", \"class\":false, \"content\":\"true\"}'),
(55, 'div>(header>ul>li*2>a)+footer>pp', '2022-01-11', 24, 'emmet', ''),
(56, '<div>     <header>         <ul>             <li>                 <a></a>             </li>             <li>                 <a></a>             </li>         </ul>     </header>     <footer>         <pp></pp>     </footer> </div>', '2022-01-11', 24, 'xml', ''),
(57, '', '2022-01-12', 21, 'emmet', ''),
(58, '', '2022-01-13', 21, 'emmet', '{\"id\":\"true\", \"class\":\"true\", \"content\":\"true\", \"custom_attribute\":\"true\", \"namespace\":\"true\", \"history\":\"false\"}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`) VALUES
(2, 'first_user', '775ca22e183875f912e2f9161064d4027599a8b2', 'Firstt'),
(13, 'admin', '7af2d10b73ab7cd8f603937f7697cb5fe432c7ff', 'admin'),
(21, 'lmao', 'e4a584b6ea87a8456062203fe2ac2721792db795', 'lmao'),
(23, 'mitka', '2f427c9f431e76e908857f230f30ee20b8097e52', 'mitko'),
(24, 'xdxdxd', 'e29376dedb53e0d41fe3ae6cf843c336ba447cfe', 'xd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`,`user_id`,`config`) USING HASH,
  ADD KEY `user_id_to_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`password`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `queries`
--
ALTER TABLE `queries`
  ADD CONSTRAINT `user_id_to_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
