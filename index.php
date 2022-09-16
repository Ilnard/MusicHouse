<?require_once 'header.php'?>
    <main class="main">
        <div class="container">
            <div class="main__inner">
                <div class="main-header">
                    <div class="main-logo">
                        <img src="media/images/logo.png" alt="" class="main-logo__pict">
                    </div>
                    <div class="main-deviz">Наш девиз 4 слова</div>
                </div>
                <div class="main-slider">
                    <button class="main-slider-btn main-slider-btn_prev"><</button>
                    <div class="main-slider-wrapper">
                        <div class="main-slider-feed">
<?php
$result = mysqli_query($GLOBALS['db'], "SELECT photo, name FROM products ORDER BY id DESC LIMIT 5");
while ($product = $result -> fetch_assoc()):
?>
                            <div class="main-slider__slide">
                                <div class="main-slider__media">
                                    <img src="media/images/<?=$product['photo']?>" alt="" class="main-slider__product-pict">
                                </div>
                                <h3 class="main-slider__product-name"><?=$product['name']?></h3>
                            </div>
<?endwhile;?>                            
                        </div>
                    </div>
                    <button class="main-slider-btn main-slider-btn_next">></button>
                </div>
            </div>
        </div>
    </main>
    <?require_once 'js/script.php'?>
    <script>slider()</script>
</body>
</html>