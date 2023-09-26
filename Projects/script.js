var i=$('#rowcount').val();
var a=$('#rowcount_ac').val();
document.addEventListener("DOMContentLoaded", function () {
    const addProductButton = document.querySelector(".add_product");
    const productDetails = document.querySelector("#product_details");

   // Function to calculate and update the total for each item
    addProductButton.addEventListener("click", function () {
        const productClone = document.querySelector(".product").cloneNode(true);
        productDetails.appendChild(productClone);
    });

    productDetails.addEventListener("click", function (e) {
        if (e.target.classList.contains("add_iron")) {
            
            
           $("#main-iron").append('<div class="row" id="row'+i+'"><div class="col-md-2 col-sm-6"> <div class="form-group"><label for="iron">مقاس الحديد</label><select class="form-control" name="iron_'+i+'" id="iron_'+i+'"><option value="0.395">8مم</option><option value="0.617">10مم</option><option value="0.888">12مم</option><option value="1.21">14مم</option><option value="1.58">16مم</option><option value="2">18مم</option><option value="2.47">20مم</option><option value="2.984">22مم</option><option value="3.85">25مم</option><option value="6.41">32مم</option>     </select>   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_price">سعر طن الحديد لليوم</label>     <input type="text" class="form-control" name="iron_price_'+i+'" id="iron_price_'+i+'">   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_quantity">كمية الحديد</label>     <input type="text" class="form-control" name="iron_quantity_'+i+'" id="iron_quantity_'+i+'">   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_long">طول الحديد</label>     <input type="text" class="form-control" name="iron_long_'+i+'" id="iron_long_'+i+'">   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_tn">السعر الطن</label>     <input type="text" class="form-control" name="iron_tn_'+i+'" id="iron_tn_'+i+'" disabled>   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_tot">السعر الكلي</label>     <input type="text" class="form-control" name="iron_tot_'+i+'" id="iron_tot_'+i+'" disabled>     <input type="hidden" value="'+i+'" id="rowcount" disabled>   </div> </div></div>');
           
        }

        if (e.target.classList.contains("add_accessory")) {
            $("#main-iron").append('<div class="row ">    <div class="col-md-2 col-sm-6 ">      <div class="form-group"><label for="accessory">أسم الاكسسوار</label><input type="text" class="form-control" name="accessory_'+a+'" id="accessory_'+a+'">      </div>    </div>    <div class="col-md-2 col-sm-6">      <div class="form-group"><label for="acc_quantity">كمية الاكسسوار</label><input type="text" class="form-control" name="acc_quantity_'+a+'" id="acc_quantity_'+a+'">      </div>    </div>    <div class="col-md-2 col-sm-6 ">      <div class="form-group"><label for="acc_price">سعر الاكسسوار الفردي</label><input type="text" class="form-control" name="acc_price_'+a+'" id="acc_price_'+a+'">      </div>    </div>    <div class="col-md-2 col-sm-6 ">      <div class="form-group"><label for="acc_tot">السعر الكلي</label><input type="text" class="form-control" name="acc_tot_'+a+'" id="acc_tot_'+a+'" disabled><input type="hidden" value="'+a+'" id="rowcount_ac " disabled>      </div>    </div>  </div>');
        }
        if (e.target.classList.contains("add_band")) {
            const itemDetails = e.target.parentElement.querySelector(".band_details");
            const itemClone = document.querySelector(".band").cloneNode(true);
            itemDetails.appendChild(itemClone);
        }
    });
});