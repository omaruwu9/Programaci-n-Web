<?php 
    include '../classes/database.php';
    // session_start();
    
    class Equipo extends Database{

        var $message = '<p style="color: darkred; font-weight: 700;">';

        function action($action_case){
            switch ($action_case) {
                case 'formEdit':
                case 'formNew':

                    if ( $action_case == 'formNew' ){
                        $button_label = 'Crear';
                        $method_name = 'create';
                        $id_marca = '';
                        $id_equipo = '';
                        $no_serie = '';
                        $descripcion = '';
                    }else{
                        $button_label = 'Actualizar';
                        $method_name = 'update';
                        $id_marca = $_REQUEST['id_marca'];
                        $id = $_REQUEST['id_equipo'];
                        $no_serie = $_REQUEST['no_serie'];
                        $descripcion = $_REQUEST['descripcion'];
                    }

                    $form = '
                    <div class="container mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" >
                                '. (isset($id) ? "<input type='hidden' name='id_equipo' value=".$id.">" : "") .'

                                    <div class="form-group">
                                        <label for="role_name">
                                            Marca:
                                        </label> 
                                        '. $this->select_field('id_marca', 'marca', 'id_marca', 'marca') .' <!-- El primer parámetro es le valor de la variable cuando se hace un POST -->
                                    </div>

                                    <div class="form-group">
                                        <label for="role_name">
                                            Número de Serie: 
                                        </label>
                                        <input id="role_name" name="no_serie" type="number" class="form-control" value="'.$no_serie.'"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="role_name">
                                            Descripción: 
                                        </label>
                                        <input id="descripcion" name="descripcion" type="text" class="form-control" value="'.$descripcion.'"/>
                                    </div>

                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn bg-blue text-white">
                                            '.$button_label.'
                                        </button>
                                    </div>
                                    <input type="hidden" value="'.$method_name.'" name="action">
                                </form>
                            </div>
                        </div>
                    </div>
                    ';
                    echo $form;
                break;
                case 'create':
                    $this->create();
                    break;
                case 'update':
                    $this->update();
                    break;
                case 'read':
                    $this->read();
                break;
                case 'delete':
                    $this->delete();
                    break;
                default:
                    # code...
                    break;
            }
        }

        function create(){
            $id_marca = $_POST['id_marca'];
            $no_serie = $_POST['no_serie'];
            $descripcion = $_POST['descripcion'];

            $insert_equipo_query = '
                INSERT INTO equipo (  id_marca, no_serie, descripcion ) 
                VALUES ( :id_marca, :no_serie, :descripcion );';
            
            $params = [ ':id_marca' => $id_marca, ':no_serie' => $no_serie, ':descripcion' => $descripcion ];
            
            $this->do_query($insert_equipo_query, $params);
            $this->read();
        }

        function update(){
            $id = $_REQUEST['id_equipo'];
            $id_marca = $_POST['id_marca'];
            $no_serie = $_POST['no_serie'];
            $descripcion = $_POST['descripcion'];
            
            $update_equipo_query = '
                UPDATE equipo SET id_marca = :id_marca, descripcion = :descripcion, no_serie = :no_serie WHERE id_equipo = :id_equipo;';
            $params = [ ':id_equipo' => $id,':id_marca' => $id_marca, ':descripcion' => $descripcion, ':no_serie' => $no_serie, ];

            $this->do_query($update_equipo_query, $params);
            $this->read();
        }


        function read(){
            $get_user_query = 'SELECT * FROM equipo;';
            $this->get_query($get_user_query);

            $result = '
            <div class="d-flex justify-content-end mb-3">
                <form method="POST">
                    <button class="btn btn-success btn-sm" title="Agregar nuevo id_marca">
                        <i class="bi bi-plus-lg"></i> Agregar Equipo
                    </button>
                    <input type="hidden" name="action" value="formNew">
                </form>
            </div>

            <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm">
                <thead class="table-primary text-center">
                    <tr>
                        <th scope="col">Id Equipo</th>
                        <th scope="col">Marca</th>
                        <th scope="col">No. de serie</th>
                        <th scope="col">Descripción</th>
                        <th scope="col" style="width: 100px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>';

            foreach($this->query_results as $register){
                $result .= "
                    <tr>
                        <td class='text-center'> ".$register['id_equipo']." </td>
                        ". ( $this->td_field('marca', 'id_marca', 'marca', $register['id_marca'] ) ) ."

                        <td class='text-center'> ".$register['no_serie']." </td>
                        <td class='text-center'> ".$register['descripcion']." </td>
                        <td class='text-center'>
                            <div class='d-flex justify-content-center gap-2'>
                                <form method='POST' class='btn btn-primary'>
                                    <input type='image' class='svg-white' style='width: 25px;' src='../images/icons/edit-button.svg' alt='Edit icon' srcset=''>
                                    <input type='hidden' name='action' value='formEdit'>
                                    <input type='hidden' name='id_equipo' value=".$register['id_equipo'].">
                                    <input type='hidden' name='id_marca' value=".$register['id_marca'].">
                                    <input type='hidden' name='no_serie' value=".$register['no_serie'].">
                                    <input type='hidden' name='descripcion' value=\"".$register['descripcion']."\">
                                </form>
                                <form method='POST' class='btn btn-danger'>
                                    <input type='image' class='svg-white' style='width: 30px;' src='../images/icons/delete.svg' alt='Delete icon' srcset=''>
                                    <input type='hidden' name='action' value='delete'>
                                    <input type='hidden' name='id_equipo' value=".$register['id_equipo'].">
                                </form>
                            </div>
                        </td>
                    </tr>";
            }
            $result .= '
                </tbody>
            </table>
            </div>';

            echo $result;
        }

        function delete(){
            $id_equipo = $_REQUEST['id_equipo']; 
            $delete_rol_query = 'DELETE FROM equipo WHERE id_equipo = :id_equipo;';
            $params = [':id_equipo' => $id_equipo,];
            $this->do_query($delete_rol_query, $params);

            $this->read();
        }
    }


    $equipoObject = new Equipo();
    if ( isset($_REQUEST['action']) ){
        $action_case = $_REQUEST['action'];
        echo $equipoObject->action( $action_case );
    }else{
        echo $equipoObject->action('read');
    }
?>