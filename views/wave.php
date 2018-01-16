<script>
var ht = jQuery('body').height()-125;


var page="wave";

var waveUID= <?php echo get_current_user_id(); ?>;
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
<?php
	$uid = get_current_user_id();
	global $wpdb;
	$table_name =wms2_tbl();
	$qry = $wpdb->get_results( "SELECT * FROM ".$table_name. " where `userID`='".$uid."'");
	
	if(!empty($qry)){
		$key = $qry[0]->shipType;
		
		}
?>
<div class="wave-box">
	<div class="wave-title"><h2 class="" class="h1"> Wave </h2></div>
  <div class="clitnshipCode-input"><input type='text' id='clitnshipCode' readonly='readonly'></div>
  </div>
  <div class="data-table">
   <a class="btn-theme helper" href="#">Refresh Wave</a>

<div id="table">
<table id="wave_table">
<tr id='tr_0'>
	<th>Order Number</th>
	<th>WebNumber</th>
	<th>Due Date</th>
</tr>
<tbody id="wave-data"></tbody>
</table>
</div>
<div id="pagination"></div>

  </div>
  </div>
  </section>

<script>

		
var array = [];
var shipdata = jQuery.parseJSON(localStorage.getItem('shipCode'));
//alert(localStorage.getItem('shipCode'));
jQuery.each(shipdata,function(k,v){
		array.push({stcode: v.STCODE, 	stdes:  v.STDES	,sKey: v.SHIPTYPE	});
	});
	
jQuery(document).ready(function(){
	
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
	
	/*************************************/
	waveData = jQuery.parseJSON(localStorage.getItem('wave'));
	if( waveData != null ){
		var html='';
		var i=1;
		for(var k in waveData ){
				console.log(waveData[k].PNCO_WEBNUMBER);
				
					var partname =waveData[k].ORDNAME;
					var place = waveData[k].PNCO_WEBNUMBER;
					var location = waveData[k].CURDATE;
					
					html += '<tr class="repeat_tr" id="tr_'+i+'"><td>'+partname+'</td><td>'+place+'</td><td>'+location+'</td></tr>';
					i++;
			}
			jQuery('#wave-data').html(html);
	}else{
		html ='<tr class="repeat_tr"><td colspan=3>NO DATA</td></tr>';
		jQuery('#wave-data').html(html);
		alert ('No Data! Please Click Refresh Wave');
		
			
	}
	
	
	
	
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
	 /************************************* pagination *************************************/
		       
		        var tableId = 'wave_table';
	            var rowCount = jQuery('#'+tableId+' >tbody >tr').length;
				console.log('#'+tableId+' >tbody >tr'+rowCount+'--'+tableId);
                var items = jQuery(".repeat_tr");

                var numItems = rowCount;
				
				var bodyhight = jQuery('body').height();
				
				
				if(bodyhight <= 380)
				{
					var perPage = 1;
				}
				else if(bodyhight >= 380 && bodyhight <= 470)
				{
					var perPage = 3;
				}
				else if(bodyhight >= 370 && bodyhight <= 480)
				{
					var perPage = 5;
				}
				else if(bodyhight >= 480 && bodyhight <= 980)
				{
					var perPage = 9;
				}
				else
				{
					var perPage = 10;
				}
               
				
				if(numItems > perPage){
					console.log(numItems +'-----------'+perPage);
                // only show the first 2 (or "first per_page") items initially
                items.slice(perPage).hide();

                // now setup pagination
                jQuery("#pagination").pagination({
                    items: numItems,
                    itemsOnPage: perPage,
                    cssStyle: "light-theme",
                    onPageClick: function(pageNumber) { // this is where the magic happens
                        // someone changed page, lets hide/show trs appropriately
                        var showFrom = perPage * (pageNumber - 1);
                        var showTo = showFrom + perPage;

                        items.hide() // first hide everything, then show for the new page
                             .slice(showFrom, showTo).show();
                              //jQuery('body,html').animate({scrollTop:0},800);
                    }
                });
                jQuery("#pagination").show();
			}else{
			     jQuery("#pagination").hide();	
			}
		
		
		
		// row highlight 
jQuery('body').on('click','table tr',function(){
	
	var currentId = jQuery( this ).attr('id');
	 var currentRow = this.rowIndex;
	//var a =parseInt(currentRow);
	jQuery('table tr').each(function(index){
		console.log(index+" >>>>>>>>>>>>>>>>>>>>>>>>>>>> > "+currentRow);
		
		if(jQuery(this).hasClass("noClick")) {
			
		}else {
			if(index == currentRow) {
				console.log(index+" Working "+currentId);
				console.log( jQuery("#"+currentId).html());
		        
				if(!jQuery(this).hasClass("red") && !jQuery(this).hasClass("green") && !jQuery(this).hasClass("noClick")){
					jQuery(this).addClass("red");
				}else if(jQuery(this).hasClass("red")){
					 jQuery(this).removeClass("red");
					 jQuery(this).addClass('green');
				}
			} else {
				jQuery(this).removeClass();
			}
			
		}
		
		
	 });
	
    
   });  
   
 
	
		
	});
	
	
	
	
</script>

 
