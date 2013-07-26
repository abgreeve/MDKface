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
        $descriptorspec[] = array('file', '/home/adrian/moodles/web/error-output.txt', 'a');
        $resource = proc_open($command, $descriptorspec, $pipes, $dir);

        $cmdoutput = null;
        if (is_resource($resource)) {
            $cmdoutput = stream_get_contents($pipes[1]);
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
        $branches = explode(' ', $rawbranches);
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
            $databaseinfo[$value] = self::run_command($command, $instancelocation);
        }
        return $databaseinfo;
    }
}
