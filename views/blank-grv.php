<script>
var page="blank_grv";
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
#report_employee {
    background: gray none repeat scroll 0 0;
    border-radius: 3px;
    font-size: 18px;
    font-weight: 600 !important;
    margin-bottom: 5px;
    padding: 5px !important;
}
</style>
  <h2 class="heading" id="grv-heading" class="h1">Blank GRV</h2>
  <label class="control-label user scan-label" style="float:left;display:none" id="report_employee"> </label>
  <div class="data-table">
  <a class="btn-theme helper_grv" href="#">Sync GRV</a>
	<div  id="table">
		<table id="blankgrv">
			<tr><th>Order Number</th><th>SUPDES</th><th>Due Date</th>
			</tr>
		<tbody id='blank-data'>

		</tbody>
		</table>
	</div>

	<div id="blank-details" class="LofinForm" style="display:none">
		  <div id="blank_form">
			  
			   <form action="" method="post" id="send_frm_data_dt">
				<div class="formgroup">	
					<input type="hidden" value="" name="blank_orderNUM">
				</div>
				<div class="formgroup">
					<label>Serial Number :</label> 
					<input type="text" name="blank_serial" class="form-control hebrinput" id="blank_serial" value="" required="">
				</div>
				<div class="formgroup">
					<label> Barcode :</label>
					<input type="text" name="blank_barcode" class="form-control hebrinput" id="blank_barcode" value="" required="">	
			   </div>
				<div class="formgroup">
					<label> Quantity :</label>
					<input type="number" id="qty2" name="qty" class=" form-control hebrinput timepicker-two form-control rightpad " value="" required="" >
				</div>
				<div class="formgroup" align="right" id="submitbutton"> <!-- Submit button -->
                   <input type="submit" name="blank_grv_post" value="Send" class="loginbtn hebrinput submobbtn " id="scan_submit">
                </div>				
				<div id="processingimg" class="form-group" align="center" style="display:none">
				  <svg width="50px" height="50px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="uil-default"><rect x="0" y="0" width="100" height="100" fill="none" class="bk"></rect><rect x="46.5" y="40" width="7" height="20" rx="5" ry="5" fill="#2576ad" transform="rotate(0 50 50) translate(0 -30)">  <animate attributeName="opacity" from="1" to="0" dur="1s" begin="0s" repeatCount="indefinite"></animate></rect><rect x="46.5" y="40" width="7" height="20" rx="5" ry="5" fill="#2576ad" transform="rotate(30 50 50) translate(0 -30)">  <animate attributeName="opacity" from="1" to="0" dur="1s" begin="0.08333333333333333s" repeatCount="indefinite"></animate></rect><rect x="46.5" y="40" width="7" height="20" rx="5" ry="5" fill="#2576ad" transform="rotate(60 50 50) translate(0 -30)">  <animate attributeName="opacity" from="1" to="0" dur="1s" begin="0.16666666666666666s" repeatCount="indefinite"></animate></rect><rect x="46.5" y="40" width="7" height="20" rx="5" ry="5" fill="#2576ad" transform="rotate(90 50 50) translate(0 -30)">  <animate attributeName="opacity" from="1" to="0" dur="1s" begin="0.25s" repeatCount="indefinite"></animate></rect><rect x="46.5" y="40" width="7" height="20" rx="5" ry="5" fill="#2576ad" transform="rotate(120 50 50) translate(0 -30)">  <animate attributeName="opacity" from="1" to="0" dur="1s" begin="0.3333333333333333s" repeatCount="indefinite"></animate></rect><rect x="46.5" y="40" width="7" height="20" rx="5" ry="5" fill="#2576ad" transform="rotate(150 50 50) translate(0 -30)">  <animate attributeName="opacity" from="1" to="0" dur="1s" begin="0.4166666666666667s" repeatCount="indefinite"></animate></rect><rect x="46.5" y="40" width="7" height="20" rx="5" ry="5" fill="#2576ad" transform="rotate(180 50 50) translate(0 -30)">  <animate attributeName="opacity" from="1" to="0" dur="1s" begin="0.5s" repeatCount="indefinite"></animate></rect><rect x="46.5" y="40" width="7" height="20" rx="5" ry="5" fill="#2576ad" transform="rotate(210 50 50) translate(0 -30)">  <animate attributeName="opacity" from="1" to="0" dur="1s" begin="0.5833333333333334s" repeatCount="indefinite"></animate></rect><rect x="46.5" y="40" width="7" height="20" rx="5" ry="5" fill="#2576ad" transform="rotate(240 50 50) translate(0 -30)">  <animate attributeName="opacity" from="1" to="0" dur="1s" begin="0.6666666666666666s" repeatCount="indefinite"></animate></rect><rect x="46.5" y="40" width="7" height="20" rx="5" ry="5" fill="#2576ad" transform="rotate(270 50 50) translate(0 -30)">  <animate attributeName="opacity" from="1" to="0" dur="1s" begin="0.75s" repeatCount="indefinite"></animate></rect><rect x="46.5" y="40" width="7" height="20" rx="5" ry="5" fill="#2576ad" transform="rotate(300 50 50) translate(0 -30)">  <animate attributeName="opacity" from="1" to="0" dur="1s" begin="0.8333333333333334s" repeatCount="indefinite"></animate></rect><rect x="46.5" y="40" width="7" height="20" rx="5" ry="5" fill="#2576ad" transform="rotate(330 50 50) translate(0 -30)">  <animate attributeName="opacity" from="1" to="0" dur="1s" begin="0.9166666666666666s" repeatCount="indefinite"></animate></rect></svg>
                 
                </div>	
			  </form>
		  </div>
	</div>
	<div id="pagination"></div>
 
</div>
  </section>
  
  
<script>
jQuery(document).ready(function(){
	
	jQuery('body').on('dblclick touchstart','#blank-data tr',function(){
		 jQuery(".loader_img").show();
		 var ordno = jQuery(this).children('td:eq(0)').text();
		 jQuery('#table').hide();
		 jQuery('#grv-heading').text('GRV Details');
		 jQuery('#blank-details').show();
		 jQuery('#report_employee').text(ordno);
		 jQuery('.helper_grv').hide();
		 jQuery(".loader_img").hide();
		
	});
	
	
	
	jQuery("#send_frm_data_dt").submit(function(event) {
		  jQuery("#processingimg").show();
			event.preventDefault();
			 var site_url = '<?php echo get_site_url(); ?>';
			var $form = jQuery( this ),
			url = '';
			var frmdata =jQuery('#send_frm_data_dt').serialize();
			var posting = jQuery.post( url, frmdata );
			posting.done(function( data ) {
				 jQuery("#processingimg").hide();
				 //jQuery("#send_frm_data_dt").reset();
				 window.location.href = site_url+'/blank-grv';
				 jQuery('#send_frm_data_dt')[0].reset();
				console.log(data);
			});
	});
	
 });
</script>


