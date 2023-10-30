<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       https://awesomecoder.dev
 * @since      1.0.0
 *
 * @package    Toys
 * @subpackage Toys/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Toys
 * @subpackage Toys/includes
 * @author     Mohammad Ibrahim <awesomecoder.dev@gmail.com>
 */
class Toys_ShortCode {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      $wpdb    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $wpdb;

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      $wpdb    The actions registered with WordPress to fire when the plugin loads.
	 */
	public $data = [];

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		add_shortcode("toys", [$this,"toys"]);
		global $wpdb;
		$this->wpdb = $wpdb;
		$table = "{$this->wpdb->prefix}toys";
		$this->data = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $table"), ARRAY_A);
	}

	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param    string               $atts             The name of the WordPress filter that is being registered.
	 * @param    string               $content          The name of the function definition on the $content.
	 * @param    string               $tag         		The priority at which the function should be fired.
	 */
	public function toys($atts = array(), $content = null, $tag = '')
	{
		$args = shortcode_atts(array(
			[]
		), $atts);
		$maps = current($this->steps());
		$steps = $this->data;

		ob_start();
		include_once AWESOMECODER_PATH . 'public/partials/toys-public-display.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function steps($parent_id = null)
	{
		$results = [];
		foreach ($this->data as $item) {
			if ($item['parent_id'] == $parent_id) {
				$children = $this->steps($item['id']);
				if (!empty($children)) {
					$item['children'] = $children;
				}
				$results[] = $item;
			}
		}
		return $results;
	}
}
