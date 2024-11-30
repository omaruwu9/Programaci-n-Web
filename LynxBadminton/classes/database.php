<?php
    require "../config/config.php";

    class Database{
        var $connection;
        var $query_results;
        var $query_results_num;

        private function connect(){
            try {
                $dsn =  SGDB.':host='.DBHOST.';dbname='.DBNAME;
                $this->connection = new PDO($dsn, DBUSER, DBPASS);
            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }

        private function close_connection(){
            try{
                $this->connection = null;
            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }

        function do_query($query = '', $query_params = []){
            if ( strlen($query) == 0 ){
                return;
            }

            try {
                $this->connect();
                $stmt = $this->connection->prepare($query);
                foreach ($query_params as $key => $value) {
                    $stmt->bindValue($key, $value);
                }
                $stmt->execute();
                // if (stripos($query, 'select') !== false) {
                //     $this->query_results = $stmt;
                //     $this->query_results_num = $stmt->rowCount();
                // }
                $this->query_results = $stmt;
                $this->query_results_num = $stmt->rowCount();
                $this->close_connection();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        # $fetch_mode = PDO::FETCH_ASSOC es paraq devolver el query como array asociativo
        function get_query($query = '', $query_params = [], $fetch_mode = PDO::FETCH_ASSOC){
            try {
                $this->connect();
                $stmt = $this->connection->prepare($query);

                if (count($query_params) > 1){
                    foreach ($query_params as $key => $value) {
                        $stmt->bindValue($key, $value);
                    }
                }
                $stmt->execute();
                $this->query_results_num = $stmt->rowCount();
                $this->query_results = $stmt->fetchAll($fetch_mode);
                $this->close_connection();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        function select_field($new_field, $table_name, $table_pk, $display_field){
            $get_user_query = 'SELECT * FROM '.$table_name.' order by '.$table_pk.';';
            $this->get_query($get_user_query);

            $res = " 
                <select class='form-control' name='".$new_field."'>";

            foreach ( $this->query_results as $register ) { 
                $res .= "
                    <option value='".$register[$table_pk]."'> ".$register[$display_field]." </option>
                ";
            }

            $res .= "</select>";
            return $res;
        }

        function td_field( $table_name, $table_pk, $display_field, $id_value){
            $get_user_query = 'SELECT '.$display_field.' FROM '.$table_name.' where '.$table_pk.' = '.$id_value.';';
            $this->get_query($get_user_query);

            $res = " 
            <td class='text-center'>";

            foreach ( $this->query_results as $register ) { 
                $res .= $register[$display_field];
            }

            $res .= "</td>";
            return $res;
        }
    }

?>