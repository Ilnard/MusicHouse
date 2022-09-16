<?php 
require_once 'header.php';
if (!isset($_SESSION['admin'])) {
    location('/');
}

?>
    <main class="admin-pan">
        <div class="container">
            <div class="admin-pan__inner">
                <div class="admin-pan__section">
                    <h2 class="admin-pan__title">Заказы</h2>
                    <form class="admin-pan__toolbar">
                        <div class="admin-pan__tool">
                            <label for="new">Новые</label>
                            <input type="checkbox" name="new" id="new" name="new" checked>
                        </div>
                        <div class="admin-pan__tool">
                            <label for="accepted">Подтвержденные</label>
                            <input type="checkbox" name="accepted" id="accepted" name="accepted">
                        </div>
                        <div class="admin-pan__tool">
                            <label for="canceled">Отмененные</label>
                            <input type="checkbox" name="canceled" id="canceled" name="canceled">
                        </div>
                        <button class="catalog-toolbar__btn admin-pan__btn" name="admin_refresh">Обновить</button>
                    </form>
                    <table class="admin-pan__orders">
                        <thead>
                            <tr>
                                <td>Заказчик</td>
                                <td>Количество</td>
                                <td>Время</td>
                                <td>Действия</td>
                            </tr>
                        </thead>
<?php
    $result = mysqli_query($GLOBALS['db'], "SELECT * FROM orders");
    while ($order = $result -> fetch_assoc()):
        $result2 = mysqli_query($GLOBALS['db'], "SELECT name, surname, patronymic FROM users WHERE id = $order[user_id]");
        $fullname = mysqli_fetch_assoc($result2)
?>
                        <tr class="admin-pan__order">
                            <td>
                                <div class="admin-pan-order__client"><? echo $fullname['name'].' '.$fullname['surname'].' '.$fullname['patronymic']?></div>
                            </td>
                            <td>
                                <div class="admin-pan-order__count"><?=$order['count']?></div>
                            </td>
                            <td>
                                <div class="admin-pan-order__time"><?=$order['time_add']?></div>
                            </td>
                            <td>
                                <div class="admin-pan-order__actions">
                                    <a href="?accept=" class="admin-pan-order__action admin-pan-order__action_accept">Подтвердить</a>
                                        <form class="admin-pan-order__cancel-action" action="" method="get">
                                            <input type="hidden" name="order_id" value="<?=$order['id']?>">
                                            <textarea name="message" class="admin-pan-order__message"></textarea>
                                            <button type="submit" class="admin-pan-order__action admin-pan-order__action_cancel">Отменить</button>
                                        </form>
                                </div>
                            </td>
                        </tr>
<?endwhile?>
                    </table>
                </div>
                <div class="admin-pan__section">
                    <h2 class="admin-pan__title">Товары</h2>
                    <table>
                        <thead>
                            <tr>
                                <td>Фото</td>
                                <td>Название</td>
                                <td>Цена</td>
                                <td>Категория</td>
                                <td>Количество</td>
                                <td>Страна</td>
                                <td>Год выпуска</td>
                                <td>Модель</td>
                                <td>Действия</td>
                            </tr>
                        </thead>
                        <tbody>
<?php
    $result = mysqli_query($GLOBALS['db'], 'SELECT * FROM products');
    while ($product = $result -> fetch_assoc()):
?>
                            <tr>
                                <td colspan="9">
                                    <form action="" class="admin-prod" method="post">
                                        <div class="admin-prod__media">
                                            <img src="media/images/<?=$product['photo']?>" alt="" class="admin-prod__pict">
                                        </div>
                                        <div class="admin-prod__name"><input type="text" name="name" value="<?=$product['name']?>"></div>
                                        <div class="admin-prod__price"><input type="number" name="price" value="<?=$product['price']?>"></div>
                                        <select class="admin-prod__category" name="category">
                                            <option value="Клавишные" name="piano"<?if ($product['category'] == 'Клавишные') echo ' selected'?>>Клавишные</option>
                                            <option value="Струнные" name="string"<?if ($product['category'] == 'Струнные') echo ' selected'?>>Струнные</option>
                                        </select>
                                        <div class="admin-prod__count"><input type="number" name="count" value="<?=$product['count']?>"></div>
                                        <div class="admin-prod__country"><input type="text" name="country" value="<?=$product['country']?>"></div>
                                        <div class="admin-prod__year"><input type="number" name="year" value="<?=$product['year']?>"></div>
                                        <div class="admin-prod__model"><input type="text" name="model" value="<?=$product['model']?>"></div>
                                        <div class="admin-prod__actions">
                                            <input type="hidden" name="photo" value="<?=$product['photo']?>">
                                            <input type="hidden" name="product_id" value="<?=$product['id']?>">
                                            <button class="admin-prod__refresh" name="admin_prod_refresh">Редактировать</button>
                                            <button class="admin-prod__delete" name="admin_prod_delete">Удалить</button>
                                        </div>
                                    </form>
                                    
                                </td>
                            </tr>
<?endwhile?>
                        </tbody>
                    </table>
                </div>
                <div class="admin-pan__section">
                    <h2 class="admin-pan__title">Добавить товар</h2>
                    <form action="" class="admin-add-prod" method="post">
                        <input type="text" class="admin-add-prod__input" name="photo" placeholder="Фото товара">
                        <input type="text" class="admin-add-prod__input" name="name" placeholder="Название товара">
                        <input type="text" class="admin-add-prod__input" name="price" placeholder="Цена">
                        <input type="text" class="admin-add-prod__input" name="country" placeholder="Страна">
                        <input type="text" class="admin-add-prod__input" name="year" placeholder="Год выпуска">
                        <input type="text" class="admin-add-prod__input" name="model" placeholder="Модель">
                        <select name="category" id="">
                            <option value="string">Струнные</option>
                            <option value="piano">Клавишные</option>
                        </select>
                        <input type="text" class="admin-add-prod__input" name="count" placeholder="Кол-во">
                        <input type="submit" name="admin-add-prod__btn" value="Добавить товар">
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script></script>
    <?require_once 'js/script.php'?>
    <?require_once 'js/admin_script.php'?>
    
</body>
</html>