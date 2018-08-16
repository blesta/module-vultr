<?php
/**
 * Vultr DNS management.
 *
 * @package blesta
 * @subpackage blesta.components.modules.vultr
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class VultrDns
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
     * Create a domain name in DNS.
     *
     * @param array $params An array contaning the following arguments:
     *     - domain: Domain name to create.
     *     - serverip: Server IP to use when creating default records.
     * @return stdClass An object containing the api response
     */
    public function createDomain($params = [])
    {
        return $this->api->apiRequest('/dns/create_domain', $params, 'POST');
    }

    /**
     * Add a DNS record.
     *
     * @param array $params An array contaning the following arguments:
     *     - domain: Domain name to add record to.
     *     - name: Name of the record.
     *     - type: Type (A, AAAA, MX, SRV, TXT) of the record.
     *     - data: The data for this record.
     *     - ttl: TTL of this record. (optional)
     *     - priority: Priority of this record. (only required for MX and SRV)
     * @return stdClass An object containing the api response
     */
    public function createRecord($params = [])
    {
        return $this->api->apiRequest('/dns/create_record', $params, 'POST');
    }

    /**
     * Delete a domain name and all associated records.
     *
     * @param array $params An array contaning the following arguments:
     *     - domain: Domain name to delete.
     * @return stdClass An object containing the api response
     */
    public function deleteDomain($params = [])
    {
        return $this->api->apiRequest('/dns/delete_domain', $params, 'POST');
    }

    /**
     * Delete an individual DNS record.
     *
     * @param array $params An array contaning the following arguments:
     *     - domain: Domain name to delete record from.
     *     - RECORDID: ID of record to delete.
     * @return stdClass An object containing the api response
     */
    public function deleteRecord($params = [])
    {
        return $this->api->apiRequest('/dns/delete_record', $params, 'POST');
    }

    /**
     * Enable or disable DNSSEC for a domain.
     *
     * @param array $params An array contaning the following arguments:
     *     - domain: Domain name to update record.
     *     - enable: 'yes' or 'no'.  If yes, DNSSEC will be enabled for the given domain.
     * @return stdClass An object containing the api response
     */
    public function dnssecEnable($params = [])
    {
        return $this->api->apiRequest('/dns/dnssec_enable', $params, 'POST');
    }

    /**
     * Get the DNSSEC keys (if enabled) for a domain.
     *
     * @param array $params An array contaning the following arguments:
     *     - domain: Domain from which to gather DNSSEC keys.
     * @return stdClass An object containing the api response
     */
    public function dnssecInfo($params = [])
    {
        return $this->api->apiRequest('/dns/dnssec_info', $params);
    }

    /**
     * List all domains associated with the current account.
     *
     * @return stdClass An object containing the api response
     */
    public function listDns()
    {
        return $this->api->apiRequest('/dns/list');
    }

    /**
     * List all the records associated with a particular domain.
     *
     * @param array $params An array contaning the following arguments:
     *     - domain: Domain from which to gather the records.
     * @return stdClass An object containing the api response
     */
    public function records($params = [])
    {
        return $this->api->apiRequest('/dns/records', $params);
    }

    /**
     * Get the SOA record information for a domain.
     *
     * @param array $params An array contaning the following arguments:
     *     - domain: Domain from which to gather SOA information.
     * @return stdClass An object containing the api response
     */
    public function soaInfo($params = [])
    {
        return $this->api->apiRequest('/dns/soa_info', $params);
    }

    /**
     * Update the SOA record information for a domain.
     *
     * @param array $params An array contaning the following arguments:
     *     - domain: Domain name to update record.
     *     - nsprimary: Primary nameserver to store in the SOA record.
     *     - email: Administrative email to store in the SOA record.
     * @return stdClass An object containing the api response
     */
    public function soaUpdate($params = [])
    {
        return $this->api->apiRequest('/dns/soa_update', $params, 'POST');
    }

    /**
     * Update a DNS record.
     *
     * @param array $params An array contaning the following arguments:
     *     - domain: Domain name to update record.
     *     - RECORDID: ID of record to update.
     *     - name: Name of the record.
     *     - data: The data for this record.
     *     - ttl: TTL of this record. (optional)
     *     - priority: Priority of this record. (only required for MX and SRV)
     * @return stdClass An object containing the api response
     */
    public function updateRecord($params = [])
    {
        return $this->api->apiRequest('/dns/update_record', $params, 'POST');
    }
}
