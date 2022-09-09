<? require_once 'config.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>О нас</title>
</head>
<body>
    <div class="modal-bg">
        <div class="modal-auth">
            <form action="" class="form-log" id="form-auth" method="post">
                <h2 class="form-log__name">Войти</h2>
                <div class="form-log__inputs">
                    <input type="text" class="form-log__input" placeholder="Логин" name="login" pattern="^[A-Za-z0-9\-]+$" required>
                    <input type="password" class="form-log__input" placeholder="Пароль" name="password" required>
                </div>    
                <div class="form-log__btns">
                    <button class="form-log__btn form-log__btn_auth" name="auth">Войти</button>
                    <button class="form-log__btn form-log__btn_close">Закрыть</button>
                </div>
            </form>
            <form action="" class="form-log" id="form-reg" method="post">
                <h2 class="form-log__name">Зарегистрироваться</h2>
                <div class="form-log__inputs">
                    <input type="text" class="form-log__input" placeholder="Имя*" name="name" pattern="^[А-Яа-я0-9\-]+$" required>
                    <input type="text" class="form-log__input" placeholder="Фамилия*" name="surname"  pattern="^[А-Яа-я0-9\-]+$" required>
                    <input type="text" class="form-log__input" placeholder="Отчество" name="patronymic"  pattern="^[А-Яа-я0-9\-]+$">
                    <input type="text" class="form-log__input" placeholder="Логин*" name="login" pattern="^[A-Za-z0-9\-]+$" required>
                    <input type="email" class="form-log__input" placeholder="Электронная почта*" name="email" required>
                    <input type="password" class="form-log__input" placeholder="Пароль*" name="password" required>
                    <input type="password" class="form-log__input" placeholder="Повтор пароля*" name="password_repeat" required>
                    <div class="form-log__checkbox">
                        <input type="checkbox" name="rules" id="rules" required>
                        <label for="rules">Согласие с правилами регистрации</label>
                    </div>
                </div>    
                <div class="form-log__btns">
                    <button class="form-log__btn form-log__btn_reg" name="reg">Зарегистрироваться</button>
                    <button class="form-log__btn form-log__btn_close">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <div class="logo">
                    <img src="media/images/logo.png" alt="" class="logo__pict">
                </div>
                <nav class="nav">
                    <a href="index.php" class="nav__link">О нас</a>
                    <a href="catalog.php" class="nav__link">Каталог</a>
                    <a href="adress.php" class="nav__link">Где нас найти?</a>
                    <?if (isset($_SESSION['user'])) {?>
                    <div class="nav__link nav__link_cart">Корзина</div>
                    <div class="nav__link nav__link_logout">Выйти</div>
                    <?}
                    else {?>
                    <div class="nav__link nav__link_auth">Войти</div>
                    <div class="nav__link nav__link_reg">Зарегистрироваться</div>
                    <?}?>
                </nav>
            </div>
        </div>
    </header>