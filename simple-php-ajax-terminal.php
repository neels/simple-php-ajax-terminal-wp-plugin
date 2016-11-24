<?php

/*
Plugin Name: Simple PHP Ajax terminal
Plugin URI: http://cocobean.co.za
Description: A simple PHP Ajax terminal for WordPress. Helps when you need ssh access but don't have the details.
Version: 1.0.0
Author: Neels Kruger
Author Email: neelskruger@gmail.com
License:GNU
Copyright 2016 Neels Kruger neelskruger@gmail.com
*/

class SimplePHPAjaxTerminal
{

    const name = 'Simple PHP Ajax terminal';
    const slug = 'simple_php_ajax_terminal';

    function __construct()
    {

        //Hook up to the init action
        add_action('init', array(&$this, 'init_simple_php_ajax_terminal'));
        function simple_php_ajax_terminal_scripts()
        {
            wp_register_style('my_css_simple_php_ajax_terminal', plugins_url('/css/simple_php_ajax_terminal.css', __FILE__));
            wp_enqueue_style('my_css_simple_php_ajax_terminal');

        }

        add_action('init', 'simple_php_ajax_terminal_scripts');

    }

    function init_simple_php_ajax_terminal()
    {

        if (is_admin()) {
            require("admin/layout.php");

            add_action('wp_ajax_simple_terminal_ajax','simple_terminal_ajax');
                function simple_terminal_ajax()
                {

                    if ($_POST['root'] == "empty") {
                        $root = trim(shell_exec('pwd'));
                    } else {
                        $root = $_POST['root'];
                    }

                    $the_array = array();

                    $commandnow = trim($_POST['command']);

                    exec('cd ' . $root . ' && ' . $commandnow . ' && pwd', $output);

                    $term_output = "";
                    $term_output .= '<div class="simple_php_ajax_terminal_command_line"> >' . $_POST['command'] . '<br>Current Dir: ' . end($output) . '</div>';
                    $count = count($output);


                    $runner = 0;
                    foreach ($output as $out) {
                        $runner++;
                        if ($runner !== $count) {
                            if (strpos($out, ".") !== false) {
                                $term_output .= '<div class="simple_php_ajax_terminal_no_stop">' . $out . '</div>';
                            } else {
                                $term_output .= '<div class="simple_php_ajax_terminal_has_stop">' . $out . '</div>';
                            }
                        }
                    }

                    $the_array['term_output'] = $term_output;

                    if ($count === 0) {
                        $root = './';
                        $the_array['root'] = trim(shell_exec('pwd'));
                    } else {
                        $get_last = $count - 1;
                        $root = $output[$get_last];

                        $the_array['root'] = $output[$get_last];
                    }

                    $the_array['count'] = $count;
                    echo json_encode($the_array);
                    die();
                }

		} else {
            //Add code here if needed for non admin area
        }


    }


}

new SimplePHPAjaxTerminal();