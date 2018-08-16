<?php
/**
 * Vultr application management.
 *
 * @package blesta
 * @subpackage blesta.components.modules.vultr
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class VultrApp
{
    /**
     * @var VultrApi The API to use for communication.
     */
    private $api;

    /**
     * Sets the API to use for communication.
     *
     * @param VultrApi $api The API to use for communication
     */
    public function __construct(VultrApi $api)
    {
        $this->api = $api;
    }

    /**
     * Retrieve a list of available applications. These refer to applications that
     * can be launched when creating a Vultr VPS.
     *
     * @return stdClass An object containing the api response
     */
    public function listApps()
    {
        return $this->api->apiRequest('/app/list');
    }
}
