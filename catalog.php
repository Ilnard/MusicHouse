<?require_once 'header.php'?>
    <main class="catalog">
        <div class="container">
            <div class="catalog__inner">
                <h1 class="section__title">Каталог</h1>
                <form method="post" action="" class="catalog-toolbar">
                    <div class="catalog-toolbar-order">
                        <label for="order" class="catalog-toolbar-order__name">Сортировка по:</label>
                        <select name="order" id="order">
                            <option value="new">Новизне</option>
                            <option value="date">Дате производства</option>
                            <option value="name">Названию</option>
                            <option value="price">Цене</option>
                        </select>
                    </div>
                    <div class="catalog-toolbar-filter">
                        <div class="catalog-toolbar-filter__item">
                            <label for="string">Струнные</label>
                            <input type="checkbox" id="string" name="string">
                        </div>
                        <div class="catalog-toolbar-filter__item">
                            <label for="piano">Клавишные</label>
                            <input type="checkbox" id="piano" name="piano">
                        </div>
                    </div>
                    <input type="submit" class="catalog-toolbar__btn" value="Обновить">
                </form>
                <div class="catalog-catalog">
                    
                </div>
            </div>
        </div>
    </main>
    <script></script>
    <?require_once 'js/catalog_script.php'?>
    <?require_once 'js/script.php'?>
</body>
</html>