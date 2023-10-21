<?php

/**
 * Fired during plugin activation
 *
 * @link       https://awesomecoder.dev
 * @since      1.0.0
 *
 * @package    Toys
 * @subpackage Toys/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Toys
 * @subpackage Toys/includes
 * @author     Mohammad Ibrahim <awesomecoder.dev@gmail.com>
 */
class Toys_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		global $wpdb;
		$table = "{$wpdb->prefix}toys";

		$sql = "CREATE TABLE $table (
			id INT NOT NULL AUTO_INCREMENT,
			parent_id INT,
			title VARCHAR(255) NOT NULL,
			image VARCHAR(255),
			link VARCHAR(255),
			PRIMARY KEY (id)
		);";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}

	function get_nested_structure($parent_id = null)
	{
		global $wpdb;
		$table = "{$wpdb->prefix}toys";
		$data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE parent_id = %d", $parent_id), ARRAY_A);
		$result = [];
		foreach ($data as $record) {
			$record['children'] = $this->get_nested_structure($record['id']);
			$result[] = $record;
		}
		return $result;
	}
}
