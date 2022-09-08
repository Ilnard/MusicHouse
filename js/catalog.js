const catalog = document.querySelector('.catalog-catalog');
let order = 'new';
let string = false;
let piano = false;
const filter = [string, piano];
const refresh = document.querySelector('.catalog-toolbar__btn');

let items = [
    {
        id: 1,
        img: 'media/images/08202cb04c25c43386510f49e8a0f18f.jpeg',
        name: 'Пианино',
        price: 5000,
        country: 'Франция',
        year: 2016,
        category: 'Клавишные',
        time: '1',
        count: 2
    },
    {
        id: 2,
        img: 'media/images/08202cb04c25c43386510f49e8a0f18f.jpeg',
        name: 'АПианино',
        price: 4000,
        country: 'Франция',
        year: 2017,
        category: 'Клавишные',
        time: '2',
        count: 2
    },
    {
        id: 3,
        img: 'media/images/2d5d0cc68ffe42f62dddcda05bf80304.jpeg',
        name: 'БПочти скрипка',
        price: 9000,
        country: 'Италия',
        year: 2014,
        category: 'Струнные',
        time: '3',
        count: 2
    },
    {
        id: 4,
        img: 'media/images/2d5d0cc68ffe42f62dddcda05bf80304.jpeg',
        name: 'Почти скрипка2',
        price: 8000,
        country: 'Италия',
        year: 2015,
        category: 'Струнные',
        time: '4',
        count: 2
    },
    {
        id: 5,
        img: 'media/images/2d5d0cc68ffe42f62dddcda05bf80304.jpeg',
        name: 'Почти скрипка2',
        price: 8000,
        country: 'Италия',
        year: 2015,
        category: 'Гитара',
        time: '4',
        count: 2
    },
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
        <div class="catalog-catalog__item">
            <div class="catalog-catalog__media">
                <img src="${itemsView[i].img}" alt="" class="catalog-catalog__pict">
            </div>
            <div class="catalog-catalog__info">
                <h3 class="catalog-catalog__name">${itemsView[i].name}</h3>
                <div class="catalog-catalog__price">${itemsView[i].price} RUB</div>
            </div>
        </div>
        `
        
    }
}
addItemsToCatalog(order, filter);

refresh.addEventListener('click', (e) => {
    e.preventDefault();
    order = document.querySelector("select[name='order'").value;
    filter[0] = document.querySelector("input[name='string'").checked;
    filter[1] = document.querySelector("input[name='piano'").checked; 

    catalog.innerHTML = '';
    itemsView = [];
    addItemsToCatalog(order, filter);
})