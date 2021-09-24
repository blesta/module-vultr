<?php
use Blesta\Core\Util\Common\Traits\Container;

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vultr_response.php';

/**
 * Vultr API.
 *
 * @package blesta
 * @subpackage blesta.components.modules.vultr
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class VultrApi
{
    // Load traits
    use Container;

    /**
     * @var string The api key
     */
    private $api_key;

    /**
     * @var array An array representing the last request made
     */
    private $last_request = ['url' => null, 'params' => null];

    /**
     * Initializes the class.
     *
     * @param string $api_key The api key
     */
    public function __construct($api_key)
    {
        $this->api_key = $api_key;

        // Initialize logger
        $logger = $this->getFromContainer('logger');
        $this->logger = $logger;
    }

    /**
     * Send a request to the Vultr API.
     *
     * @param string $method Specifies the endpoint and method to invoke
     * @param array $params The parameters to include in the api call
     * @param string $type The HTTP request type
     * @return VultrResponse An instance of the API response
     */
    public function apiRequest($method, array $params = [], $type = 'GET')
    {
        // Send request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (Configure::get('Blesta.curl_verify_ssl')) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        } else {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        // Set authentication details
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'API-Key: ' . $this->api_key
        ]);

        // Build GET request
        if ($type == 'GET') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

            if (!empty($params)) {
                $get = http_build_query($params);
            }
        }

        // Build POST request
        if ($type == 'POST') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POST, true);

            if (!empty($params)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            }
        }

        // Execute request
        $url = 'https://api.vultr.com/v1/' . trim($method, '/');

        $this->last_request = [
            'url' => $url,
            'params' => $params
        ];

        curl_setopt($ch, CURLOPT_URL, $url . (isset($get) ? '?' . $get : null));

        $response = curl_exec($ch);

        if ($response == false) {
            $this->logger->error(curl_error($ch));
        }

        curl_close($ch);

        return new VultrResponse($response);
    }

    /**
     * Returns the details of the last request made.
     *
     * @return array An array containg:
     *     - url: The URL of the last request.
     *     - params: The paramters passed to the URL.
     */
    public function lastRequest()
    {
        return $this->last_request;
    }

    /**
     * Loads a command class.
     *
     * @param string $command The command class filename to load
     */
    public function loadCommand($command)
    {
        require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'commands' . DIRECTORY_SEPARATOR . $command . '.php';
    }
}
