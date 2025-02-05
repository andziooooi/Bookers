<?php
session_start();
?>
<html>
<!DOCTYPE html>
<html>
<!DOCTYPE html>
<head lang="pl">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8"/>
    <title> Przeglądaj Książki</title>
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
$_SESSION['filter'] = 'nic';
if(isset($_POST['sort']))
{
$_SESSION['filter'] = $_POST['sortby'];
}
if(isset($_POST['search'])){
  $_SESSION['searchlike'] = $_POST['searchlike'];
}
if(isset($_SESSION['searchlike'])){

  switch ($_SESSION['filter']) {
    case 'Tytuł rosnąco':
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books where Title LIKE '%".$_SESSION['searchlike']."%' ORDER BY Title asc";
        break;
    case 'Tytuł malejąco':
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books where Title LIKE '%".$_SESSION['searchlike']."%' ORDER BY Title desc";
        break;
    case 'Gatunkami rosnąco':
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books where Title LIKE '%".$_SESSION['searchlike']."%' ORDER BY Genre asc";
        break;
    case 'Gatunkami malejąco':
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books where Title LIKE '%".$_SESSION['searchlike']."%' ORDER BY Genre desc";
        break;
    case 'Autorzy rosnąco':
      $query = "SELECT BookID,books.AuthorID,Surname,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books,authors where books.AuthorID = authors.AuthorID and Title LIKE '%".$_SESSION['searchlike']."%' ORDER BY Surname asc";
        break;
    case 'Autorzy malejąco':
      $query = "SELECT BookID,books.AuthorID,Surname,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books,authors where books.AuthorID = authors.AuthorID and Title LIKE '%".$_SESSION['searchlike']."%' ORDER BY Surname desc";
        break;
    case 'Data Wydania rosnąco':
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books where Title LIKE '%".$_SESSION['searchlike']."%' ORDER BY PublicationDate desc";
        break;
    case 'Data Wydania malejąco':
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books where Title LIKE '%".$_SESSION['searchlike']."%' ORDER BY PublicationDate asc";
        break;
    case 'Sortuj według':
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books where Title LIKE '%".$_SESSION['searchlike']."%' ORDER BY Title asc";
      break;
    default:
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books where Title LIKE '%".$_SESSION['searchlike']."%' ORDER BY Title asc";
  }
}else{
  switch ($_SESSION['filter']) {
    case 'Tytuł rosnąco':
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books ORDER BY Title asc";
        break;
    case 'Tytuł malejąco':
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books ORDER BY Title desc";
        break;
    case 'Gatunkami rosnąco':
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books ORDER BY Genre asc";
        break;
    case 'Gatunkami malejąco':
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books ORDER BY Genre desc";
        break;
    case 'Autorzy rosnąco':
      $query = "SELECT BookID,books.AuthorID,Surname,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books,authors where books.AuthorID = authors.AuthorID ORDER BY Surname asc";
        break;
    case 'Autorzy malejąco':
      $query = "SELECT BookID,books.AuthorID,Surname,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books,authors where books.AuthorID = authors.AuthorID ORDER BY Surname desc";
        break;
    case 'Data Wydania rosnąco':
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books ORDER BY PublicationDate desc";
        break;
    case 'Data Wydania malejąco':
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books ORDER BY PublicationDate asc";
        break;
    case 'Sortuj według':
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books ORDER BY Title asc";
      break;
    default:
      $query = "SELECT BookID,AuthorID,Price,Title,Publisher,Image,PublicationDate,Description,Genre,Language,quantity FROM books ORDER BY Title asc";
  }
}
echo("<div class = 'PrzegladajSearch'>
<form class='inline-form' action='przegladaj.php' method='post'>");
if(isset($_SESSION['searchlike'])){
  if($_SESSION['searchlike'] == ''){
  echo("<input class ='form-control' type='text' name='searchlike' placeholder='Wyszukaj po tytule...'>");}else{
  echo("<input class ='form-control' type='text' name='searchlike' value =". $_SESSION['searchlike'].">");
  }}else{
    echo("<input class ='form-control' type='text' name='searchlike' placeholder='Wyszukaj po tytule...'>");
  }
  echo("<button class='btn btn-primarynomarginreal'type='submit' name='search'>Wyszukaj</button>
</form>
<form class='inline-form' action='przegladaj.php' method='post'>
<select class='form-control' name='sortby'>
              <option>Sortuj według</option>
              <option>Tytuł rosnąco</option>
              <option>Tytuł malejąco</option>
              <option>Gatunkami rosnąco</option>
              <option>Gatunkami malejąco</option>
              <option>Autorzy rosnąco</option>
              <option>Autorzy malejąco</option>
              <option>Data Wydania rosnąco</option>
              <option>Data Wydania malejąco</option>
            </select>
      <button class='btn btn-primarynomarginreal'type='submit' name='sort'>Sortuj</button>
  </form>

</div>");
$result = $conn->query($query);
if (isset($_POST['submit'])) {
  if(isset($_SESSION["userlogged"])){
    $bookid = $_POST['btnbookid'];
    $_SESSION['bookidses'] = $bookid;
    $sql = "SELECT quantity FROM books where BookID = $bookid";
    $sqlquantity = mysqli_query($conn,$sql);
    if ($sqlquantity) {
    if ($qrow = $sqlquantity->fetch_assoc()) {
        $qquantity = (double) $qrow['quantity'];
    } else {
        echo "Brak wyników.";
    }
  } else {
    echo "Błąd zapytania: " . $mysqli->error;
  }
  if($qquantity > 0){
        echo("<div class='overlay'> <!-- Overlay, który przyciemni resztę strony -->
        </div>");
        echo(
        "<div class='rentconfirm'>
          <div class='rentinfo'>
            <h1>Czy jesteś pewny?</h1>
            <h3>Wybrana przez Ciebie książka będzie czekać do odbioru pod adresem naszej wypożyczalni. <br> Płatność wyłącznie przy odbiorze!</h3>
            <p>Okres wypożyczenia: 90 dni</p>
          </div>
          <div class='rentbuttons'>
            <form action='przegladaj.php' method='post'>
            <input type='hidden' name='rental' value ='true'>
            <input type='submit' class='btn btn-primarynomargin' value='Tak, Zarezerwuj' name='confirmationtrue'>
            </form>
            <form action='przegladaj.php' method='post'>
            <input type='hidden' name='rental' value ='false'>
            <input type='submit' class='btn btn-primarynomarginred' value='Anuluj' name='confirmationfalse'>
            </form>
          </div>        
        </div>");
      }else{echo "<div class='custom-alert-bad'>Książka niedostępna</div>";
  header("Refresh: 5");}
}else{
echo "<div class='custom-alert-bad'>Zaloguj sie!</div>";
header("Refresh: 5");
}}
if(isset($_POST['confirmationtrue'])) {
  $sqlbutton = "UPDATE books SET quantity = quantity - 1 WHERE BookID = ".$_SESSION['bookidses']. ";";
    if ($conn->query($sqlbutton) === TRUE) {
      echo "";
    } else {
    echo "Error updating record: " . $conn->error;}
  $sqlbutton = "INSERT INTO orders(ClientID,OrderDate,ReturnDate,BookID) VALUES (".$_SESSION["UserID"].",CURDATE(), CURDATE() + INTERVAL 91 DAY,".$_SESSION['bookidses'].")";
  if ($conn->query($sqlbutton) === TRUE) {
   echo "<div class='custom-alert-good'>Zamówienie przyjęte</div>";
   header("Refresh: 2");
  } else { echo "Error updating record: " . $conn->error;}}
 if(isset($_POST['confirmationfalse'])){header("Refresh: 1");}

if ($result) {
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
              "Wydawnictwo: " . $row['Publisher'] . " |Data Wydania: " . $row['PublicationDate'] . " |gatunek: " . $row['Genre'] . 
            "</div>"
        ."<div class = 'bookdescription'>"
        . $row['Description'] .
        "</div>
        </div>
        <div class='bookbuttonpocket'>
        <form action='przegladaj.php' method='post'>
            <input type='hidden' name='btnbookid' value =" . $row['BookID'] . ">
            <input type='hidden' name='btnquantity' value =" . $row['quantity'] . ">
            <p class='pricetext'>Cena: " . $row['Price'] ."zł</p>
            <input type='submit' class='btn btn-primarynomargin' value='Zarezerwuj' name='submit'>
            <p class='light-gray-small-text'>Dostępne:" . $row['quantity'] ."</p>
        </form>
        </div>
    </div>");}
    $result->free();
}

?>
</div>
  </div>
<footer>
    <div class="footer-content">
        <p style="margin-top:10px;">© 2024 Michał Andrzyk</p>
    </div>
</footer>
<script src="js/script.js"></script>
</body>
</html>