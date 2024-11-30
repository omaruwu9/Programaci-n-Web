<?php 
    include '../classes/database.php';    // session_start();
    
    class Renta extends Database{

        var $message = '<p style="color: darkred; font-weight: 700;">';

        function action($action_case){
            switch ($action_case) {
                case 'read':
                    $this->read();
                break;
                case 'readUserHistory':
                    $this->readUserHistory($id_usuario);
                break;
                default:
                    # code...
                    break;
            }
        }


        function read(){
            $get_user_query = 
            'SELECT 
                *,
                cli.nombres as cliente,
                emp.nombres as empleado,
                pago.forma_pago as forma_pago,
                renta.estado_renta as estado_renta
            FROM renta re
            left JOIN usuario cli
            on re.id_usuario_cliente = cli.id_usuario
            LEFT join usuario emp
            on re.id_usuario_empleado = emp.id_usuario
            LEFT join estado_renta renta
            on re.id_estado_renta = renta.id_estado_renta
            LEFT join forma_pago pago
            on re.id_forma_pago = pago.id_forma_pago;';
            

            $this->get_query($get_user_query);
            $result = '
            <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm">
                <thead class="table-primary text-center">
                    <tr>
                        <th scope="col">Id Renta</th>
                        <th scope="col">Empleado</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Id Equipo</th>
                        <th scope="col">Forma de pago</th>
                        <th scope="col">Estado de la renta</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Duración</th>
                        <th scope="col">Costo</th>
                    </tr>
                </thead>
                <tbody>';

            foreach($this->query_results as $register){
                $result .= "
                    <tr>
                        <th class='text-center'> ".$register['id_renta']." </th>
                        <td class='text-center'> ".$register['empleado']." </td>
                        <th class='text-center'> ".$register['cliente']." </th>
                        <th class='text-center'> ".$register['id_equipo']." </th>
                        <th class='text-center'> ".$register['forma_pago']." </th>
                        <td class='text-center'> ".$register['estado_renta']." </td>
                        <th class='text-center'> ".$register['fecha']." </th>
                        <th class='text-center'> ".$register['hora']." </th>
                        <th class='text-center'> ".$register['duracion']." </th>
                        <td class='text-center'> ".$register['costo']." </td>
                    </tr>";
            }
            $result .= '
                </tbody>
            </table>
            </div>';

        }

        function readUserHistory($id_usuario) {
            $get_user_query = 
            'SELECT 
                *,
                cli.nombres as cliente,
                emp.nombres as empleado,
                pago.forma_pago as forma_pago,
                renta.estado_renta as estado_renta
            FROM renta re
            LEFT JOIN usuario cli
                ON re.id_usuario_cliente = cli.id_usuario
            LEFT JOIN usuario emp
                ON re.id_usuario_empleado = emp.id_usuario
            LEFT JOIN estado_renta renta
                ON re.id_estado_renta = renta.id_estado_renta
            LEFT JOIN forma_pago pago
                ON re.id_forma_pago = pago.id_forma_pago
            WHERE re.id_usuario_cliente = ?';  // Usamos ? como marcador de posición

            $params = [$id_usuario];  // Pasamos el parámetro
            $this->get_query($get_user_query, $params);
            
            $result = '
            <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm">
                <thead class="table-primary text-center">
                    <tr>
                        <th scope="col">Id Renta</th>
                        <th scope="col">Empleado</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">No. de serie</th>
                        <th scope="col">Forma de pago</th>
                        <th scope="col">Estado de la renta</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Duración</th>
                        <th scope="col">Costo</th>
                    </tr>
                </thead>
                <tbody>';

            foreach($this->query_results as $register){
                $result .= "
                    <tr>
                        <th class='text-center'> ".$register['id_renta']." </th>
                        <td class='text-center'> ".$register['empleado']." </td>
                        <th class='text-center'> ".$register['cliente']." </th>
                        <th class='text-center'> ".$register['id_equipo']." </th>
                        <th class='text-center'> ".$register['forma_pago']." </th>
                        <td class='text-center'> ".$register['estado_renta']." </td>
                        <th class='text-center'> ".$register['fecha']." </th>
                        <th class='text-center'> ".$register['hora']." </th>
                        <th class='text-center'> ".$register['duracion']." </th>
                        <td class='text-center'> ".$register['costo']." </td>
                    </tr>";
            }

            $result .= '
                </tbody>
            </table>
            </div>';

            echo $result;
        }

    }


    $equipoObject = new Renta();
    if ( isset($_REQUEST['action']) ){
        $action_case = $_REQUEST['action'];
        echo $equipoObject->action( $action_case );
    }else{
    }
?>