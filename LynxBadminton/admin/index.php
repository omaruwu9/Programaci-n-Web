<?php 
    session_start();
    if( $_SESSION['admin'] != 1 ){
        header('location: ../index.php?m="NO eres admin"');
    }
?>

<?php 
include './views/header-admin.php';  
?>
    <h1>SOY EL ADMIN</h1>

    <div class="text-center my-4">
            <img src="
                <?php 
                    if ( $_SESSION['photo'] > "" ){
                        echo '../images/users/'.$_SESSION['user_id'].'.'.$_SESSION['photo'].'';
                    } else{
                        echo '../images/users/user.jpg';
                    }
                ?>
            " alt="Foto de perfil" class="rounded-circle mb-2" width="300" height="300">
            <h1 class="text-center color-blue">
                <?php 
                    echo $_SESSION['user_name'];
                ?>
            </h1>
            <p class="text-muted">Administrador desde 2024</p>
    </div>
</body>

<?php include 'views/footer.php'; ?>
</html>