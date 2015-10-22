<?php

# Script version
$version = "1.0";

# Check to see if WHMCS is installed
if (file_exists( 'configuration.php' ) || file_exists('../configuration.php')) {
    # Include WHMCS configuration files
    @include_once('configuration.php');
    @include_once('../configuration.php');

    $installed = 1;
}
else {
    $installed = 0;
}
# Make a connection to MySQL
                $con = mysql_connect("$db_host","$db_username","$db_password");
                if (!$con) {
                  die('Could not connect: ' . mysql_error());
                }

                $db = mysql_select_db($db_name);
                if(!$db) {
                    die("Unable to select database");
                }
?>

<html>
    <head>
        <title>WHMCS Database Tools</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans:800,400,300'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <style type="text/css">
            body {
                font-family: 'Open Sans', sans-serif;
                margin-top: 35px;
                background-color: #EFEFEF;
            }
            .green {
                vertical-align: middle;
                color: #339933;
            }
            .red {
                vertical-align: middle;
                color: #B80000;
            }
            .yellow {
                vertical-align: middle;
                color: #FFCC00;
            }
            .content {
                background-color: #FFFFFF;
                width: 960px;
                margin: 0 auto;
                padding-top: 10px;
            }
            .header1 {
                height: 50px;
                text-align: center;
            }
            .header1 img {
                height: 45px;
            }
            .header2 {
                text-align: center;
                font-size: 1.5em;
            }
            .info {
                padding: 10px;
            }
            footer {
                font-size: 0.8em;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <div class="content">
            <div class="header1">
                <img src="http://ssp.whmcs.com/logo.png">
            </div>
            <div class="header2">
                WHMCS Database Tools
            </div>
<div style="padding: 10px; padding-bottom: 10px; height: 45px;">
                <a href="#" class="btn btn-default pull-right" id="collapseAll">Close All</a> <a href="#" style="margin-right: 5px;" class="btn btn-default pull-right" id="expandAll">Expand All</a>
            </div>
            <div class="info">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-info-circle"></i> Quick Information</h3>
                    </div>
                    <div class="panel-body">
                        <strong>Database Tools Version:</strong> <?php echo $version; ?><br />

                        <?php

                        # Get the SystemURL from the database.
                        $query = mysql_query("SELECT value FROM tblconfiguration WHERE setting='SystemURL'");
                        $systemUrl = mysql_fetch_array($query);
                        $systemUrl = $systemUrl[0];

                        # Get the SystemSSLURL from the database.
                        $query = mysql_query("SELECT value FROM tblconfiguration WHERE setting='SystemSSLURL'");
                        $systemSslUrl = mysql_fetch_array($query);
                        $systemSslUrl = $systemSslUrl[0];

                        # Get the WHMCS version as per the database.
                        $query = mysql_query("SELECT value FROM tblconfiguration WHERE setting='version'");
                        $whmcsversion = mysql_fetch_array($query);
                        $whmcsversion = $whmcsversion[0];

                        # Get the set client area template.
                        $query = mysql_query("SELECT value FROM tblconfiguration WHERE setting='Template'");
                        $clientTemplate = mysql_fetch_array($query);
                        $clientTemplate = $clientTemplate[0];

                        # Print out the information which we just obtained on the WHMCS install.
                        if ($systemUrl == '') {
                            echo "<strong>System URL:</strong> Not Set.<br />";
                        }
                        else {
                            echo "<strong>System URL:</strong> $systemUrl<br />";
                        }

                        if ($systemSslUrl == '') {
                            echo "<strong>System SSL URL:</strong> Not Set.<br />";
                        }
                        else {
                            echo "<strong>System SSL URL:</strong> $systemSslUrl<br />";
                        }

                        echo "<strong>WHMCS Version:</strong> $whmcsversion<br />";
                        echo "<strong>Client Area Template:</strong> $clientTemplate<br />";

                        ?>

                    </div>
                </div>
</body>
</html>

