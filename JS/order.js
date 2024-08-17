document.addEventListener("DOMContentLoaded", function () {
  fetchMenuItems();
  fetchCartItems();
});

function fetchMenuItems() {
  fetch("../php/fetchMenuItems.php")
    .then((response) => response.json())
    .then((data) => {
      const select = document.querySelector("#item");
      const list = document.querySelector(".item-list ul");
      data.forEach((item) => {
        // Populate menu
        const li = document.createElement("li");
        li.innerHTML = `
                    <img src="data:image/jpeg;base64,${item.photo}" alt="Your Image">
                    <h3>${item.name}</h3><br>
                    <span>$ ${item.price}</span><br>
                `;
        list.appendChild(li);

        // Populate select options
        const option = document.createElement("option");
        option.value = item.item_id;
        option.innerHTML = item.name;
        select.appendChild(option);
      });
    });
}

function fetchCartItems() {
  fetch("../php/fetchCartItems.php")
    .then((response) => response.json())
    .then((data) => {
      const cartList = document.querySelector(".my_cart ul");
      const totalPriceElem = document.querySelector(".price-float span");
      data.cart.forEach((cartItem) => {
        // Populate cart
        const li = document.createElement("li");
        li.innerHTML = `
                    <img src="data:image/jpeg;base64,${cartItem.photo}" alt="photo">
                    <h3>${cartItem.name}</h3>
                    <span>${cartItem.price} $</span>
                    <h2 class="qua">${cartItem.quantity} <sub>item</sub></h2>
                    <h4>subtotal : <span>${cartItem.subtotal} $</span></h4>
                `;
        cartList.appendChild(li);
      });
      totalPriceElem.textContent = data.total_price + " $";
    });
}
