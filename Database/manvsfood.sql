-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 01, 2018 alle 22:04
-- Versione del server: 10.1.26-MariaDB
-- Versione PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manvsfood`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`id`, `user_id`) VALUES
(1, 13);

-- --------------------------------------------------------

--
-- Struttura della tabella `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `descr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `category`
--

INSERT INTO `category` (`cat_id`, `descr`) VALUES
(1, 'pasta'),
(2, 'carne'),
(3, 'pizza'),
(4, 'contorni'),
(5, 'bevande'),
(6, 'altro');

-- --------------------------------------------------------

--
-- Struttura della tabella `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `testo` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `testo`, `status`) VALUES
(1, 13, 'Il cliente con id 17 ha fatto un ordine con id: 1', 1),
(2, 17, 'Ordine pronto, il fattorino sta partendo', 1),
(3, 13, 'Il cliente con id 17 ha fatto un ordine con id: 2', 1),
(4, 17, 'Ordine pronto, il fattorino sta partendo', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `ord`
--

CREATE TABLE `ord` (
  `order_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `place` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ord`
--

INSERT INTO `ord` (`order_id`, `date`, `place`, `user_id`) VALUES
(1, '2017-12-24 18:08:48', 'Via Cervese, 121, Cesena, FC, Italia', 17),
(2, '2017-12-31 18:36:12', 'Via Cervese, 2310, Cesena, FC, Italia', 17);

-- --------------------------------------------------------

--
-- Struttura della tabella `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` longblob,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `product`
--

INSERT INTO `product` (`prod_id`, `descr`, `price`, `img`, `cat_id`) VALUES
(1, 'Tortellini alla boscaiola', '9.50', NULL, 1),
(2, 'Fiorentina', '15.00', NULL, 2),
(3, 'Margherita', '6.00', NULL, 3),
(4, 'Patate fritte', '4.00', NULL, 4),
(5, 'Aranciata', '2.00', NULL, 5),
(7, 'Gnocchi', '7.00', NULL, 1),
(8, 'Ravioli ricotta e spinaci', '5.00', NULL, 1),
(9, 'Kebab', '7.50', NULL, 6),
(10, 'Costine di maiale', '6.00', NULL, 2),
(12, 'Acqua naturale', '2.00', NULL, 5),
(13, 'Acqua frizzante', '2.50', NULL, 5),
(15, 'Petto di pollo', '4.00', NULL, 2),
(16, 'Spaghetti alla carbonara', '8.50', NULL, 1),
(17, 'Insalata mista', '3.00', NULL, 4),
(18, 'Capricciosa', '6.50', NULL, 3),
(19, 'Diavola', '7.00', NULL, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `prod_in_ord`
--

CREATE TABLE `prod_in_ord` (
  `id` int(11) NOT NULL,
  `qnt` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `prod_in_ord`
--

INSERT INTO `prod_in_ord` (`id`, `qnt`, `product_id`, `order_id`) VALUES
(1, 1, 3, 1),
(2, 1, 5, 1),
(3, 1, 1, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `password`, `hash`, `email`, `active`) VALUES
(13, 'andrea', 'alfonsi', '$2y$10$h/t3ITCXlq5KZbWmDzHVP.Qn/poI6nv9n0bnjB3UrvPlHpp7fVqfS', 'cee631121c2ec9232f3a2f028ad5c89b', 'amministratoremanvsfood@gmail.com', 1),
(14, 'matteo', 'esposto', '$2y$10$YgPmlgDIy9IeG1SztyX69uo6kGliGdk68m/GgAVS/ofGn0nKL8.qO', 'a3c65c2974270fd093ee8a9bf8ae7d0b', 'espomatti3@gmail.com', 1),
(15, 'n', '\\ui\\', '$2y$10$p6wcI.KHfGu8oT63xdXZIONDvgzuNX0wsxM.eEcobIOY3MSc6G10u', 'd79aac075930c83c2f1e369a511148fe', 'adsf@hdgh.it', 0),
(17, 'Andrea', 'Alfonsi', '$2y$10$EtxlFb69cN9bdaLydsyr3e2HCg7bSWY9EFBPqEFwEojqOENnE6NEu', 'e2ef524fbf3d9fe611d5a8e90fefdc9c', 'andri.alfo@hotmail.it', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indici per le tabelle `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `ord`
--
ALTER TABLE `ord`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indici per le tabelle `prod_in_ord`
--
ALTER TABLE `prod_in_ord`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `ord`
--
ALTER TABLE `ord`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `prod_in_ord`
--
ALTER TABLE `prod_in_ord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Limiti per la tabella `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Limiti per la tabella `ord`
--
ALTER TABLE `ord`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Limiti per la tabella `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`);

--
-- Limiti per la tabella `prod_in_ord`
--
ALTER TABLE `prod_in_ord`
  ADD CONSTRAINT `prod_in_ord_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `ord` (`order_id`),
  ADD CONSTRAINT `prod_in_ord_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`prod_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
