var i= parseInt($('#iron-new-rr').val());
var a=parseInt($('#ac-new-rr').val());
var b=parseInt($('#band-new-rr').val());
document.addEventListener("DOMContentLoaded", function () {
    
    const productDetails = document.querySelector("#product_details");

   

    productDetails.addEventListener("click", function (e) {
        if (e.target.classList.contains("add_iron")) {
            
            
           $("#main-iron").append('<div class="row" id="row'+i+'"><div class="col-md-2 col-sm-6"> <div class="form-group"><label for="iron">مقاس الحديد</label><select class="form-control" name="iron_'+i+'" id="iron_'+i+'"><option value="0.395">8مم</option><option value="0.617">10مم</option><option value="0.888">12مم</option><option value="1.21">14مم</option><option value="1.58">16مم</option><option value="2">18مم</option><option value="2.47">20مم</option><option value="2.984">22مم</option><option value="3.85">25مم</option><option value="6.41">32مم</option>     </select>   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_price">سعر طن الحديد لليوم</label>     <input type="text" class="form-control" name="iron_price_'+i+'" id="iron_price_'+i+'">   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_quantity">كمية الحديد</label>     <input type="text" class="form-control" name="iron_quantity_'+i+'" id="iron_quantity_'+i+'">   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_long">طول الحديد</label>     <input type="text" class="form-control" name="iron_long_'+i+'" id="iron_long_'+i+'">   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_tn">السعر الطن</label>     <input type="text" class="form-control" name="iron_tn_'+i+'" id="iron_tn_'+i+'" readonly>   </div> </div> <div class="col-md-2 col-sm-6">   <div class="form-group">     <label for="iron_tot">السعر </label>     <input type="text" class="form-control" name="iron_tot_'+i+'" id="iron_tot_'+i+'" readonly>     <input type="hidden" value="'+i+'" id="rowcount" readonly>   </div> </div></div><hr class="new2">');
           
        }

        if (e.target.classList.contains("add_accessory")) {
            $("#main-accessory").append('<div class="row ">    <div class="col-md-2 col-sm-6 ">      <div class="form-group"><label for="accessory">أسم الاكسسوار</label><input type="text" class="form-control" name="accessory_'+a+'" id="accessory_'+a+'">      </div>    </div>    <div class="col-md-2 col-sm-6">      <div class="form-group"><label for="acc_quantity">كمية الاكسسوار</label><input type="text" class="form-control" name="acc_quantity_'+a+'" id="acc_quantity_'+a+'">      </div>    </div>    <div class="col-md-2 col-sm-6 ">      <div class="form-group"><label for="acc_price">سعر الاكسسوار الفردي</label><input type="text" class="form-control" name="acc_price_'+a+'" id="acc_price_'+a+'">      </div>    </div>    <div class="col-md-2 col-sm-6 ">      <div class="form-group"><label for="acc_tot">السعر</label><input type="text" class="form-control" name="acc_tot_'+a+'" id="acc_tot_'+a+'" readonly><input type="hidden" value="'+a+'" id="rowcount_ac " readonly>      </div>    </div>  </div><hr class="new2">');
        }
        if (e.target.classList.contains("add_band")) {
            $("#main-band").append('<div class="row">   <div class="col-md-2 col-sm-6">     <div class="form-group">       <label for="band">أسم البند</label>       <input type="text" class="form-control" name="band_'+b+'" id="band_'+b+'">     </div>   </div>   <div class="col-md-2 col-sm-6">     <div class="form-group">       <label for="band_price">سعر البند</label>       <input type="text" class="form-control" name="band_price_'+b+'" id="band_price_'+b+'">     </div>   </div>   <div class="col-md-2 col-sm-6">     <div class="form-group">       <label for="band_tot">السعر</label>       <input type="text" class="form-control" name="band_tot_'+b+'" id="band_tot_'+b+'" readonly>       <input type="hidden" value="'+b+'" id="rowcount_band" readonly>     </div>   </div> </div><hr class="new2">');
        }
    });
});