<?php 
class restRequest {
    private $serviceUrl;
    /**
     * Constructor
     *
     * @param $serviceUrl
     * @param string $xPath
     */
    public function __construct($serviceUrl, $xPath = '')
    {
        $this->serviceUrl = $serviceUrl;
        if ($xPath !== '') {
            $this->serviceUrl .= $xPath;
        }
    }
    /**
     * Set and execute curl
     *
     * @return mixed|void
     */
    public function makeRequest()
    {
        if ($this->serviceUrl !== '') {
            $curl = curl_init($this->serviceUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            $curl_response = curl_exec($curl);
            curl_close($curl);
            return simplexml_load_string($curl_response);
        }
        return false;
    }
    ?>