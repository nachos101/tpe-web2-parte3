<?php
require_once 'config.php';

class Model
{
    protected $db;

    function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST .
                ";dbname=" . MYSQL_DB . ";charset=utf8",
            MYSQL_USER,
            MYSQL_PASS
        );

        $this->deploy();
    }

    private function deploy()
    {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
          $password = '$2a$12$sueSEU0qRVxmHEMjz7eMae4pkFdf20gdVUeaH8Yd1BdC0kBMNvLtG';
          $sql = <<<END
            

CREATE TABLE `capitulos` (
  `id_capitulo` int(255) NOT NULL,
  `id_temporada` int(255) NOT NULL,
  `num_capitulo` int(255) NOT NULL,
  `duracion` int(255) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capitulos`
--

INSERT INTO `capitulos` (`id_capitulo`, `id_temporada`, `num_capitulo`, `duracion`, `descripcion`) VALUES
(1, 1, 1, 23, 'Un equipo filma en Dunder Mifflin y Michael Scott intenta parecer líder feliz, pero falla.'),
(2, 1, 2, 22, 'Dia de la diversidad - Por ofensas de Michael, la empresa hace seminario de diversidad.'),
(3, 1, 3, 22, 'Michael evita elegir plan médico y delega en Dwight para no perder popularidad con su personal.'),
(4, 3, 1, 80, 'Tras ganar un concurso de cocina francés, Yeon Ji‑young viaja en el tiempo gracias a un libro de recetas antiguo y, al llegar, se topa con el rey Yi Heon.'),
(6, 3, 2, 80, 'Cautiva en condiciones difíciles, Ji‑young prepara un festín para ganar su libertad, pero ni su talento la salva cuando una crisis pone su vida en peligro.'),
(7, 3, 4, 81, 'Ji‑young debe ponerse a prueba en una competencia culinaria de alto riesgo, y su destino en la corte pende de un hilo. Afligido y borracho, Yi Heon la llama a su lado.'),
(8, 3, 5, 76, 'Luego de compartir un momento íntimo, Yi Heon deja de comer con Ji‑young…, pero ninguno puede parar de pensar en el otro, a pesar de la distancia.'),
(9, 3, 6, 75, 'Se ordena un concurso de comida, y Ji‑young acepta el desafío para representar a Joseon… y ganar algo más que el honor.'),
(10, 3, 7, 81, 'Para conseguir una ventaja en la competencia de cocina, Ji‑young se propone crear una olla única. Sin embargo, encontrar al artesano correcto resulta ser todo un desafío.'),
(11, 3, 8, 81, 'Ji‑young llega a duras penas a la competencia y comienza a cocinar. ¡Pero pronto descubre que le faltan sus ingredientes claves! ¿Podrá sobreponerse a la crisis?'),
(13, 3, 3, 82, 'Ji‑young se convierte en la nueva cocinera real de Yi Heon luego de impresionarlo con sus delicias francesas. Consumida por los celos, Kang Mok‑ju conspira en su contra.'),
(14, 1, 4, 22, 'En medio de rumores de reducción de personal, Michael intenta elevar la moral con una fiesta de cumpleaños, a pesar de que no es el cumpleaños de nadie. Dwight le pide a Jim que forme una alianza al estilo \"Superviviente\".'),
(15, 1, 5, 22, 'Michael y su pandilla juegan contra los trabajadores del almacén en un juego de baloncesto no tan amigable. Con demasiada confianza, Michael apuesta a que los perdedores tendrán que trabajar el sábado.'),
(16, 1, 6, 22, 'Dwight, Michael y Jim compiten por la atención de una mujer atractiva que viene a la oficina a vender carteras.'),
(17, 2, 1, 21, 'Los empleados de Dunder Mifflin sufren durante la ceremonia anual de premios de la oficina, los “Dundie”. Michael los presenta en su antro preferido: un restaurante Chili\'s.'),
(18, 2, 2, 22, 'La oficina corporativa le exige al personal que asista a una orientación sobre el acoso sexual, pero a Michael le preocupa que la política nueva haga que la oficina sea menos divertida para todos.'),
(19, 2, 3, 22, 'En la ausencia de Michael y Dwight, Jim y Pam organizan las “Olimpiadas de la Oficina”, donde los empleados compiten en juegos ridículos.'),
(20, 2, 4, 22, 'Un pequeño incendio en la cocina obliga al personal a esperar en el estacionamiento, donde Jim sugiere que jueguen a “la Isla Desierta”. Michael trata de impresionar a Ryan.'),
(21, 2, 5, 22, 'La oficina corporativa obliga a Michael a despedir a alguien y eso les resta diversión a las festividades de la Noche de Brujas de Dunder Mifflin.'),
(22, 2, 6, 22, 'Después de que Dwight le da un golpe de karate a Michael, Jim organiza una revancha durante el almuerzo en el dojo de Dwight, donde Pam se molesta cuando Jim se pone demasiado amistoso.'),
(23, 2, 7, 22, 'Cuando Michael y Jan se reúnen con un cliente Michael sorprende a Jan con sus aptitudes. Jim y el personal representan escenas del guion secreto de Michael.'),
(24, 2, 8, 22, 'El personal se reúne con Michael para hablar de su desempeño laboral, pero lo único que le preocupa a Michael es su evaluación inminente con Jan, su jefa, ese mismo día.'),
(25, 2, 9, 22, 'Los empleados de Dunder Mifflin se alteran cuando Michael empieza a monitorizar sus correos electrónicos.'),
(26, 2, 10, 22, 'Santa Claus va a llegar a Scranton. Michael sugiere un intercambio de regalos al estilo yanqui.'),
(27, 2, 11, 22, '¿Quieren ir conmigo en un crucero en el mar? Michael lleva al equipo de Dunder Mifflin de viaje en un crucero “motivador” con bebidas alcohólicas al por mayor.'),
(28, 2, 12, 21, 'Michael tiene un accidente extraño con su parrilla George Foreman. Dwight se comporta de manera rara después de un choque en auto leve.'),
(29, 2, 13, 21, 'Michael se lleva a Jim, que finge ser su mejor amigo, a almorzar a Hooters.'),
(30, 2, 14, 21, 'Cuando Michael finalmente se da cuenta de que quizá no le agrada a todo su personal, hace un concurso de ventas para levantarles la moral.'),
(31, 2, 15, 22, 'Cuando las empleadas asisten a un seminario de las Mujeres en el Trabajo, Michael se siente excluido y organiza su propio “seminario” para los hombres.'),
(32, 2, 16, 21, 'Michael se topa con una ex novia en la conferencia de Nueva York de la oficina corporativa de Dunder Mifflin. En Scranton, el personal de la oficina se prepara para un Día de San Valentín tradicional.'),
(33, 2, 17, 21, 'A Dwight lo eligen vendedor del año y le pide ayuda a Michael para vencer su miedo a hablar en público.'),
(34, 2, 18, 21, 'Un día rutinario en la oficina cambia radicalmente cuando los niños llegan a Dunder Mifflin el Día de Llevar a las Hijas al Trabajo.'),
(35, 2, 19, 21, 'Para celebrar su cumpleaños, Michael (Steve Carell, ganador de un premio Golden Globe) lleva al grupo de Dunder Mifflin a patinar en hielo.'),
(36, 2, 20, 21, 'Cuando Dwight encuentra medio cigarrillo de marihuana en el estacionamiento de Dunder Mifflin, se pone su uniforme de sheriff voluntario e inicia una investigación completa.'),
(37, 2, 21, 21, 'Se crea un caos cuando Michael se ocupa de los deberes de solución de conflictos de Recursos Humanos.'),
(38, 2, 22, 29, 'En el último episodio de la temporada, Michael y el equipo de Dunder Mifflin organizan una Noche de Casino con fines benéficos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `id_serie` int(255) NOT NULL,
  `titulo` varchar(1000) NOT NULL,
  `genero` varchar(1000) NOT NULL,
  `cant_temporadas` int(255) NOT NULL,
  `sinopsis` text NOT NULL,
  `clasificación` int(99) NOT NULL,
  `fecha_estreno` date NOT NULL,
  `img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`id_serie`, `titulo`, `genero`, `cant_temporadas`, `sinopsis`, `clasificación`, `fecha_estreno`, `img`) VALUES
(1, 'The Office', 'Comedia', 9, 'La serie narra el día a día de los empleados de una oficina situada en Scranton (Pensilvania), sucursal de la empresa papelera ficticia Dunder Mifflin, y consta de 201 episodios repartidos en nueve temporadas.', 16, '0000-00-00', 'https://hips.hearstapps.com/hmg-prod/images/season-5-pictured-ed-helms-as-andy-bernard-phyllis-smith-as-news-photo-138448895-1565378733.jpg'),
(2, 'Bon appetit majestad', 'Romance', 1, 'Tras viajar en el tiempo a los días de la dinastía Joseon, una talentosa chef conoce a un rey tirano, cuyo paladar conquista. Pero sobrevivir exigirá desafíos reales.', 13, '0000-00-00', 'https://www.infobae.com/resizer/v2/YABCNXJMOVCJ5M7L2VRMVME5Y4.jpg?auth=f583aa4bd921053ad25f28ee20b118e7acc4424587dc8e1ed5e27e14a049c463&smart=true&width=1200&height=630&quality=85');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporadas`
--

CREATE TABLE `temporadas` (
  `id_temporada` int(255) NOT NULL,
  `id_serie` int(255) NOT NULL,
  `num_temporada` int(255) NOT NULL,
  `cant_capitulos` int(255) NOT NULL,
  `resumen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `temporadas`
--

INSERT INTO `temporadas` (`id_temporada`, `id_serie`, `num_temporada`, `cant_capitulos`, `resumen`) VALUES
(1, 1, 1, 9, 'oaaaa'),
(2, 1, 2, 22, 'oaaaa'),
(3, 2, 1, 8, 'oaaaa'),
(4, 1, 3, 22, 'oaaaa'),
(5, 2, 4, 22, 'oaaaa'),
(6, 1, 5, 22, 'oaaaa'),
(7, 1, 6, 20, 'oaaaa'),
(8, 1, 7, 24, 'oaaaa'),
(9, 1, 8, 19, 'oaaaa'),
(11, 1, 9, 15, 'oaaaa'),
(12, 1, 10, 10, 'oaaaa'),
(13, 1, 5, 22, 'OAA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(255) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `user_name`, `password`) VALUES
(1, 'webadmin', '$2a$12$sueSEU0qRVxmHEMjz7eMae4pkFdf20gdVUeaH8Yd1BdC0kBMNvLtG');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `capitulos`
--
ALTER TABLE `capitulos`
  ADD PRIMARY KEY (`id_capitulo`),
  ADD KEY `id_temporada` (`id_temporada`);

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id_serie`);

--
-- Indices de la tabla `temporadas`
--
ALTER TABLE `temporadas`
  ADD PRIMARY KEY (`id_temporada`),
  ADD KEY `id_serie` (`id_serie`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `capitulos`
--
ALTER TABLE `capitulos`
  MODIFY `id_capitulo` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `id_serie` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `temporadas`
--
ALTER TABLE `temporadas`
  MODIFY `id_temporada` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `capitulos`
--
ALTER TABLE `capitulos`
  ADD CONSTRAINT `capitulos_ibfk_1` FOREIGN KEY (`id_temporada`) REFERENCES `temporadas` (`id_temporada`);

--
-- Filtros para la tabla `temporadas`
--
ALTER TABLE `temporadas`
  ADD CONSTRAINT `temporadas_ibfk_1` FOREIGN KEY (`id_serie`) REFERENCES `series` (`id_serie`);
COMMIT;


END;
            $this->db->exec($sql);
        }
    }
}