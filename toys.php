<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://awesomecoder.dev
 * @since             1.0.0
 * @package           Toys
 *
 * @wordpress-plugin
 * Plugin Name:       Toys Generator
 * Plugin URI:        https://awesomecoder.dev
 * Description:       awesomecoder.dev
 * Version:           1.0.0
 * Author:            Mohammad Ibrahim
 * Author URI:        https://awesomecoder.dev/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       toys
 * Domain Path:       /languages
 *
 *																__
 *	                                                           |  |
 *	  __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __|  | ___ _ ____
 *	 / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _`  |/ _ \ ' __|
 *	| (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_|  |  __/  |
 *	\__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,___|\___|__|
 *
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('AWESOMECODER_URL', plugin_dir_url(__FILE__));
define('AWESOMECODER_PATH', plugin_dir_path(__FILE__));
define('AWESOMECODER_BASENAME', plugin_basename(__FILE__));

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('TOYS_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-toys-activator.php
 */
function activate_toys()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-toys-activator.php';
	Toys_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-toys-deactivator.php
 */
function deactivate_toys()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-toys-deactivator.php';
	Toys_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_toys');
register_deactivation_hook(__FILE__, 'deactivate_toys');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-toys.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_toys()
{

	$plugin = new Toys();
	$plugin->run();
}
run_toys();
