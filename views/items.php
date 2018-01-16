<script>
var page="items";
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
</style>
  <h2 class="heading" class="h1">Items</h2>
  <div class="data-table">
  <a class="btn-theme helper" href="#">Sync Items</a>
  <div id="table">
  <table id="itemsTable"> 
<tr><th>Items</th><th>Barcode</th><th>Description</th><th>Warhousename</th><th>Locname</th></tr>
<tbody id='item-data'></tbody>


  </table>
  </div>
  <div id="pagination"></div>
  </div>
  </div>
  </section>
<script>

jQuery(document).ready(function(){
	
	itemData = jQuery.parseJSON(localStorage.getItem('itemdata'));
	
	if( itemData != null){
		var html='';
		
		for(var k in itemData ){
				
				console.log('page load >>>'+itemData[k].ITEMCODE);
				
				var itemcode =itemData[k].ITEMCODE;
				var barcode = itemData[k].BARCODE;
				var desc = itemData[k].DESCRIPTION;
				var wname = itemData[k].WAREHOUSENAME;
				var loc = itemData[k].LOCNAME;	
				html += '<tr class="repeat_tr"><td>'+itemcode+'</td><td class="barcode">'+barcode+'</td><td>'+desc+'</td><td>'+wname+'</td><td>'+loc+'</td><input type="hidden" name="part" value="'+itemData[k].PART+'"><input type="hidden" name="bin" value="'+itemData[k].BIN+'"></tr>';
						
			}
			jQuery('#item-data').html(html);
	}else{
		html ='<tr class="repeat_tr"><td colspan=5>NO DATA</td></tr>';
		jQuery('#item-data').html(html);
		alert ('No data !! Please Click Sync Items');
		
			
	}
	 /************************************* pagination *************************************/
		       
		        var tableId = 'itemsTable';
	            var rowCount = $('#'+tableId+' >tbody >tr').length;
				console.log('#'+tableId+' >tbody >tr'+rowCount+'--'+tableId);
                var items = jQuery(".repeat_tr");

                var numItems = rowCount;
                //var perPage = 10;
				
				/************************/
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
				/**********************/
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
			}else{
			     jQuery("#pagination").hide();	
			}
	
	});


</script>


