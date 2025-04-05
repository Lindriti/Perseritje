<?php
include_once("config.php");
echo '<pre>' . var_export($_POST, true) . '</pre>';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $tempPass = $_POST['password'];
    $password = password_hash($tempPass, PASSWORD_DEFAULT);

    if (empty($name) || empty($surname) || empty($username) || empty($email) || empty($tempPass)) {
        echo "Please fill all the fields";
        header("refresh:20; url=register.php");

    } else {
        $sql = "SELECT username from users WHERE username=:username";
        $tempSql = $conn->prepare($sql);
        $tempSql->bindParam(":username", $username);
        $tempSql->execute();

        if ($tempSql->rowCount() > 0) {
            echo "Username exists!";
            header("refresh:20; url=register.php");
        } else {
            $sql = "INSERT INTO users (name, surname, username, email, password) VALUES (:name, :surname, :username, :email, :password)";
            $tempSql = $conn->prepare($sql);
            $tempSql->bindParam(":name", $name);
            $tempSql->bindParam(":surname", $surname);
            $tempSql->bindParam(":username", $username);
            $tempSql->bindParam(":email", $email);
            $tempSql->bindParam(":password", $password);

            $tempSql->execute();

            echo "Data saved successfully...";
            header("refresh:20; url=register.php");
        }

    }

}