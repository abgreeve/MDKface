<?php
    include '/home/adrian/moodles/web/lib/mdk-class.php';
    include '/home/adrian/moodles/web/lib/general.php';

    $engine = optional_param('database', null);
    $integration = optional_param('integration', 0);
    $version = optional_param('version', null);
    $suffix = optional_param('suffix', null);
    $install = optional_param('install', 0);
    $submitted = optional_param('submit', null);

    // echo 'submitted: ' .  $submitted . '<br />';

    if ($submitted) {
        $response = mdk::create_instance($engine, $install, $integration, $suffix, $version);
        echo $response;
    }




?>
<html>
    <head>
    <title>Create a new MDK Instance.</title>
    <link rel="stylesheet" type="text/css" href="instances.css">    
    </head>
    <body>
       <form name="instcreate" action="instance_create.php" method="post">
       <table>
           <tr>
               <td>Database: </td>
               <td><input type="radio" name="database" value="mysqli">MySQL
                   <input type="radio" name="database" value="pgsql">PostgreSQL</td>
           </tr>
           <tr>
               <td>Integration: </td>
               <td><input type="checkbox" name="integration" value="1" /></td>
           </tr>
           <tr>
               <td>version: </td>
               <td><input type="text" name="version" /></td>
           </tr>
           <tr>
               <td>Suffix: </td>
               <td><input type="text" name="suffix" /></td>
           </tr>
           <tr>
               <td>Install: </td>
               <td><input type="checkbox" name="intstall" value="1" /></td>
           </tr>
           <tr>
               <td colspan="2"><input type="submit" name="submit" value="Create Instance" /></td>

           </tr>
       </table>
       </form>
    </body>
</html>