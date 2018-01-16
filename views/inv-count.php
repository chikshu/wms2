  <h2 class="heading" class="h1"> Investment Count</h2>
   <div class="data-table recieve-goods">
 <div id="table">
   <table tabindex="0">
  <tr>
  <th>Order Number</th>
  <th>Main</th>
  <th>Details</th>
  </tr>
  <tr class="repeat_tr">
  <td>GR170001</td>
  <td>Main</td>
  <td> </td>
  </tr>
 <tr class="repeat_tr">
  <td>GR170002</td>
  <td>Main</td>
  <td>  </td>
  </tr>
  <tr class="repeat_tr">
  <td>GR170002</td>
  <td>Main</td>
  <td> </td>
  </tr>
  <tr class="repeat_tr">
  <td>GR170002</td>
  <td>Main</td>
  <td>  </td>
  </tr>
  <tr class="repeat_tr">
  <td>GR170003</td>
  <td>Main</td>
  <td>  </td>
  </tr>
  <tr class="repeat_tr">
  <td>GR170005</td>
  <td>Main</td>
  <td> </td>
  </tr>
   <tr class="repeat_tr">
  <td>GR170003</td>
  <td>Main</td>
  <td>  </td>
  </tr>
  <tr class="repeat_tr">
  <td>GR170005</td>
  <td>Main</td>
  <td> </td>
  </tr>
  <tr class="repeat_tr">
  <td>GR170003</td>
  <td>Main</td>
  <td> </td>
  </tr>
 
 
  </table>
  </div>
      <div id="pagination">
 
  </div> 
  </div>
  </div>
  </div>
  </section>

  <script>
	//pagination 
	  jQuery(function($) {
                var items = jQuery(".repeat_tr");

                var numItems = items.length;
                var perPage = 8;
				if(numItems > perPage){
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
                              //$('body,html').animate({scrollTop:0},800);
                    }
                });
			}
            }); 
   
	
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
  </body>
  </html>
