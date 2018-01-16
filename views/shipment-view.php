<?php
if(isset($_POST['shipment_name'])){
	
	$ordId = $_POST['shipment_name'];
	}
?>
<script>
var page="shipment-view";


var ht = jQuery('body').height()-125;

	jQuery('#content').css({
			height: ht
	});
if (window.matchMedia('(max-width: 768px)').matches){
	var ht = jQuery('body').height()-205;

	jQuery('#content').css({
			height: ht
	});
	if(jQuery('body').find('#pagination')===true){
	jQuery('.simple-pagination').css({ 'bottom': '0px','margin-top': '30px', 'position': 'relative !important',' width':' 100%'});
	}else{
		//alert('not found');
		
		}
}
</script>
<style>
button.skip {
    background: #2576ad none repeat scroll 0 0;
    border: 0 none;
    border-radius: 4px;
    color: #fff;
    float: left;
    margin-bottom: 15px;
    padding: 10px 20px;
    text-decoration: none;
    margin-left: 20px;
}
.overlay_div {
  position: fixed;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  background: rgba(0,0,0,0.5);
  z-index: 999999999999999;
}

.popup {
  background: #fff none repeat scroll 0 0;
  border-radius: 7px;
  box-shadow: 0 0 7px #ccc;
  left: 0;
  margin: auto !important;
  max-width: 400px;
  min-height: 124px;
  padding: 10px;
  position: absolute;
  right: 0; 
  top: 15%;
  width: 100%;
  z-index: 9999999;
}
.popup textarea {
  color: #000;
  font-family: inherit;
  font-size: 16px !important;
  line-height: 20px;
  margin: 0;
  min-height: auto;
  padding: 10px 0;
  resize: none;
  background: #fff;max-height: 130px;
  border: 0!important;
  width: 100% !important;
}
.popup .close-btnn {
  background: #2576ad none repeat scroll 0 0;
  bottom: 10px;
  color: #fff;
  cursor: pointer;
  font-weight: bold;
  padding: 5px 0;
  position: absolute;
  right: 10px;
  text-align: center;
  width: 60px;
}
.popup .close-btnn:hover {background:#F00; color:#fff;}
.overlay_div textarea {
  margin: 0;
  resize: none;
  width: 100% !important;
}

</style>
  <h2 class="heading" class="h1"> Shipment View</h2>  
 
  <div class="data-table counter-invoice">
  <div id="table">
  <table id="invoice_listing_id">
  <tr>
  <th>Item</th>
  <th>Description</th>
  <th>Barcode</th>
  <th>Location</th>
  <th>Quantity</th>
  <th style="display:none">BIN</th>
  <th style="display:none">ORDI</th>
  <th>PIKORDER</th>
  </tr>
  <tbody id="tbldata">
  <tr class="repeat_tr" id="itemrow1">
  <td>1111</td>
  <td>This is test description-1111</td>
  <td>vvvvggg</td>
  <td>loc-1111</td>
  <td>5</td>
  </tr>
  <tr class="repeat_tr" id="itemrow2">
  <td>2222</td>
  <td>This is test description-2222</td>
  <td>1qw23e</td>
  <td>loc-2222</td>
  <td>6</td>
  </tr>
  <tr class="repeat_tr" id="itemrow3">
  <td>3333</td>
  <td>This is test description-3333</td>
  <td>cccfff</td>
  <td>loc-3333</td>
  <td>7</td>
  </tr>  
  </tbody> 
  </table>
  </div>
  <div id="itemsData" style="display:none"></div>
  <div class="LofinForm">
  <div id="invoice_form"  style="display:none;" >
	  <form method="post" action="<?php get_bloginfo("siteurl"); ?>/DEVELOPMENT/wms2/shipment/" id="invoice_form_id"> 
	    <div class="formgroup"><label>Item :</label> <input type="text" name="item" id="item_id" value="" readonly /> </div>
	    <div class="formgroup"><label> Description :</label> <input type="text" name="description" id="description_id" value="" readonly /> </div>
		<div class="formgroup"><label> Barcode :</label> <input type="text" name="barcode" id="barcode_id" value="" /> </div>
	    <div class="formgroup"><label> Location :</label> <input type="text" name="location" id="location_id" value=""  /> </div>	   
		<div class="formgroup"><label> Quantity :</label> <input type="text" name="quantity" id="quantity_id" value=""/> </div>
		<input type="hidden" name="ordId" id="ordId" value="<?php echo $ordId;?>" >
	  </form>
  </div>
  
  <div class="clear"></div>
   <div class="overlay_div" style="display:none;">
	
	<div class="popup" style="display:none;">
	</div>
	</div>
    <div class="buttons">
    <button type="button" id="continue_button" class="btn-theme pull-left">Continue</button>
    <button type="button" id="next_button" class="next" style="display:none;">Next</button>
     <button type="button" id="skip_button" class="skip" style="display:none;">Skip</button>
    <button type="button" id="finish_button" class="next" style="display:none;">Finish</button>
    </div>
	</div>
  </div>
  </div>
  </div>
  </section>

	  
	  
	


