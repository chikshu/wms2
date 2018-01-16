	jQuery(document).ready(function(){
		
	/****************** Check condition for window load ajax in both Order View and order to Onvoce/Shipment View**********************/	
	 		
	jQuery('body').on('click','.helper_grv',function(){
			fetchData = "true";
			console.log(page+'-----'+fetchData);	 
		if( page == 'open_grv' && fetchData == 'true') {		
			  jQuery(".loader_img").show();
					jQuery.ajax({
								
						type: "post",
						data:{FormPage : page, FetchMode:fetchData },
						url: '',
						success: function (response) {
						  jQuery(".loader_img").hide();
						 // alert(response);
						  var res = jQuery.parseJSON(response);
						  
						  var html='';
						  
							jQuery(res).each(function(k,v){
									
										var curdate =res[k].CURDATE;
										var ord = res[k].ORDNAME;
										var des = res[k].SUPDES;
										
										html += '<tr class="repeat_tr"><td>'+ord+'</td><td>'+des+'</td><td>'+curdate+'</td></tr>';
										
								});
							jQuery('#grv-data').html(html);
							paginations('grv');
						   localStorage.setItem('opengrv', JSON.stringify(res));
						 
					  }
				});
			}
			if( page == 'blank_grv' && fetchData == 'true') {		
				
			  jQuery(".loader_img").show();
					jQuery.ajax({
								
						type: "post",
						data:{FormPage : page, FetchMode:fetchData },
						url: '',
						success: function (response) {
						  jQuery(".loader_img").hide();
						 // alert(response);
						  var res = jQuery.parseJSON(response);
						  
						  var html='';
						  
							jQuery(res).each(function(k,v){
									
										var curdate =res[k].CURDATE;
										var ord = res[k].ORDNAME;
										var des = res[k].SUPDES;
										
										html += '<tr class="repeat_tr"><td>'+ord+'</td><td>'+des+'</td><td>'+curdate+'</td></tr>';
										
								});
							jQuery('#blank-data').html(html);
							paginations('blankgrv');
						   localStorage.setItem('blankgrv', JSON.stringify(res));
						 
					  }
				});
			}
		 });
		 
	
	 // get data from localstorage
	var opengrv = jQuery.parseJSON(localStorage.getItem('opengrv'));
	var blankgrv = jQuery.parseJSON(localStorage.getItem('blankgrv'));
	if(page=='open_grv'){
		if( opengrv != null){
		console.log('opengrv loaclstorage');
			var html='';
			jQuery(opengrv).each(function(k,v){
					
						var curdate =opengrv[k].CURDATE;
						var ord = opengrv[k].ORDNAME;
						var des = opengrv[k].SUPDES;
						
						html += '<tr class="repeat_tr"><td>'+ord+'</td><td>'+des+'</td><td>'+curdate+'</td></tr>';
						
				});
				jQuery('#grv-data').html(html);
				paginations('grv');
				
		}else{
			html ='<tr class="repeat_tr"><td colspan=4>NO DATA</td></tr>';
			jQuery('#grv-data').html(html);
			alert ('No data !! Please Click Sync GRV');
		}
	}
	// blank grv page
	
	if ( page=='blank_grv'){
		if( blankgrv != null ){
			console.log('blankgrv loaclstorage');
			var html='';
			jQuery(blankgrv).each(function(k,v){
					
						var curdate =blankgrv[k].CURDATE;
						var ord = blankgrv[k].ORDNAME;
						var des = blankgrv[k].SUPDES;
						
						html += '<tr class="repeat_tr"><td>'+ord+'</td><td>'+des+'</td><td>'+curdate+'</td></tr>';
						
				});
				jQuery('#blank-data').html(html);
				paginations('blankgrv');
				
		}else{
			html ='<tr class="repeat_tr"><td colspan=4>NO DATA</td></tr>';
			jQuery('#blank-data').html(html);
			alert ('No data !! Please Click Sync GRV');
		}
	}	       
		       
});
	/*if( page == 'open-grv' && fetchData == 'true') {			
			 alert('here');
			 return false;
				jQuery("body").on('click', '.tbl_body tr', function(){ 
				//alert('here');
				var iSelectedTab = jQuery(this).find(".cu_DOC").val();
				if (iSelectedTab == null) {
					cu_doc = '';
				} else {
					cu_doc =iSelectedTab;
				}
				
				console.log('cu_doc'+cu_doc);
				//return false;
				var order_grvnum = jQuery(this).find(".order_num").text();
				//alert(order_grvnum);
				jQuery("#orderNUM").val(cu_doc);
				jQuery("#grvNUM").val(order_grvnum);
				
									jQuery(".loader_img").show();
									jQuery("#frm_doc").submit();									

													return false;
					jQuery(".tbl_body tr").removeClass('highlights');
					jQuery(this).addClass('highlights');					
					jQuery(".popup").hide();
					
					var order_num = jQuery(".tbl_body .highlights .order_num").text();
					var interface_name=jQuery("#interface_name_post").val();   // get dynamic interface name for both pages Invoice/Shipment
			
					// Send OrderNumber to the api/
					   jQuery.ajax({
							type: "post",
							data: {order_num:order_num,interface_name:interface_name},
							url: '',						
							success: function (data) {								
								//console.log(data); 
								var resp = data.split('api_res');	
								// 	Check API response							
								if(resp[1] == 'Failure') {
									jQuery(".overlay_div").show();
									jQuery(".popup").show();
									jQuery(".popup").html("<div class='close-btnn'>Ok</div><h2>API response</h2><textarea disabled>"+resp[0]+"</textarea>");
									
								} else {									
									jQuery("#orderNUM").val(order_num); //pass value;
									jQuery("#frm_doc").submit();									
								}
								jQuery(".loader_img").hide();								
								jQuery(".tbl_body tr").removeClass('highlights');
							}
						});					
				});
}
 else {
	
	// post data to the api when checkbox checked
	jQuery("body").on('click', '.check_post', function(){ 	
	 var id = jQuery(this).attr('id');
		  if (jQuery(this).is(':checked')) {
			  var t_qty = jQuery('tr .t_qty'+id).val();	
		  } else {
			  var t_qty = '0';	
		  }
		  //alert(t_qty);
		  //return false;
			
			 
			  var update_bar_check = 0;			  
			  var input_barcode = jQuery(".input_barcode"+id).val();				  
			  var hiden_barcode = jQuery(".hiden_barcode"+id).val();	
			  var partname = jQuery(".partname"+id).val();	
		   	  var doc_no = jQuery(".doc"+id).val();				  
			  var trans = jQuery('.trans'+id).val();			  
			  var serial_name = jQuery('.serial_name'+id).val();			  
			  var to_loc = jQuery('.to_loc'+id).val();	
				//input_barcode =input_barcode.trim();
				console.log("hidden barcode> "+hiden_barcode+"   Input barcode >  "+input_barcode);
			 if(input_barcode == '' && hiden_barcode != '') {
				 console.log('focus');
				 	jQuery(".input_barcode"+id).focus();
					jQuery(".overlay_div").show();
					jQuery(".popup").show();
					jQuery(".popup").html("<div class='close-btnn'>Ok</div><h2>Error</h2><textarea disabled>Please fill in a new barcode</textarea>");
					jQuery(this).attr('checked', false); // Unchecks it					
			 }	
			 else if(hiden_barcode == '' && input_barcode == '') {				  
					jQuery(".overlay_div").show();
					jQuery(".popup").show();
					jQuery(".popup").html("<div class='close-btnn'>Ok</div><h2>Error</h2><textarea disabled>please fill in a new barcode</textarea>");
					jQuery(this).attr('checked', false); // Unchecks it
					
			  }
			  else if(hiden_barcode == '' && input_barcode != ''){
				  update_bar_check = 0;
				   jQuery(".loader_img").show();
				   jQuery.ajax({
							type: "post",
							data: {doc_no:doc_no,trans:trans,t_qty:t_qty,serial_name:serial_name,to_loc:to_loc,partname:partname,input_barcode:input_barcode,update_bar_check:update_bar_check},
							url: '',						
							success: function (data) {								
								console.log(data); 
								jQuery(".loader_img").hide();	
								var resp = data.split('api_res');	
								// 	Check API response	
								var  ErrorAPIstring = resp[0];
								
								var innerErrorAPIstring=ErrorAPIstring.substring(ErrorAPIstring.lastIndexOf("<text>")+6,ErrorAPIstring.lastIndexOf("</text>")); // fetch the inner error from XML api 								
								if(resp[1] == 'Failure') {
									jQuery(".overlay_div").show();
									jQuery(".popup").show();
									jQuery(".popup").html("<div class='close-btnn'>Ok</div><h2>API response</h2><textarea disabled>"+innerErrorAPIstring+"</textarea>");
									
								} 
															
								jQuery(".tbl_body tr").removeClass('highlights');
							}
						});	
			  }
			 else if(hiden_barcode != input_barcode ){
			   update_bar_check = 1;
			   
			   var r = confirm("Are you sure that you want to change the barcode?");
				if (r == true) {
				  
			  jQuery(".loader_img").show();
			 //return false;
			  jQuery.ajax({
							type: "post",
							data: {doc_no:doc_no,trans:trans,t_qty:t_qty,serial_name:serial_name,to_loc:to_loc,update_bar_check:update_bar_check,partname:partname,input_barcode:input_barcode},
							url: '',						
							success: function (data) {								
								console.log(data); 
								jQuery(".loader_img").hide();	
								var resp = data.split('api_res');	
								// 	Check API response	
								var  ErrorAPIstring = resp[0];
								
								var innerErrorAPIstring=ErrorAPIstring.substring(ErrorAPIstring.lastIndexOf("<text>")+6,ErrorAPIstring.lastIndexOf("</text>")); // fetch the inner error from XML api 								
								if(resp[1] == 'Failure') {
									jQuery(".overlay_div").show();
									jQuery(".popup").show();
									jQuery(".popup").html("<div class='close-btnn'>Ok</div><h2>API response</h2><textarea disabled>"+innerErrorAPIstring+"</textarea>");
									
								} 
								jQuery(".hiden_barcode"+id).val(input_barcode);
															
								jQuery(".tbl_body tr").removeClass('highlights');
							}
						});	
				}
						
	} else {
		 jQuery(".loader_img").show();
			 //return false;
			  jQuery.ajax({
							type: "post",
							data: {doc_no:doc_no,trans:trans,t_qty:t_qty,serial_name:serial_name,to_loc:to_loc,update_bar_check:update_bar_check,partname:partname,input_barcode:input_barcode},
							url: '',						
							success: function (data) {								
								console.log(data); 
								jQuery(".loader_img").hide();	
								var resp = data.split('api_res');	
								// 	Check API response	
								var  ErrorAPIstring = resp[0];
								
								var innerErrorAPIstring=ErrorAPIstring.substring(ErrorAPIstring.lastIndexOf("<text>")+6,ErrorAPIstring.lastIndexOf("</text>")); // fetch the inner error from XML api 								
								if(resp[1] == 'Failure') {
									jQuery(".overlay_div").show();
									jQuery(".popup").show();
									jQuery(".popup").html("<div class='close-btnn'>Ok</div><h2>API response</h2><textarea disabled>"+innerErrorAPIstring+"</textarea>");
									
								} 
															
								jQuery(".tbl_body tr").removeClass('highlights');
							}
						});	
	}
		  
});
}


});	
		
var abc =1;
			var ht = '';
			
			
		//  Close popup 
			jQuery("body").on('click', '.popup .close-btnn', function(){ 
				jQuery(".overlay_div").hide();
				jQuery(".popup").hide();
				//jQuery(".loader_img").hide();
			});
			
			
      jQuery("#send_frm_data_dt").submit(function(event) {
		  jQuery("#processingimg").show();
			event.preventDefault();
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
	});*/
		
			
function paginations(tableId){
		        var rowCount = $('#'+tableId+' >tbody >tr').length;
				console.log('#'+tableId+' >tbody >tr'+rowCount+'--'+tableId);
                var items = jQuery(".repeat_tr");

                var numItems = rowCount;
                var perPage = 9;
				if(numItems > perPage){
					console.log(numItems +'-----'+page+'------'+perPage);
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
}

// row click on open grv 
jQuery('#gtable').hide();
jQuery('#grvno').hide();
var id ='#grv-data tr';
jQuery('body').on('dblclick touchstart',id,function(){
	  jQuery(".loader_img").show();
	var ordno = jQuery(this).children('td:eq(0)').text();
	jQuery('#grv').hide();
	jQuery('#gtable').show();
	jQuery('#grvno').show();
	jQuery('#grvno').text(ordno);
	jQuery('#grv-heading').text('GRV Details');
	jQuery('.helper_grv').hide();
	if(ordno != ''){
		var postdata = 'grvdata=grvdata&interface_name=ROYY_GRVDETAILS&page_dt=open_grv'; 
		var tdval_data ='';
		var auto_i ='1';
		//alert(postdata);
		jQuery.ajax({
						type: "post",
						data: postdata,						
						url: '',						
						success: function (data) {	
							  jQuery(".loader_img").hide();
								var data1=JSON.parse(data);	 // parse json data						
								
								jQuery.each(data1,function(k,v){							
														
								
								
									var fr_haeder = v.HEAD;	
								if(jQuery.isEmptyObject(fr_haeder)) { 
									var cur_date = '';
									var doc_no = '';
									var doc = '';
									var sup_desc = '';
								}
								else {		
									var cur_date = fr_haeder.CURDATE;
									var doc = fr_haeder.DOC;
									var doc_no = fr_haeder.DOCNO;
									var sup_desc = fr_haeder.SUPDES;
									
								}
							
									var fr_details = v.DETAILS;

									if(jQuery.isEmptyObject(fr_details)) { 
										console.log(fr_details);
									//jQuery(".overlay_div").show();
									//jQuery(".popup").show();
									//jQuery(".popup").html("<div class='close-btnn'>Ok</div><h2>Error</h2><textarea disabled>No Data Found</textarea>");
									}else{
										
									
									jQuery.each(fr_details,function(k,v){	
									console.log("Test > "+fr_details[k]['PARTNAME']);
									
									console.log('hhh '+v.EXPDATE);		
									console.log('SETFLAG '+v.SETFLAG);		
									
									var obj_for_expdate = fr_details[k]['EXPDATE'];
									var obj_for_setflag = fr_details[k]['SETFLAG'];
									var checked ='';
									var flag='';
									var exp_date='';
					
									var b =fr_details[k]['BARCODE'];
									if(b && typeof b === "object") {
										 b ='';
									 }
													
									if(fr_details[k]['PARTNAME'] != undefined){
							
										tdval_data += '<tr class="repeat_tr"><td class="current_date">'+fr_details[k]['PARTNAME']+'<input type="hidden" value="'+fr_details[k]['PARTNAME']+'" name="partname" class="partname'+auto_i+'"></td><td><input type="text" value="" id="barcode" name="barcode" class="input_barcode'+auto_i+'"><input type="text" value="'+b+'" name="hiden_barcode" class="hiden_barcode'+auto_i+'"><input type="hidden" value="'+doc+'" name="doc" class="doc'+auto_i+'"><input type="hidden" value="'+sup_desc+'" class="sup_desc'+auto_i+'"></td><td>'+fr_details[k]['PDES']+'</td><td>'+fr_details[k]['PQUANT']+'</td><td class="current_date"><input type="checkbox" id="'+auto_i+'" class="check_post" value="" '+checked+'></td><td><input type="text" value="'+v.TQUANT+'" name="t_qty" class="t_qty'+auto_i+'"></td><td><input type="text" value="'+fr_details[k]['TOLOCNAME']+'" name="to_loc" class="to_loc'+auto_i+'" ><input type="hidden" value="'+fr_details[k]['TRANS']+'" name="trans" class="trans'+auto_i+'"><input type="hidden" value="'+fr_details[k]['SERIALNAME']+'" name="serial_name" class="serial_name'+auto_i+'"><input type="hidden" value="'+exp_date+'" name="exp_date" class="exp_date'+auto_i+'"></td><td><input type="text" value="'+fr_details[k]['SERIALNAME']+'" name="SERIALNAME"></td></tr>';
									}	
										
										jQuery('#grv-list').html(tdval_data); 
										paginations('gtable');
										auto_i++;
										
									});
									}
									});
									
								
						}
						
					});
				}
	});


// check box click 


jQuery("body").on('click', '.check_post', function(){ 	
	 var id = jQuery(this).attr('id');

		  if (jQuery(this).is(':checked')) {
			  var t_qty = jQuery('tr .t_qty'+id).val();	
		  } else {
			  var t_qty = '0';	
		  }
		  //alert(t_qty);
		  //return false;
			
			 
			  var update_bar_check = 0;			  
			  var input_barcode = jQuery(".input_barcode"+id).val();				  
			  var hiden_barcode = jQuery(".hiden_barcode"+id).val();	
			  var partname = jQuery(".partname"+id).val();	
		   	  var doc_no = jQuery(".doc"+id).val();				  
			  var trans = jQuery('.trans'+id).val();			  
			  var serial_name = jQuery('.serial_name'+id).val();			  
			  var to_loc = jQuery('.to_loc'+id).val();	
				//input_barcode =input_barcode.trim();
				console.log("hidden barcode> "+hiden_barcode+"   Input barcode >  "+input_barcode);
			 if(input_barcode == '' && hiden_barcode != '') {
				 console.log('focus');
				 	jQuery(".input_barcode"+id).focus();
					jQuery(".overlay_div").show();
					jQuery(".popup").show();
					jQuery(".popup").html("<div class='close-btnn'>Ok</div><h2>Error</h2><textarea disabled>Please fill in a new barcode</textarea>");
					jQuery(this).attr('checked', false); // Unchecks it					
			 }	
			 else if(hiden_barcode == '' && input_barcode == '') {				  
					jQuery(".overlay_div").show();
					jQuery(".popup").show();
					jQuery(".popup").html("<div class='close-btnn'>Ok</div><h2>Error</h2><textarea disabled>please fill in a new barcode</textarea>");
					jQuery(this).attr('checked', false); // Unchecks it
					
			  }
			  else if(hiden_barcode == '' && input_barcode != ''){
				  update_bar_check = 0;
				   jQuery(".loader_img").show();
				   jQuery.ajax({
							type: "post",
							data: {doc_no:doc_no,trans:trans,t_qty:t_qty,serial_name:serial_name,to_loc:to_loc,partname:partname,input_barcode:input_barcode,update_bar_check:update_bar_check},
							url: '',						
							success: function (data) {								
								console.log(data); 
								jQuery(".loader_img").hide();	
								var resp = data.split('api_res');	
								// 	Check API response	
								var  ErrorAPIstring = resp[0];
								
								var innerErrorAPIstring=ErrorAPIstring.substring(ErrorAPIstring.lastIndexOf("<text>")+6,ErrorAPIstring.lastIndexOf("</text>")); // fetch the inner error from XML api 								
								if(resp[1] == 'Failure') {
									jQuery(".overlay_div").show();
									jQuery(".popup").show();
									jQuery(".popup").html("<div class='close-btnn'>Ok</div><h2>API response</h2><textarea disabled>"+innerErrorAPIstring+"</textarea>");
									
								} 
															
								jQuery(".tbl_body tr").removeClass('highlights');
							}
						});	
			  }
			 else if(hiden_barcode != input_barcode ){
			   update_bar_check = 1;
			   
			   var r = confirm("Are you sure that you want to change the barcode?");
				if (r == true) {
				  
			  jQuery(".loader_img").show();
			 //return false;
			  jQuery.ajax({
							type: "post",
							data: {doc_no:doc_no,trans:trans,t_qty:t_qty,serial_name:serial_name,to_loc:to_loc,update_bar_check:update_bar_check,partname:partname,input_barcode:input_barcode},
							url: '',						
							success: function (data) {								
								console.log(data); 
								jQuery(".loader_img").hide();	
								var resp = data.split('api_res');	
								// 	Check API response	
								var  ErrorAPIstring = resp[0];
								
								var innerErrorAPIstring=ErrorAPIstring.substring(ErrorAPIstring.lastIndexOf("<text>")+6,ErrorAPIstring.lastIndexOf("</text>")); // fetch the inner error from XML api 								
								if(resp[1] == 'Failure') {
									jQuery(".overlay_div").show();
									jQuery(".popup").show();
									jQuery(".popup").html("<div class='close-btnn'>Ok</div><h2>API response</h2><textarea disabled>"+innerErrorAPIstring+"</textarea>");
									
								} 
								jQuery(".hiden_barcode"+id).val(input_barcode);
															
								jQuery(".tbl_body tr").removeClass('highlights');
							}
						});	
				}
						
	} else {
		 jQuery(".loader_img").show();
			 //return false;
			  jQuery.ajax({
							type: "post",
							data: {doc_no:doc_no,trans:trans,t_qty:t_qty,serial_name:serial_name,to_loc:to_loc,update_bar_check:update_bar_check,partname:partname,input_barcode:input_barcode},
							url: '',						
							success: function (data) {								
								console.log(data); 
								jQuery(".loader_img").hide();	
								var resp = data.split('api_res');	
								// 	Check API response	
								var  ErrorAPIstring = resp[0];
								
								var innerErrorAPIstring=ErrorAPIstring.substring(ErrorAPIstring.lastIndexOf("<text>")+6,ErrorAPIstring.lastIndexOf("</text>")); // fetch the inner error from XML api 								
								if(resp[1] == 'Failure') {
									jQuery(".overlay_div").show();
									jQuery(".popup").show();
									jQuery(".popup").html("<div class='close-btnn'>Ok</div><h2>API response</h2><textarea disabled>"+innerErrorAPIstring+"</textarea>");
									
								} 
															
								jQuery(".tbl_body tr").removeClass('highlights');
							}
						});	
	}
		  
});
/*  Close popup */
			jQuery("body").on('click', '.popup .close-btnn', function(){ 
				jQuery(".overlay_div").hide();
				jQuery(".popup").hide();
				//jQuery(".loader_img").hide();
			});
