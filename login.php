<?php
    include_once('resources/core/connection.class.php');
    
    $connection = new Connection();
    $conn = $connection->getConnect();
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $pst = $conn->prepare("SELECT * FROM system_users WHERE username=? and password=?");
    // Putting values on ?s
    $pst->bindValue(1, $username, PDO::PARAM_STR);
    $pst->bindValue(2, $password, PDO::PARAM_STR);
    $pst->execute();
    $result = $pst->fetch(PDO::FETCH_OBJ);
    $connection->closeConnect();
    
    // If no result, return to login interface
    // Go to search interface, otherwise
    if ($result->username != '') { 
        session_start();
        $_SESSION['user'] = $username;
        $_SESSION['logged'] = 1;
        $_SESSION['tryed'] = 0;
        header('Location: search.php');
        die();
    } else {
        session_start();
        $_SESSION['tryed'] = 1;
        header('Location: index.php');
        die();
    }
?>