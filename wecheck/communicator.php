<?php
/** WeCheck API - PHP Client
  * Version 1.0
  * 
  * - Home: http://www.wecheck.net/
  * - Documentation: http://www.wecheck.net/dashboard/info/api
  *
  * All rights reserved  - (c) 2014 WeCheck - S.H.Q. B.V.
**/
namespace WeCheck;
class Communicator 
{
    private $settings;

    const API_LOCATION  = 'http://www.wecheck.net/api/';
    const API_VERSION   = 1;

    private function sendRequest($api_method, $request_body = array()) 
    {
        $headers = array(
            'X-API-Identity: '      . $this->__get('API_KEY'),
            'X-API-Method: '        . $api_method,
            'X-Client-Version: '    . self::API_VERSION,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,               self::API_LOCATION);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,    0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,    FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,    1);
        curl_setopt($ch, CURLOPT_TIMEOUT,           rand(5, 10));
        curl_setopt($ch, CURLOPT_HTTPHEADER,        $headers);

        if (is_array($request_body) && count($request_body)) {
            curl_setopt($ch, CURLOPT_POST,          1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,    http_build_query($request_body));
        }

        $curl_resp          = curl_exec($ch);
        $curl_error         = curl_error($ch);

        $data               = curl_getinfo($ch);
        $data['error']      = $curl_error;
        $data['response']   = $curl_resp;
        if (is_array($request_body)) {
            $data['body']   = $request_body;
        }

        return $data;
    }

    public function call($api_method = '', $request_body = array())
    {
        if ($this->__get('API_KEY') == null) {
            throw new \Exception('No API_KEY given');
        }

        $response = $this->sendRequest($api_method, $request_body);
        if (empty($response['error'])) {
            return json_decode($response['response'], true);
        }
        return $response;
    }

    public function __set($key, $var)
    {
        $this->settings[$key] = $var;
    }

    public function __get($key) 
    {
        return isset($this->settings[$key]) ? $this->settings[$key] : null;
    }
}
