document.addEventListener("DOMContentLoaded", function () {
    const addProductButton = document.querySelector(".add_product");
    const productDetails = document.querySelector("#product_details");

   // Function to calculate and update the total for each item
    addProductButton.addEventListener("click", function () {
        const productClone = document.querySelector(".product").cloneNode(true);
        productDetails.appendChild(productClone);
    });

    productDetails.addEventListener("click", function (e) {
        if (e.target.classList.contains("add_item")) {
            const itemDetails = e.target.parentElement.querySelector(".item_details");
            const itemClone = document.querySelector(".iron").cloneNode(true);
            itemDetails.appendChild(itemClone);
        }
    });
});