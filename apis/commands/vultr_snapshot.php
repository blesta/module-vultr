<?php
/**
 * Vultr snapshot management.
 *
 * @package blesta
 * @subpackage blesta.components.modules.vultr
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class VultrSnapshot
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
     * List all snapshots on the current account.
     *
     * @param array $params An array contaning the following arguments:
     *     - SNAPSHOTID: Filter result set to only contain this snapshot.
     * @return stdClass An object containing the api response.
     */
    public function listSnapshots($params = [])
    {
        return $this->api->apiRequest('/snapshot/list', $params);
    }

    /**
     * Create a snapshot from an existing virtual machine.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - description: Description of snapshot contents.
     * @return stdClass An object containing the api response.
     */
    public function create($params = [])
    {
        return $this->api->apiRequest('/snapshot/create', $params, 'POST');
    }

    /**
     * Destroy (delete) a snapshot.
     *
     * @param array $params An array contaning the following arguments:
     *     - SNAPSHOTID: Unique identifier for this snapshot.
     * @return stdClass An object containing the api response.
     */
    public function destroy($params = [])
    {
        return $this->api->apiRequest('/snapshot/destroy', $params, 'POST');
    }
}
