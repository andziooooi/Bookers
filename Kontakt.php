<?php
session_start();
?>
<html>
<!DOCTYPE html>
<head lang="pl">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8"/>
    <title>Kontak</title>
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
    <div id="KontaktPocket">
    <div class="KontaktHeader KontaktHeaderFirst">Godziny Otwarcia</div>
    <div class="KontaktData">
      <table class="TableKontakt">
        <tbody>
          <tr>
            <td class="TableKontakt">Poniedziałek:</td>
            <td class="TableKontakt">08:00-16:00</td>
          </tr>
          <tr>
            <td class="TableKontakt">Wtorek:</td>
            <td class="TableKontakt">08:00-16:00</td>
          </tr>
          <tr>
            <td class="TableKontakt">Środa:</td>
            <td class="TableKontakt">08:00-16:00</td>
          </tr>
          <tr>
            <td class="TableKontakt">Czwartek:</td>
            <td class="TableKontakt">08:00-16:00</td>
          </tr>
          <tr>
            <td class="TableKontakt">Piątek:</td>
            <td class="TableKontakt">08:00-16:00</td>
          </tr>
          <tr>
            <td class="TableKontakt">Sobota:</td>
            <td class="TableKontakt">10:00-15:00</td>
          </tr>
          <tr>
            <td class="TableKontakt">Niedziela:</td>
            <td class="TableKontakt">Zamknięte</td>
          </tr>
        </tbody>
        </table>
      </div>
    <div class="KontaktHeader">Adres i kontakt</div>
    <div class="KontaktData">
      <table class="TableKontakt">
        <tbody>
          <tr>
            <td class="TableKontakt">Bookers</td>
            <td class="TableKontakt"></td>
          </tr>
          <tr>
            <td class="TableKontakt">ul. Nowoursynowska 1/5</td>
          </tr>
          <tr>
            <td class="TableKontakt">02-776 Warszawa</td>
          </tr>
          <tr>
            <td class="TableKontakt">tel: (+48 22)123 456 789</td>
          </tr>
        </tbody>
        </table>
    </div>
    <div class="KontaktHeader">Napisz do nas!</div>
    <div class="KontaktData">
        <form action="Kontakt.php" method="post">
            <div class="form-group">
              <label for="exampleFormControlInput1">Email kontaktowy</label>
              <input type="email" class="form-control" name="KEmail" placeholder="name@example.com">
            </div>
            <div class="form-group">
            <div class="form-group">
              <label for="exampleFormControlSelect1">W jakiej sprawie</label>
              <select class="form-control" name="KCase">
                <option>Sprawa1</option>
                <option>Sprawa2</option>
                <option>Sprawa3</option>
                <option>Sprawa4</option>
                <option>Sprawa5</option>
              </select>
            </div>
              <label for="exampleFormControlTextarea1">Temat</label>
              <input type="text" class="form-control" name="KTopic" maxlength="30"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Treść wiadomości</label>
              <textarea class="form-control" name="KMessage" rows="3"></textarea>
            </div>
            <div class="KontaktButton"><input type="submit" class="btn btn-primarynomarginreal" value="Wyślij" name="KontaktButtonik"> </div>
            
          </form>
    </div> 
</div>
  </div>
<?php
require_once "Database.php";
if(isset($_POST['KontaktButtonik'])){
  $Email = $_POST['KEmail'];
  $Case = $_POST['KCase'];
  $Topic = $_POST['KTopic'];
  $Message = $_POST['KMessage'];
  $sql = "INSERT INTO contactforms(Email,`Case`,Topic,`Message`) values('$Email','$Case','$Topic','$Message')";
  if ($conn->query($sql) === TRUE) {
    echo ("<div class='custom-alert-good'>Formularz wysłano</div>");
 }
}
?>
    </div>
<footer>
    <div class="footer-content">
        <p style="margin-top:10px;">© 2024 Michał Andrzyk</p>
    </div>
</footer>
<script src="js/script.js"></script>
</body> 
</html>
