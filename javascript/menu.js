/*let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');

openShopping.addEventListener('click', ()=>{
    body.classList.add('active');
})

closeShopping.addEventListener('click', ()=>{
    body.classList.remove('active');
})
let products = [
    {
        id: 1,
        name: 'CHICKEN PIZZA',
        image: 'special5.jpg',
        price: 100
    },
    {
        id: 2,
        name: 'FRIED CHICKEN',
        image: 'special2.jpeg',
        price: 120
    },
    {
        id: 3,
        name: 'CHICKEN BIRYANI',
        image: 'special3.jpg',
        price: 150
    },
    {
        id: 4,
        name: 'FRENCH FRIES',
        image: 'special4.jpg',
        price: 80
    },
    {
        id: 5,
        name: 'PEPSI',
        image: 'pepsi.jpg',
        price: 80
    },
    {
        id: 6,
        name: 'CHICKEN LOLLIPOP',
        image: 'lollipop.jpg',
        price: 110
    },
];
let listCards = [];
function initApp(){
    products.forEach((value, key)=>{
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
            <img src="images/${value.image}"/>
            <div class="title">${value.name}</div>
            <div class="price">${value.price.toLocaleString()}</div>
            <button onclick="addToCard(${key})">Add To Card</button>
        `;
        list.appendChild(newDiv);
    })
}
initApp();
function addToCard(key){
    if(listCards[key] == null){
        listCards[key] = products[key];
        listCards[key].quantity = 1;
        prices=products[key].price;
    }
    reloadCard();
}
function reloadCard(){
    listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    listCards.forEach((value, key) => {
        totalPrice = totalPrice + value.price;
        count = count + value.quantity;

        if(value != null){
            let newDiv = document.createElement('li');
            newDiv.innerHTML = `
                <div><img src="images/${value.image}"/></div>
                <div>${value.name}</div>
                <div>${value.price.toLocaleString()}</div>
                <div>${value.quantity}</div>
                <div>
                    <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                    <div class="count">${value.quantity}</div>
                    <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
                </div>
            `;
            listCard.appendChild(newDiv);
        }
    })
    total.innerText = totalPrice.toLocaleString();
    quantity.innerText = count;
}
function changeQuantity(key, quantity){
    console.log(key,quantity,listCards)
    var price = products[key].price
    if(quantity == 0){
        delete listCards[key];
    }else{
        listCards[key].quantity = quantity;
        listCards[key].price = quantity * price;
    }
    reloadCard();
}*/
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM fully loaded and parsed'); // Debugging line

    let openShopping = document.querySelector('.shopping');
    let closeShopping = document.querySelector('.closeShopping');
    let list = document.querySelector('.list');
    let listCard = document.querySelector('.listCard');
    let body = document.querySelector('body');
    let total = document.querySelector('.total');
    let quantity = document.querySelector('.quantity');

    console.log('openShopping:', openShopping); // Debugging line
    console.log('closeShopping:', closeShopping); // Debugging line

    if (openShopping) {
        openShopping.addEventListener('click', () => {
            console.log('Opening shopping cart'); // Debugging line
            body.classList.add('active');
        });
    } else {
        console.error('.shopping element not found');
    }

    if (closeShopping) {
        closeShopping.addEventListener('click', () => {
            console.log('Closing shopping cart'); // Debugging line
            body.classList.remove('active');
        });
    } else {
        console.error('.closeShopping element not found');
    }

    let products = [
        { id: 1, name: 'CHICKEN PIZZA', image: 'special5.jpg', price: 100 },
        { id: 2, name: 'FRIED CHICKEN', image: 'special2.jpeg', price: 120 },
        { id: 3, name: 'CHICKEN BIRYANI', image: 'special3.jpg', price: 150 },
        { id: 4, name: 'FRENCH FRIES', image: 'special4.jpg', price: 80 },
        { id: 5, name: 'PEPSI', image: 'pepsi.jpg', price: 80 },
        { id: 6, name: 'CHICKEN LOLLIPOP', image: 'lollipop.jpg', price: 110 },
    ];

    let listCards = [];

    function initApp() {
        products.forEach((value, key) => {
            let newDiv = document.createElement('div');
            newDiv.classList.add('item');
            newDiv.innerHTML = `
                <img src="images/${value.image}" alt="${value.name}"/>
                <div class="title">${value.name}</div>
                <div class="price">$${value.price.toLocaleString()}</div>
                <button onclick="addToCard(${key})">Add To Cart</button>
            `;
            list.appendChild(newDiv);
        });
    }
    initApp();

    window.addToCard = function(key) {
        if (listCards[key] == null) {
            listCards[key] = { ...products[key], quantity: 1 };
        } else {
            listCards[key].quantity += 1;
        }
        reloadCard();
    }

    function reloadCard() {
        listCard.innerHTML = '';
        let count = 0;
        let totalPrice = 0;
        listCards.forEach((item, key) => {
            if (item) {
                totalPrice += item.price * item.quantity;
                count += item.quantity;

                let newDiv = document.createElement('li');
                newDiv.innerHTML = `
                    <div><img src="images/${item.image}" alt="${item.name}"/></div>
                    <div>${item.name}</div>
                    <div>$${(item.price * item.quantity).toLocaleString()}</div>
                    <div>
                        <button onclick="changeQuantity(${key}, ${item.quantity - 1})">-</button>
                        <div class="count">${item.quantity}</div>
                        <button onclick="changeQuantity(${key}, ${item.quantity + 1})">+</button>
                    </div>
                `;
                listCard.appendChild(newDiv);
            }
        });
        total.innerText = `$${totalPrice.toLocaleString()}`;
        quantity.innerText = count;
    }

    window.changeQuantity = function(key, quantity) {
        if (quantity === 0) {
            delete listCards[key];
        } else {
            listCards[key].quantity = quantity;
        }
        reloadCard();
    }

    // Redirect to checkout page with total amount
    const checkoutButton = document.querySelector('.checkout .total');
    checkoutButton.addEventListener('click', () => {
        const totalAmount = total.innerText.replace('$', '');
        window.location.href = `checkout.php?total=${totalAmount}`;
    });
});
