<?php
    session_start();
    $GLOBALS['db'] = new mysqli('127.0.0.1', 'root', '', 'musichouse');

    function location($url) {
        if ($url == NULL) {
            $url = $SERVER['REQUEST_URI'];
        }
        header("Location: http://{$_SERVER['SERVER_NAME']}$url");
        exit();
    }

    function auth($login, $password) {
        $result = mysqli_query($GLOBALS['db'], "SELECT * FROM users WHERE login = '$login' AND password = '$password'");
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user'] = $user;
    }

    function reg($data) {
        mysqli_query($GLOBALS['db'], "INSERT INTO users (name, surname, patronymic, login, email, password) VALUES ('{$data['name']}', '{$data['surname']}', '{$data['patronymic']}', '{$data['login']}', '{$data['email']}', '$data[password]')");
        auth($data['login'], $data['password']);
    }

    if (isset($_POST['auth'])) {
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);

        auth($login, $password);
    }

    if (isset($_POST['reg'])) {
        $data['name'] = htmlspecialchars($_POST['name']);
        $data['surname'] = htmlspecialchars($_POST['surname']);
        $data['patronymic'] = htmlspecialchars($_POST['patronymic']);
        $data['login'] = htmlspecialchars($_POST['login']);
        $data['email'] = htmlspecialchars($_POST['email']);
        $data['password'] = htmlspecialchars($_POST['password']);

        reg($data);
    }

    if (isset($_GET['order_id']) && isset($_GET['message'])) {
        $id = $GET['order_id'];
        $message = $GET['message'];
        mysqli_query($GLOBALS['id'], "UPDATE orders SET status = 'Отменен', message = '$message' WHERE id = '$id'")
    }