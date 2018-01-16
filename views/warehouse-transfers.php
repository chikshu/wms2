<?php
/*
Created By : Shilpa
Date : 4 July
Description : Warehouse Transfers page
*/

if(isset($_POST['ordId']))
{
   $_POST['ordId'];
   $id = $_POST['ordId'];	
}

$uid = get_current_user_id();
global $wpdb;
$table_name =wms2_tbl();
$qry = $wpdb->get_results( "SELECT * FROM ".$table_name. " where `userID`='".$uid."'");

if(!empty($qry)){
$key = $qry[0]->shipType;

}

?>
<script>
var page="warehouse-transfers";

var ht = jQuery('body').height()-125;
jQuery('#content').css({
     height: ht
});
if (window.matchMedia('(max-width: 768px)').matches)
{
	var ht = jQuery('body').height()-80;

	jQuery('#content').css({
			height: ht
	});
	if(jQuery('body').find('#pagination')===true){
	jQuery('.simple-pagination').css({ 'bottom': '0px','margin-top': '30px', 'position': 'relative !important',' width':' 100%'});
	}else
	{
		//alert('not found');	
	}
}
</script>
  <h2 class="heading" class="h1">Warehouse Transfers</h2>
  
  <div class="data-table warehouse-transfers">
	<div id="table">
	<table >
	<tr id="tr_0">
	<th>Document Number</th>
	<th>From Location</th>
	<th>Date</th>
	</tr>
	<tbody id="warehouse">
	</tbody>
	</table>
	</div>
	<div>
	      <form method="post" action="<?php echo get_site_url(); ?>/warehouse-view" id="warehouse_view_id"> 
		      <input type="hidden" name="warehouse_name" id="warehouse_id" value="" />
	     </form>
	</div>
	<div id="pagination"></div>
  </div>
 <!-- </div>
  </div>
  </section>-->

  <script>
var array = [];
var shipdata = jQuery.parseJSON(localStorage.getItem('shipCode'));
//alert(localStorage.getItem('shipCode'));
jQuery.each(shipdata,function(k,v){
		array.push({stcode: v.STCODE, 	stdes:  v.STDES	,sKey: v.SHIPTYPE	});
	});

jQuery(document).ready(function() {
	
/****************Client Defenation Ship code*********************/
var shipcodeVal = '';
var Shipkey = <?php echo $key; ?>;
jQuery.each(array,function(k,v){
	if(Shipkey == v.sKey)
	{
		shipcodeVal = 'Code: '+v.stcode  +' Desc: '+v.stdes+'';
	}
	jQuery('#clitnshipCode').val(shipcodeVal);
	});

/************************************************************/

// get table data
	var wavedata = localStorage.getItem('wave');
    //console.log(wavedata+'oooooooooo');
	var arr = JSON.parse(wavedata);
	if(arr != null){
		var tr='';
		var i=1;
		
		jQuery.each(arr,function(k,v){
		//  alert('wavedata'+ v.ORDNAME+','+v.PNCO_WEBNUMBER+','+v.CURDATE);
		tr += '<tr class="repeat_tr" id="tr_'+i+'"><td>'+ v.ORDNAME+'</td><td>'+v.PNCO_WEBNUMBER+'</td><td>'+v.CURDATE+'</td></tr>';
		i++;
		
		});
		
		jQuery('#warehouse').html(tr);
		}else{
		
			alert('No Data');
			jQuery('#counter').html('<tr class="noClick"><td colspan=4>NO DATA</td></tr>');
		}

// row nonclick
 jQuery('table tr').each(function(index){
	   var result = JSON.parse(localStorage.getItem("oldIds"));
	   var tr = jQuery(this);
	   	jQuery.each(result,function(k,v){
		console.log(k+'result '+ result[k].id);
		var oldId =  result[k].id;
			console.log( index + ": " + jQuery( tr ).attr('id') );
			console.log('old: '+oldId);
			var tid = jQuery( tr ).attr('id');
			 console.log('Tid: '+tid);
			var id = jQuery('#'+tid).children('td:eq(0)').text();
			if(oldId == id){
				console.log('class added');
				jQuery(tr).addClass('noClick');
			}else{
				console.log(oldId+ ' no id '+id);
			}
		});

 });

 jQuery('body').on('click','table tr',function(){
	
	var currentId = jQuery( this ).attr('id');
	 var currentRow = this.rowIndex;
	//var a =parseInt(currentRow);
	jQuery('table tr').each(function(index){
		console.log(index+" >>>>>>>>>>>>>>>>>>>>>>>>>>>>> "+currentRow);
		
		if(jQuery(this).hasClass("noClick")) {
			
		} else {
			if(index == currentRow) {
				console.log(index+" Working "+currentId);
				console.log( jQuery("#"+currentId).html());
		        //jQuery("#"+currentId).html("<td>1</td><td>2</td><td>3</td>");
				//jQuery("#" + currentId).removeAttr('class').addClass('red');
				if(!jQuery(this).hasClass("red") && !jQuery(this).hasClass("green") && !jQuery(this).hasClass("noClick")){
					jQuery(this).addClass("red");
				}else if(jQuery(this).hasClass("red")){
					 jQuery(this).removeClass("red");
					 jQuery(this).addClass('green');
					 var inv = jQuery(this).chil