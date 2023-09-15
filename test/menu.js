document.addEventListener("DOMContentLoaded", function () {
  const addToCartButtons = document.querySelectorAll(".add-to-cart");
  const cartItemsContainer = document.querySelector(".cart-items");

  const cart = [];

  addToCartButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const productId = button.getAttribute("data-product-id");
      const productName = button.parentElement.querySelector("h3").textContent;
      const productPrice = button.parentElement.querySelector("p").textContent;

      const item = {
        id: productId,
        name: productName,
        price: productPrice,
      };

      cart.push(item);
      updateCartUI();
    });
  });

  function updateCartUI() {
    cartItemsContainer.innerHTML = "";
    cart.forEach((item) => {
      const cartItem = document.createElement("div");
      cartItem.classList.add("cart-item");
      cartItem.innerHTML = `<p>${item.name} - ${item.price}</p>`;
      cartItemsContainer.appendChild(cartItem);
    });
  }
});
