<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Cplc_Chmg_Paybright_Loan_Calculator
 * @subpackage Cplc_Chmg_Paybright_Loan_Calculator/admin/partials
 */
    $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'cplc_loan_options';

    if( isset( $_GET[ 'tab' ] ) ) {
        $active_tab = $_GET[ 'tab' ];
    } // end if

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<div class="wrap">
    <?php settings_errors(); ?>
    <h1><?php echo get_admin_page_title(); ?></h1>
    <hr/>

    <h2 class="nav-tab-wrapper">
        <a href="?page=cplc-chmg-paybright-loan-calculator&tab=cplc_loan_options" class="nav-tab <?php echo $active_tab == 'cplc_loan_options' ? 'nav-tab-active' : ''; ?>">Loan Calculator</a>
        <a href="?page=cplc-chmg-paybright-loan-calculator&tab=cplc_product_settings" class="nav-tab <?php echo $active_tab == 'cplc_product_settings' ? 'nav-tab-active' : ''; ?>">Product Settings</a>
        <a href="?page=cplc-chmg-paybright-loan-calculator&tab=cplc_form_heading" class="nav-tab <?php echo $active_tab == 'cplc_form_heading' ? 'nav-tab-active' : ''; ?>">Form Heading</a>
        <a href="?page=cplc-chmg-paybright-loan-calculator&tab=cplc_form_main" class="nav-tab <?php echo $active_tab == 'cplc_form_main' ? 'nav-tab-active' : ''; ?>">Form Main</a>
        <a href="?page=cplc-chmg-paybright-loan-calculator&tab=cplc_card_block" class="nav-tab <?php echo $active_tab == 'cplc_card_block' ? 'nav-tab-active' : ''; ?>">Card Block</a>
        <a href="?page=cplc-chmg-paybright-loan-calculator&tab=cplc_form_footer" class="nav-tab <?php echo $active_tab == 'cplc_form_footer' ? 'nav-tab-active' : ''; ?>">Form Footer</a>

    </h2>

    <form method="post" action="options.php">

    <?php
            

            if( $active_tab == 'cplc_form_footer' ) {
                settings_fields($this->plugin_name);
                do_settings_sections($this->plugin_name);
                
            } else if( $active_tab == 'cplc_product_settings') {
                settings_fields($this->plugin_name."-product");
                do_settings_sections($this->plugin_name."-product");
            }else if( $active_tab == 'cplc_loan_options'){
                settings_fields($this->plugin_name."-loan_options");
                do_settings_sections($this->plugin_name."-loan_options");
            }else if( $active_tab == 'cplc_form_heading'){
                settings_fields($this->plugin_name."-form_heading");
                do_settings_sections($this->plugin_name."-form_heading");
            }else if( $active_tab == 'cplc_form_main'){
                settings_fields($this->plugin_name."-form_main");
                do_settings_sections($this->plugin_name."-form_main");
            
            }else if( $active_tab == 'cplc_card_block'){
                settings_fields($this->plugin_name."-card_block");
                do_settings_sections($this->plugin_name."-card_block");
            }

            submit_button(); 
    ?>
    </form>
</div>