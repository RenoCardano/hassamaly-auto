

    
    <?php
    /*
* This part allows to connect to database with the config.php and 
* We are taking login and password to check if user is an admin or an employee
*/
session_start();
    $login = $password = "";

if (isset($_POST['login'])){

    $login = $_POST['inputEmail'];
    $login  = securisation($login );


    $password = $_POST['inputPassword'];
    $password  = securisation($password);

    $query = "SELECT * FROM `adminstrateur` WHERE LOGIN='$login' and MDPADMIN='".hash('sha256', $password)."'";
    
    $result = mysqli_query($conn,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if($rows==1){        
        $_SESSION['username'] = $login;
         session_write_close();
        header("Location: dashboard/index.php");
        die();
    }else{
        ?>
        <script>
        swal({
title: "Erreur de login ou mot de passe!",
text: "Veuillez recommencer!",
icon: "warning",
button: "Rééssayer!",
});
    </script>
   <?php
    }

}

?>