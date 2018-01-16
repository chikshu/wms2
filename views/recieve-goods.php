  <h2 class="heading" class="h1"> Recieve Goods</h2>
    <div class="data-table recieve-goods">
  <div id="table">
   <table>
  <tr>
  <th>Order Number</th>
  <th>SUPDES</th>
  <th>Due Date</th>
  </tr>
  <tr class="repeat_tr">
  <td>GR170001</td>
  <td>WINEKEEPER</td>
  <td>15/3/20178 </td>
  </tr>
 <tr class="repeat_tr">
  <td>GR170002</td>
  <td>Lorem</td>
  <td>15/3/20178 </td>
  </tr>
  <tr class="repeat_tr">
  <td>GR170002</td>
  <td>Ipsum</td>
  <td>15/3/20178 </td>
  </tr>
   <tr class="repeat_tr">
  <td>GR170002</td>
  <td>1923</td>
  <td>15/3/20178 </td>
  </tr>
  <tr class="repeat_tr">
  <td>GR170003</td>
  <td>Dummy Text</td>
  <td>15/3/20178 </td>
  </tr>
  <tr class="repeat_tr">
  <td>GR170005</td>
  <td>LoremIpsum</td>
  <td>15/3/20178 </td>
  </tr>
   <tr class="repeat_tr">
  <td>GR170003</td>
  <td>Dummy Text</td>
  <td>15/3/20178 </td>
  </tr>
   <tr class="repeat_tr">
  <td>GR170005</td>
  <td>LoremIpsum</td>
  <td>15/3/20178 </td>
  </tr>
  <tr class="repeat_tr">
  <td>GR170003</td>
  <td>Dummy Text</td>
  <td>15/3/20178 </td>
  </tr>
 
 
  </table>
  </div>
  <!--div class="paginations">  <ul><li><a href="#"><<</a></li>  <li class="selected"><a href="#">1</a></li>  <li><a href="#">2</a></li>  <li><a href="#">3</a></li>  <li><a href="#">4</a></li>  <li><a href="#">>></a></li>  </ul>  </div-->
  <div id="pagination"></div>
  
  </div>
  </div>
  </div>
  </section>
  <script>
	  
	  
	   jQuery(function($) {
                var items = jQuery(".repeat_tr");

                var numItems = items.length;
                //var perPage = 8;
																/******************************/
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
																/******************************/
				if( numItems > perPage){
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
			}
            });
            
            
            
    jQuery('.nav-toggle').click(function(){
   jQuery('.navbar').slideToggle();
   });
   
      jQuery('.parent').click(function(){
	   jQuery(this).addClass("activemenu");
     jQuery(this).find("ul").slideToggle(); 
	
	 jQuery(this).siblings().children('ul').slideUp(); 
	 jQuery(this).siblings().removeClass("activemenu");
   });
  </script>
  <script>
 
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
