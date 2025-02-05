<?php
session_start();
if(isset($_SESSION["userlogged"])){
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<head lang="pl">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8"/>
    <title> Zaloguj się!</title>
    <link rel="icon" type="image/x-icon" href="Ikona.ico">
    <meta name="description" content = "Super strona o ksiazkach" />
    <meta name="keywords" content="ksiazka,wpozyczalnia,najlepsze ksiazki"/>
    <meta name="author" content="Michał Andrzyk"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylereal.css" type="text/css"/>
</head>
<body>
<div class="registerloginpocket">
    <button class="underline-button" onclick="AktualnościChange()">Strona główna</button>
    <div class="RegLogHeader">
        <h1>Zaloguj się!</h1>
        <h3>Nie masz jeszcze konta?</h3>
        <button class="underline-button" onclick="RegisterPage()">Zarejestruj się!</button>
    </div>
    <?php
    $borderColorLogin = ' 0,5px black';
    $borderColorPassword = ' 0,5px black'; 
    if(isset($_POST["loginbtn"])){
        $Login = $_POST["Login"];
        $Password = $_POST["Password"];
        require_once "database.php";
        $sql = "SELECT* FROM client WHERE Login = '$Login'";
        $result = mysqli_query($conn,$sql);
        $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
        if($user){
            if(password_verify($Password,$user["Password"])){
                
                session_start();
                $_SESSION["userlogged"] = "yes";
                $sql = "SELECT * FROM client where Login = '$Login'";
                $query = mysqli_query($conn,$sql);
                $numrows=mysqli_num_rows($query);
                while($row = mysqli_fetch_assoc($query))
                {
                    $dblogin = $row['Login'];
                    $dbClientID = $row['ClientID'];
                    $dbPesel = $row['Pesel'];
                    $dbName = $row['Name'];
                    $dbSurname = $row['Surname'];
                }
                $_SESSION["User"] = $dbName;
                $_SESSION["UserID"] = $dbClientID;
                header("Location: index.php");
                die();
            }else{
                echo "<div class= 'alert alert-danger'> Błędne hasło</div>";
            }
        }else{
            echo "<div class= 'alert alert-danger'> Błędny Login</div>";
        }
    }
    ?>
    <form action="Login.php" method="post">
        <div class="form-group">
            <div class="form-title">
                Login
            </div>
            <input type="text" class="form-control" name="Login" placeholder="Login" pattern="[A-Za-z0-9]+" style="border: <?php echo $borderColorLogin; ?>;">
        </div>
        <div class="form-group">
            <div class="form-title">
                Hasło
            </div>
            <input type="password" class="form-control" name="Password" placeholder="min. 8 znaków" style="border: <?php echo $borderColorPassword; ?>;">
        </div>
        <div class = "form-btn">
            <input type="submit" class="btn btn-primary" value="Zaloguj" name="loginbtn">
        </div>       
    </form>
</div>
    <script src="js/script.js"></script>
</body>