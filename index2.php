<?php

require_once "config/app.php";
require_once "vendor/autoload.php";

use App\Models\Database;
use App\Models\Fetch;
use App\Models\Log;
use Rhumsaa\Uuid\Uuid;


Log::clear();

// User input validation
$debug = (isset($_GET['debug']) && is_numeric($_GET['debug'])) ? (int)$_GET['debug'] : null;

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

$fetch = new Fetch($rows);
$data = $fetch->getStatuses();

\App\Models\View::render('index', $data);
echo '<pre>';
print_r($data);
echo '</pre>';

/*
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
*/

echo $uuid = Uuid::uuid1();

/*
function multiRequest($data, $options = array()) {

    // array of curl handles
    $curly = array();
    // data to be returned
    $result = array();

    // multi handle
    $mh = curl_multi_init();

    // loop through $data and create curl handles
    // then add them to the multi-handle
    foreach ($data as $id => $d) {

        $curly[$id] = curl_init();

        $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
        curl_setopt($curly[$id], CURLOPT_URL,            $url);
        curl_setopt($curly[$id], CURLOPT_HEADER,         0);
        curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);

        // post?
        if (is_array($d)) {
            if (!empty($d['post'])) {
                curl_setopt($curly[$id], CURLOPT_POST,       1);
                curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
            }
        }

        // extra options?
        if (!empty($options)) {
            curl_setopt_array($curly[$id], $options);
        }

        curl_multi_add_handle($mh, $curly[$id]);
    }

    // execute the handles
    $running = null;
    do {
        curl_multi_exec($mh, $running);
    } while($running > 0);


    // get content and remove handles
    foreach($curly as $id => $c) {
        curl_multi_getcontent($c);
        $httpCode = curl_getinfo($c, CURLINFO_HTTP_CODE);
        $result[$id] = $httpCode;
        curl_multi_remove_handle($mh, $c);
    }

    // all done
    curl_multi_close($mh);

    return $result;
}

$values = array_column($rows, 'url');
$data = array_combine($values, $values);

// $r = multiRequest($data);

*/


