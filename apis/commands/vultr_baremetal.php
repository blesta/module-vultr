<?php
/**
 * Vultr baremetal management.
 *
 * @package blesta
 * @subpackage blesta.components.modules.vultr
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class VultrBaremetal
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
     * Create a new baremetal server.
     *
     * @param array $params An array contaning the following arguments:
     *     - DCID: Location in which to create the server.
     *     - METALPLANID: Plan to use when creating this server.
     *     - OSID: Operating system to use.
     *     - SCRIPTID: The id of a startup script to execute on boot.
     *     - SNAPSHOTID: The snapshot id, If you've selected the 'snapshot' operating system (OSID 164).
     *     - enable_ipv6: 'yes' or 'no'.  If yes, an IPv6 subnet will be assigned to the server.
     *     - label: This is a text label that will be shown in the control panel.
     *     - SSHKEYID: List of SSH keys to apply to this server on install (only valid for Linux/FreeBSD).
     *     - APPID: If launching an application (OSID 186), this is the app id to launch.
     *     - userdata: Base64 encoded user-data.
     *     - notify_activate: 'yes' or 'no'. If yes, an email will be sent when the server is ready.
     *     - hostname: The hostname to assign to this server.
     *     - tag: The tag to assign to this server.
     * @return VultrResponse An instance of the API response
     */
    public function create($params = [])
    {
        return $this->api->apiRequest('/baremetal/create', $params, 'POST');
    }

    /**
     * Destroy (delete) a baremetal server.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return VultrResponse An instance of the API response
     */
    public function destroy($params = [])
    {
        return $this->api->apiRequest('/baremetal/destroy', $params, 'POST');
    }

    /**
     * List all baremetal servers on the current account.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier of a subscription. Only the subscription object will be returned.
     *     - tag: A tag string. Only subscription objects with this tag will be returned.
     *     - label: A text label string. Only subscription objects with this text label will be returned.
     *     - main_ip: An IPv4 address. Only the subscription matching this IPv4 address will be returned.
     * @return VultrResponse An instance of the API response
     */
    public function listBaremetal($params = [])
    {
        return $this->api->apiRequest('/baremetal/list', $params);
    }

    /**
     * List the IPv4 information of a baremetal server.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier of a subscription. Only the subscription object will be returned.
     * @return VultrResponse An instance of the API response
     */
    public function listIpv4($params = [])
    {
        return $this->api->apiRequest('/baremetal/list_ipv4', $params);
    }

    /**
     * List the IPv6 information of a baremetal server.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier of a subscription. Only the subscription object will be returned.
     * @return VultrResponse An instance of the API response
     */
    public function listIpv6($params = [])
    {
        return $this->api->apiRequest('/baremetal/list_ipv6', $params);
    }

    /**
     * Halt a baremetal server. This is a hard power off, meaning that the power to
     * the machine is severed.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return VultrResponse An instance of the API response
     */
    public function halt($params = [])
    {
        return $this->api->apiRequest('/baremetal/halt', $params, 'POST');
    }

    /**
     * Reboot a baremetal server. This is a hard reboot, which means that the server
     * is powered off, then back on.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier of a subscription.
     * @return VultrResponse An instance of the API response
     */
    public function reboot($params = [])
    {
        return $this->api->apiRequest('/baremetal/reboot', [], 'POST');
    }

    /**
     * Reinstall the operating system on a baremetal server.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier of a subscription.
     * @return VultrResponse An instance of the API response
     */
    public function reinstall($params = [])
    {
        return $this->api->apiRequest('/baremetal/reinstall', $params, 'POST');
    }

    /**
     * Enables IPv6 networking on a baremetal server by assigning an IPv6 subnet to it.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return VultrResponse An instance of the API response
     */
    public function enableIpv6($params = [])
    {
        return $this->api->apiRequest('/baremetal/ipv6_enable', $params, 'POST');
    }

    /**
     * Set the label of a baremetal server.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - label: This is a text label that will be shown in the control panel.
     * @return VultrResponse An instance of the API response
     */
    public function setLabel($params = [])
    {
        return $this->api->apiRequest('/baremetal/label_set', $params, 'POST');
    }

    /**
     * Retrieves a list of Vultr one-click applications to which a baremetal server can be changed.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return VultrResponse An instance of the API response
     */
    public function getBandwidth($params = [])
    {
        return $this->api->apiRequest('/baremetal/bandwidth', $params);
    }

    /**
     * Retrieves the (base64 encoded) user-data for this subscription.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return VultrResponse An instance of the API response
     */
    public function getUserData($params = [])
    {
        return $this->api->apiRequest('/baremetal/get_user_data', $params);
    }

    /**
     * Reinstalls the baremetal server to a different Vultr one-click application.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - APPID: Application to use.
     * @return VultrResponse An instance of the API response
     */
    public function appChange($params = [])
    {
        return $this->api->apiRequest('/baremetal/app_change', $params, 'POST');
    }

    /**
     * Retrieves a list of Vultr one-click applications to which a baremetal server can be changed.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Filter result set to only contain apps of this subscription object.
     * @return VultrResponse An instance of the API response
     */
    public function appChangeList($params = [])
    {
        return $this->api->apiRequest('/baremetal/app_change_list', $params);
    }

    /**
     * Retrieves the application information for a baremetal server.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return VultrResponse An instance of the API response
     */
    public function getAppInfo($params = [])
    {
        return $this->api->apiRequest('/baremetal/get_app_info', $params);
    }

    /**
     * Retrieves a list of operating systems to which a baremetal server can be changed.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier of a subscription.
     * @return VultrResponse An instance of the API response
     */
    public function osChangeList($params = [])
    {
        return $this->api->apiRequest('/baremetal/os_change_list', $params);
    }

    /**
     * Sets the user-data for this subscription.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier of a subscription.
     *     - userdata: Base64 encoded user-data.
     * @return VultrResponse An instance of the API response
     */
    public function setUserData($params = [])
    {
        return $this->api->apiRequest('/baremetal/set_user_data', $params, 'POST');
    }

    /**
     * Set the tag of a baremetal server.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier of a subscription.
     *     - tag: A tag string. Only subscription objects with this tag will be returned.
     * @return VultrResponse An instance of the API response
     */
    public function setTag($params = [])
    {
        return $this->api->apiRequest('/baremetal/tag_set', $params, 'POST');
    }
}
