<?php

/**
 * The plugin bootstrap file.
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.linkedin.com/in/ljpinto/
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       amalgama
 * Plugin URI:        amalgama
 * Description:       This is amalgama code challenge
 * Version:           1.0.0
 * Author:            Luis J Pinto
 * Author URI:        https://www.linkedin.com/in/ljpinto/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       amalgama
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC'))
{
	die;
}

/*
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('AMALGAMA_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-amalgama-activator.php.
 */
function activate_amalgama(): void
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-amalgama-activator.php';
	Amalgama_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-amalgama-deactivator.php.
 */
function deactivate_amalgama(): void
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-amalgama-deactivator.php';
	Amalgama_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_amalgama');
register_deactivation_hook(__FILE__, 'deactivate_amalgama');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-amalgama.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_amalgama(): void
{
	$plugin = new Amalgama();
	$plugin->run();
}
run_amalgama();
