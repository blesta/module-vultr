<?php
/**
 * Vultr reserved IPs management.
 *
 * @package blesta
 * @subpackage blesta.components.modules.vultr
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class VultrReservedIp
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
     * Attach a reserved IP to an existing subscription.
     *
     * @param array $params An array contaning the following arguments:
     *     - ip_address: Reserved IP to be attached. Include the subnet size (e.g: /32 or /64).
     *     - attach_SUBID: Unique identifier of the target server.
     * @return stdClass An object containing the api response
     */
    public function attach($params = [])
    {
        return $this->api->apiRequest('/reservedip/attach', $params, 'POST');
    }

    /**
     * Convert an existing IP on a subscription to a reserved IP.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: ID of the server that currently has the IP address you want to convert.
     *     - ip_address: Reserved IP to be attached. Include the subnet size (e.g: /32 or /64).
     *     - label: Label for this reserved IP. (optional)
     * @return stdClass An object containing the api response
     */
    public function convert($params = [])
    {
        return $this->api->apiRequest('/reservedip/convert', $params, 'POST');
    }

    /**
     * Create a new reserved IP. Reserved IPs can only be used within the same datacenter
     * for which they were created.
     *
     * @param array $params An array contaning the following arguments:
     *     - DCID: Location to create this reserved IP in.
     *     - ip_type: 'v4' or 'v6' Type of reserved IP to create.
     *     - label: Label for this reserved IP. (optional)
     * @return stdClass An object containing the api response
     */
    public function create($params = [])
    {
        return $this->api->apiRequest('/reservedip/create', $params, 'POST');
    }

    /**
     * Remove a reserved IP from your account. After making this call, you will not be able
     * to recover the IP address.
     *
     * @param array $params An array contaning the following arguments:
     *     - ip_address: Reserved IP to be removed. Include the subnet size (e.g: /32 or /64).
     * @return stdClass An object containing the api response
     */
    public function destroy($params = [])
    {
        return $this->api->apiRequest('/reservedip/destroy', $params, 'POST');
    }

    /**
     * Detach a reserved IP from an existing subscription.
     *
     * @param array $params An array contaning the following arguments:
     *     - ip_address: Reserved IP to be detached. Include the subnet size (e.g: /32 or /64).
     *     - detach_SUBID: Unique identifier of the target server.
     * @return stdClass An object containing the api response
     */
    public function detach($params = [])
    {
        return $this->api->apiRequest('/reservedip/detach', $params, 'POST');
    }

    /**
     * List all the active reserved IPs on this account. The "subnet_size" field is the size
     * of the network assigned to this subscription.
     *
     * @return stdClass An object containing the api response
     */
    public function listReservedIps()
    {
        return $this->api->apiRequest('/reservedip/list');
    }
}
