<?php
session_start();
?>
<html>
<!DOCTYPE html>
<head lang="pl">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8"/>
    <title> Moje Wypożyczenia</title>
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

    require_once "database.php";
    if(isset($_SESSION["userlogged"])){
    $query = "SELECT books.BookID,AuthorID,Image,Price,Title,OrderID,OrderDate,ReturnDate,status FROM books,client,orders WHERE client.ClientID = orders.ClientID and books.BookID = orders.BookID and client.ClientID =". $_SESSION["UserID"]." ORDER BY OrderDate desc;";
    $result = $conn->query($query);
    if (isset($_POST['submit'])) {
      $orderid = $_POST['btnorderid'];
      $bookid = $_POST['btnbookid'];
      $sqlbutton = "UPDATE books SET quantity = quantity + 1 WHERE BookID = $bookid;";
      $sqlinc = mysqli_query($conn,$sqlbutton);
      $sql = "DELETE FROM orders WHERE OrderID = $orderid;";
      $sqldelete = mysqli_query($conn,$sql);
      if ($sqldelete){
          echo "<div class='custom-alert-bad'>Zamówienie anulowane</div>";
          header("Refresh: 2");
      }else {
      echo "Błąd zapytania: " . $mysqli->error;
      }
  }
    if ($result) {
    echo("<h1>Twoje Wypożyczenia:</h1>");
    if ($result->num_rows == 0){echo("<h2 style='text-align: center; color: red;'>Brak wypożyczeń</h2>");}
    while ($row = mysqli_fetch_assoc($result)) {
      echo("<div class='bookpocket'>");
      echo("<div class='bookimage'>");
      $imageData = $row['Image'];
      $base64Image = base64_encode($imageData);
      echo '<a href="book_image.php?BookID=' . $row['BookID'] . '" target="_blank"><img src="data:image/jpeg;base64,' . $base64Image . '" alt="Obraz książki width="auto" height="188px"> </a>';
      echo("</div>");
        $rowauthorid = $row['AuthorID'];
        $sql = "SELECT Name,Surname FROM `authors`,books WHERE `authors`.AuthorID = `books`.AuthorID and books.AuthorID = $rowauthorid";
        $rslt = $conn->query($sql);
        $rowAuthor = mysqli_fetch_assoc($rslt);
        echo("<div class='bookinfo'>
            <div class='booktitle'>" .
                $row['Title'] . "<br>" .
                $rowAuthor['Name'] . " " . $rowAuthor['Surname'] .
            "</div>"
        ."<div class ='bookproparties'>" .
              "Status zamówienia: " . $row['status']. 
            "</div>"
        ."<div class = 'bookdescription'>
            Data zamówienia: " . $row['OrderDate']. ", Oczekiwana data zwrotu: " . $row['ReturnDate'] . "." .
        "</div>
        </div>
        <div class='bookbuttonpocket'>");
        if($row['status'] === 'Gotowe do odbioru'){echo("<form action='MojeWyp.php' method='post'>
            <input type='hidden' name='btnorderid' value =" . $row['OrderID'] . ">
            <input type='hidden' name='btnbookid' value =" . $row['BookID'] . ">
            <button type='submit' class='btn btn-primaryred' name='submit'>
            Anuluj<br>Zamówienie
            </button>
        </form>");}if($row['status'] === 'U czytelnika'){echo("<p class='light-gray-small-text-MojeWyp'>Książka u czytelnika</p>");}
        if($row['status'] === 'Oddano'){echo("<p class='light-gray-small-text-MojeWyp'>Książka oddana</p>");}
        echo("</div>
        </div>");}
   
    $result->free();
}
}else{
    echo("<h1 style='text-align: center; color: red;'>Zaloguj się by zobaczyć swoje zamówienia!</h1>");
}

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