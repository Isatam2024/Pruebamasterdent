<?php
// Configuración de conexión a la base de datos
$host = 'localhost'; // Ajusta si es necesario
$usuario = 'root';   // Nombre de usuario de la base de datos
$contraseña = '';    // Contraseña de la base de datos
$base_de_datos = 'empresa';

// Establecer la conexión a la base de datos
$conn = new mysqli($host, $usuario, $contraseña, $base_de_datos);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para agregar un nuevo empleado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre']) && isset($_POST['puesto']) && isset($_POST['salario'])) {
    $nombre = $_POST['nombre'];
    $puesto = $_POST['puesto'];
    $salario = $_POST['salario'];

    // Preparar la consulta SQL para insertar el nuevo empleado
    $stmt = $conn->prepare("INSERT INTO empleados (nombre, puesto, salario) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $nombre, $puesto, $salario); // "ssd" indica tipos de datos: string, string, decimal

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<div class='alert alert-success' role='alert'>Empleado agregado con éxito!</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error al agregar empleado: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Consulta para obtener los nombres de los empleados y las horas trabajadas
$sql = "SELECT e.nombre, SUM(p.horas_trabajadas) AS total_horas_trabajadas
        FROM empleados e
        JOIN proyectos p ON e.id = p.empleado_id
        GROUP BY e.id
        ORDER BY total_horas_trabajadas DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados y Horas Trabajadas</title>
    <!-- Vinculación de Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 30px;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center mb-4">Empleados y Horas Trabajadas</h1>

    <!-- Mostrar la tabla de empleados y horas trabajadas -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Nombre del Empleado</th>
                <th>Total de Horas Trabajadas</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Comprobar si hay resultados y mostrarlos
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                                    <td>" . htmlspecialchars($row['nombre']) . "</td>
                                    <td>" . $row['total_horas_trabajadas'] . "</td>
                                  </tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No hay empleados o proyectos disponibles.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <!-- Formulario para agregar un nuevo empleado -->
    <h2 class="mt-5">Agregar un Nuevo Empleado</h2>
    <form action="index.php" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="puesto">Puesto:</label>
            <input type="text" class="form-control" id="puesto" name="puesto" required>
        </div>
        <div class="form-group">
            <label for="salario">Salario:</label>
            <input type="number" class="form-control" id="salario" name="salario" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Empleado</button>
    </form>
</div>

<!-- Vinculación de Bootstrap JS y dependencias (jQuery y Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
