<?php
/**
 * Vultr block storage management.
 *
 * @package blesta
 * @subpackage blesta.components.modules.vultr
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class VultrBlockStorage
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
     * Attach a block storage subscription to a VPS subscription.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: ID of the block storage subscription to attach.
     *     - attach_to_SUBID: ID of the VPS subscription to mount the block storage subscription to.
     * @return stdClass An object containing the api response
     */
    public function attach($params = [])
    {
        return $this->api->apiRequest('/block/attach', $params, 'POST');
    }

    /**
     * Create a block storage subscription.
     *
     * @param array $params An array contaning the following arguments:
     *     - DCID: DCID of the location to create this subscription in.
     *     - size_gb: Size (in GB) of this subscription.
     *     - label: Text label that will be associated with the subscription.
     * @return stdClass An object containing the api response
     */
    public function create($params = [])
    {
        return $this->api->apiRequest('/block/create', $params, 'POST');
    }

    /**
     * Delete a block storage subscription.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: ID of the block storage subscription to delete.
     * @return stdClass An object containing the api response
     */
    public function delete($params = [])
    {
        return $this->api->apiRequest('/block/delete', $params, 'POST');
    }

    /**
     * Detach a block storage subscription from the currently attached instance.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: ID of the block storage subscription to detach.
     * @return stdClass An object containing the api response
     */
    public function detach($params = [])
    {
        return $this->api->apiRequest('/block/detach', $params, 'POST');
    }

    /**
     * Set the label of a block storage subscription.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: ID of the block storage subscription.
     *     - label: Text label that will be shown in the control panel.
     * @return stdClass An object containing the api response
     */
    public function setLabel($params = [])
    {
        return $this->api->apiRequest('/block/label_set', $params, 'POST');
    }

    /**
     * Retrieve a list of any active block storage subscriptions on this account.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: ID of the block storage subscription. (optional)
     * @return stdClass An object containing the api response
     */
    public function listBlockStorage($params = [])
    {
        return $this->api->apiRequest('/block/list', $params);
    }

    /**
     * Resize the block storage volume to a new size.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: ID of the block storage subscription.
     *     - size_gb: New size (in GB) of the block storage subscription.
     * @return stdClass An object containing the api response
     */
    public function resize($params = [])
    {
        return $this->api->apiRequest('/block/resize', $params);
    }
}
