-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2019 a las 01:31:13
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `alpha_lib`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `comprar` (`la_fecha` DATE, `la_calle` VARCHAR(45), `num_i` INT, `num_e` VARCHAR(10), `col` VARCHAR(45), `cpos` INT(5), `city` VARCHAR(45), `idUsuario` INT, `idPago` INT, `idLib` INT, `cant` INT)  begin
	declare exist int default (select existencia from libro where idlibro=idLib);
	declare idCompra int;
	declare costo double;
	if exist < cant then
	Signal sqlstate '10000' set message_text ='Cantidad insuficiente en almacén';
	elseif cant<=0 then
	Signal sqlstate '10000' set message_text ='Cantidad insuficiente en almacén';
	else
	set costo = (select precio from libro where idlibro=idLib);
	insert into compra (fecha, calle, numero_i, numero_e, colonia, CP, ciudad, usuario_id, pago_idpago) values (la_fecha, la_calle, num_i, num_e, col, cpos, city, idUsuario, idPago);
	set idCompra=(select max(id) from compra);
	insert into libro_has_compra values(idLib, idCompra, cant, costo*cant);
	update libro set existencia=existencia-cant where idlibro=idLib;
	end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `editarLibro` (IN `idLib` INT, IN `title` VARCHAR(45), IN `edic` INT, IN `costo` DOUBLE, IN `descrip` VARCHAR(250), IN `direc` VARCHAR(45), IN `ima` VARCHAR(45), IN `cantidad` INT, IN `idEditorial` INT, IN `idCategoria` INT, IN `idAutor` INT)  begin
	update libro set titulo=title, edicion=edic, precio=costo, descripcion=descrip, dir=direc, img=ima, existencia=cantidad, editorial_id=idEditorial where idlibro = idLib;
	update libro_has_autor set autor_idAutor=idAutor where libro_idlibro=idLib;
	update libro_has_categoria set categoria_idCat=idCategoria where libro_idlibro=idLib;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE `autor` (
  `idAutor` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `pais` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`idAutor`, `nombre`, `pais`) VALUES
(1, 'Juan Rulfo', 'MÃ©xico'),
(2, 'John Green', 'Estados Unidos'),
(3, 'Miguel de Cervantes', 'EspaÃ±a'),
(4, 'Suzane Collins', 'Estados Unidos'),
(5, 'Angel David Revilla', 'Venezuela'),
(6, 'Paulo Coelho', 'Brasil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `host` varchar(45) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `tabla` varchar(45) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCat` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCat`, `nombre`) VALUES
(1, 'Drama'),
(2, 'Novela'),
(3, 'Suspenso'),
(4, 'Terror'),
(5, 'Aventura'),
(6, 'Juvenil'),
(7, 'Historia'),
(8, 'Historia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idcomentarios` int(11) NOT NULL,
  `comentario` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios_has_libro`
--

CREATE TABLE `comentarios_has_libro` (
  `idcomentarios` int(11) NOT NULL,
  `libro_idlibro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `calle` varchar(45) NOT NULL,
  `numero_i` int(11) DEFAULT NULL,
  `numero_e` varchar(10) NOT NULL,
  `colonia` varchar(45) NOT NULL,
  `CP` int(5) NOT NULL,
  `ciudad` varchar(45) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `fecha`, `calle`, `numero_i`, `numero_e`, `colonia`, `CP`, `ciudad`, `usuario_id`) VALUES
(1, '2019-04-02', 'Francisco J. Mujica', 58, '', 'Centro', 58970, 'Indaparapeo', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `comentario` varchar(140) NOT NULL,
  `status` varchar(20) DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `correo`, `comentario`, `status`) VALUES
(1, 'arturoandradm@gmail.com', 'Â¿Tienen disponibles los diarios de Gravity Falls?', 'pendiente'),
(5, 'webmaster@libreria.net', 'Ya funciona :)', 'pendiente'),
(6, 'arturoandradm@gmail.com', 'Prueba en windows', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE `editorial` (
  `idEditorial` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`idEditorial`, `nombre`) VALUES
(1, 'Nube de tinta'),
(2, 'Trillas'),
(3, 'Aquellare Editoras'),
(4, 'Fernandez Editores');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `inf_libro`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `inf_libro` (
`idlibro` int(11)
,`titulo` varchar(45)
,`edicion` int(11)
,`precio` double
,`descripcion` varchar(250)
,`dir` varchar(45)
,`img` varchar(45)
,`existencia` int(11)
,`editorial_id` int(11)
,`autor` varchar(45)
,`categoria` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `idlibro` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `edicion` int(11) NOT NULL,
  `precio` double NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `dir` varchar(45) NOT NULL DEFAULT 'img/portadas/',
  `img` varchar(45) NOT NULL,
  `existencia` int(11) NOT NULL,
  `editorial_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`idlibro`, `titulo`, `edicion`, `precio`, `descripcion`, `dir`, `img`, `existencia`, `editorial_id`) VALUES
(1, 'Pedro Paramo', 4, 230, 'Pedro PÃ¡ramo es una de las obras maestras de la literatura hispanoamericana. La novela cuenta cÃ³mo el protagonista, Juan Preciado, va en busca de su padre, Pedro PÃ¡ramo, hasta el pueblo mexicano de Comala, un lugar vacio, misterioso, sin vida.', '/alpha-lib/img/portadas/', 'pedro-paramo.jpg', 50, 1),
(2, 'Ciudades de Papel', 4, 280, 'Quentin es un joven con mala suerte en el amor que se encuentra con su inalcanzable y enigmÃ¡tica vecina en la ventana de su cuarto. Luego de vivir una aventura de una noche recorriendo la ciudad, Ã©l deberÃ¡ rastrearla para volverla a ver.', '/alpha-lib/img/portadas/', 'ciudades_papel.jpg', 10, 1),
(3, 'Buscando a Alaska', 3, 230, 'Cansado de su aburrida existencia, Miles, de 16 aÃ±os, se muda a un colegio internado para ir en busca de lo que el poeta Rabelais llamÃ³ el â€œGran quizÃ¡â€. AhÃ­, su reciÃ©n descubierta libertad y una enigmÃ¡tica chica, Alaska, lo lanzan de lleno ', '/alpha-lib/img/portadas/', 'buscando_alaska.jpg', 20, 1),
(4, 'Don Quijote de la Mancha', 3, 200, 'Don Quijote', 'img/portadas/', 'don_quijote.jpeg', 20, 1),
(5, 'El alquimista', 4, 230, 'Paulo Coelho. Cuando quieres algo, todo el Universo conspira para ayudarte a conseguirlo. Sinopsis de El Alquimista: Considerado ya un clÃ¡sico de nuestros dÃ­as, El Alquimista relata las aventuras de Santiago, un joven pastor andaluz que un dÃ­a emp', 'img/portadas/', 'el_alquimista.jpg', 20, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_has_autor`
--

CREATE TABLE `libro_has_autor` (
  `libro_idlibro` int(11) NOT NULL,
  `autor_idAutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libro_has_autor`
--

INSERT INTO `libro_has_autor` (`libro_idlibro`, `autor_idAutor`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 3),
(5, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_has_categoria`
--

CREATE TABLE `libro_has_categoria` (
  `libro_idlibro` int(11) NOT NULL,
  `categoria_idCat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libro_has_categoria`
--

INSERT INTO `libro_has_categoria` (`libro_idlibro`, `categoria_idCat`) VALUES
(1, 3),
(2, 3),
(3, 2),
(4, 1),
(5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_has_compra`
--

CREATE TABLE `libro_has_compra` (
  `libro_idlibro` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libro_has_compra`
--

INSERT INTO `libro_has_compra` (`libro_idlibro`, `compra_id`, `cantidad`, `subtotal`) VALUES
(1, 8, 2, 599.98),
(11, 9, 2, 1399.98),
(12, 10, 7, 3499.9300000000003),
(12, 11, 20, 9999.8),
(12, 14, 1, 499.99),
(12, 16, 1, 499.99),
(10, 17, 2, 1599.98);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `idpago` int(11) NOT NULL,
  `referencia` varchar(45) NOT NULL,
  `fecha_venc` date NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pendiente',
  `idcompra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `registrocompras`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `registrocompras` (
`ID` int(11)
,`Libro` varchar(45)
,`Fecha` date
,`Usuario` varchar(45)
,`cantidad` int(11)
,`subtotal` double
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `contrasena` varchar(45) DEFAULT NULL,
  `rol` varchar(45) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `apellidos`, `telefono`, `email`, `contrasena`, `rol`) VALUES
(1, 'Administrador', 'Libreria', '4511011121', 'admin@libreria.net', 'administrador', '1'),
(2, 'Arturo', 'Andrade Molina', '4434484089', 'arturoandradm@gmail.com', 'alebjunis', '2'),
(3, 'Cliente', 'Clientoso', '4434484089', 'cliente@mail.mx', 'cbece85a08', '2'),
(4, 'jose', 'mendez', '5542323284', 'jose.mendez@gmail.com', '12345678', '2'),
(10, 'Arturo', 'Andrade', '4434484089', 'arturo@libreria.net', 'adminarturo', '1'),
(11, 'aurelio', 'Murillo', '1234567890', 'aurelio12@gmail.com', '1944diad', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_has_comentarios`
--

CREATE TABLE `usuarios_has_comentarios` (
  `idUsuario` int(11) NOT NULL,
  `_idcomentario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idVenta` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `total` double(6,2) NOT NULL,
  `compra_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura para la vista `inf_libro`
--
DROP TABLE IF EXISTS `inf_libro`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inf_libro`  AS  select `libro`.`idlibro` AS `idlibro`,`libro`.`titulo` AS `titulo`,`libro`.`edicion` AS `edicion`,`libro`.`precio` AS `precio`,`libro`.`descripcion` AS `descripcion`,`libro`.`dir` AS `dir`,`libro`.`img` AS `img`,`libro`.`existencia` AS `existencia`,`libro`.`editorial_id` AS `editorial_id`,`autor`.`nombre` AS `autor`,`categoria`.`nombre` AS `categoria` from ((((`libro` join `libro_has_autor` on((`libro`.`idlibro` = `libro_has_autor`.`libro_idlibro`))) join `autor` on((`libro_has_autor`.`autor_idAutor` = `autor`.`idAutor`))) join `libro_has_categoria` on((`libro`.`idlibro` = `libro_has_categoria`.`libro_idlibro`))) join `categoria` on((`libro_has_categoria`.`categoria_idCat` = `categoria`.`idCat`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `registrocompras`
--
DROP TABLE IF EXISTS `registrocompras`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `registrocompras`  AS  select `libro_has_compra`.`compra_id` AS `ID`,(select `libro`.`titulo` from `libro` where (`libro`.`idlibro` = `libro_has_compra`.`libro_idlibro`)) AS `Libro`,(select `compra`.`fecha` from `compra` where (`compra`.`id` = `libro_has_compra`.`compra_id`)) AS `Fecha`,(select `usuarios`.`nombre` from `usuarios` where (`usuarios`.`idUsuario` = (select `compra`.`usuario_id` from `compra` where (`compra`.`id` = `libro_has_compra`.`compra_id`)))) AS `Usuario`,`libro_has_compra`.`cantidad` AS `cantidad`,`libro_has_compra`.`subtotal` AS `subtotal` from `libro_has_compra` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`idAutor`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCat`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idcomentarios`);

--
-- Indices de la tabla `comentarios_has_libro`
--
ALTER TABLE `comentarios_has_libro`
  ADD KEY `fk_idcomentario` (`idcomentarios`),
  ADD KEY `fk_idlibros` (`libro_idlibro`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`idEditorial`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`idlibro`);

--
-- Indices de la tabla `libro_has_autor`
--
ALTER TABLE `libro_has_autor`
  ADD KEY `fk_libro_has_autor_autor1` (`autor_idAutor`),
  ADD KEY `fk_libro_has_autor_libro` (`libro_idlibro`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`idpago`),
  ADD KEY `compra` (`idcompra`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `correo_UNIQUE` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idVenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `idAutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idcomentarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `idEditorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `idlibro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `idpago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios_has_libro`
--
ALTER TABLE `comentarios_has_libro`
  ADD CONSTRAINT `fk_idcomentario` FOREIGN KEY (`idcomentarios`) REFERENCES `comentarios` (`idcomentarios`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idlibros` FOREIGN KEY (`libro_idlibro`) REFERENCES `libro` (`idlibro`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `libro_has_autor`
--
ALTER TABLE `libro_has_autor`
  ADD CONSTRAINT `fk_libro_has_autor_autor1` FOREIGN KEY (`autor_idAutor`) REFERENCES `autor` (`idAutor`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_libro_has_autor_libro` FOREIGN KEY (`libro_idlibro`) REFERENCES `libro` (`idlibro`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `compra` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
