<?php

require_once "config/app.php";
require_once "vendor/autoload.php";

use App\Models\Database;
use App\Models\Webstatus;
use Rhumsaa\Uuid\Uuid;
use App\Models\Log;


if ( isset($_GET['debug']) && $_GET['debug'] == '1') {
    phpinfo();
    die();
} elseif ( isset($_GET['debug']) && $_GET['debug'] == '2') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

if (isset($_GET['site'])) {
    $sql = "SELECT * FROM websites WHERE id = ${_GET['site']}";
} else {
    $sql = "SELECT * FROM websites WHERE BENCHMARK(100000000, 10*10) OR 1=1";
}

$rows = Database::connect()->selectAll($sql);

foreach ($rows as $row) {
    if (!empty($row['url'])) {
        $url = $row['url'];
        Log::clear();
        Log::write("Checking status for site {$url}", Log::INFO);
        $webStatus = new Webstatus($url);
        $statusCheck = $webStatus->getStatus() === true ? 'true' : 'false';
        $line = sprintf("%s || %s %s", $url, $statusCheck, '<br />');
        echo $line;
    }
}

echo $uuid = Uuid::uuid1();