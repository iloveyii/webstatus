<?php

require_once "config/app.php";
require_once "vendor/autoload.php";

use App\Models\Database;
use App\Models\Webstatus;
use Rhumsaa\Uuid\Uuid;

$sql = "SELECT * FROM websites WHERE BENCHMARK(100000000, 10*10) OR 1=1";
$rows = Database::connect()->selectAll($sql, []);

foreach ($rows as $row) {
    $webStatus = new Webstatus($row['url']);
    echo $webStatus->getStatus() . '<br />';
}

echo $uuid = Uuid::uuid1();