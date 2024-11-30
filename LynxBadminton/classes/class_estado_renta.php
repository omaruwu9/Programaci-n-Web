<?php 
    include '../classes/database.php';
    // session_start();
    
    class Role extends Database{

        var $message = '<p style="color: darkred; font-weight: 700;">';

        function action($action_case){
            switch ($action_case) {
                case 'formEdit':
                case 'formNew':

                    if ( $action_case == 'formNew' ){
                        $button_label = 'Crear';
                        $method_name = 'create';
                        $estado_renta = '';
                    }else{
                        $button_label = 'Actualizar';
                        $method_name = 'update';
                        $id = $_REQUEST['id_estado_renta'];
                        $estado_renta = $_REQUEST['estado_renta'];
                        // echo 'VOY A EDITAR';
                    }

                    $form = '
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" >
                                '. (isset($id) ? "<input type='hidden' name='id_estado_renta' value=".$id.">" : "") .'

                                    <div class="form-group">
                                        
                                        <label for="role_name">
                                            Estado Renta: 
                                        </label>
                                        <input id="role_name" name="estado_renta" type="text" class="form-control" value="'.$estado_renta.'"/>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4">
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
            // echo ' VAMOS A HACER UN INSERT ';
            $estado_renta = $_POST['estado_renta'];
            $insert_rol_query = '
                INSERT INTO estado_renta ( estado_renta ) 
                VALUES ( :estado_renta );';
            
            $params = [':estado_renta' => $estado_renta,];
            
            $this->do_query($insert_rol_query, $params);
            $this->read();
        }

        function update(){
            $estado_renta = $_POST['estado_renta'];
            $id_estado_renta = $_POST['id_estado_renta'];
            
            $update_rol_query = '
                UPDATE estado_renta SET estado_renta = :estado_renta 
                WHERE id_estado_renta = :id_estado_renta;';
            $params = [':estado_renta' => $estado_renta, ':id_estado_renta' => $id_estado_renta];

            $this->do_query($update_rol_query, $params);
            $this->read();
        }


        function read(){
            $get_user_query = 'SELECT * FROM estado_renta';
            $this->get_query($get_user_query);

            $result = '
            <div class="d-flex justify-content-end mb-3">
                <form method="POST">
                    <button class="btn btn-success btn-sm" title="Agregar nuevo estado_renta">
                        <i class="bi bi-plus-lg"></i> Agregar Estado Renta
                    </button>
                    <input type="hidden" name="action" value="formNew">
                </form>
            </div>

            <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm">
                <thead class="table-primary text-center">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col" style="width: 100px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>';

            foreach($this->query_results as $register){
                $result .= "
                    <tr>
                        <th class='text-center'> ".$register['id_estado_renta']." </th>
                        <td class='text-center'> ".$register['estado_renta']." </td>
                        <td class='text-center'>
                            <div class='d-flex justify-content-center gap-2'>
                                <form method='POST' class='btn btn-primary'>
                                    <input type='image' class='svg-white' style='width: 25px;' src='../images/icons/edit-button.svg' alt='Edit icon' srcset=''>
                                    <input type='hidden' name='action' value='formEdit'>
                                    <input type='hidden' name='estado_renta' value=".$register['estado_renta'].">
                                    <input type='hidden' name='id_estado_renta' value=".$register['id_estado_renta'].">
                                </form>
                                <form method='POST' class='btn btn-danger'>
                                    <input type='image' class='svg-white' style='width: 30px;' src='../images/icons/delete.svg' alt='Delete icon' srcset=''>
                                    <input type='hidden' name='action' value='delete'>
                                    <input type='hidden' name='id_estado_renta' value=".$register['id_estado_renta'].">
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
            $id_estado_renta = $_REQUEST['id_estado_renta']; 
            $delete_rol_query = 'DELETE FROM estado_renta WHERE id_estado_renta = :id_estado_renta;';
            $params = [':id_estado_renta' => $id_estado_renta,];
            $this->do_query($delete_rol_query, $params);

            $this->read();
        }
    }


    $roleObject = new Role();
    if ( isset($_REQUEST['action']) ){
        $action_case = $_REQUEST['action'];
        echo $roleObject->action( $action_case );
    }else{
        echo $roleObject->action('read');
    }
?>