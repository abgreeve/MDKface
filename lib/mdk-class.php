<?php

class mdk {



    function run_command($command, $dir = null) {
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

    function get_version() {
        return self::run_command('mdk -v');
    }

    function get_status($branchlocation) {
        return self::run_command('git status', $branchlocation);
    }

    function get_branches($branchlocation) {
        $rawbranches = self::run_command('git branch', $branchlocation);
        $branches = explode(' ', $rawbranches);
        $branches = array_filter($branches);
        return $branches;
    }

    function change_branch($name, $location) {
        $cmd = 'git checkout ' . $name;
        $notused = self::run_command($cmd, $location);
    }
}
