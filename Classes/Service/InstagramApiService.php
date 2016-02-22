<?php
namespace Keizer\KoningInstagram\Service;

class InstagramApiService
{
    /**
     * @var array
     */
    protected $settings;

    /**
     * @param array $settings
     * @return InstagramApiService
     */
    public function setSettings(array $settings)
    {
        $this->settings = $settings;
        return $this;
    }

    /**
     * @param string $url
     * @return InstagramApiService
     */
    public function get($url)
    {
        return $this->makeRequest($url);
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $params
     * @param array $headers
     * @return array
     */
    protected function makeRequest($url, $method = 'GET', array $params = array(), $headers = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        switch (strtoupper($method)) {
            case 'GET':
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                break;
        }

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        return array(
            'response' => $response,
            'info' => $info
        );
    }
}