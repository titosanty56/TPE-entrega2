<?php
    require_once('./db/config.php');
class Model {
    protected $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=agencia_viajes;charset=utf8', 'root', '');
        $this->_deploy();
    } 

    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql = <<<END
                Base de datos: `agencia de viajes`
                --

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `aerolinea`
                --

                CREATE TABLE `aerolinea` (
                `Id_aerolinea` int(11) NOT NULL,
                `Nombre` varchar(100) NOT NULL,
                `Pais` varchar(100) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `aerolinea`
                --

                INSERT INTO `aerolinea` (`Id_aerolinea`, `Nombre`, `Pais`) VALUES
                (1, 'Aerolineas Argentinas', 'Argentina'),
                (2, 'Sky Airline', 'Chile'),
                (3, 'Qatar Airways', 'Qatar');

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `persona`
                --

                CREATE TABLE `persona` (
                `id` int(11) NOT NULL,
                `Nombre` varchar(100) NOT NULL,
                `Cantidad` varchar(100) NOT NULL,
                `Id_aerolinea` int(11) NOT NULL,
                `Destino` varchar(100) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `persona`
                --

                INSERT INTO `persona` (`id`, `Nombre`, `Cantidad`, `Id_aerolinea`, `Destino`) VALUES
                (1, 'Juan Fernandez', '5', 2, 'Bolivia'),
                (2, 'Carlos Luna', '2', 1, 'Peru'),
                (3, 'Ezequiel Maggiolo', '3', 3, 'Arabia');

                --
                -- Índices para tablas volcadas
                --

                --
                -- Indices de la tabla `aerolinea`
                --
                ALTER TABLE `aerolinea`
                ADD PRIMARY KEY (`Id_aerolinea`);

                --
                -- Indices de la tabla `persona`
                --
                ALTER TABLE `persona`
                ADD PRIMARY KEY (`id`),
                ADD KEY `Id_aerolinea` (`Id_aerolinea`);

                --
                -- AUTO_INCREMENT de las tablas volcadas
                --

                --
                -- AUTO_INCREMENT de la tabla `aerolinea`
                --
                ALTER TABLE `aerolinea`
                MODIFY `Id_aerolinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

                --
                -- AUTO_INCREMENT de la tabla `persona`
                --
                ALTER TABLE `persona`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

                --
                -- Restricciones para tablas volcadas
                --

                --
                -- Filtros para la tabla `persona`
                --
                ALTER TABLE `persona`
                ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`Id_aerolinea`) REFERENCES `aerolinea` (`Id_aerolinea`);
                COMMIT;

                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
        END;
        $this->db->query($sql);
        } 
    }
}