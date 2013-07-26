<?php
// include '../../config.php';
// require_once   '../' . basename(__DIR__) . '/config.php';

class mdk {



    function run_command($command, $dir = null) {

        // echo 'Something: ' . $mdkinstancelocation;
        $pipes = array();
        $descriptorspec = array();
        $descriptorspec[] = array('pipe', 'r');
        $descriptorspec[] = array('pipe', 'w');
        $descriptorspec[] = array('file', './error-output.txt', 'a');
        $resource = proc_open($command, $descriptorspec, $pipes, $dir);

        $cmdoutput = null;
        if (is_resource($resource)) {
            // echo 'I get here!';
            $cmdoutput = stream_get_contents($pipes[1]);
            // echo 'output: ' .  $cmdoutput . '<br />';
            // foreach ($pipes as $key => $value) {
            //     echo stream_get_contents($value);
            // }
        }

        foreach ($pipes as $pipe) {
            fclose($pipe);
        }

        // echo $cmdoutput;

        proc_close($resource);
        return $cmdoutput;
    }

    static function get_version() {
        return self::run_command('mdk -v');
    }

    static function get_status($branchlocation) {
        return self::run_command('git status', $branchlocation);
    }

    static function get_branches($branchlocation) {
        $rawbranches = self::run_command('git branch', $branchlocation);
        $branches = explode("\n", $rawbranches);
        $i = 1;
        foreach ($branches as $key => $value) {
            if (stripos($value, '*') !== false) {
                unset($branches[$key]);
                $branches['0'] = trim($value, '* ');
            } else {
                $branches[$i] = trim($value);
                $i++;
            }
        }
        $branches = array_filter($branches);
        return $branches;
    }

    static function change_branch($name, $location) {
        $cmd = 'git checkout ' . $name;
        $notused = self::run_command($cmd, $location);
    }

    static function get_moodle_instances() {
        $instances = array();
        $rawdata = self::run_command('mdk info --list');
        $instances = explode("\n", $rawdata);
        foreach ($instances as $key => $value) {
            $instance = explode(' ', $value, 2);
            $instances[$key] = $instance[0];
        }
        $instances = array_filter($instances);
        return $instances;
    }

    static function get_dbinfo($instancelocation) {
        $databasevars = array('dbhost', 'dbname', 'dbpass', 'dbtype', 'dbuser');
        $databaseinfo = array();
        foreach ($databasevars as $value) {
            $command = 'mdk info --var ' . $value;
            $databaseinfo[$value] = trim(self::run_command($command, $instancelocation));
        }
        return $databaseinfo;
    }

    static function create_instance($engine, $install, $integration, $suffix, $version) {
        $cmd = 'mdk create ';
        if (!empty($engine)) {
            $cmd .= '--engine '. $engine . ' ';
        }
        if (!empty($integration)) {
            $cmd .= '--integration ';
        }
        if (!empty($suffix)) {
            $cmd .= '--suffix '. $suffix . ' ';
        }
        if (!empty($version)) {
            $cmd .= '--version '. $version . ' ';
        }
        if (!empty($install)) {
            $cmd .= '--install ';
        }
        return self::run_command($cmd);
    }
}
