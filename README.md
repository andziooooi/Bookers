# Bookers

Bookers to aplikacja internetowa służąca do zarządzania wypożyczalnią książek. Projekt łączy technologie baz danych oraz budowę serwisów internetowych.

## Technologie
- PHP
- MySQL
- HTML
- CSS
- JavaScript
  
## Wymagania systemowe
- XAMPP (lub inny lokalny serwer obsługujący PHP i MySQL)
- Przeglądarka internetowa
- PHP, HTML, CSS, JavaScript

## Instalacja
1. **Uruchom XAMPP** i włącz usługi **Apache** oraz **MySQL**.
2. **Skopiuj projekt** do katalogu `xampp/htdocs` (np. `xampp/htdocs/Bookers`).
3. **Stwórz bazę danych** w `phpMyAdmin`:
   - Otwórz `http://localhost/phpmyadmin`
   - Wykonaj zapytanie: `CREATE DATABASE wypozyczalnia;`
   - Przejdź do utworzonej bazy danych i wybierz opcję `Importuj`.
   - Wybierz plik `wypozyczalnia.sql` dołączony do projektu i kliknij `Importuj`.
4. **Sprawdź konfigurację bazy danych**:
   - Jeśli używasz niestandardowych danych logowania do MySQL, edytuj `Database.php`, zmieniając wartości:
     ```php
     $dbUser = "root";
     $dbPass = ""; // Zmień jeśli używasz hasła
     ```

## Uruchomienie

Po zakończeniu instalacji otwórz przeglądarkę i wpisz adres:
```
http://localhost/Bookers
```

## Domyślne dane logowania

- **Login:** Test
- **Hasło:** testtest

- **Login:** Test2
- **Hasło:** testtest



