<?php 
session_start();

$mysqli = new mysqli('localhost', 'root', 'root', 'qwest') or die (mysqli_error($mysqli));

$id_person = 0;
$update = false;
$firstname = '';
$lastname = '';
$address = '';

if (isset($_POST['save'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];

    $mysqli->query("INSERT INTO person (firstname, lastname, address) VALUES ('$firstname', '$lastname', '$address')") 
    or die($mysqli->error); 

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id_person = $_GET['delete'];
    $mysqli->query("DELETE FROM person WHERE id_person=$id_person") or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id_person = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM person WHERE id_person=$id_person") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $address = $row['address'];

    }
}

if(isset($_POST['update'])){
    $id_person = $_POST['id_person'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];

    $mysqli->query("UPDATE person SET firstname='$firstname',lastname='$lastname',address='$address' WHERE id_person=$id_person");

    $_SESSION['message'] = "record has been updated";
    $_SESSION['msg_type'] = "Warring";

    header('location: index.php');
}