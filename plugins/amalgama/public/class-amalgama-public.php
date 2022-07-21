<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.linkedin.com/in/ljpinto/
 * @since      1.0.0
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @author     Luis J Pinto <otzi122@gmail.com>
 */
class Amalgama_Public
{
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @var      string       The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @var      string       The current version of this plugin.
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
		$this->version     = $version;

		add_filter('the_title', [ $this, 'add_titles_extension_to_post'], 10, 2);

	}

	
	/**
	 * Add title extension to the post title
	 *
	 * @param  mixed $title
	 * @param  mixed $id
	 * @return void
	 */
	public function add_titles_extension_to_post(string $title, int $id) 
	{
		$titleExtension = get_option(Amalgama_Admin::FIELD_TITLES_EXTENSION,'');
		return get_post_type($id) == "post" ?
			sprintf('%s %s', $title, $titleExtension):
			$title;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles(): void
	{
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/amalgama-public.css', [], $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts(): void
	{
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/amalgama-public.js', ['jquery'], $this->version, false);
	}
}
