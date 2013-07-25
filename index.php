<?php

    include '/home/adrian/moodles/web/lib/mdk-class.php';

    $mdk = new mdk();
    $output = $mdk->run_command('mdk info', '/home/adrian/moodles/stable_master_postgres/moodle/');
    echo nl2br($output);



?>
<html>
	<head>
		<title>Listing of all of my Moodle instances</title>
        <link rel="stylesheet" type="text/css" href="instances.css">
	</head>
	<body>
        <a href="http://www.moodle.org"><img src="pics/moodle.jpg"></a>
		<h2>Stable</h2>
		<ul>
			<li><a href="http://adrian.moodle.local/stable_master_postgres/">Stable Master (Postgres)</a></li>
			<li><a href="http://adrian.moodle.local/stable_25_postgres/">Stable 25 (Postgres)</a></li>
			<li><a href="http://adrian.moodle.local/stable_24_postgres/">Stable 24 (Postgres)</a></li>
		</ul>
		<h2>Integration</h2>
        <table>
            <tr>
            <th><img src="pics/postgres_small.png" /> Postgres</th>
            <th><img src="pics/mssql_small.png" />MS SQL</th>
            <th><img src="pics/Mysql_Logo_small.gif" /> MySQL</th>
            </tr>
            <tr>
                <td>
                    <ul>
                        <li><a href="http://adrian.moodle.local/integration_master_postgres/">Integration Master (Postgres)</a></li>
                        <li><a href="http://adrian.moodle.local/integration_25_postgres/">Integration 25 (Postgres)</a></li>
                        <li><a href="http://adrian.moodle.local/integration_24_postgres/">Integration 24 (Postgres)</a></li>
                        <li><a href="http://adrian.moodle.local/integration_23_postgres/">Integration 23 (Postgres)</a></li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li><a href="http://adrian.moodle.local/integration_master_mssql/">Integration Master (mssql)</a></li>
                        <li><a href="http://adrian.moodle.local/integration_25_mssql/">Integration 25 (mssql)</a></li>
                        <li><a href="http://adrian.moodle.local/integration_24_mssql/">Integration 24 (mssql)</a></li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li><a href="http://adrian.moodle.local/integration_master/">Integration Master (MySQL)</a></li>
                        <li><a href="http://adrian.moodle.local/integration_24/">Integration 24 (MySQL)</a></li>
                        <li><a href="http://adrian.moodle.local/integration_23/">Integration 23 (MySQL)</a></li>
                        <li><a href="http://adrian.moodle.local/integration_22/">Integration 22 (MySQL)</a></li>
                        <li><a href="http://adrian.moodle.local/integration_21/">Integration 21 (MySQL)</a></li>
                    </ul>
                </td>
            </tr>
        </table>
        <h2>Other</h2>
        <table>
            <tr>
                <th><a href="http://adrian.moodle.local/phpmyadmin/"><img src="pics/logo_right.png" /></a></th>
            </tr>
        </table>
	</body>
</html>