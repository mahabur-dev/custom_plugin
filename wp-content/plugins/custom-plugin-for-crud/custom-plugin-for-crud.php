<?php
/*
plugin Name: Custom Plugin for CRUD
Description: A custom WordPress plugin to perform CRUD operations on a custom database table.
Version: 1.0
Author: Your Name
Author URI: https://yourwebsite.com
License: GPL2
*/


if(!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

register_activation_hook(__FILE__, 'create_custom_table');

function create_custom_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'orders_table';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        product_name tinytext NOT NULL,
        product_price varchar(100) NOT NULL,
        product_description text NOT NULL,
        product_image varchar(255) NULL,
        product_stock mediumint(9) NOT NULL,
        status ENUM('active', 'inactive', 'out_of_stock') NOT NULL DEFAULT 'active',
        created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
