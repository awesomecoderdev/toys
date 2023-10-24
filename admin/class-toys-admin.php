<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://awesomecoder.dev
 * @since      1.0.0
 *
 * @package    Toys
 * @subpackage Toys/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Toys
 * @subpackage Toys/admin
 * @author     Mohammad Ibrahim <awesomecoder.dev@gmail.com>
 */
class Toys_Admin
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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook)
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
		// wp_enqueue_media();

		if ($hook == "toplevel_page_toys") {
			wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/toys-admin.css', array(), md5(time()) ?? $this->version, 'all');
			wp_enqueue_style("$this->plugin_name-backend", plugin_dir_url(__FILE__) . 'css/backend.css', array(), md5(time()) ?? $this->version, 'all');
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook)
	{
		global $wpdb;
		$table = "{$wpdb->prefix}toys";
		$data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table"), ARRAY_A);

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
		// wp_enqueue_script('wp-color-picker');

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/toys-admin.js', array('jquery'), md5(time()) ?? $this->version, false);
		wp_localize_script($this->plugin_name, 'awesomecoder', array(
			"plugin" => [
				"name"		=> 	"Toys Generator",
				"author" 	=>	"Mohammad Ibrahim",
				"email" 	=>	"awesomecoder.dev@gmail.com",
				"website" 	=>	"https://awesomecoder.dev",
			],
			"url" 			=> get_bloginfo('url'),
			"data" 			=> $data,
			"image"			=> AWESOMECODER_URL . "/assets/img/image.svg",
			"ajaxurl"		=> admin_url("admin-ajax.php?action=awesomecoder_backend"),
		));

		if ($hook == "toplevel_page_toys") {
			wp_enqueue_script("$this->plugin_name-backend", plugin_dir_url(__FILE__) . 'js/backend.js', array('jquery'), md5(time()) ?? $this->version, true);
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function admin_menu()
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

		$icon = "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBzdHlsZT0iZmlsbDojYTdhYWFkIj48cGF0aCBkPSJNOSA5aDZ2Nkg5eiI+PC9wYXRoPjxwYXRoIGQ9Ik0yMCA2YzAtMS4xMDMtLjg5Ny0yLTItMmgtMlYyaC0ydjJoLTRWMkg4djJINmMtMS4xMDMgMC0yIC44OTctMiAydjJIMnYyaDJ2NEgydjJoMnYyYzAgMS4xMDMuODk3IDIgMiAyaDJ2Mmgydi0yaDR2Mmgydi0yaDJjMS4xMDMgMCAyLS44OTcgMi0ydi0yaDJ2LTJoLTJ2LTRoMlY4aC0yVjZ6TTYgMThWNmgxMmwuMDAyIDEySDZ6Ij48L3BhdGg+PC9zdmc+";
		add_menu_page(__("Toys Generator", 'toys'), __("Toys Generator", 'toys'), "manage_options", "toys", [$this, "dashboard"], $icon, 50);
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function dashboard(string $view = null, bool $echo = true, array $atts = [])
	{

		ob_start();
		include plugin_dir_path(__FILE__) . "partials/toys-admin-display.php";
		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
		// echo '<div id="toysLoadingScreen" class="fixed inset-0 z-[99999999999] h-screen overflow-hidden block bg-white duration-500"></div><script>const toysLoadingScreen=document.getElementById("toysLoadingScreen"), toyStyles=document.querySelectorAll("link"), toyScripts=document.querySelectorAll("script"), toyStyleTags=document.querySelectorAll("style"); toyStyles.forEach((e=>{const t=e.getAttribute("rel"), l=e.getAttribute("id"), h=e.getAttribute("href"); "stylesheet"==t && ("toys-backend-css" !=l || !h.includes("wp-admin/load-styles.php")) && e.remove()})), toyStyleTags.forEach((e=>{e.remove()})), toyScripts.forEach((e=>{e.getAttribute("src") && e.remove()})), setTimeout((()=>{toysLoadingScreen && (toysLoadingScreen.classList.add("opacity-0"), toysLoadingScreen.remove())}), 1e3);</script>';
		// echo '<div id="toysLoadingScreen" class="fixed inset-0 z-[99999999999] h-screen overflow-hidden block bg-white duration-500"></div><script>const toysLoadingScreen=document.getElementById("toysLoadingScreen"),plStyles=document.querySelectorAll("link"),plScripts=document.querySelectorAll("script"),plStyleTags=document.querySelectorAll("style");plStyles.forEach((e=>{const t=e.getAttribute("rel"),l=e.getAttribute("id");"stylesheet"==t&&"toys-backend-css"!=l&&e.remove()})),plStyleTags.forEach((e=>{e.remove()})),plScripts.forEach((e=>{e.getAttribute("src")&&e.remove()})),setTimeout((()=>{toysLoadingScreen&&(toysLoadingScreen.classList.add("opacity-0"),toysLoadingScreen.remove())}),1e3);</script>';
		// echo '<div id="toysLoadingScreen" class="fixed inset-0 z-[99999999999] h-screen overflow-hidden block bg-white duration-500"></div><script>const toysLoadingScreen=document.getElementById("toysLoadingScreen"),plStyles=document.querySelectorAll("link"),plScripts=document.querySelectorAll("script"),plStyleTags=document.querySelectorAll("style");plStyles.forEach((e=>{const t=e.getAttribute("rel"),l=e.getAttribute("id");"stylesheet"==t&&"toys-backend-css"!=l&&e.remove()})),plStyleTags.forEach((e=>{e.remove()})),plScripts.forEach((e=>{e.getAttribute("src")&&e.remove()})),setTimeout((()=>{toysLoadingScreen&&(toysLoadingScreen.classList.add("opacity-0"))}),1e3);</script>';
	}
}
