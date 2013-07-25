<?php
    include '/home/adrian/moodles/web/lib/mdk-class.php';

    $change = $_GET['change'];
    $branchname = $_GET['branchname'];

    $mdk = new mdk();
    $instancelocation = '/home/adrian/moodles/stable_master_postgres/moodle/';
    
    if ($change) {
        $mdk->change_branch($branchname, $instancelocation);
    }

    $status = $mdk->get_status($instancelocation);
    $branches = $mdk->get_branches($instancelocation);

?>
<html>
<head>
    <title>Info page for this instance</title>
    <link rel="stylesheet" type="text/css" href="instances.css">
</head>
<body>
<h2>Info page for Stable Master Postgres</h2>
<h3>Current branch:</h3>
<p><?php echo nl2br($status); ?></p>
<h3>branches:</h3>
<table>
<?php
    foreach ($branches as $key => $value) {
        echo '<tr>';
        echo '<td><a href="view.php?change=1&branchname=' . $value .'">' . $value . '</a></td>';      
        echo '</tr>';
    }
?>        
</table>
</body>
</html>
