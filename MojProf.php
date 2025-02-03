<?php
session_start();
?>
<html>
<!DOCTYPE html>
<head lang="pl">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8"/>
    <title>Mój Profil</title>
    <link rel="icon" type="image/x-icon" href="Ikona.ico">
    <meta name="description" content = "Super strona o ksiazkach" />
    <meta name="keywords" content="ksiazka,wpozyczalnia,najlepsze ksiazki"/>
    <meta name="author" content="Michał Andrzyk"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylereal.css" type="text/css"/>
</head>
<body>
  <div id="header">
    <div id="logo">
      <a href="./index.php">
        <img src="./image/logo.png" height="100" width = "auto">
      </a>
    </div>
    <div id="login">
        <?php
        if(isset( $_SESSION['userlogged'])){
          echo "<div id='loginnamediv'>Witaj " . $_SESSION['User'] . "!</div>";
        }else{
          echo"<div id='loginimagediv'><img src='./image/user.png' alt='obrazek' class='imagelogin'></div>";
        }
        ?>  
      <div id ="loginbuttonslogin">
        <?php
        if(isset( $_SESSION['userlogged'])){
          
          
          echo ("<button class = 'button buttonlogin' onclick='Logout()'>Wyloguj się</button>");
          
        } else {
          echo("<button class = 'button buttonlogin' onclick='LoginPage()'>Zaloguj się</button>");
        }
        ?>
        
      </div>
    </div>
  </div>
  
  <div class = "pocket" id="pocket">

    <div id="nav">
      <div class="buttonsdiv"><button class="button buttonnav" onclick="AktualnościChange()">Aktualności</button></div> 
      <div class="buttonsdiv"><button class="button buttonnav" onclick="PrzegladajChange()">Przeglądaj książki</button></div>
      <div class="buttonsdiv"><button class="button buttonnav" onclick="MojeWypChange()">Moje wypożyczenia</button></div>
      <div class="buttonsdiv"><button class="button buttonnav" onclick="KontaktChange()">Kontakt</button></div>
      <div class="buttonsdiv"><button class="buttonnav buttonnavlast" onclick="MojProfChange()">Mój profil</button></div>    
    </div>
    <!-- Koniec części nawigującej -->
    <div id="content">
<?php
require_once "Database.php";
if(isset($_SESSION['userlogged'])){
$sql = "SELECT Name,Surname,Login,Password,Pesel,Email FROM client WHERE ClientID =".$_SESSION['UserID'].";";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
echo(
    "<div id='KontaktPocket'>
    <div class='KontaktHeader KontaktHeaderFirst'>Twoje Dane</div>
    <div class='MojProfData'>
        <table class='TableMojProf'>
        <tbody>
             <tr>
                <td class='TableMojProfFirst'>Login:</td>
                <td class='TableMojProf'>".$row['Login']."</td>
            </tr>       
            <tr>
                <td class='TableMojProfFirst'>Imie:</td>
                <td class='TableMojProf'>".$row['Name']."</td>
            </tr>
            <tr>
                <td class='TableMojProfFirst'>Nazwisko:</td>
                <td class='TableMojProf'>".$row['Surname']."</td>
            </tr>
            <tr>
                <td class='TableMojProfFirst'>Pesel:</td>
                <td class='TableMojProf'>".$row['Pesel']."</td>
            </tr>
            <tr>
                <td class='TableMojProfFirst'>E-mail:</td>
                <td class='TableMojProf'>".$row['Email']."</td>
            </tr>

        </tbody>
        </table>
  </div>
  <div class='MojProfButtons'>
        <form method='post' action ='PasswordChange.php'>
        <button type='submit' class='btn btn-primaryMojProf' name='Change'>
            Zmień Hasło
        </button>
        </form>
            <br>
        <form method='post' action ='MojProf.php'>
        <button type='submit' class='btn btn-primarynomarginredMojProf' name='Delete'>
            Usuń Konto (Trwale!!!)
        </button>
        </form>
  </div>"
);
}else{
    echo("<h1 style='text-align: center; color: red;'>Zaloguj się by zobaczyć swój profil!</h1>");
}

if(isset($_POST['Delete'])){
    echo("<div class='overlay'> <!-- Overlay, który przyciemni resztę strony -->
    </div>");
    echo(
        "<div class='rentconfirm'>
          <div class='rentinfo'>
            <h1>Czy jesteś pewny?</h1>
            <h3>Konto zostanie TRWALE USUNIĘTE</h3>
          </div>
          <div class='rentbuttons'>
            <form action='MojProf.php' method='post'>
            <input type='hidden' name='rental' value ='true'>
            <input type='submit' class='btn btn-primarynomargindelete' value='Anuluj' name='confirmationfalse'>
            </form>
            <form action='MojProf.php' method='post'>
            <input type='hidden' name='rental' value ='false'>
            <input type='submit' class='btn btn-primarynomarginreddelete' value='Usuń' name='confirmationtrue'>
            </form>
          </div>        
        </div>");
}
    if(isset($_POST['confirmationtrue'])) {
    $query = "SELECT books.BookID,AuthorID,Price,Title,OrderID,OrderDate,ReturnDate,status FROM books,client,orders WHERE client.ClientID = orders.ClientID and books.BookID = orders.BookID and status not LIKE \"Oddano\" and client.ClientID =". $_SESSION["UserID"];
    $result = $conn->query($query);
    if ($result->num_rows > 0){echo("<div class= 'custom-alert-bad'>Masz aktywne wypożyczenia, nie można usunąć konta</div>");}
    else{
      $query = "DELETE FROM orders WHERE status LIKE \"Oddano\" and ClientID =". $_SESSION["UserID"];
      $conn->query($query);
        $sqlbutton = "DELETE from client WHERE ClientID =". $_SESSION['UserID'].";";
        if ($conn->query($sqlbutton) === TRUE) {
          echo "<div class='custom-alert-bad'>Konto usunięte!</div>";
          session_destroy();
          header("Refresh: 2");
      } else { echo "Error updating record: " . $conn->error;}}
    }
   if(isset($_POST['confirmationfalse'])){header("Refresh: 1");}
  

?>
    </div>
  </div>
  <script type="text/javascript">
    function AktualnościChange() {
      
      window.location.href = "index.php";
    }
    function PrzegladajChange() {
      window.location.href ="przegladaj.php";
    }
    function MojeWypChange() {
      window.location.href ="MojeWyp.php";
    }
    function KontaktChange() {
      window.location.href ="Kontakt.php";
    }
    function MojProfChange() {
      window.location.href = "MojProf.php";
    }
    function scrollToTop() {
      window.scrollTo({
        top: 0,
        behavior: 'instant'
      });
    }
    function LoginPage(){
      window.location.assign('./login.php');
    }
    function Logout() {
      window.location.href = "Logout.php";
    }
  </script>
    </div>
<footer>
    <div class="footer-content">
        <p style="margin-top:10px;">© 2024 Michał Andrzyk</p>
    </div>
</footer>
</body> 
</html>