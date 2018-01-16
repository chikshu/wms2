<?php

////////////////// function for create the table /////////////////
if(!function_exists("wms2_data_tbl"))
{
	function wms2_data_tbl()
		{
			global $wpdb;
			$table_name = wms2_tbl();	
			$charset_collate = $wpdb->get_charset_collate();
				$sql = "CREATE TABLE $table_name (
					id mediumint(9) NOT NULL AUTO_INCREMENT,
					userID INT(11) NOT NULL,
					shipType INT(11) NOT NULL,
					UNIQUE KEY id (id)		
				) $charset_collate;";		
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}
}


global $wpdb;
if (count($wpdb->get_var("SHOW TABLES LIKE '" . wms2_tbl() . "'")) == 0)
	{
		wms2_data_tbl();
	}

	
?>
