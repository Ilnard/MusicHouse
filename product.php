<?php
require_once 'header.php';

$result = mysqli_query($GLOBALS['db'], "SELECT * FROM products WHERE id = $_GET[id]");
$product = mysqli_fetch_assoc($result);

?>
    <main class="product">
        <div class="container">
            <div class="product__inner">
                <div class="product__media">
                    <img src="media/images/<?=$product['photo']?>" alt="" class="product__pict">
                </div>
                <div class="product__info">
                    <h2 class="product__name"><?=$product['name']?></h2>
                    <div class="product__price"><?=$product['price']?> RUB</div>
                    <div class="product__charact">
                        <ul class="product__list">
                            <li>Страна-производитель: <?=$product['country']?></li>
                            <li>Год выпуска: <?=$product['year']?></li>
                            <li>Модель: <?=$product['model']?></li>
                            <li>Категория: <?=$product['category']?></li>
                        </ul>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?=$product['id']?>">
                        <button class="product__btn" name="add_to_cart">В корзину</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?require_once 'js/script.php'?>
    <?require_once 'js/catalog_script.php'?>
    <script></script>
</body>
</html>