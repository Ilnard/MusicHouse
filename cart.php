<?require_once 'header.php'?>
    <main class="cart-section">
        <div class="container">
            <div class="cart-section__inner">
                <h1 class="section__title">Корзина</h1>
                <table class="cart-section__cart">
                    <thead>
                        <tr>
                            <td>Фото</td>
                            <td>Название</td>
                            <td>Количество</td>
                        </tr>
                    </thead>
<?php
    $result = mysqli_query($GLOBALS['db'], "SELECT * FROM cart WHERE user_id = {$_SESSION['user']['id']}");

    while ($cart_product = $result -> fetch_assoc()):
        $result1 = mysqli_query($GLOBALS['db'], "SELECT * FROM products WHERE id = $cart_product[product_id]");
        $product = $result1 -> fetch_assoc();
?>
                    <tr class="cart-product">
                        <td>
                            <div class="cart-product__media">
                            <img src="media/images/<?=$product['photo']?>" alt="" class="cart-product__pict">
                            </div>
                        </td>
                        <td>
                            <div class="cart-product__name"><?=$product['name']?></div>
                        </td>
                        <td class="cart-product__actions">
                            <form action="" method="post">
                                <button name="cart_product_minus" class="cart-product__count cart-product__count_minus" <?if ($cart_product['count'] <= 0) echo "disabled"?>>-</button>
                                <input type="hidden" name="product_id" value="<?=$cart_product['product_id']?>">
                                <input class="cart-product__counter" name="counter" value="<?=$cart_product['count']?>" readonly>
                                <button name="cart_product_plus" class="cart-product__count cart-product__count_plus" <?if ($cart_product['count'] >= $product['count']) echo "disabled"?>>+</button>
                            </form>
                        </td>
                    </tr>
<?endwhile?>
                </table>
                <form action="" method="post">
                    <button type="submit" name="order_btn" class="cart-section__btn">Заказать</button>
                </form>
            </div>
        </div>
    </main>
    <script></script>
    <?require_once 'js/script.php'?>
</body>
</html>