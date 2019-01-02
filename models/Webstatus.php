<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 1/2/19
 * Time: 2:59 PM
 */

namespace App\Models;


class Webstatus
{
    private $url;
    private $debug;

    public function __construct($url, $debug = true)
    {
        $this->url = $url;
        $this->debug = $debug;
    }

    public function getStatus ()
    {
        $res = exec("curl -I -s $this->url | head -n 1");
        $res = explode(' ', $res);
        $res = isset($res[1]) ? $res[1] : '500';

        return $res === '200' ? true : false;
    }
}