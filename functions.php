<?php

session_start();


$database='localhost';
$database_user='root';
$database_password='';
$database_name='testepitech';

//connection avec base des donnes

$con=mysqli_connect($database, $database_user, $database_password, $database_name);

if(mysqli_connect_error()){
    exit('Connection Faild, vous etes pas connecté a bas des donnes.' .mysqli_connect_error());
}

//prepare notre SQL statement

if ($stmt=$con->prepare('SELECT id, password FROM tests WHERE name = ?')){
    $stmt->bind_param('s', $_POST['name']);
    $stmt->execute();
}

$stmt->store_result();

if($stmt->num_rows > 0){
    $stmt->bind_result($id, $password);
    $stmt->fetch();


  if($_POST['password'] ===  $password){
    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['id'] = $id;
    header('Location: home.php');
  }
  else{
    echo('Mauvais Identificant ou Mot de passe!');
    header('refresh:3;url=Connection.php');
}}

?>