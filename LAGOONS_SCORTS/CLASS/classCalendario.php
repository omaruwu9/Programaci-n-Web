<?php
// Establecer el mes y el año actuales
$mes = date('m');
$año = date('Y');

// Si se pasa un mes o año diferente a través de la URL, actualizar las variables
if (isset($_GET['mes']) && isset($_GET['año'])) {
    $mes = (int)$_GET['mes']; // Convertir a entero para asegurar el tipo de dato
    $año = (int)$_GET['año'];
}

// Asegurarse de que el mes está en el rango válido
if ($mes < 1) {
    $mes = 12; // Si el mes es menor que 1, ir a diciembre
    $año--; // Decrementar el año
} elseif ($mes > 12) {
    $mes = 1; // Si el mes es mayor que 12, ir a enero
    $año++; // Incrementar el año
}

// Crear un array con los nombres de los meses en español
$nombresMeses = [
    1 => 'Enero',
    2 => 'Febrero',
    3 => 'Marzo',
    4 => 'Abril',
    5 => 'Mayo',
    6 => 'Junio',
    7 => 'Julio',
    8 => 'Agosto',
    9 => 'Septiembre',
    10 => 'Octubre',
    11 => 'Noviembre',
    12 => 'Diciembre'
];

// Calcular el primer día del mes
$primerDia = mktime(0, 0, 0, $mes, 1, $año);

// Obtener el nombre del mes y el año
$nombreMes = $nombresMeses[$mes]; // Usar el array para obtener el nombre
$diasEnMes = date('t', $primerDia);
$diaDeLaSemana = date('w', $primerDia);

// Crear el calendario
$calendario = '<table border="1">';
$calendario .= '<tr><th colspan="7" class="mes-titulo">' . $nombreMes . ' ' . $año . '</th></tr>';
$calendario .= '<tr>
                    <th class="dias-semana">Dom</th>
                    <th class="dias-semana">Lun</th>
                    <th class="dias-semana">Mar</th>
                    <th class="dias-semana">Mié</th>
                    <th class="dias-semana">Jue</th>
                    <th class="dias-semana">Vie</th>
                    <th class="dias-semana">Sáb</th>
                </tr>
                <tr>';

// Llenar los espacios en blanco del primer día
for ($i = 0; $i < $diaDeLaSemana; $i++) {
    $calendario .= '<td></td>';
}

// Llenar los días del mes
for ($dia = 1; $dia <= $diasEnMes; $dia++) {
    $calendario .= '<td>' . $dia . '</td>';
    
    // Comprobar si es el último día de la semana
    if (($dia + $diaDeLaSemana) % 7 == 0) {
        $calendario .= '</tr><tr>';
    }
}

// Rellenar los espacios en blanco del final
while (($dia + $diaDeLaSemana) % 7 != 0) {
    $calendario .= '<td></td>';
    $dia++;
}

$calendario .= '</tr></table>';
?>
