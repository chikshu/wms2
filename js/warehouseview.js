/*
Created By : Shilpa
Date : 4 July
Description : Warehouse Items View
*/
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
		//alert();
		//console.log('iiii >>>> ' + i + ' item >>?????????????? '+ wave.ORDER);
		var ord = wave.ORDER[i].ORDNAME;
		
		}
		
		
	});
jQuery(document).ready(function() {
			
    var rowcnt=2;
  //  var totrowcnt= jQuery('#tbldata tr').length; //3; //COUNT RECORD ARRAY
    var qty = 0;
   //var origarray = [];
    var newarray = [];

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
    
    jQuery("#item_id").val('');
    jQuery('#description_id').val('');
    jQuery('#barcode_id').val('');
    jQuery('#fromlocation').val('');
    jQuery('#tolocation').val('');
    jQuery('#quantity_id').val('');
    
    jQuery( "#barcode_id" ).blur(function(e)
    {
        e.preventDefault();
        var barcodeUsedInputValue = jQuery(this).val();

        itemsData = localStorage.getItem('itemdata');
        var arr = JSON.parse(itemData);
        var barcodes = [];
        console.log(itemsData+'<<>>>');
        jQuery.each(arr,function(k,v){
            barcodes.push(v.BARCODE);
        });
        // Get barcode index
        var othervalue = barcodes.indexOf(barcodeUsedInputValue);
         
         // Get Item and description value accrording to barcode
        if(jQuery.inArray( barcodeUsedInputValue, barcodes ) !== -1 && barcodeUsedInputValue !== '')
        {
            var description = arr[othervalue].DESCRIPTION;
            var barItem = arr[othervalue].ITEMCODE;
            var itempart = arr[othervalue].PART;
            var itembin = arr[othervalue].BIN;
            //var barItem = arr[othervalue].ITEMCODE;
            jQuery("#item_id").val(barItem);
            jQuery('#description_id').val(description);
            jQuery("#itembin").val(itembin);
            jQuery('#itempart').val(itempart);
        }
        else
        {
            alert('bar error: Can not be blank or should match with Item barcodes');
        }
        itemm = jQuery("#item_id").val();
        desc = jQuery('#description_id').val();
        part  = jQuery('#itempart').val();
   });
  

   /*************************************** on next click event ****************************************************/
   
  //global variable for storing barcodes and loc val for comparing data
  var barNum = [];
  var barcodes = [];

	
   jQuery('#next_button').on('click touchstart',function(){ 
    //console.log("rowcntrowcnt >> "+rowcnt);
   var newqty = jQuery('#quantity_id').val();
   //alert(newqty +'----'+rowcnt);
   var bar = jQuery('#barcode_id').val();
   var fromloc = jQuery('#fromlocation').val();
   var toloc = jQuery('#tolocation').val();
   var locArr = JSON.parse(listbinData);
                   
       jQuery.each(locArr,function(k,v){
           barNum.push(v.LOCNAME.toLowerCase());
       });
       var arr = JSON.parse(itemData);
                       
       jQuery.each(arr,function(k,v){
           barcodes.push(v.BARCODE);
       });
		  if(jQuery.inArray( bar, barcodes ) !==  -1  && bar !== ''){

			 loc = fromloc.toLowerCase();
             toloc = toloc.toLowerCase();
				 if((jQuery.inArray( loc, barNum ) !=  -1 ) && (jQuery.inArray( toloc, barNum ) !=  -1) && toloc !== '' && fromloc !== '')
                 {
                    if(newqty != '')
                    {
						 var index = jQuery.inArray( loc, barNum );
						loc = loc.toUpperCase();
						
						var BIN =  warhs[index];
						
						newarray.push({item:itemm,desc:desc,bar:bar,fromloc:fromloc,toloc:toloc,qty:newqty,bin : BIN, ordi: ordi,pik_ord: pik_ord,part:part });	
                       
						var rowss='';
						var i=1;
						
						jQuery.each(newarray,function(k,v){
							//console.log("newarray > "+v.item);
							
						rowss +='<tr id="itemrow'+i+'"><td>'+v.item+'</td><td>'+v.desc+'</td><td>'+v.bar+'</td><td>'+v.fromloc+'</td><td>'+v.qty+'</td><td>'+v.toloc+'</td><td  style="display:none" id="bin">'+v.bin+'</td><td  style="display:none" id="ordi">'+v.ordi+'</td><td>'+v.pik_ord+'</td><td style="display:none" id="part">'+v.part+'</td></tr>';
						i++;
						});
						jQuery("#tbldata").html(rowss);	
						
                            rowcnt=1;
                            itemm = jQuery('#warehouse_listing_id tr#itemrow'+rowcnt).children('td:eq(0)').text();
							desc = jQuery('#warehouse_listing_id tr#itemrow'+rowcnt).children("td:eq(1)").text();
							//bar = jQuery('#invoice_listing_id tr#itemrow'+rowcnt).children("td:eq(2)").text();
							barcode = jQuery('#warehouse_listing_id tr#itemrow'+rowcnt).children("td:eq(2)").text();
							loc = jQuery('#warehouse_listing_id tr#itemrow'+rowcnt).children("td:eq(3)").text();
							qty = jQuery('#warehouse_listing_id tr#itemrow'+rowcnt).children("td:eq(4)").text();   
							bin = jQuery('#warehouse_listing_id tr#itemrow'+rowcnt).children("td:eq(5)").text();   
							ordi = jQuery('#warehouse_listing_id tr#itemrow'+rowcnt).children("td:eq(6)").text();   
							pik_ord = jQuery('#warehouse_listing_id tr#itemrow'+rowcnt).children("td:eq(7)").text();   
							part = jQuery('#warehouse_listing_id tr#itemrow'+rowcnt).children("td:eq(8)").text();   
						
								  // var itembar = itemm +"<<<<<"+ barcode;
                            jQuery("#item_id").val('');
                            jQuery('#description_id').val('');
                            jQuery('#barcode_id').val('');
                            jQuery('#fromlocation').val('');
                            jQuery('#tolocation').val('');
                            jQuery('#quantity_id').val(''); 
                            rowcnt=rowcnt+1;
                    }
                    else
                    {
                        alert('Quantity field is empty');
                    }
				}
                else
                {
					if(jQuery.inArray( loc, barNum ) !=  -1 )
                    {
                        alert("Location entered in 'To Location' field  doesn't exist in List of Bins");	
                    }
                    else{
                        alert("Location entered in 'From Location' field  doesn't exist in List of Bins");	
                    }
				
				}
			}
            else
            {   
                alert('bar error: Can not be blank or should match with Item barcodes');
            }		   
        }); 
   
   
   /********************************************* Done button *******************************************/
    jQuery('#done_button').on('click',function()
    {
           var newqty = jQuery('#quantity_id').val();
        //alert(newqty +'----'+rowcnt);
        var bar = jQuery('#barcode_id').val();
        var fromloc = jQuery('#fromlocation').val();
        var toloc = jQuery('#tolocation').val();
        var locArr = JSON.parse(listbinData);
                        
            jQuery.each(locArr,function(k,v){
                barNum.push(v.LOCNAME.toLowerCase());
            });
            var arr = JSON.parse(itemData);
                            
            jQuery.each(arr,function(k,v){
                barcodes.push(v.BARCODE);
            });
        var fromloc = jQuery('#fromlocation').val();
        var toloc = jQuery('#tolocation').val();
        var newqty = jQuery('#quantity_id').val();
        var oldbar = jQuery('#barcode_id').val();
        console.log("rowcntrowcnt >> "+rowcnt);
        loc = fromloc.toLowerCase();
        toloc = toloc.toLowerCase();
        if(jQuery.inArray( bar, barcodes ) !==  -1  && bar !== '')
        {
            if((jQuery.inArray( loc, barNum ) !=  -1 ) && (jQuery.inArray( toloc, barNum ) !=  -1) && toloc !== '' && fromloc !== '')
            {
                if(newqty !== '')
                {
                     
                    console.log("Lastsst"+oldbar);
                    loc = loc.toUpperCase();
                    newarray.push({item:itemm,desc:desc,bar:oldbar,fromloc:fromloc,toloc:toloc,qty:newqty,bin : bin, ordi: ordi,pik_ord: pik_ord,part:part });
                    jQuery('#warehouse_form').hide(); 
                    jQuery('#warehouse_listing_id').show(); 
                    jQuery('#table').show(); 
                    jQuery('#finish_button').show();  
                    jQuery('#next_button').hide(); 
                    jQuery('#done_button').hide(); 
                    var rowss='';
                    var i=1;
                 
                    jQuery.each(newarray,function(k,v)
                    {
                     //console.log("newarray > "+v.item);
                        rowss +='<tr id="itemrow'+i+'"><td>'+v.item+'</td><td>'+v.desc+'</td><td>'+v.bar+'</td><td>'+v.fromloc+'</td><td>'+v.qty+'</td><td>'+v.toloc+'</td><td  style="display:none" id="bin">'+v.bin+'</td><td  style="display:none" id="ordi">'+v.ordi+'</td><td>'+v.pik_ord+'</td><td  style="display:none" id="part">'+v.part+'</td></tr>';
                        i++;
                    });
                    jQuery("#tbldata").html(rowss);	
                    rowcnt=1;
                }
                else
                {
                    alert('Quantity field is empty');
                }
			}
            else
            {
                if(jQuery.inArray( loc, barNum ) !=  -1 )
                {
                    alert("Location entered in 'To Location' field  doesn't exist in List of Bins");	
                }
                else{
                    alert("Location entered in 'From Location' field  doesn't exist in List of Bins");	
                }
            
            }
        }
        else
        {   
            alert('bar error: Can not be blank or should match with Item barcodes');
        }
	});
   
   
   /********************************************** finish button ****************************************/
    //Post Data To API
    jQuery('#finish_button').on('click',function(){ 
    var ordNo = jQuery('#ordId').val();
	var table = jQuery('#warehouse_listing_id tr');
	var tbl =tableToJson(table);
	jQuery(".loader_img").show();
    
    jQuery.ajax({           
        type: "post",
        data:{FormPage : page,ordNo:ordNo,tableData:tbl },
        url: '',
        success: function (response)
        {
            //alert(response);
            jQuery(".loader_img").hide();
            var resp = response.split('$$api_res');
            console.log(resp[0] +' Status> '+resp[1]);
                // 	Check API response							
             if(resp[1] == 'Failure')
             {
                 var  ErrorAPIstring = resp[0];  
                 var innerErrorAPIstring=ErrorAPIstring.substring(ErrorAPIstring.lastIndexOf("<text>")+6,ErrorAPIstring.lastIndexOf("</text>"));
                 //	alert(innerErrorAPIstring+'API Error : '+resp[0]);
                 jQuery(".overlay_div").show();
                 jQuery(".popup").show();
                 jQuery(".popup").html("<div class='close-btnn'>Ok</div><h2>API response</h2><textarea disabled>"+innerErrorAPIstring+"</textarea>");    
            }
            else
            {
                 jQuery('#ordId').val(ordNo); //pass value;
                 jQuery('#warehouse_form_id').submit();
                 order_id_store(ordNo);
            }
        }
        
    });
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