<?php
/**
 * Vultr API response handler.
 *
 * @package blesta
 * @subpackage blesta.components.modules.vultr
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class VultrResponse
{
    /**
     * @var string The raw response from the API.
     */
    private $raw;

    /**
     * Initializes the Vultr Response.
     *
     * @param string $response The raw response data from an API request
     */
    public function __construct($response)
    {
        $this->raw = $response;
    }

    /**
     * Returns the status of the API Response.
     *
     * @return string The status (success, error, null if invalid response)
     */
    public function status()
    {
        $response = $this->response();

        if (!is_object($response) && !empty($this->raw)) {
            return 'error';
        } else {
            return 'success';
        }

        return null;
    }

    /**
     * Returns the response.
     *
     * @return stdClass A stdClass object representing the response, null if invalid response
     */
    public function response()
    {
        if ($this->raw) {
            return $this->formatResponse($this->raw);
        }

        return null;
    }

    /**
     * Returns all errors contained in the response.
     *
     * @return stdClass A stdClass object representing the errors in the response, false if invalid response
     */
    public function errors()
    {
        $response = $this->response();

        if (!is_object($response) && !empty($this->raw)) {
            return (object) [
                'error' => $this->raw
            ];
        }
    }

    /**
     * Returns the raw response.
     *
     * @return string The raw response
     */
    public function raw()
    {
        return $this->raw;
    }

    /**
     * Decodes the response.
     *
     * @param mixed $data The JSON data to convert to a stdClass object
     * @return stdClass $data in a stdClass object form
     */
    private function formatResponse($data)
    {
        $response = json_decode($data);

        if (is_array($response)) {
            $response = (object) $response;
        }

        return $response;
    }
}
