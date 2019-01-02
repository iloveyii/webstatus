<?php

namespace App\Models;


class Webstatus
{
    private $data;

    /*
     * Return the http status codes for the given urls
     *
     *@param array $rows array of database rows
     */
    public function __construct($rows)
    {
        $values = array_column($rows, 'url');
        $this->data = array_combine($values, $values);
    }

    /**
     * Returns status of the urls given
     * @return array of url => status code (0,1)
     * @throws \Exception
     */
    public function getWebsitesStatuses()
    {
        /**
         * Check if php curl is installed else use system curl
         */
        $curlEnabled = function_exists('curl_version');
        $statuses = array();

        if ($curlEnabled) {
            Log::write('PHP curl is enabled', Log::INFO);
            $statuses = $this->multiRequest();
        } else {
            Log::write('PHP curl is not enabled', Log::WARN);

            foreach ($this->data as $id => $url) {
                $statuses[$id] = $this->singleRequest($url);
            }
        }

        Log::write(sprintf("Made requests to %d different sites", count($statuses)), Log::INFO);

        return $statuses;
    }

    protected function singleRequest($url)
    {
        Log::write('Making single request to ' . $url, Log::INFO);
        $res = exec("curl -I -s $url | head -n 1");
        $res = explode(' ', $res);
        $res = isset($res[1]) ? $res[1] : '500';

        return $res === '200' ? true : false;
    }

    protected function multiRequest()
    {
        $curly = array();
        $statuses = array();

        $mh = curl_multi_init();

        foreach ($this->data as $id => $url) {

            $curly[$id] = curl_init();
            curl_setopt($curly[$id], CURLOPT_URL, $url);
            curl_setopt($curly[$id], CURLOPT_HEADER, 0);
            curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
            Log::write('Making multi request to ' . $url, Log::INFO);
            curl_multi_add_handle($mh, $curly[$id]);
        }

        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running > 0);

        // Get http status code
        foreach ($curly as $id => $c) {
            curl_multi_getcontent($c);
            $httpCode = curl_getinfo($c, CURLINFO_HTTP_CODE);
            $statuses[$id] = $httpCode === 200 ? true : false;
            curl_multi_remove_handle($mh, $c);
        }

        curl_multi_close($mh);

        return $statuses;
    }
}