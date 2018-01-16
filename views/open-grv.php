<script>
var page="open_grv";
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

			 jQuery('body').on('click','table tr',function(){
				
				if(!jQuery(this).hasClass("red") && !jQuery(this).hasClass("green")){
						jQuery('table tr').removeClass();
						jQuery(this).addClass("red");
				}else{
						 jQuery(this).removeClass("red");
						 jQuery(this).addClass('green');
				 }
				
			   });  

</script>
<style>
@media only screen and (max-width:768px) { 
.repeat_tr {
  height: 35px !important;
}
}
.helper_grv {
    margin-top: -55px;
    position: relative;
}
#grvno {
    background: gray none repeat scroll 0 0;
    border-radius: 3px;
    font-size: 18px;
    font-weight: 600 !important;
    margin-bottom: 5px;
    padding: 5px !important;
}
</style>
  <h2 class="heading" id="grv-heading" class="h1">Open GRV</h2>
  <div>
			<label class="control-label" id="grvno" style="float:left; width:auto !important;  padding:0; font-weight:500; ">
			</label>
</div>
  <div class="data-table">
  <a class="btn-theme helper_grv" href="#">Sync GRV</a>
	<div  id="table">
		<table id="grv">
			<tr><th>Order Number</th><th>SUPDES</th><th>Due Date</th>
			</tr>
		<tbody id='grv-data'>

		</tbody>
		</table>
		
		<table id="gtable">
			<thead><th>PARTNAME</th>
					<th>Barcode</th>
					<th>Part Description</th>
					<th>PQUANT</th>
					<th>SETFLAG</th>
					<th>TQUANT</th>
					<th>TOLOCNAME</th>
					<th>SERIALNAME</th>
			</thead>
			<tbody id="grv-list">
				
			</tbody>
		</table>
	
	</div>

		
		
	<div id="pagination"></div>
	<div class="overlay_div" style="display:none;">
	<div>
	<div class="popup" style="display:none;">
	</div>
</div>
  </section>
  
  
<script>
	

</script>


