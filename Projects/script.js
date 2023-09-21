document.addEventListener("DOMContentLoaded", function () {
    const addProductButton = document.querySelector(".add_product");
    const productDetails = document.querySelector("#product_details");

    // Function to calculate and update the total
    function updateTotal(item) {
        const quantity = parseFloat(item.querySelector("[name='quantity[]']").value);
        const kh_price = parseFloat(item.querySelector("[name='kh_price']").value);
        const kh_per = parseFloat(item.querySelector("[name='kh_per']").value);
        const totalField = item.querySelector(".kh_tot");

        if (!isNaN(quantity) && !isNaN(kh_price) && !isNaN(kh_per)) {
            const total = ( kh_per * quantity * kh_price).toFixed(2); // Calculate total
            totalField.value = total; // Update the total field
        } else {
            totalField.value = ""; // Clear the total if any input is not a number
        }
    }

    // Add event listeners to the input fields
    productDetails.addEventListener("input", function (e) {
        if (
            e.target.name === "quantity[]" ||
            e.target.name === "kh_price" ||
            e.target.name === "kh_per"
        ) {
            const item = e.target.closest(".item");
            if (item) {
                updateTotal(item);
            }
        }
    });

    addProductButton.addEventListener("click", function () {
        const productClone = document.querySelector(".product").cloneNode(true);
        productDetails.appendChild(productClone);
    });

    productDetails.addEventListener("click", function (e) {
        if (e.target.classList.contains("add_item")) {
            const itemDetails = e.target.parentElement.querySelector(".item_details");
            const itemClone = document.querySelector(".item").cloneNode(true);
            itemDetails.appendChild(itemClone);
        }
    });
});