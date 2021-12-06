<?php
// Schimbați acest lucru cu informațiile despre conexiune.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = "";
$DATABASE_NAME = 'wefit';  
// Incerc sa ma conectez pe baza info de mai sus.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) 
{
    // Dacă există o eroare la conexiune, opriți scriptul și afișați eroarea.
    exit('Nu se poate conecta la MySQL: ' . mysqli_connect_error());
}
if (!isset($_POST['nume'], $_POST['telefon'], $_POST['email'], $_POST['antrenor'],  $_POST['mesaj'])) 
{
    // Nu s-au putut obține datele care ar fi trebuit trimise.
    exit('Nu s-au putut obtine date care trebuie trimise!');
}
// Asigurați-vă că valorile înregistrării trimise nu sunt goale.
if (empty($_POST['nume']) || empty($_POST['telefon']) || empty($_POST['email']) || empty($_POST['antrenor']) || empty($_POST['mesaj'])) 
{
    // One or more values are empty.
    exit('Ati lasat unul sau mai multe campuri libere!');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
{
    exit('Email nu este valid!');
}
{
    if ($stmt = $con->prepare('INSERT INTO mesaje_contact (nume, telefon, email, antrenor, mesaj) VALUES (?, ?, ?, ?, ?)'))
    {
            $stmt->bind_param('sssss', $_POST['nume'], $_POST['telefon'], $_POST['email'], $_POST['antrenor'], $_POST['mesaj']);
            $stmt->execute();
            echo 'Success inregistrat!';
            header('Location: index.html');
    }
    else 
    {
            // Ceva nu este în regulă cu declarația sql, verificați pentru a vă asigura că tabelul conturilor există cu toate cele 3 câmpuri.
            echo 'Nu se poate face prepare statement!';
    }
}
$con->close();

?>