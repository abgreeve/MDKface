<?php

function get_moodle_instances($mainlocation) {
    $instances = scandir($mainlocation);
    $instances = array_filter($instances, 'not_instance');
    return $instances;
}

function not_instance($directoryentry) {
    $notincluded = array('.', '..', 'web');
    foreach ($notincluded as $value) {
        if ($directoryentry == $value) {
            return false;
        }
    }
    return true;
}

function print_instances($instances) {
    echo '<h2>Stable</h2>';
    echo '<ul>';
    foreach ($instances as $instance) {
        if (stripos($instance, 'stable') !== false) {
            $url = 'http://adrian.moodle.local/' . $instance;
            echo '<li><a href="' . $url . '">' . $instance . '</a></li>';
        }
    }
    echo '</ul>';
    echo '<h2>Integration</h2>';
    echo '<ul>';
    foreach ($instances as $instance) {
        if (stripos($instance, 'integration') !== false) {
            $url = 'http://adrian.moodle.local/' . $instance;
            echo '<li><a href="' . $url . '">' . $instance . '</a></li>';
        }
    }
    echo '</ul>';
}

function optional_param($param, $default) {
    if (isset($_POST[$param])) {
        return $_POST[$param];
    } else if (isset($_GET[$param])) {
        return $_GET[$param];
    } else {
        return $default;
    }
}

