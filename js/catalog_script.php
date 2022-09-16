<script>
const catalog = document.querySelector('.catalog-catalog');
let order = 'new';
let string = false;
let piano = false;
const filter = [string, piano];
const refresh = document.querySelector('.catalog-toolbar__btn');

let items = [
<?php
    $result = mysqli_query($GLOBALS['db'], "SELECT * FROM products");
    while ($product = $result -> fetch_assoc()):
?>
    {
        id: <?=$product['id']?>,
        img: '<?=$product['photo']?>',
        name: '<?=$product['name']?>',
        price: <?=$product['price']?>,
        country: '<?=$product['country']?>',
        year: <?=$product['year']?>,
        category: '<?=$product['category']?>',
        count: <?=$product['count']?>
    },
<?endwhile;?>
]

function addItemsToCatalog(order, filter) {
    if (filter[0] == true || filter[1] == true) {
        if (filter[0]) itemsView = itemsView.concat(items.filter(item => item.category == 'Струнные'))
        if (filter[1]) itemsView = itemsView.concat(items.filter(item => item.category == 'Клавишные'))
    } else itemsView = items

    switch (order) {
        case 'new': {
            itemsView.sort((a, b) => a.time - b.time)
            break;
        }
        case 'name': {
            itemsView.sort((a, b) => a.name.localeCompare(b.name))
            break;
        }
        case 'date': {
            itemsView.sort((a, b) => b.year - a.year)
            break;
        }
        case 'price': {
            itemsView.sort((a, b) => a.price - b.price)
            break;
        }
    }

    for (let i = 0; i < itemsView.length; i++) {
        catalog.innerHTML += 
        `
        <form class="catalog-catalog__item" method="post">
            <div class="catalog-catalog__media">
                <img src="media/images/${itemsView[i].img}" alt="" class="catalog-catalog__pict">
            </div>
            <div class="catalog-catalog__info">
                <h3 class="catalog-catalog__name">${itemsView[i].name}</h3>
                <div class="catalog-catalog__price">${itemsView[i].price} RUB</div>
                    <input type="hidden" value="${itemsView[i].id}" name="id">
                    <button type="submit" name="open_product">Открыть товар</button>
                    <?if (isset($_SESSION)) {?>
                        <button type="submit" name="add_to_cart">Добавить в корзину</button>
                    <?}?>
            </div>
        </form>
        `
        
    }
}
addItemsToCatalog(order, filter);

refresh.addEventListener('click', (e) => {
    e.preventDefault();
    order = document.querySelector("select[name='order']").value;
    filter[0] = document.querySelector("input[name='string']").checked;
    filter[1] = document.querySelector("input[name='piano']").checked; 

    catalog.innerHTML = '';
    itemsView = [];
    addItemsToCatalog(order, filter);
})
</script>