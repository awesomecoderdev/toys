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
	 * @var      string    $version    The db instance.
	 */
	private $version;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The db instance.
	 */
	private $wpdb;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $table    The current table of this plugin.
	 */
	private $table;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{
		global $wpdb;
		$this->wpdb = $wpdb;
		$this->table = "{$wpdb->prefix}toys";

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

		if($wpdb->num_rows == 0){
			$result = $wpdb->insert($table, [
				"parent_id" => null,
				"title" => "Start",
			]);

			if (!is_wp_error($result)) {
				$data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table"), ARRAY_A);
			}
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
			"ajaxurl"		=> admin_url("admin-ajax.php?action="),
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

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function handle()
	{
		$action = isset($_REQUEST["do"]) ? strtolower($_REQUEST["do"]) : null;

		if ($action) {
			if (method_exists($this, $action)) {
				call_user_func([$this, $action], $_REQUEST);
				wp_die();
			}
		}

		wp_send_json_error([
			"success" => false,
			"status"  => 403,
			"message" => __("Something wend wrong", "toys"),
			"data" => [
				"request" => $_REQUEST,
			]
		]);

		wp_die();
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function create($request)
	{
		$id = isset($request["id"]) ? $request["id"] : null;
		$result = $this->wpdb->insert($this->table, [
			"parent_id" => $id,
			"title" => "New Step $id",
			// "question" => "Question For Step $id",
			"question" => "",
		]);

		if (!is_wp_error($result)) {
			$steps = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->table"), ARRAY_A);
			wp_send_json_success([
				"success" => true,
				"status"  => 201,
				"message" => __("Steps Created Successfully", "toys"),
				"data" => [
					"steps" => $steps
				]
			]);
		} else {
			wp_send_json_error([
				"success" => false,
				"status"  => 403,
				"message" => __("Something went wrong.", "toys"),
			]);
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function insert($request)
	{
		$result = $this->wpdb->insert($this->table, [
			"parent_id" =>  $request["parent_id"] == "" ? null : $request["parent_id"],
			"thumbnail_id" =>  $request["thumbnail_id"] == "" ? null : $request["thumbnail_id"],
			"title" => $request["title"],
			"description" =>  $request["description"] == "" ? null : $request["description"],
			"image" =>  $request["image"] == "" ? null : $request["image"],
			"link" => $request["link"],
			"question" => $request["question"],
		]);

		if(!is_wp_error($result)){
			return $this->wpdb->insert_id;
		}

		return null;
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function set_nested_structure($steps = [], $parent_id = null)
	{
		foreach ($steps as $key => $step) {
			$step["parent_id"] = $parent_id;
			$new_parent_id = $this->insert($step);

			if(count($step["children"]) > 0){
				$this->set_nested_structure($step["children"],$new_parent_id);
			}
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function duplicate($request)
	{
		$steps = $this->get_nested_structure($request["id"]);
		$parent_id = $request["parent_id"] == "" ? null : $request["parent_id"];
		$new_parent_id = $this->insert($request);

		try {
		$this->set_nested_structure($steps, $new_parent_id);
			$steps = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->table"), ARRAY_A);
			wp_send_json_success([
				"success" => true,
				"status"  => 200,
				"message" => __("Step Duplicated Successfully.", "toys"),
				"data" => [
					"steps" => $steps
				]
			]);
		} catch (\Exception $e) {
			// throw $e;
			wp_send_json_error([
				"success" => false,
				"status"  => 403,
				"message" => __("Something went wrong.", "toys"),
			]);
		}
		// wp_send_json_success([
		// 	"success" => true,
		// 	"status"  => 200,
		// 	"message" => __("Step Deleted Successfully.", "toys"),
		// 	"result" => $this->wpdb->insert_id,
		// 	"request" => $request,
		// 	"data" =>[
		// 		"steps"=> $steps,
		// 	],
		// ]);


		// $deleteByID = $this->wpdb->delete($this->table, [
		// 	"id" => $request["id"],
		// ]);

		// $deleteByParentID = $this->wpdb->delete($this->table, [
		// 	"parent_id" => $request["id"],
		// ]);

		// if (!is_wp_error($deleteByParentID || $deleteByID)) {
		// 	$steps = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->table"), ARRAY_A);
		// 	wp_send_json_success([
		// 		"success" => true,
		// 		"status"  => 200,
		// 		"message" => __("Step Deleted Successfully.", "toys"),
		// 		"data" => [
		// 			"steps" => $steps
		// 		]
		// 	]);
		// } else {
		// 	wp_send_json_error([
		// 		"success" => false,
		// 		"status"  => 403,
		// 		"message" => __("Something went wrong.", "toys"),
		// 	]);
		// }
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function get_nested_structure($parent_id = null)
	{
		$data = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->table WHERE parent_id = %d", $parent_id), ARRAY_A);
		$result = [];
		foreach ($data as $record) {
			$record['children'] = $this->get_nested_structure($record['id']);
			$result[] = $record;
		}

		return $result;
	}


	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function delete($request)
	{
		$deleteByID = $this->wpdb->delete($this->table, [
			"id" => $request["id"],
		]);

		$deleteByParentID = $this->wpdb->delete($this->table, [
			"parent_id" => $request["id"],
		]);

		if (!is_wp_error($deleteByParentID || $deleteByID)) {
			$steps = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->table"), ARRAY_A);
			wp_send_json_success([
				"success" => true,
				"status"  => 200,
				"message" => __("Step Deleted Successfully.", "toys"),
				"data" => [
					"steps" => $steps
				]
			]);
		} else {
			wp_send_json_error([
				"success" => false,
				"status"  => 403,
				"message" => __("Something went wrong.", "toys"),
			]);
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function update($request)
	{
		$data = [];
		if (isset($request["title"]) && !empty($request["title"])) {
			$data["title"] = ltrim($request["title"]);
		}
		if (isset($request["link"]) && !empty($request["link"])) {
			$data["link"] = ltrim($request["link"]);
		}
		if (isset($request["question"]) && !empty($request["question"])) {
			$data["question"] = ltrim($request["question"]);
		}

		if (isset($request["thumbnail_id"], $request["image"]) && !empty($request["thumbnail_id"])) {
			$data["thumbnail_id"] = $request["thumbnail_id"];
			$data["image"] = $request["image"];
		}
		if (isset($request["description"]) && !empty($request["description"])) {
			$data["description"] = sanitize_text_field($request["description"]);
		}

		$update = $this->wpdb->update($this->table, $data, [
			"id" => $request["id"],
		]);

		if (!is_wp_error($update)) {
			$steps = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->table"), ARRAY_A);
			wp_send_json_success([
				"success" => true,
				"status"  => 200,
				"message" => __("Step Updated Successfully.", "toys"),
				"data" => [
					"steps" => $steps
				]
			]);
		} else {
			wp_send_json_error([
				"success" => false,
				"status"  => 403,
				"message" => __("Something went wrong.", "toys"),
			]);
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function remove($request)
	{
		$update = $this->wpdb->update($this->table, [
			"thumbnail_id" => null,
			"image" => null,
		], [
			"id" => $request["id"],
		]);

		if (!is_wp_error($update)) {
			$steps = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->table"), ARRAY_A);
			wp_send_json_success([
				"success" => true,
				"status"  => 200,
				"message" => __("Image Removed Successfully.", "toys"),
				"data" => [
					"steps" => $steps
				]
			]);
		} else {
			wp_send_json_error([
				"success" => false,
				"status"  => 403,
				"message" => __("Something went wrong.", "toys"),
			]);
		}
	}
}
