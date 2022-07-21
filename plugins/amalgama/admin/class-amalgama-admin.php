<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.linkedin.com/in/ljpinto/
 * @since      1.0.0
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @author     Luis J Pinto <otzi122@gmail.com>
 */
class Amalgama_Admin
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

	const FIELD_TITLES_EXTENSION = 'amalgama_titles_extension';

	const LABEL_TITLES_EXTENSION = 'Titles Extension';
	const LABEL_SAVE             = 'Save Changes';

	const MESSAGE_SUCCESS      = '<em>Done:</em> Updated!';
	const MESSAGE_ERROR        = '<em>Error:</em> Sorry, we couldn\'t save it';

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
		$this->version     = $version;

		add_action('admin_menu', [$this, 'register_settings_menu_page']);
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles(): void
	{
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/amalgama-admin.css', [], $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts(): void
	{
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/amalgama-admin.js', ['jquery'], $this->version, false);
	}

	/**
	 * Register the settings menu page.
	 */
	public function register_settings_menu_page(): void
	{
		add_options_page(
			__('Amalgama configuration', $this->plugin_name),
			__('Amalgama config', $this->plugin_name),
			'manage_options',
			'amalgama',
			[$this, 'get_page_settings'],
			2
		);
	}

	/**
	 * Get page settings.
	 */
	public function get_page_settings(): void
	{
		$this->save_form_setting();

		include __DIR__ . '/partials/amalgama-admin-display.php';
	}

	/**
	 * Save the form from setting.
	 */
	public function save_form_setting(): void
	{
		try
		{
			if (empty($_POST))
			{
				return;
			}

			$fieldTitlesExtension = $_POST[self::FIELD_TITLES_EXTENSION] ?? null;

			($error                                        = $this->get_validation_text_error($fieldTitlesExtension) !== false)
				? $this->errors[self::FIELD_TITLES_EXTENSION] = $error
				: update_option(self::FIELD_TITLES_EXTENSION, $fieldTitlesExtension);

			if (count($this->errors))
			{
				foreach ($this->errors as $errorMessage)
				{
					add_settings_error('setting', 'updated', $errorMessage, 'error');
				}

				return;
			}

			add_settings_error('setting', 'updated', self::MESSAGE_SUCCESS, 'updated');
		}
		catch (\Throwable $th)
		{
			add_settings_error('setting', 'updated', self::MESSAGE_ERROR, 'error');

			return;
		}
	}

	/**
	 * Validate text field.
	 */
	public function get_validation_text_error(?string $text, int $min = 3, int $max = 50): bool
	{
		if (! $text || strlen($text) == 0)
		{
			return __('The unavailability text is empty', $this->plugin_name);
		}

		if (strlen($text) < $min)
		{
			return __('The unavailability text is too short', $this->plugin_name);
		}

		if (strlen($text) > $max)
		{
			return __('The unavailability text is too large', $this->plugin_name);
		}

		return false;
	}

	/**
	 * Is field valid?
	 */
	public function is_field_valid($fieldName): bool
	{
		return ! isset($this->errors[$fieldName]);
	}
}
