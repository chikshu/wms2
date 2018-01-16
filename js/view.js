// shipment and in voice view
function isArray(what) {
    return Object.prototype.toString.call(what) === '[object Array]';
}	
	var bins = [];
	 var items = [];
	  var locval = [];
	  var warhs = [];
	jQuery(function($) { 
		 
	  var DataArray =[];
	  var wave = jQuery.parseJSON(localStorage.getItem('waveComplete'));
	  var ordNo = jQuery('#ordId').val();
	  var list_bin = jQuery.parseJSON(listbinData);
	  var itemdata = jQuery.parseJSON(localStorage.getItem('itemdata'));
		
	  
	   var pikorder = [];
	   
	  
	   var part = [];
	  
		jQuery.each(itemdata,function(k,v){
			//items.push({loc: v.LOCNAME, 	item:  v.ITEMCODE		});
			
			locval.push(v.LOCNAME);
			items.push(v.ITEMCODE);
			part.push(v.PART);
			bins.push(v.BIN);
		});
		jQuery.each(list_bin,function(k,v){
			//items.push({loc: v.LOCNAME, 	item:  v.ITEMCODE		});
			pikorder.push(v.PIKORDER);
			warhs.push(v.WARHS);
			
		});
		
	  var trData = '';
	  var j = 1;
	  
	  for(var i in wave.ORDER){
		
		//console.log('iiii >>>> ' + i + ' item >> '+ wave.ORDER[i].ORDNAME);
		var ord = wave.ORDER[i].ORDNAME;
		
		if(ord ==  ordNo){
			//alert(pikorder);
			DataArray.push(wave.ORDER[i]);
			console.log(ordNo +' iiii >>>> ' + i + ' item >> '+ wave.ORDER[i].ORDERITEMS.ORDERITEM.PARTNAME);
				if(isArray(wave.ORDER[i].ORDERITEMS.ORDERITEM)){
				//	pikorder.reverse();
				//	alert('array');
					for( k in DataArray[0].ORDERITEMS.ORDERITEM){
			
							var count = DataArray[0].ORDERITEMS.ORDERITEM.length;
							var item = DataArray[0].ORDERITEMS.ORDERITEM[k].PARTNAME;
							 if(jQuery.inArray( item, items ) !=  -1 ){
								// console.log('yehhhhhh' + jQuery.inArray( item, items )  +'---'+ locval[1352]);
								
								 var index = jQuery.inArray( item, items );
								  console.log(index+'yehhhhhhoooo' + jQuery.inArray( item, items )  +'---'+ locval[index]+'part -- '+ part[index]);
								 var locvals = locval[index];
								 var parts = part[index];
								 var BIN = bins[index];
								 if(jQuery.inArray( BIN, warhs ) !=  -1 ){
									 var indx = jQuery.inArray( BIN, warhs );
									 var pikord = pikorder[indx];
								 }
								 //add pikorder in array
								 DataArray[0].ORDERITEMS.ORDERITEM[k].pikord = pikord;
								 DataArray[0].ORDERITEMS.ORDERITEM.sort(function(obj1, obj2) {
										// Ascending: first age less than the previous
								//		return obj1.pikord - obj2.pikord;
									});
																	 
								//alert(DataArray[0].ORDERITEMS.ORDERITEM[k].pikord);
								console.log('count-- '+count+' ORDI >> '+ DataArray[0].ORDERITEMS.ORDERITEM[k].ORDI);
								
								trData += '<tr class="repeat_tr" id="itemrow'+j+'"><td>'+ DataArray[0].ORDERITEMS.ORDERITEM[k].PARTNAME +'</td><td>'+DataArray[0].ORDERITEMS.ORDERITEM[k].PDES+'</td><td>'+DataArray[0].ORDERITEMS.ORDERITEM[k].BARCODE+'</td><td>'+locvals+'</td><td>'+ DataArray[0].ORDERITEMS.ORDERITEM[k].TQUANT +'</td><td  style="display:none" id="bin">'+BIN+'</td><td  style="display:none" id="ordi">'+DataArray[0].ORDERITEMS.ORDERITEM[k].ORDI+'</td><td>'+DataArray[0].ORDERITEMS.ORDERITEM[k].pikord+'</td><td  style="display:none" id="part">'+parts+'</td></tr>';
								
								j++;
						}
				
					}
				}else{
						
					//	alert('not array');
						
						var item = wave.ORDER[i].ORDERITEMS.ORDERITEM.PARTNAME;
							 if(jQuery.inArray( item, items ) !=  -1 ){
								// console.log('yehhhhhh' + jQuery.inArray( item, items )  +'---'+ locval[1352]);
								 var index = jQuery.inArray( item, items );
								  console.log(index+'yehhhhhh' + jQuery.inArray( item, items )  +'---'+ locval[index]+'part -- '+ part[index]);
								 var locvals = locval[index];
								 var parts = part[index];
								 var BIN = bins[index];
								 if(jQuery.inArray( BIN, warhs ) !=  -1 ){
									 var indx = jQuery.inArray( BIN, warhs );
									 var pikord = pikorder[indx];
								 }
								console.log('count-- '+count+' ORDI >> '+wave.ORDER[i].ORDERITEMS.ORDERITEM.ORDI);
								
								trData += '<tr class="repeat_tr" id="itemrow'+j+'"><td>'+wave.ORDER[i].ORDERITEMS.ORDERITEM.PARTNAME +'</td><td>'+wave.ORDER[i].ORDERITEMS.ORDERITEM.PDES+'</td><td>'+wave.ORDER[i].ORDERITEMS.ORDERITEM.BARCODE+'</td><td>'+locvals+'</td><td>'+ wave.ORDER[i].ORDERITEMS.ORDERITEM.TQUANT +'</td><td  style="display:none" id="bin">'+BIN+'</td><td  style="display:none" id="ordi">'+wave.ORDER[i].ORDERITEMS.ORDERITEM.ORDI+'</td><td>'+pikord+'</td><td  style="display:none" id="part">'+parts+'</td></tr>';
								
								j++;
						}
						
					}
			
			jQuery('#tbldata').html(trData);
		
		}else{
			console.log('no data');
			}
		
		
		
		}
		
		
	});
jQuery(document).ready(function() {
			
			var rowcnt=2;
			var totrowcnt= jQuery('#tbldata tr').length; //3; //COUNT RECORD ARRAY
			var qty = 0;
	        var origarray = [];
			var newarray = [];
			var headers = [];
			jQuery('#invoice_listing_id th').each(function(index, item) {
				headers[index] = jQuery(item).html();
			});
			jQuery('#invoice_listing_id tr').has('td').each(function() {
				var arrayItem = {};
				jQuery('td', $(this)).each(function(index, item) {
					arrayItem[headers[index]] =jQuery(item).html();
				});
				origarray.push(arrayItem);
			});
			console.log('origarray :'+ origarray ); 
	      var origarrlen = origarray.length;
			// last row data
			var item_last = jQuery('#tbldata tr:last').children('td:eq(0)').text();
			//global variables
			var itemm = '';
			var desc = '';
			var bar = '';
			var loc = '';
			var qty = '';
			var bin = '';
			var ordi = '';
			var pik_ord = '';
			var oldbar = '';
			var part = '';
 jQuery('#continue_button').on('click',function(){ 
	 
			jQuery('#invoice_listing_id').hide(); 
			jQuery('#table').hide(); 
			jQuery('#continue_button').hide(); 
			jQuery('#invoice_form').show(); 
			jQuery('#next_button').show();  
			jQuery('#skip_button').show();  
			
			 itemm = jQuery('#invoice_listing_id tr#itemrow1').children('td:eq(0)').text();
			 desc = jQuery('#invoice_listing_id tr#itemrow1').children("td:eq(1)").text();
			 barcode = jQuery('#invoice_listing_id tr#itemrow1').children("td:eq(2)").text();
			 oldbar = jQuery('#invoice_listing_id tr#itemrow1').children("td:eq(2)").text();
			 loc = jQuery('#invoice_listing_id tr#itemrow1').children("td:eq(3)").text();   
			 qty = jQuery('#invoice_listing_id tr#itemrow1').children("td:eq(4)").text();   
			 bin = jQuery('#invoice_listing_id tr#itemrow1').children("td:eq(5)").text();   
			 ordi = jQuery('#invoice_listing_id tr#itemrow1').children("td:eq(6)").text();   
			 pik_ord = jQuery('#invoice_listing_id tr#itemrow1').children("td:eq(7)").text();   
			 part = jQuery('#invoice_listing_id tr#itemrow1').children("td:eq(8)").text();   
			 //newarray.push({item:itemm,desc:desc,bar:bar,loc:loc,qty:qty});
            // var itembar = itemm +">>>>"+ barcode;
			  jQuery("#item_id").val(itemm);
			  jQuery('#description_id').val(desc);
			  jQuery('#barcode_id').val('');
			  jQuery('#location_id').val(loc);
			  jQuery('#quantity_id').val(qty);  
			  
   }); 
   
   
   /*************************************** on next click event ****************************************************/
  //global variable for storing barcodes and loc val for comparing data
  var barNum = [];
  var barcodes = [];
   jQuery('#next_button').on('click touchstart',function(){ 
	
	 console.log("rowcntrowcnt >> "+rowcnt);
	var newqty = jQuery('#quantity_id').val();
	//alert(newqty +'----'+rowcnt);
	var bar = jQuery('#barcode_id').val();
	var loc = jQuery('#location_id').val();
	var locArr = JSON.parse(listbinData);
					
			jQuery.each(locArr,function(k,v){
				
				barNum.push(v.LOCNAME.toLowerCase());
			});
	var arr = JSON.parse(itemData);
					
			jQuery.each(arr,function(k,v){
			//	console.log(v.BARCODE);
				barcodes.push(v.BARCODE);
			});
	
	  // if(rowcnt > origarrlen ){	
	  if((itemm == item_last) && ((newqty == qty)  || (newqty == 0)) ){
		  
		  if(jQuery.inArray( bar, barcodes ) !=  -1  && bar != '' && bar == barcode){
			 loc = loc.toLowerCase();
				 if(jQuery.inArray( loc, barNum ) !=  -1 ) {
						 var index = jQuery.inArray( loc, barNum );
						loc = loc.toUpperCase();
						
						var BIN =  warhs[index];
						
						newarray.push({item:itemm,desc:desc,bar:bar,loc:loc,qty:newqty,bin : BIN, ordi: ordi,pik_ord: pik_ord,part:part });	
						jQuery('#invoice_form').hide(); 
						jQuery('#invoice_listing_id').show(); 
						jQuery('#table').show(); 
						jQuery('#finish_button').show();  
						jQuery('#next_button').hide(); 
						jQuery('#skip_button').hide(); 
						var rowss='';
						var i=1;
						
						jQuery.each(newarray,function(k,v){
							//console.log("newarray > "+v.item);
							
						rowss +='<tr id="itemrow'+i+'"><td>'+v.item+'</td><td>'+v.desc+'</td><td>'+v.bar+'</td><td>'+v.loc+'</td><td>'+v.qty+'</td><td  style="display:none" id="bin">'+v.bin+'</td><td  style="display:none" id="ordi">'+v.ordi+'</td><td>'+v.pik_ord+'</td><td style="display:none" id="part">'+v.part+'</td></tr>';
						i++;
						});
						jQuery("#tbldata").html(rowss);	
						
						rowcnt=1;
				}else{
					
				alert('loc value does not match with table data');	
				}
			}else{
			alert('bar error: Can not be blank or should match with Item barcodes');
		 }
	   }else{
			//console.log("count > "+rowcnt);
			console.log("rowcnt >> "+rowcnt);
			console.log("item : "+itemm+'----- qty'+newqty);
			// match bar value from items > barcode
			
			// compare barcode with item page bar code on next click
			if( itemData != null && listbinData != null ){
			
				 // list bin location
					
						console.log('barNum'+barNum);
					
					
					console.log('BARCODE '+ barcodes);
			 if(jQuery.inArray( bar, barcodes ) !=  -1 && bar != '' && bar == barcode){
				  loc = loc.toLowerCase();
				 if(jQuery.inArray( loc, barNum ) !=  -1 ) {
					 
					 var index = jQuery.inArray( loc, barNum );
						loc = loc.toUpperCase();
						
						var BIN =  warhs[index];
								
						newarray.push({item:itemm,desc:desc,bar:bar,loc:loc,qty:newqty, bin:BIN, ordi : ordi, pik_ord: pik_ord,part:part });
						console.log("qty > "+qty+"  newqty "+newqty); 
						
						
						if(newqty<qty){
									console.log('new val');
									var newrowqty= parseInt(qty) - parseInt(newqty);  
									 jQuery('#quantity_id').val(newrowqty); 
									 qty = newrowqty;
									 newqty = newrowqty;
								
						 }else{
							itemm = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children('td:eq(0)').text();
							desc = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(1)").text();
							//bar = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(2)").text();
							barcode = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(2)").text();;
							loc = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(3)").text();
							qty = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(4)").text();   
							bin = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(5)").text();   
							ordi = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(6)").text();   
							pik_ord = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(7)").text();   
							part = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(8)").text();   
						
								  // var itembar = itemm +"<<<<<"+ barcode;
                                    jQuery("#item_id").val(itemm);
								  jQuery('#description_id').val(desc);
								  jQuery('#barcode_id').val('');
								  jQuery('#location_id').val(loc);
								  jQuery('#quantity_id').val(qty); 
									rowcnt=rowcnt+1;
								//	newarray.push({item:itemm,desc:desc,bar:bar,loc:loc,qty:qty});
									
							}
					}else{
						
						alert('Location does not match');
						}
				}else{
					if(bar == ''){
						alert('Barcode can not be blank');
						}else{
					alert('Barcode Does not match');}
					}
			//console.log(last_qty+'----'+newqty+'==='+qty);
			}else{
				if(itemData == null){ 
				alert('Item table is empty, please sync items');
				}
				if(listbinData == null){
				alert('Listbin table is empty, please sync items');	
				}
			  }
		  } 
		
			
		   
   }); 
   
   
   /********************************************* skip button *******************************************/
    jQuery('#skip_button').on('click',function(){ 
		 ConfirmDialog('Are you sure that you want to skip?');
		// promt for confirmation
			function ConfirmDialog(message){
				$('<div></div>').appendTo('body')
								.html('<div><h6>'+message+'?</h6></div>')
								.dialog({
									modal: true, title: 'Delete message', zIndex: 10000, autoOpen: true,
									width: 'auto', resizable: false,
									buttons: {
										Yes: function () {
											var newqty = jQuery('#quantity_id').val();
											//var bar = jQuery('#barcode_id').val();
											console.log("rowcntrowcnt >> "+rowcnt);
											
											if((itemm == item_last) && ((newqty == qty) || (newqty == 0))){
											   console.log("Lastsst"+oldbar);
												loc = loc.toUpperCase();
												newarray.push({item:itemm,desc:desc,bar:oldbar,loc:loc,qty:newqty,bin : bin, ordi: ordi,pik_ord: pik_ord,part:part });
												jQuery('#invoice_form').hide(); 
												jQuery('#invoice_listing_id').show(); 
												jQuery('#table').show(); 
												jQuery('#finish_button').show();  
												jQuery('#next_button').hide(); 
												jQuery('#skip_button').hide(); 
												var rowss='';
												var i=1;
												
												jQuery.each(newarray,function(k,v){
													//console.log("newarray > "+v.item);
													
												rowss +='<tr id="itemrow'+i+'"><td>'+v.item+'</td><td>'+v.desc+'</td><td>'+v.bar+'</td><td>'+v.loc+'</td><td>'+v.qty+'</td><td  style="display:none" id="bin">'+v.bin+'</td><td  style="display:none" id="ordi">'+v.ordi+'</td><td>'+v.pik_ord+'</td><td  style="display:none" id="part">'+v.part+'</td></tr>';
												i++;
												});
												jQuery("#tbldata").html(rowss);	
												
												rowcnt=1;
										   }else{
												console.log("qty > "+qty+"  newqty "+newqty); 
													newarray.push({item:itemm,desc:desc,bar:oldbar,loc:loc,qty:newqty,bin : bin, ordi: ordi,pik_ord: pik_ord,part:part });		
															//newarray.push({item:itemm,desc:desc,bar:bar,loc:loc,qty:newqty});
															if(newqty<qty){
																		console.log('new val');
																		var newrowqty= parseInt(qty) - parseInt(newqty);  
																		 jQuery('#quantity_id').val(newrowqty); 
																		 qty = newrowqty;
																		 newqty = newrowqty;
																	//	newarray.push({item:itemm,desc:desc,bar:bar,loc:loc,qty:newrowqty});
															 }else{
																itemm = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children('td:eq(0)').text();
																desc = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(1)").text();
																oldbar = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(2)").text();
																bar = '';
																loc = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(3)").text();
																qty = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(4)").text();   
																bin = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(5)").text();   
																ordi = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(6)").text();   
																pik_ord = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(7)").text();   
																part = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(8)").text(); 
																	
																	  jQuery("#item_id").val(itemm);
																	  jQuery('#description_id').val(desc);
																	  jQuery('#barcode_id').val(bar);
																	  jQuery('#location_id').val(loc);
																	  jQuery('#quantity_id').val(qty); 
																		rowcnt=rowcnt+1;
																	//	newarray.push({item:itemm,desc:desc,bar:bar,loc:loc,qty:qty});
																		
																}
											   
											   
											   }
											
											$(this).dialog("close");
										},
										No: function () {                           		     									
											$(this).dialog("close");
										}
									},
									close: function (event, ui) {
										$(this).remove();
									}
								});
			};
		
	});
   
   
   /********************************************** finish button ****************************************/

   jQuery('#finish_button').on('click',function(){ 
	var ordNo = jQuery('#ordId').val();
	var table = jQuery('#invoice_listing_id tr');
	var tbl =tableToJson(table);
	
	jQuery(".loader_img").show();
	
			jQuery.ajax({
								
						type: "post",
						data:{FormPage : page,ordNo:ordNo,tableData:tbl },
						url: '',
						success: function (response) {
								  jQuery(".loader_img").hide();
								 
								var resp = response.split('$$api_res');	
								// 	Check API response							
								if(resp[1] == 'Failure') {
								
									var  ErrorAPIstring = resp[0];
										
									var innerErrorAPIstring=ErrorAPIstring.substring(ErrorAPIstring.lastIndexOf("<text>")+6,ErrorAPIstring.lastIndexOf("</text>"));
									//	alert(innerErrorAPIstring+'API Error : '+resp[0]);
									jQuery(".overlay_div").show();
									jQuery(".popup").show();
									jQuery(".popup").html("<div class='close-btnn'>Ok</div><h2>API response</h2><textarea disabled>"+innerErrorAPIstring+"</textarea>");
										
								} else {									
									jQuery('#ordId').val(ordNo); //pass value;
									jQuery('#invoice_form_id').submit();
									order_id_store(ordNo);
								}
						}
						
					});
   // jQuery('#invoice_form_id').submit(); 
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

});


function html2json() {
   var json = '{';
   var otArr = [];
   var tbl2 = $('#invoice_listing_id tr').each(function(i) {        
      x = $(this).children();
      var itArr = [];
      x.each(function() {
         itArr.push('"' + $(this).text() + '"');
      });
      otArr.push('"' + i + '": [' + itArr.join(',') + ']');
   })
   json += otArr.join(",") + '}'

   return json;
}

function tableToJson(table) {
      var rows = [];
            $('#tbldata tr').each(function(i, n){
                var $row = $(n);
                rows.push({
                    item: $row.find('td:eq(0)').text(),
                    des:   $row.find('td:eq(1)').text(),
                    barcode: $row.find('td:eq(2)').text(),
                    loc: $row.find('td:eq(3)').text(),
                    qty:         $row.find('td:eq(4)').text(),
					bin:        $row.find('td:eq(5)').text(),
                    ordi:          $row.find('td:eq(6)').text(),
                    pikord:          $row.find('td:eq(7)').text(),
                    part:          $row.find('td:eq(8)').text()
                });
            });
return JSON.stringify(rows);
}


//table sort according to PIKORDER
function sortTable(f,n){
    var rows = $('#tbldata tr').get();

    rows.sort(function(a, b) {

        var A = getVal(a);
        var B = getVal(b);

        if(A < B) {
            return -1*f;
        }
        if(A > B) {
            return 1*f;
        }
        return 0;
    });

    function getVal(elm){
        var v = $(elm).children('td').eq(n).text().toUpperCase();
        if($.isNumeric(v)){
            v = parseInt(v,10);
        }
        return v;
    }

    $.each(rows, function(index, row) {
        $('#tbldata').append(row);
    });
}
var f_sl = 1; // flag to toggle the sorting order
$('th:last-child').click(function(){
		f_sl *= -1; // toggle the sorting order
		var n = $("th:last-child").prevAll().length;
		sortTable(f_sl,n);
	});
	// sort rows according to the PIKORDER
    $(document).ready(function() {
       f_sl *= 1; // toggle the sorting order
       var n = $("th:last-child").prevAll().length;
       sortTable(f_sl,n);
   });