-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 01:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bv`
--

-- --------------------------------------------------------

--
-- Table structure for table `bibliotecario`
--

CREATE TABLE `bibliotecario` (
  `usuario` varchar(255) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `bibliotecario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bibliotecario`
--

INSERT INTO `bibliotecario` (`usuario`, `contrasenia`, `bibliotecario_id`) VALUES
('stalin', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `libros`
--

CREATE TABLE `libros` (
  `id_libros` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `ejemplares` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `libros`
--

INSERT INTO `libros` (`id_libros`, `titulo`, `fecha`, `autor`, `categoria`, `descripcion`, `ejemplares`) VALUES
(1, 'El alquimista', '10 de agosto de 1988', 'Paulo Coelho', 'Ficción', 'Una novela que narra la historia de Santiago, un joven pastor andaluz que sueña con viajar en busca de un tesoro material y descubre tesoros espirituales a lo largo del camino.', '24'),
(19, 'Cien años de soledad', '30 de mayo de 1967', 'Gabriel García Márquez', 'Realismo mágico', 'Esta novela sigue la saga de la familia Buendía a lo largo de varias generaciones en el ficticio pueblo de Macondo, explorando temas de soledad, amor, poder y destino.', '32');

-- --------------------------------------------------------

--
-- Table structure for table `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamos` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL,
  `id_libros` int(11) NOT NULL,
  `fecha_salida` varchar(255) NOT NULL,
  `fecha_devolucion` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `observaciones` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `prestamos`
--

INSERT INTO `prestamos` (`id_prestamos`, `id_usuarios`, `id_libros`, `fecha_salida`, `fecha_devolucion`, `cantidad`, `observaciones`) VALUES
(3, 1, 1, '20 de marzo de 2024', '27 de marzo de 2024', 1, ''),
(22, 4, 1, '19 de marzo de 2024', '30 de marzo de 2024', 1, ''),
(32, 3, 19, '28 de marzo de 2024', '16 de abril de 2024', 1, ''),
(35, 1, 1, 'a', '', 2, ''),
(36, 3, 1, 'a', '5/4/2024', 18, 'roto'),
(37, 1, 1, 'g', '', 2, ''),
(38, 1, 19, 'g', '', 3, 'bien'),
(39, 3, 1, '5/4/2024', '5sjs', 10, 'Bueno'),
(42, 1, 1, '2024-04-10', '2024-04-05', 10, 'Bueno');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido_paterno` varchar(30) NOT NULL,
  `apellido_materno` varchar(30) NOT NULL,
  `domicilio` varchar(250) NOT NULL,
  `telefono` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nombre`, `apellido_paterno`, `apellido_materno`, `domicilio`, `telefono`) VALUES
(1, 'Alejandra', 'García', 'Rodríguez', 'Av. Juárez #123, Col. Centro, Ciudad de México', '555-123-4567'),
(3, 'Javier', 'López', 'Pérez', 'Calle Morelos #456, Col. Libertad, Monterrey, Nuevo León', '555-987-6543'),
(4, 'María', 'Martínez', 'Sánchez', 'Paseo de la Reforma #789, Col. Polanco, Ciudad de México', '555-432-1098');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bibliotecario`
--
ALTER TABLE `bibliotecario`
  ADD PRIMARY KEY (`bibliotecario_id`);

--
-- Indexes for table `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libros`);

--
-- Indexes for table `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamos`),
  ADD KEY `usuarios_id_usuarios_prestamos` (`id_usuarios`),
  ADD KEY `libros_id_libros_prestamos` (`id_libros`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bibliotecario`
--
ALTER TABLE `bibliotecario`
  MODIFY `bibliotecario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libros` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `libros_id_libros_prestamos` FOREIGN KEY (`id_libros`) REFERENCES `libros` (`id_libros`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_id_usuarios_prestamos` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
