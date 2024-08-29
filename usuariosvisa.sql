
CREATE TABLE `usuariovisa` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `levely` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO `usuariovisa` (`id`, `nombre`, `usuario`, `clave`, `fecha_registro`, `levely`) VALUES
(7, 'ADMINISTRADOR', 'admin', 'visacita', '2024-03-21', '3');

ALTER TABLE `usuariovisa`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuariovisa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

