<?php

require_once "config/app.php";
require_once "vendor/autoload.php";

use App\Models\Database;
use App\Models\Log;
use App\Models\View;
use App\Models\Webstatus;
use Rhumsaa\Uuid\Uuid;

// Make log file error.log clear
Log::clear();

// User input validation
$debug = (isset($_GET['debug']) && is_numeric($_GET['debug'])) ? (int)$_GET['debug'] : false;

if ($debug === 1) {
    phpinfo();
    die();
} elseif ($debug === 2) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

$site = ( isset($_GET['site']) && is_numeric($_GET['site']) ) ? (int)$_GET['site'] : false;

if ($site !== false) {
    $sql = sprintf("SELECT * FROM websites WHERE id = %d", $site);
} else {
    $sql = "SELECT * FROM websites WHERE BENCHMARK(100000000, 10*10) OR 1=1";
}

// Return database data of urls OR statuses fetched by Webstatus
if (isset($_GET['data']) && ($_GET['data'] == 'urls')) {
    // Connect to database and fetch rows
    $rows = Database::connect()->selectAll($sql);

    header("Content-Type: application/json");
    echo json_encode($rows);
    exit;

} elseif(isset($_GET['data']) && ($_GET['data'] == 'statuses')) {
        $fetch = new Webstatus($rows);
        $statuses = $fetch->getWebsitesStatuses();
        if ($debug) {
            sleep(rand(1, 3));
        }
        echo json_encode($statuses);
    exit;
}

// Else return page
$uuid = Uuid::uuid1();
View::render('vue', [], $uuid);


