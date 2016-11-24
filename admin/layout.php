<?php

    add_action('admin_menu', 'simple_php_ajax_terminal_menu');


                    function simple_php_ajax_terminal_menu() {

                            add_menu_page('Simple PHP Ajax terminal ', 'Simple PHP Ajax terminal', 'manage_options', 'simple-php-ajax-terminal-list','simple_php_ajax_terminal_index','dashicons-desktop');

                            add_submenu_page( 'simple-php-ajax-terminal-list', 'Main Page', 'Main Page', 'manage_options', 'simple-php-ajax-terminal-list','simple_php_ajax_terminal_index');
                            //add_submenu_page( 'simple-php-ajax-terminal-list', 'Add/edit Layout', 'Add/Edit Layout', 'manage_options', 'simple-php-ajax-terminal-layout','layout');
                        }


                        function simple_php_ajax_terminal_index(){
                           require('simple_php_ajax_terminal_index.php');
                        }