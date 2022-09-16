<?php
    session_start();
    $GLOBALS['db'] = new mysqli('127.0.0.1', 'root', '', 'musichouse');

    $curl = $_SERVER['REQUEST_URI'];

    function location($url = '/') {
        header("Location: http://{$_SERVER['SERVER_NAME']}$url");
        exit();
    }

    switch ($_SERVER['REQUEST_URI']) {
        case '/': {
            $title = 'О нас';
            break;
        }
        case '/index.php': {
            $title = 'О нас';
            break;
        }
        case '/catalog.php': {
            $title = 'Каталог';
            break;
        }
        case '/address.php': {
            $title = 'Где нас найти?';
            break;
        }
        case '/cart.php': {
            $title = 'Корзина';
            break;
        }
        case '/admin.php': {
            $title = 'Админ панель';
            break;
        }
        case '/config.php': {
            location('/');
            break;
        }
        case '/header.php': {
            location('/');
            break;
        }
    }

    function auth($login, $password) {
        
        $result = mysqli_query($GLOBALS['db'], "SELECT * FROM users WHERE login = '$login' AND password = '$password'");
        $user = $result -> fetch_assoc();
        var_dump($user);
        

        if ($login == 'admin' && $password == 'admin') $_SESSION['admin'] = $user;
        else $_SESSION['user'] = $user;
    }

    function reg($data) {
        mysqli_query($GLOBALS['db'], "INSERT INTO users (name, surname, patronymic, login, email, password) VALUES ('{$data['name']}', '{$data['surname']}', '{$data['patronymic']}', '{$data['login']}', '{$data['email']}', '$data[password]')");
        auth($data['login'], $data['password']);
    }

    if (isset($_POST['auth'])) {
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);

        auth($login, $password);
        location($curl);
    }

    if (isset($_POST['reg'])) {
        $data['name'] = htmlspecialchars($_POST['name']);
        $data['surname'] = htmlspecialchars($_POST['surname']);
        $data['patronymic'] = htmlspecialchars($_POST['patronymic']);
        $data['login'] = htmlspecialchars($_POST['login']);
        $data['email'] = htmlspecialchars($_POST['email']);
        $data['password'] = htmlspecialchars($_POST['password']);

        reg($data);
        location($curl);
    }

    if(isset($_GET['logout'])) {
        if (isset($_SESSION['user'])) unset($_SESSION['user']);
        else unset($_SESSION['admin']);
        location('/');
        session_destroy();
    }

    if (isset($_POST['open_product'])) {
        location("/product.php?id=".$_POST['id']);
    }

    if (isset($_POST['add_to_cart'])) {
        $user_id = (int)$_SESSION['user']['id'];
        $id = $_POST['id'];
        $result = mysqli_query($GLOBALS['db'], "SELECT * FROM cart WHERE product_id = $id");
        $cart_items = mysqli_fetch_assoc($result);
        if ($cart_items == []) mysqli_query($GLOBALS['db'], "INSERT INTO cart (user_id, product_id, count) VALUES ($user_id, $id, 1)");
        else {
            $count = (int)$cart_items['count'] + 1;
            mysqli_query($GLOBALS['db'], "UPDATE cart SET count = '$count' WHERE product_id = $id");
        }
        location($curl);
    }

    if(isset($_POST['cart_product_plus'])) {
        $product_id = $_POST['product_id'];
        $counter = $_POST['counter'] + 1;

        mysqli_query($GLOBALS['db'], "UPDATE cart SET count = $counter WHERE product_id = $product_id");
    }

    if(isset($_POST['cart_product_minus'])) {
        $product_id = $_POST['product_id'];
        $counter = $_POST['counter'] - 1;

        mysqli_query($GLOBALS['db'], "UPDATE cart SET count = $counter WHERE product_id = $product_id");
    }

    if (isset($_POST['order_btn'])) {
        $user_id = $_SESSION['user']['id'];
        
        $result = mysqli_query($GLOBALS['db'], "SELECT product_id, count FROM cart WHERE user_id = $user_id");
        $product_ids = '';
        $global_count = 0;
        while ($cart_product = $result -> fetch_assoc()) {
            $product_ids .= $cart_product['product_id'].',';
            $global_count += $cart_product['count'];
        }
        $user_id = (int)$_SESSION['user']['id'];
        $product_ids = rtrim($product_ids, ',');
        
        mysqli_query($GLOBALS['db'], "INSERT INTO orders (user_id, product_id, count) VALUES ($user_id, '$product_ids', $global_count)");
        mysqli_query($GLOBALS['db'], "DELETE FROM cart WHERE user_id = $user_id");
    }

    if (isset($_GET['order_id']) && isset($_GET['message'])) {
        $id = $_GET['order_id'];
        $message = $_GET['message'];
        mysqli_query($GLOBALS['db'], "UPDATE orders SET status = 'Отменен', message_cancel = '$message' WHERE id = $id");
        // location($curl);
    }

    if (isset($_POST['admin_prod_refresh'])) {
        mysqli_query($GLOBALS['db'], "UPDATE products SET name='$_POST[name]', photo='$_POST[photo]', price='$_POST[price]', country='$_POST[country]', year='$_POST[year]', model='$_POST[model]', category='$_POST[category]', count='$_POST[count]' WHERE id = '$_POST[product_id]'");
        location($curl);
    }
    
    if (isset($_POST['admin_prod_delete'])) {
        mysqli_query($GLOBALS['db'], "DELETE FROM products WHERE id = '$_POST[product_id]'");
        location($curl);
    }
    if (isset($_POST['admin-add-prod__btn'])) {
        $result = mysqli_query($GLOBALS['db'], "SELECT * FROM products WHERE model = '$_POST[model]'");
        if ($result -> fetch_array() == []) mysqli_query($GLOBALS['db'], "INSERT INTO products (name, photo, price, country, year, model, category, count) VALUES ('$_POST[name]', '$_POST[photo]', '$_POST[price]', '$_POST[country]', '$_POST[year]', '$_POST[model]', '$_POST[category]', '$_POST[count]')");
        else mysqli_query($GLOBALS['db'], "UPDATE products SET photo = '$_POST[photo]', name = '$_POST[name]', price = '$_POST[price]', country = '$_POST[country]', year = '$_POST[year]', category = '$_POST[category]', count = '$_POST[count]' WHERE model = '$_POST[model]'");
    }
