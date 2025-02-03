<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head lang="pl">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8"/>
    <title> Pełna okładka książki</title>
    <link rel="icon" type="image/x-icon" href="Ikona.ico">
    <meta name="description" content = "Super strona o ksiazkach" />
    <meta name="keywords" content="ksiazka,wpozyczalnia,najlepsze ksiazki"/>
    <meta name="author" content="Michał Andrzyk"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylereal.css" type="text/css"/>
</head>
<body>
<?php
if(isset($_GET['BookID']))
{

    require_once "Database.php";
    $bookid = $_GET['BookID'];
    $sql = "SELECT `Image` FROM books where BookID = $bookid";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $imageData = $row['Image'];
    $base65Image = base64_encode($imageData);
    echo('<div style="text-align: center;margin-left:40%; margin-top:20px; width:400px; border: 1px solid black;"> <img src="data:image/jpeg;base64,' . $base65Image . '" alt="Obraz książki"><br> <button class="underline-button" onclick="PrzegladajChange()">Powrót na strone główną (poprzednia strona wciąż dostepna w karcie na górze)</button> </p></div> ');
    
}
?>
<script type="text/javascript">
    function PrzegladajChange() {
      window.location.href ="index.php";
    }
</script>
</body>
</html>

