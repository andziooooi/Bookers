<?php
session_start();
if(!isset($_SESSION["userlogged"])){
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<head lang="pl">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8"/>
    <title> Zmień Hasło</title>
    <link rel="icon" type="image/x-icon" href="Ikona.ico">
    <meta name="description" content = "Super strona o ksiazkach" />
    <meta name="keywords" content="ksiazka,wpozyczalnia,najlepsze ksiazki"/>
    <meta name="author" content="Michał Andrzyk"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylereal.css" type="text/css"/>
</head>
<body>
<div class="registerloginpocket">
    <div class="RegLogHeader">
        <h1>Zmień hasło<h1>
        <h3>Rozmyśliłeś się?</h3>
        <button class="underline-button" onclick="RegisterPage()">Powrót</button>
    </div>
    <?php
    $borderColorNewPassword = ' 0,5px black';
    $borderColorPassword = ' 0,5px black'; 
    if(isset($_POST["change"])){
        $Password = $_POST["Password"];
        $PasswordHash =password_hash($Password,PASSWORD_DEFAULT);
        $NewPassword = $_POST["NewPassword"];
        $NewPasswordHash = password_hash($NewPassword,PASSWORD_DEFAULT);
        $NewPasswordRepeat = $_POST["NewPasswordRepeat"];
        require_once "database.php";
        $sql = "SELECT * FROM client WHERE ClientID =". $_SESSION['UserID'].";";
        $result = mysqli_query($conn,$sql);
        $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
        if($user){
            $errors = array();
            if(!password_verify($Password,$user["Password"])){
                $borderColorPassword = '1px solid red';
                array_push($errors,"Błędne hasło");
            }
            if($NewPassword !== $NewPasswordRepeat){
                array_push($errors,"Hasła nie są takie same");
                $borderColorNewPassword = '1px solid red';
            }
            if(strlen($NewPassword)<8){
                $borderColorNewPassword = '1px solid red';
                array_push($errors,"Hasło musi mieć minimum 8 znaków!");
            }
            if(count($errors)>0)
            {
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }else{
                $sql = "UPDATE client SET Password = ? WHERE ClientID = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $NewPasswordHash, $_SESSION['UserID']);
                
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'> Hasło Zmienione!</div>";
                    session_destroy();
                    header("Refresh: 2");
                } else {
                    echo "Błąd: " . $stmt->error;
                }      
            }

        }else{
            echo "<div class= 'alert alert-danger'> Błędny Login</div>";
        }

    }
    ?>
    <form action="PasswordChange.php" method="post">
        <div class="form-group">
            <div class="form-title">
                Stare hasło
            </div>
            <input type="password" class="form-control" name="Password" placeholder="min. 8 znaków" style="border: <?php echo $borderColorPassword; ?>;">
        </div>
        <div class="form-group">
            <div class="form-title">
                Nowe hasło
            </div>
            <input type="password" class="form-control" name="NewPassword" placeholder="min. 8 znaków" style="border: <?php echo $borderColorNewPassword; ?>;">
        </div>
        <div class="form-group">
            <div class="form-title">
                Powtórz nowe hasło
            </div>
            <input type="password" class="form-control" name="NewPasswordRepeat" placeholder="min. 8 znaków" style="border: <?php echo $borderColorNewPassword; ?>;">
        </div>
        <div class = "form-btn">
            <input type="submit" class="btn btn-primary" value="Zmień hasło" name="change">
        </div>       
    </form>
</div>
    <script>
        function RegisterPage(){
            window.location.assign('./MojProf.php');
        }
    </script>
</body>