<?php
/**
 * Vultr plans management.
 *
 * @package blesta
 * @subpackage blesta.components.modules.vultr
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class VultrPlans
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
     * Retrieve a list of all active plans. Plans that are no longer available will not be shown.
     *
     * @return stdClass An object containing the api response
     */
    public function listPlans()
    {
        return $this->api->apiRequest('/plans/list');
    }

    /**
     * Retrieve a list of all active bare metal plans.
     *
     * @return stdClass An object containing the api response
     */
    public function listBaremetalPlans()
    {
        return $this->api->apiRequest('/plans/list_baremetal');
    }

    /**
     * Retrieve a list of all active vc2 plans.
     *
     * @return stdClass An object containing the api response
     */
    public function listVc2()
    {
        return $this->api->apiRequest('/plans/list_vc2');
    }

    /**
     * Retrieve a list of all active vdc2 plans.
     *
     * @return stdClass An object containing the api response
     */
    public function listVdc2()
    {
        return $this->api->apiRequest('/plans/list_vdc2');
    }
}
