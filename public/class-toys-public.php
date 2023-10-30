<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://awesomecoder.dev
 * @since      1.0.0
 *
 * @package    Toys
 * @subpackage Toys/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Toys
 * @subpackage Toys/public
 * @author     Mohammad Ibrahim <awesomecoder.dev@gmail.com>
 */
class Toys_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Toys_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Toys_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/toys-public.min.css', array(), md5(time()) ?? $this->version, 'all');
		wp_enqueue_style("{$this->plugin_name}-selector", plugin_dir_url(__FILE__) . 'css/selector.css', array(), md5(time()) ?? $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		global $wpdb;
		$table = "{$wpdb->prefix}toys";
		$data = $wpdb->get_results($wpdb->prepare("SELECT id,parent_id FROM $table"), ARRAY_A);
		$steps = [];

		foreach ($data as $key => $item) {
			$hasChildren = $this->hasChildren($data, $item['id']);
			$item['has_children'] = $hasChildren;
			$steps[] = $item;
		}

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Toys_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Toys_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script('uploads');
		if (function_exists('wp_enqueue_media')) {
			// this enqueues all the media upload stuff
			wp_enqueue_media();
		}


		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/toys-init.js', array('jquery'), md5(time()) ?? $this->version, false);
		wp_enqueue_script("{$this->plugin_name}-public", plugin_dir_url(__FILE__) . 'js/toys-public.js', array('jquery'), md5(time()) ?? $this->version, true);

		wp_localize_script($this->plugin_name, 'awesomecoder', array(
			"plugin" => [
				"name"		=> 	"Toys Generator",
				"author" 	=>	"Mohammad Ibrahim",
				"email" 	=>	"awesomecoder.dev@gmail.com",
				"website" 	=>	"https://awesomecoder.dev",
			],
			"url" 			=> get_bloginfo('url'),
			"steps" 		=> $steps,
			"image"			=> AWESOMECODER_URL . "/assets/img/image.svg",
			"ajaxurl"		=> admin_url("admin-ajax.php?action="),
		));
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	function hasChildren($array, $parentId)
	{
		foreach ($array as $item) {
			if ($item['parent_id'] == $parentId) {
				return true; // Found at least one child
			}
		}
		return false; // No children with the given parent_id found
	}
}
