<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             2.0.0
 * @package           Cplc_Chmg_Paybright_Loan_Calculator
 *
 * @wordpress-plugin
 * Plugin Name:       CHMG Paybright Loan Calculator
 * Plugin URI:        #
 * Description:       Calculates the total loan amount for payBright financing.
 * Version:           2.0.0
 * Author:            Canadian Home Medical Group
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cplc-chmg-paybright-loan-calculator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CPLC_CHMG_PAYBRIGHT_LOAN_CALCULATOR_VERSION', '2.0.0' );
define( 'CPLC_CHMG_TEXT_DOMAIN', 'cplc-chmg-paybright-loan-calculator' );
define('CPLC_ROOT_PATH', plugin_dir_url( __FILE__ ).'public/');


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cplc-chmg-paybright-loan-calculator-activator.php
 */
function activate_cplc_chmg_paybright_loan_calculator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cplc-chmg-paybright-loan-calculator-activator.php';
	Cplc_Chmg_Paybright_Loan_Calculator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cplc-chmg-paybright-loan-calculator-deactivator.php
 */
function deactivate_cplc_chmg_paybright_loan_calculator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cplc-chmg-paybright-loan-calculator-deactivator.php';
	Cplc_Chmg_Paybright_Loan_Calculator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cplc_chmg_paybright_loan_calculator' );
register_deactivation_hook( __FILE__, 'deactivate_cplc_chmg_paybright_loan_calculator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cplc-chmg-paybright-loan-calculator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cplc_chmg_paybright_loan_calculator() {

	$plugin = new Cplc_Chmg_Paybright_Loan_Calculator();
	$plugin->run();

}
run_cplc_chmg_paybright_loan_calculator();

if(!is_admin()){
	require_once plugin_dir_path( __FILE__ ) . 'public/shortcodes/cplc_shortcode.php';
}
