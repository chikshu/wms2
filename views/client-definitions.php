<?php
	$uid = get_current_user_id();
	global $wpdb;
	$table_name =wms2_tbl();
	$qry = $wpdb->get_results( "SELECT * FROM ".$table_name. " where `userID`='".$uid."'");
	
	if(!empty($qry)){
		$key = $qry[0]->shipType;
		
		}
?>
<script>
var page="debug";
var ht = jQuery('body').height()-125;

		jQuery('#content').css({
			height: ht
	});
</script>
  <h2 class="heading" class="h1">Client definitions</h2>  
  <div class="data-table debug">
  
  <table id="">
  
  <tbody>
  
  </tbody> 
  </table>
  <div class="LofinForm">
  <div id="client_form"  style="display:block;" >
	  <form method="post" action="http://web1.kindlebit.com/clientdemo/WMS2/html/#" id="clientDefinition"> 
	   <select id="shipCode">
		   <option value="0">Select Ship Code and Description</option>
       </select>
	   <div class="clear"></div>
       <label>Debug Mode</label> <input type="checkbox" class="chk" name="debug_mode" id="debug" value="">
       
	  </form>
	   <div class="buttons">
	   <button type="button" id="save_button" class="next">Save</button>
	   </div>
  </div>
  
  <div class="clear"></div>
  
    
	</div>
  </div>
  </div>
  </div>
  </section>
 
    <script>
    
  </script>

	<script>
	var array = [];
	var shipdata = jQuery.parseJSON(localStorage.getItem('shipCode'));
	//alert(localStorage.getItem('shipCode'));
	jQuery.each(shipdata,function(k,v){
			array.push({stcode: v.STCODE, 	stdes:  v.STDES	,sKey: v.SHIPTYPE	});
			
			//array.push(v.STCODE);
			
		});
	
	jQuery(document).ready(function(){
		
	var Shipkey = <?php echo $key; ?>;
	
	 jQuery('table tr').on('click',function(){
		if(!jQuery(this).hasClass("red") && !jQuery(this).hasClass("green")){
			
		// row click color
			jQuery('table tr').removeClass();
						jQuery(this).addClass("red");
				}else{
						 jQuery(this).removeClass("red");
						 jQuery(this).addClass('green');
				 }
				
			   });  
			   
		// dropdown data	
		var url = '';
		var option = '';
		var selected ='';
		
		jQuery.each(array,function(k,v){
			//alert(k+'---'+v);
			if(Shipkey == v.sKey){
				selected ='selected';
				option += '<option id="'+v.sKey+'" value="'+v.sKey+'" selected="'+selected+'">Code: '+v.stcode  +'               Desc: '+v.stdes+'</option>';
				}else{
					selected='';
					option += '<option id="'+v.sKey+'" value="'+v.sKey+'">Code: '+v.stcode  +'               Desc: '+v.stdes+'</option>';
				}
			
		});
		jQuery('#shipCode').append(option);
	});
	
	//debug mode
	jQuery('#debug').change(function(){
	/*	if(this.checked){
		  alert(jQuery(this).attr('id'));	
		}else{
			alert('not checked');
		}*/
	});
	jQuery('#save_button').click(function(){
	var code=jQuery('#shipCode').val();
	var user= <?php echo get_current_user_id(); ?>;
		jQuery.ajax({
								
						type: "post",
						data:{code : code, UserId:user },
						url: '',
						success: function (response) {
							
							var res = response.split("$$");
							if(res[0] == "success"){
								alert( "ShipKey is Saved");
								jQuery('#shipCode option[id="'+res[1]+'"]').attr("selected", "selected");
							}else{
								
								alert("ShipKey not saved");
								}
						}
					});
	});
	</script>
  </body>
  </html>

