<head lang="pl">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8"/>
    <title> Rejestracja</title>
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
            <h1>Zarejestuj się!</h1>
            <h3>Masz konto?</h3>
            <button class="underline-button" onclick="LoginPage()">Zaloguj się!</button>
        </div>

    <?php
        $borderColorLogin = ' 0,5px black';
        $borderColorPassword = ' 0,5px black';
        $borderColorEmail = ' 0,5px black';
        $borderColorPesel = ' 0,5px black';
        $borderColorRepeatPassword = ' 0,5px black';
        if(isset($_POST["submit"])){
            $Login = $_POST["Login"];
            $Email = $_POST["Email"];
            $Password = $_POST["Password"];
            $PasswordHash = password_hash($Password,PASSWORD_DEFAULT);
            $Repeat_Password = $_POST["Repeat_Password"];
            $Name = $_POST["Name"];
            $Surname = $_POST["Surname"];
            $Pesel = $_POST["Pesel"];
            
            $errors = array();
            if(empty($Login) or empty($Email) or empty($Password) or empty($Repeat_Password) or empty($Name) or empty($Surname) or empty($Pesel)){
                array_push($errors,"Wszystkie pola są wymagane");

            }
            if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
                array_push($errors,"Nieprawidłowy adres E-mail");
                $borderColorEmail = '1px solid red';
            }
            if(strlen($Password)<8){
                $borderColorPassword = '1px solid red';
                array_push($errors,"Hasło musi mieć minimum 8 znaków!");
               
            }
            if($Password !== $Repeat_Password){
                array_push($errors,"Hasła nie są takie same");
                $borderColorPassword = '1px solid red';
                $borderColorRepeatPassword = '1px solid red';
            }
            if(strlen($Pesel)!==11){
                array_push($errors,"Podano błędny Pesel");
                $borderColorPesel = '1px solid red';
            }
            require_once("Database.php");
            $sql = "SELECT * FROM client WHERE Email = '$Email'";
            $result = mysqli_query($conn,$sql);
            $rowcount = mysqli_num_rows($result);
            if($rowcount > 0){
                array_push($errors,"Podany Email jest już zarejestrowany!");
                $borderColorEmail = '1px solid red';
            }
            $sql = "SELECT * FROM client WHERE Login = '$Login'";
            $result = mysqli_query($conn,$sql);
            $rowcount = mysqli_num_rows($result);
            if($rowcount > 0){
                array_push($errors,"Podany Login jest już zajęty!");
                $borderColorLogin = '1px solid red';
            }
            $sql = "SELECT * FROM client WHERE Pesel = '$Pesel'";
            $result = mysqli_query($conn,$sql);
            $rowcount = mysqli_num_rows($result);
            if($rowcount > 0){
                array_push($errors,"Podany Pesel jest przypisany do innego konta!");
                $borderColorPesel = '1px solid red';
            }
            if(count($errors)>0)
            {
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }else{
                
                $sql = "INSERT INTO client (Login,Password,Email,Name,Surname,Pesel) values('$Login','$PasswordHash','$Email','$Name','$Surname','$Pesel')";
                if(mysqli_query($conn, $sql)){
                    echo "<div class='alert alert-success'> Zarejestrowano Cie!</div>";
                }else{
                    die("Coś poszło nie tak");
                }
            }
        }
        ?>
        <form action="Register.php" method="post">

            <div class="form-group">
                <div class="form-title">
                    Adres E-mail
                </div>
                <input type="email" class="form-control" name="Email" placeholder="przykład@gmail.com" pattern="[A-Za-z0-9.@]*" style="border: <?php echo $borderColorEmail; ?>;">
            </div>
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
            <div class="form-group">
                <div class="form-title">
                    Powtórz hasło
                </div>
                <input type="password" class="form-control" name="Repeat_Password" placeholder="min. 8 znaków" style="border: <?php echo $borderColorRepeatPassword; ?>;">
            </div>
            <div class="form-group">
                <div class="form-title">
                    Imie
                </div>
                <input type="text" class="form-control" pattern="[A-Za-zĄąĆćĘęŁłŃńÓóŚśŹźŻż]+" name="Name" placeholder="Jan">
            </div>
            <div class="form-group">
                <div class="form-title">
                    Nazwisko
                </div>
                <input type="text" class="form-control" pattern="[A-Za-zĄąĆćĘęŁłŃńÓóŚśŹźŻż]+" name="Surname" placeholder="Nowak">
            </div>
            <div class="form-group">
                <div class="form-title">
                    Pesel
                </div>
                <input type="text" class="form-control" name="Pesel" pattern="[0-9]+"  placeholder="Pesel"style="border: <?php echo $borderColorPesel; ?>;">
            </div>
            <div class = "form-btn">
                <input type="submit" class="btn btn-primary" value="Zarejestruj" name="submit">
            </div>                       
        </form>

    </div>
    <script src="js/script.js"></script>

</body>