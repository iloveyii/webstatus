<?php

require_once "config/app.php";
require_once "vendor/autoload.php";

use App\Models\Database;
use App\Models\Fetch;
use App\Models\Log;
use App\Models\View;
use Rhumsaa\Uuid\Uuid;

// Make log file error.log clear
Log::clear();
exit;
// User input validation
$debug = (isset($_GET['debug']) && is_numeric($_GET['debug'])) ? (int)$_GET['debug'] : false;

if ($debug === 1) {
    phpinfo();
    die();
} elseif ($debug === 2) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

if (isset($_GET['site']) && is_numeric($_GET['site'])) {
    $sql = sprintf("SELECT * FROM websites WHERE id = %d", (int)$_GET['site']);
} else {
    $sql = "SELECT * FROM websites WHERE BENCHMARK(100000000, 10*10) OR 1=1";
}

// Connect to database and fetch rows
$rows = Database::connect()->selectAll($sql);

$fetch = new \App\Models\Webstatus($rows);
$statuses = $fetch->getWebsitesStatuses();

$uuid = Uuid::uuid1();

if ($debug) {
    print_r($data);
}

View::render('index', $statuses, $uuid);
echo 'hifafasfdsafa';

