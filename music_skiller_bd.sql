-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2025 a las 23:19:55
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `music_skiller_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE `ejercicios` (
  `ID` int(9) NOT NULL,
  `ejercicio` varchar(50) NOT NULL,
  `nivel` varchar(50) NOT NULL,
  `imagenPequena` varchar(50) DEFAULT NULL,
  `imagenGrande` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`ID`, `ejercicio`, `nivel`, `imagenPequena`, `imagenGrande`, `descripcion`) VALUES
(1, 'escalas', 'principiante', '../imagenes/ejemplo escalas principiante.png', NULL, NULL),
(2, 'escalas', 'medio', '../imagenes/ejemplo escalas medio.png', NULL, NULL),
(3, 'escalas', 'avanzado', '../imagenes/ejemplo escalas avanzado.png', '../imagenes/Escalas avanzado 1.png', NULL),
(4, 'escalas', 'avanzado', '../imagenes/ejemplo escalas avanzado2.png', '../imagenes/Escalas avanzado 2.png', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(9) NOT NULL,
  `Nick` varchar(9) NOT NULL,
  `password` varchar(9) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Instrumento` varchar(20) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Direccion` varchar(50) DEFAULT NULL,
  `Premium` tinyint(9) NOT NULL,
  `Admin` tinyint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID`, `Nick`, `password`, `Email`, `Instrumento`, `Nombre`, `Telefono`, `Direccion`, `Premium`, `Admin`) VALUES
(285623516, 'Pepe', '1234', 'pepe@pepe.com', 'trompeta', '', NULL, NULL, 0, 0),
(462767685, 'Pepe', '1234', 'pepe@pepe.com', 'bandoneón', '', NULL, NULL, 0, 0),
(521124890, 'Arturo', '1234', 'arturomiq_90@hotmail.com', 'trombón', '', NULL, NULL, 0, 0),
(770883660, 'Arturo', '1234', 'arturomiq_90@hotmail.com', 'trombón', '', NULL, NULL, 0, 0),
(815251412, 'hola', '1234', 'pepe@pepe.com', 'trompeta', '', NULL, NULL, 0, 0),
(947909640, 'Arturo', '1234', 'arturomiq_90@hotmail.com', 'trombón', '', NULL, NULL, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
