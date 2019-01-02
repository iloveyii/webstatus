<?php

require('lib/inc.php');

if($_GET['debug'] == '1') 
{
    phpinfo();
    die();
}
elseif($_GET['debug'] == '2')
{
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

$con = mysql_connect('localhost', 'root', '');
mysql_select_db('bad', $con);

if(!$con)
{
    $message  = 'Could not connect: ' . mysql_error();
    header("Location: error.php?msg=$message");
    die();
}

if(isset($_GET['site']))
{
    sleep(2);
        $sql = "SELECT * FROM websites WHERE id = ${_GET['site']}";
}
else
{
    $sql = "SELECT * FROM websites WHERE BENCHMARK(100000000, 10*10) OR 1=1";
}

sleep(1);

$result = mysql_query($sql, $con);

if (!$result) {
    $message  = 'Invalid query: ' . mysql_error();
    header("Location: error.php?msg=$message");
    die();
}

$rowArr = array();
while ($row = mysql_fetch_assoc($result)) 
{
    $rowArr[] = $row;
}

for($i = 1; $i < count($rowArr); ++$i)
{
    if(checkStatus($rowArr[$i]['url']))
    {
        echo $rowArr[$i]['url'] . ' <font color="green">&check;</font><br>';
    }
    else
    {
        echo $rowArr[$i]['url'] . ' <font color="red">&cross;</font><br>';
    }
}

mysql_close($con);

$uuid = getMyUuid();

    echo br() . "Your unique UUID is $uuid" . br();



/*FUNCTIONS*/

function newLine()
{
    return "
    ";
}

        function br()
        {
    return "<br>";
        }

function checkStatus ($url, $debug = true)
{
    $test = [];
    $res = exec("curl -I -s $url | head -n 1");
    $res = explode(' ', $res);
    $res = isset($res[1]) ? $res[1] : '500';

    return $res === '200' ? true : false;
}

function getMyUuid()
{
    $uuid = Rhumsaa\Uuid\Uuid::uuid1();
    return $uuid->toString();
}