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
                        $rol = '';
                    }else{
                        $button_label = 'Actualizar';
                        $method_name = 'update';
                        $id = $_REQUEST['id_rol'];
                        $rol = $_REQUEST['role'];
                        // echo 'VOY A EDITAR';
                    }

                    $form = '
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" id="formRole">
                                '. (isset($id) ? "<input type='hidden' name='id_rol' value=".$id.">" : "") .'

                                    <div class="form-group">
                                        
                                        <label for="role_name">
                                            Rol: 
                                        </label>
                                        <input id="role_name" name="rol" type="text" class="form-control" value="'.$rol.'"/>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4">
                                        <button 
                                            onclick="return roles(\''.$method_name.'\')" 
                                            class="btn bg-blue text-white">
                                            '.$button_label.'
                                        </button>
                                    </div>
                                    <input type="hidden" value="'.$method_name.'" name="action">
                                </form>
                            </div>
                        </div>
                    </div>
                    ';
                    return $form;
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
            $rol = $_POST['rol'];
            $insert_rol_query = '
                INSERT INTO rol ( rol ) 
                VALUES ( :rol );';
            
            $params = [':rol' => $rol,];
            
            $this->do_query($insert_rol_query, $params);
            $this->read();
        }

        function update(){
            $rol = $_POST['rol'];
            $id_rol = $_POST['id_rol'];
            
            $update_rol_query = '
                UPDATE rol SET rol = :rol 
                WHERE id_rol = :id_rol;';
            $params = [':rol' => $rol, ':id_rol' => $id_rol];

            $this->do_query($update_rol_query, $params);
            $this->read();
        }


        function read(){
            $get_user_query = 'SELECT * FROM rol';
            $this->get_query($get_user_query);

            $result = '
            <div id ="RolesTableContainer">
            <div class="d-flex justify-content-end mb-3">
                <button 
                    onclick="return roles(\'formNew\');"
                    class="btn btn-success btn-sm" title="Agregar nuevo rol">
                    <i class="bi bi-plus-lg"></i> Agregar Rol
                </button>
            </div>

            <div class="table-responsive">
            <table id="tableRoleData" class="table table-striped table-hover shadow-sm">
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
                        <th class='text-center'> ".$register['id_rol']." </th>
                        <td class='text-center'> ".$register['rol']." </td>
                        <td class='text-center'>
                            <div class='d-flex justify-content-center gap-2'>
                                <input type='image' 
                                    onclick='return roles(\"formEdit\", ".$register['id_rol'].", \"".$register['rol']."\");'
                                    class='svg-white' style='width: 30px;' 
                                    src='../images/icons/edit-button.svg' alt='Delete icon' srcset=''>

                                <input type='image' 
                                    onclick='return roles(\"delete\", \"".$register['id_rol']."\");'
                                    class='svg-white' style='width: 30px;' 
                                    src='../images/icons/delete.svg' alt='Delete icon' srcset=''>
                            </div>
                        </td>
                    </tr>";
            }
            $result .= '
                </tbody>
            </table>
            </div>
            </div>';

            echo $result;
        }

        function delete(){
            $id_rol = $_REQUEST['id_rol'];
            $delete_rol_query = 'DELETE FROM rol WHERE id_rol = :id_rol;';
            $params = [':id_rol' => $id_rol,];
            $this->do_query($delete_rol_query, $params);

            $this->read();
        }
    }


    $roleObject = new Role();
    if ( isset( $_REQUEST['action'] ) ){
        $action_case = $_REQUEST['action'];
        echo $roleObject->action( $action_case );
    }else{
        echo $roleObject->action('read');
    }
?>