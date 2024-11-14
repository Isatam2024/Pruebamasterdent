<?php

// Clase Referencia
class Referencia {
    // Propiedades
    public $nombre;
    public $cantidadDeMoldes;
    public $juegosPorMolde;
    public $gramosPorJuego;
    public $tipo;
    public $capas;

    // Constructor
    public function __construct($nombre, $cantidadDeMoldes, $juegosPorMolde, $gramosPorJuego, $tipo, $capas) {
        $this->nombre = $nombre;
        $this->cantidadDeMoldes = $cantidadDeMoldes;
        $this->juegosPorMolde = $juegosPorMolde;
        $this->gramosPorJuego = $gramosPorJuego;
        $this->tipo = $tipo;
        $this->capas = $capas;
    }

    // Método para aumentar en 1 la cantidad de moldes
    public function actualizarMoldes() {
        $this->cantidadDeMoldes += 1;
    }

    // Método para mostrar la información de la referencia
    public function mostrarReferencia() {
        echo "Nombre: " . $this->nombre . "\n";
        echo "Cantidad de Moldes: " . $this->cantidadDeMoldes . "\n";
        echo "Juegos por Molde: " . $this->juegosPorMolde . "\n";
        echo "Gramos por Juego: " . $this->gramosPorJuego . "\n";
        echo "Tipo: " . $this->tipo . "\n";
        echo "Capas: " . $this->capas . "\n";
    }
}

// Subclase ReferenciaDePrueba que hereda de Referencia
class ReferenciaDePrueba extends Referencia {
    // Propiedad adicional
    public $materialDelMolde;

    // Constructor que incluye la propiedad adicional
    public function __construct($nombre, $cantidadDeMoldes, $juegosPorMolde, $gramosPorJuego, $tipo, $capas, $materialDelMolde) {
        // Llamada al constructor de la clase padre (Referencia)
        parent::__construct($nombre, $cantidadDeMoldes, $juegosPorMolde, $gramosPorJuego, $tipo, $capas);
        $this->materialDelMolde = $materialDelMolde;
    }

    // Sobrescribir el método actualizarMoldes() para aumentar en 10 en lugar de 1
    public function actualizarMoldes() {
        $this->cantidadDeMoldes += 10;
    }

    // Método para mostrar la información de la referencia de prueba
    public function mostrarReferencia() {
        parent::mostrarReferencia(); // Llamada al método de la clase padre para mostrar información común
        echo "Material del Molde: " . $this->materialDelMolde . "\n";
    }
}

// Ejemplo de uso
// Crear una instancia de Referencia
$referencia = new Referencia("Referencia A", 5, 20, 0.5, "Muela", "2C");
$referencia->mostrarReferencia();
echo "\n";

// Actualizar moldes
$referencia->actualizarMoldes();
$referencia->mostrarReferencia();
echo "\n";

// Crear una instancia de ReferenciaDePrueba
$referenciaPrueba = new ReferenciaDePrueba("Referencia B", 10, 30, 1.0, "Diente", "4C", "Plástico");
$referenciaPrueba->mostrarReferencia();
echo "\n";

// Actualizar moldes en ReferenciaDePrueba
$referenciaPrueba->actualizarMoldes();
$referenciaPrueba->mostrarReferencia();

?>
