<script>
var ht = jQuery('body').height()-125;
var page="ship_code";		
		jQuery('#content').css({
			height: ht
	});
if (window.matchMedia('(max-width: 768px)').matches){
	var ht = jQuery('body').height()-125;

	jQuery('#content').css({
			height: ht
	});
}
if (window.matchMedia('(max-width: 375px)').matches){
	var ht = jQuery('body').height()-85;

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
.data-table table th, .data-table table td {
  line-height: 20px!important;
}
}
</style>

  <h2 class="heading" class="h1">Ship Codes</h2>
  <div class="data-table">
  <a class="btn-theme helper" href="#">Sync Ship Codes</a>
  <div id="table">
  <table id="ship_code">
  <tr>
  <th>Line</th>
  <th>Shipment code</th>
  <th>Shipment description</th>
  </tr>
  <tbody id='ship-data'>
 <tr class="repeat_tr">
  <td>1</td>
  <td>9876</td>
  <td>The standard chunk of Lorem Ipsum used since the 1500s.</td>
  </tr>
  <tr class="repeat_tr">
  <td>2</td>
  <td>1923</td>
  <td>The standard chunk of Lorem Ipsum used since the 1500s.  </td>
  </tr>
  <tr class="repeat_tr">
  <td>3</td>
  <td>3224</td>
  <td>There are many variations of passages of Lorem Ipsum. </td>
  </tr>
  <tr class="repeat_tr">
  <td>4</td>
  <td>5476</td>
  <td>All the Lorem Ipsum generators on the Internet tend.</td>
  </tr>
   <tr class="repeat_tr">
  <td>5</td>
  <td>9876</td>
  <td>The standard chunk of Lorem Ipsum used since the 1500s.</td>
  </tr>
   <tr class="repeat_tr">
  <td>6</td>
  <td>9876</td>
  <td>There are many variations of passages of Lorem Ipsum.</td>
  </tr>
   <tr class="repeat_tr">
  <td>7</td>
  <td>9258</td>
  <td>The standard chunk of Lorem Ipsum used since the 1500s.</td>
  </tr>
   <tr class="repeat_tr">
  <td>8</td>
  <td>2589</td>
  <td>The standard chunk of Lorem Ipsum used since the 1500s.</td>
  </tr>
  </tbody>
  </table>
  </div>
  <div id="pagination"></div>
<script>
jQuery(document).ready(function(){
	
	shipCode = jQuery.parseJSON(localStorage.getItem('shipCode'));
	if( shipCode != null ){
		var html='';
		var i=1;
		for(var k in shipCode ){
			console.log(shipCode[k].SHIPTYPE);
		
			var SHIPTYPE =shipCode[k].SHIPTYPE;
			var STCODE = shipCode[k].STCODE;
			var STDES = shipCode[k].STDES;
			
			html += '<tr class="repeat_tr"><td>'+i+'</td><td>'+STCODE+'</td><td>'+STDES+'</td></tr>';
			i++;							
						
		}
			jQuery('#ship-data').html(html);
		}else{
		html ='<tr class="repeat_tr"><td colspan=3>NO DATA</td></tr>';
		jQuery('#ship-data').html(html);
		alert ('No data !! Please Click Sync Ship Code');
		
			
	}
	
	 /************************************* pagination *************************************/
		       
		        var tableId = 'ship_code';
	            var rowCount = $('#'+tableId+' >tbody >tr').length;
				console.log('#'+tableId+' >tbody >tr'+rowCount+'--'+tableId);
                var items = jQuery(".repeat_tr");

                var numItems = rowCount;
                //var perPage = 10;
				/***********************/
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
				/****************************************************/
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



	 


