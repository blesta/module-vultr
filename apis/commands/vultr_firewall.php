<?php
/**
 * Vultr firewall management.
 *
 * @package blesta
 * @subpackage blesta.components.modules.vultr
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class VultrFirewall
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
     * Create a new firewall group on the current account.
     *
     * @param array $params An array contaning the following arguments:
     *     - description: Description of firewall group.
     * @return stdClass An object containing the api response
     */
    public function groupCreate($params = [])
    {
        return $this->api->apiRequest('/firewall/group_create', $params, 'POST');
    }

    /**
     * Delete a firewall group.
     *
     * @param array $params An array contaning the following arguments:
     *     - FIREWALLGROUPID: Firewall group to delete.
     * @return stdClass An object containing the api response
     */
    public function groupDelete($params = [])
    {
        return $this->api->apiRequest('/firewall/group_delete', $params, 'POST');
    }

    /**
     * List all firewall groups on the current account.
     *
     * @param array $params An array contaning the following arguments:
     *     - FIREWALLGROUPID: Filter result set to only contain this firewall group. (optional)
     * @return stdClass An object containing the api response
     */
    public function groupList($params = [])
    {
        return $this->api->apiRequest('/firewall/group_list', $params);
    }

    /**
     * Change the description on a firewall group.
     *
     * @param array $params An array contaning the following arguments:
     *     - FIREWALLGROUPID: Firewall group to update.
     *     - description: Description of firewall group.
     * @return stdClass An object containing the api response
     */
    public function groupSetDescription($params = [])
    {
        return $this->api->apiRequest('/firewall/group_set_description', $params, 'POST');
    }

    /**
     * Create a rule in a firewall group.
     *
     * @param array $params An array contaning the following arguments:
     *     - FIREWALLGROUPID: Target firewall group.
     *     - direction: Direction of rule. Possible values: "in".
     *     - ip_type: IP address type. Possible values: "v4", "v6".
     *     - protocol: Protocol type. Possible values: "icmp", "tcp", "udp", "gre".
     *     - subnet: IP address representing a subnet. The IP address format must match with the "ip_type" parameter value.
     *     - subnet_size: IP prefix size in bits.
     *     - port: TCP/UDP only. This field can be an integer value specifying a port or a colon separated port range.
     * @return stdClass An object containing the api response
     */
    public function ruleCreate($params = [])
    {
        return $this->api->apiRequest('/firewall/rule_create', $params, 'POST');
    }

    /**
     * Delete a rule in a firewall group.
     *
     * @param array $params An array contaning the following arguments:
     *     - FIREWALLGROUPID: Target firewall group.
     *     - rulenumber: Rule number to delete.
     * @return stdClass An object containing the api response
     */
    public function ruleDelete($params = [])
    {
        return $this->api->apiRequest('/firewall/rule_delete', $params, 'POST');
    }

    /**
     * List all firewall groups on the current account.
     *
     * @param array $params An array contaning the following arguments:
     *     - FIREWALLGROUPID: Target firewall group.
     *     - direction: Direction of firewall rules. Possible values: "in".
     *     - ip_type: IP address type. Possible values: "v4", "v6".
     * @return stdClass An object containing the api response
     */
    public function ruleList($params = [])
    {
        return $this->api->apiRequest('/firewall/rule_list', $params);
    }
}
