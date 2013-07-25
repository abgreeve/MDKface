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
}
