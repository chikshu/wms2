<?php
/*
Created By : Shilpa
Date : 4 July
Description : Warehouse Item view data page
*/
if(isset($_POST['warehouse_name'])){
	
	$ordId = $_POST['warehouse_name'];
	}
?>
<script>
var page="warehouse-view";
var ht = jQuery('body').height()-125;

	jQuery('#content').css({
			height: ht
	});
if (window.matchMedia('(max-width: 768px)').matches){
	var ht = jQuery('body').height()-205;

	jQuery('#content').css({
			height: ht
	});
}
</script>
<h2 class="heading" class="h1"> Item View - Warehouse Transfers</h2>  
<div class="data-table warehouse-invoice">
  <div id="warehouse_table">
	  <table id="warehouse_listing_id" style="display:none">
		  <tr >
			  <th>Item</th>
			  <th>Description</th>
			  <th>Barcode</th>
			  <th>From Location</th>
			  <th>Quantity</th>
				<th>To Location</th>
			  <th style="display:none">BIN</th>
			  <th style="display:none">ORDI</th>
			  <th>PIKORDER</th>
		  </tr>
	  <tbody id="tbldata"></tbody> 
	  </table>
   </div>
   <div id="itemsData" style="display:none"></div>
   <div class="LofinForm">
	  <div id="warehouse_form">
		  <form method="post" action="<?php echo get_site_url(); ?>/warehouse-transfers/" id="warehouse_form_id"> 
			<div class="formgroup"><label>Item :</label> <input type="text" name="item" id="item_id" value="" readonly /> </div>
			<div class="formgroup"><label> Description :</label> <input type="text" name="description" id="description_id" value="" readonly /> </div>
			<div class="formgroup"><label> Barcode :</label> <input type="text" name="barcode" id="barcode_id" value=""/> </div>
			<div class="formgroup"><label> From Location :</label> <input type="text" name="fromlocation" id="fromlocation" value=""  /> </div>	   
			<div class="formgroup"><label> Quantity :</label> <input type="text" name="quantity" id="quantity_id" value=""/> </div>
			 <div class="formgroup"><label> To Location :</label> <input type="text" name="tolocation" id="tolocation" value=""/> </div>	 
			<input type="hidden" name="itembin" id="itembin" value="" >
			<input type="hidden" name="itempart" id="itempart" value="" >
			<input type="hidden" name="ordId" id="ordId" value="<?php echo $ordId;?>" >
		  </form>
	  </div>
	  <div class="clear"></div>
		<div class="buttons">
		  <button type="button" id="next_button" class="next">Next</button>
		  <button type="button" id="done_button" class="skip">Done</button>
		  <button type="button" id="finish_button" class="next" style="display:none;">Finish</button>
	  </div>
  </div>
</div>

