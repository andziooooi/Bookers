<?php
session_start();
?>
<html>
<!DOCTYPE html>
<head lang="pl">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8"/>
    <title>Aktualności</title>
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
  
  <div class = "pocket" class = "pocket" id="pocket">

    <div id="nav">
      <div class="buttonsdiv"><button class="button buttonnav" onclick="AktualnościChange()">Aktualności</button></div> 
      <div class="buttonsdiv"><button class="button buttonnav" onclick="PrzegladajChange()">Przeglądaj książki</button></div>
      <div class="buttonsdiv"><button class="button buttonnav" onclick="MojeWypChange()">Moje wypożyczenia</button></div>
      <div class="buttonsdiv"><button class="button buttonnav" onclick="KontaktChange()">Kontakt</button></div>
      <div class="buttonsdiv"><button class="buttonnav buttonnavlast" onclick="MojProfChange()">Mój profil</button></div>    
    </div>
    <!-- Koniec części nawigującej -->
    <div id="content">
    <div class="divaktualHeader">
          Nowe godziny otwarcia!
        </div>
      <div class = "divaktual">
        <div class="divaktualtextpocket">
          <div class="divaktualtext">
            <p>Drodzy Czytelnicy,<br>Informujemy że od dnia jutrzejszego zostają zmienione godziny otwarcia<br>Nowe godziny otwarcia są dostępne w zakładce <button class="underline-button" onclick="KontaktChange()">Kontakt</button>!</p>
          </div>
        </div>
        <div class="divaktualfooter">
          dodano: 22-04-2024
        </div>
      </div>
      <div class="divaktualHeader">
          Prace konserwacyjne
        </div>
      <div class = "divaktual">

        <div class="divaktualtextpocket">
          <div class="divaktualtext">
            <p>Drodzy Czytelnicy,<br>W dniach 16 kwietnia - 21 maja 2024 r. <br>Strona wypożyczalni będzie niedostępna z powodu<br> trwacjących prac konserwacyjnych, przepraszamy!</p>
          </div>
        </div>
        <div class="divaktualfooter">
          dodano: 15-04-2024
        </div>
      </div>
      <div class="divaktualHeader">
          Nowe książki do wypożyczenia!
        </div>
      <div class = "divaktual">
        <div class="divaktualtextpocket">
          <div class="divaktualtext">
            <p>Drodzy Czytelnicy,<br>Od dzisiaj w naszej wypożyczalni dostępne są nowe książki<br>Zachęcamy do sprawdzenia zakładki <button class="underline-button" onclick="PrzegladajChange()">Przeglądaj</button>!! </p>
          </div>
        </div>
        <div class="divaktualfooter">
          dodano: 10-04-2024
        </div>
      </div>
      <div class="divaktualHeader">
          Nowe godziny otwarcia!
        </div>
      <div class = "divaktual">
        <div class="divaktualtextpocket">
          <div class="divaktualtext">
            <p>Drodzy Czytelnicy,<br>Informujemy, że z powodów stron trzecich<br>płatność kartą jest niemożliwa do odwołania<br>Płatność tylko przy odbiorze książki.<br>Za utrudnienia przepraszamy</p>
          </div>
      </div>
        <div class="divaktualfooter">
          dodano: 10-03-2024
        </div>
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