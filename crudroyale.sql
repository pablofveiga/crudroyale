-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-07-2018 a las 00:12:48
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `crudroyale`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cards`
--

CREATE TABLE IF NOT EXISTS `tbl_cards` (
`card_ID` int(11) NOT NULL,
  `card_Img` varchar(200) NOT NULL,
  `card_Nombre` varchar(200) CHARACTER SET ucs2 NOT NULL,
  `card_Tipo` varchar(200) NOT NULL,
  `card_Nivel` int(11) NOT NULL,
  `card_Cantidad` int(11) NOT NULL,
  `card_NextLevel` varchar(200) NOT NULL,
  `card_Lavel13` int(11) NOT NULL,
  `card_OroTotal` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Tabla de Imagenes';

--
-- Volcado de datos para la tabla `tbl_cards`
--

INSERT INTO `tbl_cards` (`card_ID`, `card_Img`, `card_Nombre`, `card_Tipo`, `card_Nivel`, `card_Cantidad`, `card_NextLevel`, `card_Lavel13`, `card_OroTotal`) VALUES
(1, '770585.jpg', 'Petardas', 'Común', 11, 124, 'muchas',1423,150000),
(2, '736043.jpeg', 'Petardas', 'Especial', 11, 154, 'muchas',1423,150000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_cards`
--
ALTER TABLE `tbl_cards`
ADD PRIMARY KEY (`card_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_cards`
--
ALTER TABLE `tbl_cards`
MODIFY `card_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
