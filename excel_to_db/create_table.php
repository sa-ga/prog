<?php

// if(isset($_POST)) {
//     // var_dump($_POST);

//     $sql = 'CREATE TABLE MyGuests (';
//     $sql .= 'id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,';
// }

foreach($_POST as $key => $value) {
    // echo $key. " : " .$value. "<BR />";
    if($key != 'val_tb_name'){
        $sql .= "$value VARCHAR(30) NOT NULL,";
    }else{
        $sql = "CREATE TABLE $value (";
        $sql .= "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    }
}

$sql .= "reg_date TIMESTAMP)";

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDBPDO";

try {
    // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo = new PDO('mysql:dbname=gs_db_gs;charset=utf8;host=localhost','root','root');
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
    // $sql = "CREATE TABLE MyGuests (
    // id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    // firstname VARCHAR(30) NOT NULL,
    // lastname VARCHAR(30) NOT NULL,
    // email VARCHAR(50),
    // reg_date TIMESTAMP
    // )";

    // use exec() because no results are returned
    $pdo->exec($sql);
    echo "Table MyGuests created successfully<br>";
    echo "<a href='index.html'>最初の画面に戻る</a>";
}catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

$pdo = null;
?>