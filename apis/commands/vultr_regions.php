<?php
/**
 * Vultr regions management.
 *
 * @package blesta
 * @subpackage blesta.components.modules.vultr
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class VultrRegions
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
     * Retrieve a list of the VPSPLANIDs currently available in this location.
     *
     * @param array $params An array contaning the following arguments:
     *     - DCID: Location to check availability.
     * @return stdClass An object containing the api response
     */
    public function availability($params = [])
    {
        return $this->api->apiRequest('/regions/availability', $params);
    }

    /**
     * Retrieve a list of the METALPLANIDs currently available in this location.
     *
     * @param array $params An array contaning the following arguments:
     *     - DCID: Location to check availability.
     * @return stdClass An object containing the api response
     */
    public function availabilityBaremetal($params = [])
    {
        return $this->api->apiRequest('/regions/availability_baremetal', $params);
    }

    /**
     * Retrieve a list of the vc2 VPSPLANIDs currently available in this location.
     *
     * @param array $params An array contaning the following arguments:
     *     - DCID: Location to check availability.
     * @return stdClass An object containing the api response
     */
    public function availabilityVc2($params = [])
    {
        return $this->api->apiRequest('/regions/availability_vc2', $params);
    }

    /**
     * Retrieve a list of the vdc2 VPSPLANIDs currently available in this location.
     *
     * @param array $params An array contaning the following arguments:
     *     - DCID: Location to check availability.
     * @return stdClass An object containing the api response
     */
    public function availabilityVdc2($params = [])
    {
        return $this->api->apiRequest('/regions/availability_vdc2', $params);
    }

    /**
     * Retrieve a list of all active regions.
     *
     * @param array $params An array contaning the following arguments:
     *     - availability: 'yes' or 'no'. If 'yes', include the current availability with each region entry.
     * @return stdClass An object containing the api response
     */
    public function listRegions($params = [])
    {
        return $this->api->apiRequest('/regions/list', $params);
    }
}
