<?php 
    include '../classes/database.php';

    class Equipo extends Database{
        // Función para obtener equipos disponibles
        public function get_equipos_disponibles() {
            $query = "SELECT * FROM vw_EquipoDetalle;";
            $this->get_query($query);
            return $this->query_results;
        }

        var $message = '<p style="color: darkred; font-weight: 700;">';

        // Método para gestionar diferentes acciones
        function action($action_case){
            switch ($action_case) {
                case 'read':
                    $this->read();  // Solo se ejecuta cuando 'action' es 'read'
                    break;
                default:
                    break;
            }
        }

        // Método para leer los equipos desde la base de datos
        function read(){
            $get_user_query = 'SELECT * FROM vw_EquipoDetalle;';
            $this->get_query($get_user_query);

            $result = '
            <div class="table-responsive">
                <table class="table table-striped table-hover shadow-sm">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">ID Equipo</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Número de Serie</th>
                            <th scope="col">Descripción</th>
                        </tr>
                    </thead>
                    <tbody>';

            // Genera las filas de la tabla a partir de los resultados
            foreach($this->query_results as $register){
                $result .= "
                    <tr>
                        <td class='text-center'>".$register['ID_Equipo']."</td>
                        <td class='text-center'>".$register['Marca']."</td>
                        <td class='text-center'>".$register['Numero_Serie']."</td>
                        <td class='text-center'>".$register['Descripcion']."</td>
                    </tr>";
            }

            $result .= '
                </tbody>
            </table>
            </div>';

            echo $result;  // Imprime solo una vez
        }
    }

    // Crea una instancia del objeto 'Equipo'
    $equipoObject = new Equipo();
    
    // Verifica si 'action' está presente en la solicitud
    if ( isset($_REQUEST['action']) ){
        $action_case = $_REQUEST['action'];
        echo $equipoObject->action($action_case);  // Ejecuta la acción según 'action'
    } else {
    }
?>
