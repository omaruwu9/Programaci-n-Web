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
                        $forma_pago = '';
                    }else{
                        $button_label = 'Actualizar';
                        $method_name = 'update';
                        $id = $_REQUEST['id_forma_pago'];
                        $forma_pago = $_REQUEST['forma_pago'];
                        // echo 'VOY A EDITAR';
                    }

                    $form = '
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" >
                                '. (isset($id) ? "<input type='hidden' name='id_forma_pago' value=".$id.">" : "") .'

                                    <div class="form-group">
                                        
                                        <label for="role_name">
                                            Formas de pago: 
                                        </label>
                                        <input id="role_name" name="forma_pago" type="text" class="form-control" value="'.$forma_pago.'"/>
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
            $forma_pago = $_POST['forma_pago'];
            $insert_rol_query = '
                INSERT INTO forma_pago ( forma_pago ) 
                VALUES ( :forma_pago );';
            
            $params = [':forma_pago' => $forma_pago,];
            
            $this->do_query($insert_rol_query, $params);
            $this->read();
        }

        function update(){
            $forma_pago = $_POST['forma_pago'];
            $id_forma_pago = $_POST['id_forma_pago'];
            
            $update_rol_query = '
                UPDATE forma_pago SET forma_pago = :forma_pago 
                WHERE id_forma_pago = :id_forma_pago;';
            $params = [':forma_pago' => $forma_pago, ':id_forma_pago' => $id_forma_pago];

            $this->do_query($update_rol_query, $params);
            $this->read();
        }


        function read(){
            $get_user_query = 'SELECT * FROM forma_pago';
            $this->get_query($get_user_query);

            $result = '
            <div class="d-flex justify-content-end mb-3">
                <form method="POST">
                    <button class="btn btn-success btn-sm" title="Agregar nueva forma_pago">
                        <i class="bi bi-plus-lg"></i> Agrega Forma de Pago
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
                        <th class='text-center'> ".$register['id_forma_pago']." </th>
                        <td class='text-center'> ".$register['forma_pago']." </td>
                        <td class='text-center'>
                            <div class='d-flex justify-content-center gap-2'>
                                <form method='POST' class='btn btn-primary'>
                                    <input type='image' class='svg-white' style='width: 25px;' src='../images/icons/edit-button.svg' alt='Edit icon' srcset=''>
                                    <input type='hidden' name='action' value='formEdit'>
                                    <input type='hidden' name='forma_pago' value=".$register['forma_pago'].">
                                    <input type='hidden' name='id_forma_pago' value=".$register['id_forma_pago'].">
                                </form>
                                <form method='POST' class='btn btn-danger'>
                                    <input type='image' class='svg-white' style='width: 30px;' src='../images/icons/delete.svg' alt='Delete icon' srcset=''>
                                    <input type='hidden' name='action' value='delete'>
                                    <input type='hidden' name='id_forma_pago' value=".$register['id_forma_pago'].">
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
            $id_forma_pago = $_REQUEST['id_forma_pago']; 
            $delete_rol_query = 'DELETE FROM forma_pago WHERE id_forma_pago = :id_forma_pago;';
            $params = [':id_forma_pago' => $id_forma_pago,];
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