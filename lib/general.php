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



