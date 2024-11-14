-- Crear la base de datos
CREATE DATABASE empresa;

-- Usar la base de datos recién creada
USE empresa;

-- Crear la tabla empleados
CREATE TABLE empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    puesto VARCHAR(100),
    salario FLOAT
);

-- Crear la tabla proyectos
CREATE TABLE proyectos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_proyecto VARCHAR(100),
    empleado_id INT,
    horas_trabajadas INT,
    FOREIGN KEY (empleado_id) REFERENCES empleados(id)
);

-- Insertar empleados
INSERT INTO empleados (id, nombre, puesto, salario)
VALUES
    (1, 'Ana Torres', 'Desarrolladora', 3500),
    (2, 'Luis Martínez', 'Analista', 4000);

-- Insertar proyectos
INSERT INTO proyectos (id, nombre_proyecto, empleado_id, horas_trabajadas)
VALUES
    (1, 'SistemaWeb', 1, 120),
    (2, 'AppMovil', 2, 80);

-- Consulta para obtener los nombres de los empleados junto con el total de horas trabajadas
SELECT e.nombre, SUM(p.horas_trabajadas) AS total_horas_trabajadas
FROM empleados e
JOIN proyectos p ON e.id = p.empleado_idempleados
GROUP BY e.id
ORDER BY total_horas_trabajadas DESC;
