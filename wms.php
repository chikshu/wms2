<?php
/*
Plugin Name: WMS2
Plugin URI: 
Description: This plugin allows you to register buyer.
Author: Chikshi
Version: 1.0
Author URI: 
License: GPLv3 or later
*/

/* Define Constants */
if (!defined("WP_WMS_FORM_DIR")) define("WP_WMS_FORM_DIR", plugin_dir_path(__FILE__));
/* Runs when plugin is activated */
register_activation_hook(__FILE__,'wms_plugin_install');

// user role

add_action( 'init','user_role');

function user_role(){
	
add_role( 'WMS2', 'wms2_user', array( 'read' => true, 'level_0' => true ) );
}
///------------------------------------------- plugin install -----------------------------------------------//
if(!function_exists("wms_plugin_install"))
{
	function wms_plugin_install()
	{
		page_call('Ship Codes', '[ship-codes]');
		page_call('List Of Bins', '[list-of-bins]');
		page_call('Items', '[items]');
		page_call('Client Definitions', '[client-definition]');
		page_call('Wave', '[wave]');
		page_call('Shipment', '[shipment]');
		page_call('Receive Goods', '[goods]');
		page_call('Inventory Count', '[inventory]');
		page_call('Over The Counter Invoice', '[counter-invoice]');
		page_call('Invoice View', '[invoice-view]');
		page_call('Shipment View', '[shipment-view]');
		page_call('Open GRV', '[open-grv]'); // Create Open GRV 
		page_call('Blank GRV', '[blank-grv]'); // Create blank GRV
		page_call('Warehouse Transfers', '[warehouse-transfer]');
		page_call('Item View - Warehouse Transfers', '[warehouse-view]');
		db_script_wms();	
	} 
}

// database
if(!function_exists("db_script_wms")) {
				function db_script_wms() {
					if(file_exists(WP_WMS_FORM_DIR . "/lib/install_script.php"))
						{
							include WP_WMS_FORM_DIR . "/lib/install_script.php";
						}
					}
}
function wms2_tbl()
{
	global $wpdb;
	return $wpdb->prefix."wms2_data_tbl";
}
function page_call($pageTitle, $shortcode){
	
	global $wpdb;

		$the_page_title = $pageTitle; //'Buyer Form';
		$the_page_name = $pageTitle; // 'Buyer Form';

		// the menu entry...
		delete_option("wms_plugin_page_title");
		add_option("wms_plugin_page_title", $the_page_title, '', 'yes');
		// the slug...
		delete_option("wms_plugin_page_name");
		add_option("wms_plugin_page_name", $the_page_name, '', 'yes');
		// the id...
		delete_option("wms_plugin_page_id");
		add_option("wms_plugin_page_id", '0', '', 'yes');

		$the_page = get_page_by_title( $the_page_title );

		if ( ! $the_page ) {

			// Create post object
			$_page = array();
			$_page['post_title'] = $the_page_title;
			$_page['post_content'] = $shortcode; //"[buyer-form]"
			$_page['post_status'] = 'publish';
			$_page['post_type'] = 'page';
			$_page['comment_status'] = 'closed';
			$_page['ping_status'] = 'closed';
			$_page['post_name'] = $the_page_title;
			$_page['post_category'] = array(1); // the default 'Uncatrgorised'

			// Insert the post into the database
			$the_page_id = wp_insert_post( $_page );

		}
		else {
			// the plugin may have been previously active and the page may just be trashed...

			$the_page_id = $the_page->ID;

			//make sure the page is not trashed...
			$the_page->post_status = 'publish';
			$the_page_id = wp_update_post( $the_page );

		}

		delete_option( 'wms_plugin_page_id' );
		add_option( 'wms_plugin_page_id', $the_page_id );

	
	}
/* Runs when plugin is deactivated */
register_deactivation_hook(__FILE__, 'wms_plugin_uninstall');

if(!function_exists("wms_plugin_uninstall"))
{
	function wms_plugin_uninstall() {

		global $wpdb;

		$the_page_title = get_option( "wms_plugin_page_title" );
		$the_page_name = get_option( "wms_plugin_page_name" );

		//  the id of our page...
		$the_page_id = get_option( 'wms_plugin_page_id' );
		if( $the_page_id ) {

			wp_delete_post( $the_page_id ); // this will trash, not delete

		}

		delete_option("wms_plugin_page_title");
		delete_option("wms_plugin_page_name");
		delete_option("wms_plugin_page_id");

	}
}


/* Create shortcode */

add_shortcode('warehouse-transfer', 'warehouse_transfer');


if(!function_exists("warehouse_transfer"))
{
	function warehouse_transfer()
	{
		include WP_WMS_FORM_DIR . "/views/warehouse-transfers.php";
		// include js files
		wp_enqueue_script("datepicker.js", plugins_url("/js/datepicker.js", __file__));
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
		wp_enqueue_style("datepicker.css", plugins_url("/css/datepicker.css", __file__));
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}


// ship code form 
add_shortcode('ship-codes', 'ship_form');


if(!function_exists("ship_form"))
{
	function ship_form()
	{
		include WP_WMS_FORM_DIR . "/views/shipcode-form.php";
		// include js files
		wp_enqueue_script("datepicker.js", plugins_url("/js/datepicker.js", __file__));
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
		wp_enqueue_style("datepicker.css", plugins_url("/css/datepicker.css", __file__));
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}
//list bin page
add_shortcode('list-of-bins', 'listbin_form');

if(!function_exists("listbin_form"))
{
	function listbin_form()
	{
		include WP_WMS_FORM_DIR . "/views/list-bins.php";
		// include js files
		wp_enqueue_script("datepicker.js", plugins_url("/js/datepicker.js", __file__));
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
		wp_enqueue_style("datepicker.css", plugins_url("/css/datepicker.css", __file__));
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}
// item page
add_shortcode('items', 'item_form');

if(!function_exists("item_form"))
{
	function item_form()
	{
		include WP_WMS_FORM_DIR . "/views/items.php";
		// include js files
		wp_enqueue_script("datepicker.js", plugins_url("/js/datepicker.js", __file__));
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
		wp_enqueue_style("datepicker.css", plugins_url("/css/datepicker.css", __file__));
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}
// invoice-view
add_shortcode('invoice-view', 'invoice_view');

if(!function_exists("invoice_view"))
{
	function invoice_view()
	{
		include WP_WMS_FORM_DIR . "/views/invoice-view.php";
		// include js files
		wp_enqueue_script("datepicker.js", plugins_url("/js/datepicker.js", __file__));
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
		wp_enqueue_script("view.js", plugins_url("/js/view.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
		wp_enqueue_style("datepicker.css", plugins_url("/css/datepicker.css", __file__));
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}
// Warehouse-view
add_shortcode('warehouse-view', 'warehouse_view');

if(!function_exists("warehouse_view"))
{
	function warehouse_view()
	{
		include WP_WMS_FORM_DIR . "/views/warehouse-view.php";
		// include js files
		wp_enqueue_script("datepicker.js", plugins_url("/js/datepicker.js", __file__));
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
		wp_enqueue_script("view.js", plugins_url("/js/warehouseview.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
		wp_enqueue_style("datepicker.css", plugins_url("/css/datepicker.css", __file__));
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}
// shipment-view
add_shortcode('shipment-view', 'shipment_view');

if(!function_exists("shipment_view"))
{
	function shipment_view()
	{
		include WP_WMS_FORM_DIR . "/views/shipment-view.php";
		// include js files
		wp_enqueue_script("datepicker.js", plugins_url("/js/datepicker.js", __file__));
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
		wp_enqueue_script("view.js", plugins_url("/js/view.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
		wp_enqueue_style("datepicker.css", plugins_url("/css/datepicker.css", __file__));
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}
// client definition  page
add_shortcode('client-definition', 'client_form');

if(!function_exists("client_form"))
{
	function client_form()
	{
		include WP_WMS_FORM_DIR . "/views/client-definitions.php";
		// include js files
		wp_enqueue_script("datepicker.js", plugins_url("/js/datepicker.js", __file__));
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
		wp_enqueue_style("datepicker.css", plugins_url("/css/datepicker.css", __file__));
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}
// shipment page
add_shortcode('shipment', 'shipment_form');

if(!function_exists("shipment_form"))
{
	function shipment_form()
	{
		include WP_WMS_FORM_DIR . "/views/shipment.php";
		// include js files
		wp_enqueue_script("datepicker.js", plugins_url("/js/datepicker.js", __file__));
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
		wp_enqueue_style("datepicker.css", plugins_url("/css/datepicker.css", __file__));
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}

// wave page 
add_shortcode('wave', 'wave_form');


if(!function_exists("wave_form"))
{
	function wave_form()
	{
		include WP_WMS_FORM_DIR . "/views/wave.php";
		// include js files
		wp_enqueue_script("datepicker.js", plugins_url("/js/datepicker.js", __file__));
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
		wp_enqueue_style("datepicker.css", plugins_url("/css/datepicker.css", __file__));
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}

// Receive goods page 
add_shortcode('goods', 'goods_form');

if(!function_exists("goods_form"))
{
	function goods_form()
	{
		include WP_WMS_FORM_DIR . "/views/recieve-goods.php";
		// include js files
		wp_enqueue_script("datepicker.js", plugins_url("/js/datepicker.js", __file__));
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
		wp_enqueue_style("datepicker.css", plugins_url("/css/datepicker.css", __file__));
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}

// inventory  page 

add_shortcode('inventory', 'inventory_form');

if(!function_exists("inventory_form"))
{
	function inventory_form()
	{
		include WP_WMS_FORM_DIR . "/views/inv-count.php";
		// include js files
		wp_enqueue_script("datepicker.js", plugins_url("/js/datepicker.js", __file__));
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
		wp_enqueue_style("datepicker.css", plugins_url("/css/datepicker.css", __file__));
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}

// counter invoice  page 
add_shortcode('counter-invoice', 'counterinvoice_form');

if(!function_exists("counterinvoice_form"))
{
	function counterinvoice_form()
	{
		include WP_WMS_FORM_DIR . "/views/counter-invoice.php";
		// include js files
		wp_enqueue_script("datepicker.js", plugins_url("/js/datepicker.js", __file__));
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
		wp_enqueue_style("datepicker.css", plugins_url("/css/datepicker.css", __file__));
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}


// open grv  page 
add_shortcode('open-grv', 'open_grv');

if(!function_exists("open_grv"))
{
	function open_grv()
	{
		include WP_WMS_FORM_DIR . "/views/open-grv.php";
		// include js files
	
	
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
			wp_enqueue_script("grv.js", plugins_url("/js/grv.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
	
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}

//blank grv page
add_shortcode('blank-grv', 'blank_grv');

if(!function_exists("blank_grv"))
{
	function blank_grv()
	{
		include WP_WMS_FORM_DIR . "/views/blank-grv.php";
		// include js files
	
	
		wp_enqueue_script("jquery.js", plugins_url("/js/jquery.js", __file__));
			wp_enqueue_script("grv.js", plugins_url("/js/grv.js", __file__));
		wp_enqueue_script("simplePagination.js", plugins_url("/pagination/simplePagination.js", __file__));
		wp_enqueue_script("jquery-ui.js", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js", __file__);		
		// include css files		
	
		wp_enqueue_style("maincss.css", plugins_url("/css/maincss.css", __file__));
		wp_enqueue_style("simplePagination.css", plugins_url("/pagination/simplePagination.css", __file__));
		wp_enqueue_style("jquery-ui.css", "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css", __file__);
	}
}


// pages data

if(isset($_POST['FormPage'])){
	$page = $_POST['FormPage'];
	
	// wave page
	if($page == 'wave'){
		if($_POST['FetchMode'] == 'false'){
			// static XML
			echo $page.'$$';
			echo "No data !! Please Click Refresh Wave";
			
		}else{
			// api data
			$id= $_POST['waveUID'];
			global $wpdb;
			$table_name =wms2_tbl();
			$myrow = $wpdb->get_results( "SELECT * FROM ".$table_name. " where `userID`='".$id."'");
			if(!empty($myrow)){
				
				$shiptype=$myrow[0]->shipType;
				
			}
		
			$userdata = array();
			$interface = 'WMS2_ORDERS';
			$xmldata = '<General><InterfaceConditions> <columnname>SHIPTYPE</columnname> <operator>=</operator> <columnvalue>'.$shiptype.' </columnvalue></InterfaceConditions><InterfaceConditions><columnname>ORDSTATUS</columnname><operator></operator><columnvalue>-2</columnvalue> </InterfaceConditions></General>';
			echo $page.'$$';
			$response = Post_InterfaceOut($xmldata,$interface,$userdata);
			$xml = simplexml_load_string($response);
			
			$result = array();
			
				foreach($xml->ORDER as $arr) {
					// $arr->ORDERITEM;

					 $test = array("CURDATE"=>(string)$arr->CURDATE,"ORDNAME"=>(string)$arr->ORDNAME,"PNCO_WEBNUMBER"=>(string)$arr->PNCO_WEBNUMBER);
					 $result[] = $test;
					
				}
			 $resultFull = array();
					
				foreach($xml->ORDER->ORDERITEMS->ORDERITEMS as $arr) {
					// $arr->ORDERITEM;

					 $test = array("PARTNAME"=>(string)$arr->PARTNAME,"BARCODE"=>(string)$arr->BARCODE,"PDES"=>(string)$arr->PDES,"TQUANT"=>(string)$arr->TQUANT,"ORDI"=>(string)$arr->ORDI,"PART"=>(string)$arr->PART);
					 $resultFull[] = $test;
					
			
				}
				
			
			print_r(json_encode($result));
			echo '$$';
			print_r(json_encode($xml));
			//die('end here');
			WriteToLog($xmldata,$response,$interface,$page);
		}
	}
	//list bin page
	elseif($page == 'list_bin'){
		if($_POST['FetchMode'] == 'false'){
			// static XML
				echo $page.'$$';
				echo "No data !! Please Click Sync Bins";
		}else{
			// api data
			$userdata = array();
			$interface = 'WMS2_LOCATIONS';
			$xmldata = '<General><InterfaceConditions><columnname>WARHSNAME</columnname><operator></operator><columnvalue>Main</columnvalue></InterfaceConditions></General>';
			echo $page.'$$';
			$response = Post_InterfaceOut($xmldata,$interface,$userdata);
			$xml = simplexml_load_string($response);
			//print_r($xml);
			$result = array();
				foreach($xml->WAREHOUSE as $arr) {
					 $arr->SHIPCODE;

					 $test = array("WARHSNAME"=>(string)$arr->WARHSNAME,"LOCNAME"=>(string)$arr->LOCNAME,"WARHSDES"=>(string)$arr->WARHSDES,"WARHS"=>(string)$arr->WARHS,"PIKORDER"=>(string)$arr->PIKORDER);
					 $result[] = $test;
				}
			print_r(json_encode($result));
			//WriteToLog($xmldata,$response,$interface,$page);
		}
	}
	// items page
	elseif($page == 'items'){
		if($_POST['FetchMode'] == 'false'){
			// static XML
			echo $page.'$$';
			echo "No data !! Please Click Sync Items";
		}else{
			// api data
			$userdata = array();
			$interface = 'WMS2_PARTS';
			$xmldata = '<General> <InterfaceConditions> <columnname>PARTNAME</columnname> <operator></operator> <columnvalue>*</columnvalue> </InterfaceConditions> </General>';
			echo $page.'$$';
			$response = Post_InterfaceOut($xmldata,$interface,$userdata);
			$xml = simplexml_load_string($response);
			
			if(!empty($xml)){
				$result = array();
				foreach($xml->ITEM as $arr) {
					 $arr->ITEMS;

					 $test = array("ITEMCODE"=>(string)$arr->ITEMCODE,"BARCODE"=>(string)$arr->BARCODE,"DESCRIPTION"=>(string)$arr->DESCRIPTION,"PART"=>(string)$arr->PART,"WAREHOUSENAME"=>(string)$arr->WAREHOUSENAME,"LOCNAME"=>(string)$arr->LOCNAME,"BIN"=>(string)$arr->BIN);
					 $result[] = $test;
				}
			}
			print_r(json_encode($result));
			WriteToLog($xmldata,$response,$interface,$page);
		}
	}
	// ship code page
	elseif($page == 'ship_code'){
		if($_POST['FetchMode'] == 'false'){
			// static XML
			echo $page.'$$';
			echo "No data !! Please Click Sync Ship Code";
		}else{
			// api data
		
			$userdata = array();
			$interface = 'WMS2_SHIPCODES';
			$xmldata = '<General><InterfaceConditions><columnname>STCODE</columnname><operator></operator><columnvalue>*</columnvalue></InterfaceConditions></General>';
			
			// $interface = "ROYY_WORKHOURS33";
			
			$response = Post_InterfaceOut($xmldata,$interface,$userdata);
			$xml = simplexml_load_string($response);
			//print_r($xml);
			$result = array();
				foreach($xml->SHIPCODE as $arr) {
					 $arr->SHIPCODE;

					 $test = array("SHIPTYPE"=>(string)$arr->SHIPTYPE,"STCODE"=>(string)$arr->STCODE,"STDES"=>(string)$arr->STDES);
					 $result[] = $test;
				}
			echo $page.'$$';
			print_r(json_encode($result));
			WriteToLog($xmldata,$response,$interface,$page);
		}
	}
	elseif($page == 'invoice-view'){
		if(isset($_POST['tableData'])){
				$ordNo = $_POST['ordNo'];
				$data = json_decode($_POST['tableData']);
					$xmldata = '<EINVOICES>';
					$xmldata .= '<ORD>';
					$xmldata .= $ordNo;
					$xmldata .= '</ORD>';
				foreach($data as $row){
					
					$xmldata .= '<ITEMS>';
					$xmldata .= '<PART>';
					$xmldata .= $row->part;
					$xmldata .= '</PART>';
					$xmldata .= '<BIN>';
					$xmldata .= $row->bin;
					$xmldata .= '</BIN>';
					$xmldata .= '<QUANTITY>';
					$xmldata .= $row->qty;
					$xmldata .= '</QUANTITY>';
					$xmldata .= '<ORDI>';
					$xmldata .= $row->ordi;
					$xmldata .= '</ORDI>';
					$xmldata .= '</ITEMS>';
				}
				$xmldata .= '</EINVOICES>';
				
				$ordNo = $_POST['ordNo'];
				$userdata = array();
				$interface = 'WMS2_EINVOICES';
			
					
					// $interface = "ROYY_WORKHOURS33";
					
				echo $response = Get_InterfaceIn($xmldata,$interface,$userdata);
				$xml = simplexml_load_string($response);
				//print_r(json_encode($xml));
				WriteToLog($xmldata,$response,$interface,$page);
		}
	}
	elseif($page == 'warehouse-view'){
		if(isset($_POST['tableData'])){
				$ordNo = $_POST['ordNo'];
				$data = json_decode($_POST['tableData']);
					$xmldata = '<EINVOICES>';
					$xmldata .= '<ORD>';
					$xmldata .= $ordNo;
					$xmldata .= '</ORD>';
				foreach($data as $row){
					
					$xmldata .= '<ITEMS>';
					$xmldata .= '<PART>';
					$xmldata .= $row->part;
					$xmldata .= '</PART>';
					$xmldata .= '<BIN>';
					$xmldata .= $row->bin;
					$xmldata .= '</BIN>';
					$xmldata .= '<QUANTITY>';
					$xmldata .= $row->qty;
					$xmldata .= '</QUANTITY>';
					$xmldata .= '<ORDI>';
					$xmldata .= $row->ordi;
					$xmldata .= '</ORDI>';
					$xmldata .= '</ITEMS>';
				}
				$xmldata .= '</EINVOICES>';
				
				$ordNo = $_POST['ordNo'];
				$userdata = array();
				$interface = 'WMS2_EINVOICES';
			
					
					// $interface = "ROYY_WORKHOURS33";
					
				echo $response = Get_InterfaceIn($xmldata,$interface,$userdata);
				$xml = simplexml_load_string($response);
				//print_r(json_encode($xml));
				WriteToLog($xmldata,$response,$interface,$page);
		}
	}
	elseif($page == 'shipment-view'){
		
		if(isset($_POST['tableData'])){
				$ordNo = $_POST['ordNo'];
				$userdata = array();
				$interface = 'WMS2_DOCUMENTS_D';
					$data = json_decode($_POST['tableData']);
					$xmldata = '<EINVOICES>';
					$xmldata .= '<ORD>';
					$xmldata .= $ordNo;
					$xmldata .= '</ORD>';
				foreach($data as $row){
					
					$xmldata .= '<ITEMS>';
					$xmldata .= '<PART>';
					$xmldata .= $row->part;
					$xmldata .= '</PART>';
					$xmldata .= '<BIN>';
					$xmldata .= $row->bin;
					$xmldata .= '</BIN>';
					$xmldata .= '<QUANTITY>';
					$xmldata .= $row->qty;
					$xmldata .= '</QUANTITY>';
					$xmldata .= '<ORDI>';
					$xmldata .= $row->ordi;
					$xmldata .= '</ORDI>';
					$xmldata .= '</ITEMS>';
				}
				$xmldata .= '</EINVOICES>';
					
					// $interface = "ROYY_WORKHOURS33";
					
				echo $response = Get_InterfaceIn($xmldata,$interface,$userdata);
				$xml = simplexml_load_string($response);
				//print_r(json_encode($xml));
				WriteToLog($xmldata,$response,$interface,$page);
			}
	}
	//grv page
	elseif($page == 'open_grv' || $page == 'blank_grv'){
		//echo $page.'is here';		
	$xmldata = '<General> <InterfaceConditions> 
<columnname>STATDES</columnname> <operator>=</operator>
 <columnvalue>טיוטא</columnvalue> 
 </InterfaceConditions> </General>';
		
	
//	$debug_mode = debugMode();
	
		$interface = "ROYY_GRV";	
		$response = Post_InterfaceOut($xmldata,$interface,$userdata);
		$curlData =$response;		
    
	$curlData =@simplexml_load_string($curlData);
			if(!empty($curlData)){			
			if (strpos($response, 'Errors') === FALSE) {
				foreach($curlData->GRV as $data)
				{
					$result[]=$data;
				}				
				print_r(json_encode($result));
							}				
	 }else{
		 echo "error";
	 }
		
		
	}
	exit;
}

/*--------------------------- Open GRV --------------------------------------*/
if(isset($_POST['grvdata'])){
	global $wpdb;	
			
	$xmldata = '<General> <InterfaceConditions> 
<columnname>STATDES</columnname> <operator>=</operator>
 <columnvalue>טיוטא</columnvalue> 
 </InterfaceConditions> </General>';
		
	
	
		//$interface = "ROYY_GRV";	
		$interface = $_POST['interface_name'];	
		$response = Post_InterfaceOut($xmldata,$interface,$userdata);
		$curlData =$response;		
   
	    $curlData =@simplexml_load_string($curlData);
			if(!empty($curlData)){			
			if (strpos($response, 'Errors') === FALSE) {
				foreach($curlData->GRV as $data)
				{
					$result[]=$data;
				}				
				print_r(json_encode($result));
			}				
	 }else{
		 echo "error";
	 }
	exit; 
}

// grv details
if(isset($_POST['order_num'])){
	global $wpdb;
	
	$order_num = $_POST['order_num'];
		 
	$xmldata = '<ORDERS><ORDER><ORDNAME>'.$order_num.'</ORDNAME></ORDER></ORDERS>';	
	$interface = $_POST['interface_name'];
	$debug_mode = debugMode();
	if($debug_mode == 1) {
		
	} else {	
		//$interface = "ROYY_CREATEINVOICE"; // Roy: this is bug, $interface assigned in line 902 already, this is new assignment that hard code invoice.
		
		$response = Get_InterfaceIn($xmldata,$interface,$userdata);
	}	
			print_r($response);
		$pagename = 'Orderview Row Double Click';	
	    WriteToLog($xmldata,$response,$interface,$pagename);
			
	 
	exit;
}

////////////////////// Send Blank GRV Details data ////////////////////////////
if($_POST['blank_serial']){
		
	$blank_orderNUM = $_POST['blank_orderNUM'];
	$blank_serial = $_POST['blank_serial'];
	$blank_barcode = $_POST['blank_barcode'];
	$qty = $_POST['qty'];
	$userdata = array();
	$interface = 'ROYY_GRVDETAILS';
	$xmldata = '<GRVS><GRV><HEAD><DOC>'.$blank_orderNUM.'</DOC></HEAD><DETAILS><BARCODE>'.$blank_barcode.'</BARCODE><TQUANT>'.$qty.'</TQUANT></DETAILS></GRV></GRVS>';
	
	echo $response = Get_InterfaceIn($xmldata,$interface,$userdata);
	
	$pagename = 'Blank GRV Form Submit';
	WriteToLog($xmldata,$response,$interface,$pagename);
exit;	
} 

/******************************** Client Defination ****************************************************/

if(isset($_POST['code'])){
	
	global $wpdb;
	$table_name =wms2_tbl();
	$key = $_POST['code'];
	$id = $_POST['UserId'];
	$myrow = $wpdb->get_results( "SELECT * FROM ".$table_name. " where `userID`='".$id."'");
	$data=array(
			'userID' => $id,
			'shipType' => $key
	);
	$whereId =array('userID' => $id);
	if(empty($myrow)){
			
			$insert_query=$wpdb->insert($table_name,$data);
		
		}else{
			
			$insert_query=$wpdb->update($table_name,$data,$whereId);
			
	}
	if($insert_query){
			echo "success";
			echo "$$";
			echo $key;
			exit;
		}else{
			
			echo "fail";
		}
		
	exit;
	}

 

/************************* Post GRV Details data to the api ************/
if(isset($_POST['serial_name'])){
	global $wpdb;
		
	$partname = $_POST['partname'];
	$input_barcode = $_POST['input_barcode'];
	$update_bar_check = $_POST['update_bar_check'];
	if($update_bar_check == 1) {
		$serial_name = $_POST['serial_name'];
		$doc_no = $_POST['doc_no'];
		$trans = $_POST['trans'];
		$t_qty = $_POST['t_qty'];
		$to_loc = $_POST['to_loc'];
			 
		$xmldata = '<GRVS><GRV><HEAD><DOC>'.$doc_no.'</DOC></HEAD><DETAILS><TRANS>'.$trans.'</TRANS><TQUANT>'.$t_qty.'</TQUANT><SERIALNAME>'.$serial_name.'</SERIALNAME><TOLOCNAME>'.$to_loc.'</TOLOCNAME></DETAILS></GRV></GRVS>';	
		$interface = 'ROYY_GRVDETAILS';
		//$debug_mode = debugMode();
		$debug_mode = 0;
		if($debug_mode == 1) {
			
		} else {	
			$response = Get_InterfaceIn($xmldata,$interface,$userdata);
		}	
			echo $response;
			$pagename = 'Orderview Row Double Click';	
			WriteToLog($xmldata,$response,$interface,$pagename);
	}		
		$xmldata = ' <LOGPARTS><LOGPART><PARTNAME>'.$partname.'</PARTNAME><BARCODE>'.$input_barcode.'</BARCODE></LOGPART></LOGPARTS>';	
		$interface = 'ROYY_UPDATEBARCODE';
		//$debug_mode = debugMode();
		$debug_mode = 0;
		if($debug_mode == 1) {
			
		} else {	
			$response = Get_InterfaceIn($xmldata,$interface,$userdata);
		}	
		echo $response;
		$pagename = 'Orderview Row Double Click';	
		WriteToLog($xmldata,$response,$interface,$pagename);
	 
	exit;
}
////////////////////// Function for save the logs in DB ////////////////////////
function WriteToLog($xmldata,$response,$interface,$pagename) {
	global $wpdb;
	 //if (strpos($response, '<InterfaceMessages>') !== false) { }
	 if (strpos($response, '<InterfaceErrors>') == false) {
			$status = 'Success';
					 
					
				} else {        
					$status = 'Failure';					
				}
			$dt = date("d-m-y H:i");
			$errorlog_tbl = $wpdb->prefix."errorlog_table_tbl";
			$insert = $wpdb->insert( 
				$errorlog_tbl, 
				array( 
						'Response' => $response, 
						'TimeStamp' => $dt,
						'InterfaceName' => $interface, 
						'XMLout' => $xmldata, 
						'Status' => $status,							
						'pagename' => $pagename							
					)
			);	
		
           echo "$$"."api_res".$status; 		
}

////////////////////// Function for post data to the api(InterfaceOut) ////////////////////////
function Post_InterfaceOut($xmldata,$interface,$userdata=array()) {
	global $wpdb;
	$roles = array();
	if(!empty($userdata)) {
	  $roles = $userdata->roles;
	}
	 $api_table_name = $wpdb->prefix."priotity_api_tbl";
	 $API_credential = $wpdb->get_results( "SELECT * FROM ".$api_table_name );
	
	$interface_type = "InterfaceOut";
	
	 $api_url = $API_credential[0]->api_url;
	 $Application = $API_credential[0]->application;
	 $EnviromnetName = $API_credential[0]->enviromnet_name;
	 $Language = $API_credential[0]->language;
	 $apiUrl = $API_credential[0]->url;
	 
	 if (in_array("wms", $roles)) {	
	 
		 $Password = $userdata->employee_password;
		 $UserName = $userdata->employee;	
	 } else { 
		 $Password = $API_credential[0]->password;
		 $UserName = $API_credential[0]->username;	 
	 }
	 $debugMode = $API_credential[0]->debugMode;
	 //$interface = "ROYY_OPENORDERS";
	 
	 	 $url = $api_url.$interface_type;
		
		$act_text = str_replace(' ', '%20', $xmldata);
		$act_text = str_replace('+', '%2B', $act_text);
		$act_text = str_replace('&', '%26', $act_text);
	
	$postData = array('Application' => $Application, 'EnviromnetName' => $EnviromnetName,'Language' => $Language,'UserName' => $UserName,'Url' => $apiUrl, 'Password' => $Password, 'Interface' => $interface,'inputxml' => $xmldata);
	
	
	$uri = http_build_query($postData, '', '&');	
	$uri = str_replace (array('+',' '), '%20', $uri);
	$url = sprintf("%s?%s", $url, $uri);	
		
	$curlObj = curl_init();
	curl_setopt($curlObj, CURLOPT_URL, $url);
	curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curlObj, CURLOPT_HEADER, 0);
	curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/text'));
	curl_setopt($curlObj, CURLOPT_HTTPGET, 1);
	//curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

	$response = curl_exec($curlObj);
	$curlData =$response;	
	curl_close($curlObj);
	return $response;
}


////////////////////// Function for get data from the api(InterfaceIn) ////////////////////////
function Get_InterfaceIn($xmldata,$interface,$userdata=array()) {
	global $wpdb;
	$roles = $userdata->roles;$roles = array();
	if(!empty($userdata)) {
	  $roles = $userdata->roles;
	}
	$api_table_name = $wpdb->prefix."priotity_api_tbl";
	$API_credential = $wpdb->get_results( "SELECT * FROM ".$api_table_name );
	
	$interface_type = "InterfaceIn";
	
	 $api_url = $API_credential[0]->api_url;
	 $Application = $API_credential[0]->application;
	 $EnviromnetName = $API_credential[0]->enviromnet_name;
	 $Language = $API_credential[0]->language;
	 $apiUrl = $API_credential[0]->url;
	  if (in_array("wms", $roles)) {
		
		  $Password = $userdata->employee_password;
	 //$Password = "123456";
	 $UserName = $userdata->employee;
	 } else {
	 
	 $Password = $API_credential[0]->password;
	 //$Password = "123456";
	 $UserName = $API_credential[0]->username;
	 }
	 
	 
	 $url = $api_url.$interface_type;
		
	$postData = array('Application' => $Application, 'EnviromnetName' => $EnviromnetName,'Language' => $Language,'UserName' => $UserName,'Url' => $apiUrl, 'Password' => $Password, 'Interface' => $interface,'inputxml' => $xmldata);
	
	$jsonData = json_encode($postData);
				
	$curlObj = curl_init();
	curl_setopt($curlObj, CURLOPT_URL, $url);
	curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curlObj, CURLOPT_HEADER, 0);
	curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
	curl_setopt($curlObj, CURLOPT_POST, 1);
	curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

	$response = curl_exec($curlObj);

	curl_close($curlObj);	
	return $response;
}

 
?>
