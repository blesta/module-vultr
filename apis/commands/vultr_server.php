<?php
/**
 * Vultr server management.
 *
 * @package blesta
 * @subpackage blesta.components.modules.vultr
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class VultrServer
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
     * Changes the virtual machine to a different application.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - APPID: Unique identifier of the application to use.
     * @return stdClass An object containing the api response.
     */
    public function appChange($params = [])
    {
        return $this->api->apiRequest('/server/app_change', $params, 'POST');
    }

    /**
     * Retrieves a list of applications to which a virtual machine can be changed.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function appChangeList($params = [])
    {
        return $this->api->apiRequest('/server/app_change_list', $params);
    }

    /**
     * Disables automatic backups on a server.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function backupDisable($params = [])
    {
        return $this->api->apiRequest('/server/backup_disable', $params, 'POST');
    }

    /**
     * Enables automatic backups on a server.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function backupEnable($params = [])
    {
        return $this->api->apiRequest('/server/backup_enable', $params, 'POST');
    }

    /**
     * Retrieves the backup schedule for a server.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function backupGetSchedule($params = [])
    {
        return $this->api->apiRequest('/server/backup_get_schedule', $params, 'POST');
    }

    /**
     * Sets the backup schedule for a server.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - cron_type: Backup cron type. Can be one of 'daily', 'weekly', 'monthly',
     *         'daily_alt_even', or 'daily_alt_odd'.
     *     - hour: Hour value (0-23).
     *     - dow: Day-of-week value (0-6). Applicable to crons: 'weekly'.
     *     - dom: Day-of-month value (1-28). Applicable to crons: 'monthly'.
     * @return stdClass An object containing the api response.
     */
    public function backupSetSchedule($params = [])
    {
        return $this->api->apiRequest('/server/backup_set_schedule', $params, 'POST');
    }

    /**
     * Get the bandwidth used by a virtual machine.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function bandwidth($params = [])
    {
        return $this->api->apiRequest('/server/bandwidth', $params);
    }

    /**
     * Create a new virtual machine. You will start being billed for this immediately.
     * The response only contains the SUBID for the new machine.
     *
     * In order to create a server using a snapshot, use OSID 164 and specify a SNAPSHOTID.
     * Similarly, to create a server using an ISO use OSID 159 and specify an ISOID.
     *
     * @param array $params An array contaning the following arguments:
     *     - DCID: Location to create this virtual machine in.
     *     - VPSPLANID: Plan to use when creating this virtual machine.
     *     - OSID: Operating system to use.
     *     - ipxe_chain_url: If you've selected the 'custom' operating system,
     *         this can be set to chainload the specified URL on bootup, via iPXE. (optional)
     *     - ISOID: If you've selected the 'custom' operating system, this is the ID of a
     *         specific ISO to mount during the deployment. (optional)
     *     - SCRIPTID: If you've not selected a 'custom' operating system, this can be the
     *         SCRIPTID of a startup script to execute on boot. (optional)
     *     - SNAPSHOTID: If you've selected the 'snapshot' operating system, this
     *         should be the SNAPSHOTID. (optional)
     *     - enable_ipv6: 'yes' or 'no'.  If yes, an IPv6 subnet will be assigned. (optional)
     *     - enable_private_network: yes' or 'no'. If yes, private networking support
     *         will be added to the server. (optional)
     *     - NETWORKID: List of private networks to attach to this server.
     *         Use either this field or enable_private_network, not both. (optional)
     *     - label: This is a text label that will be shown in the control panel. (optional)
     *     - SSHKEYID: List of SSH keys to apply to this server on install. (optional)
     *     - auto_backups: 'yes' or 'no'.  If yes, automatic backups will be enabled. (optional)
     *     - APPID: If launching an application (OSID 186), this is the APPID to launch. (optional)
     *     - userdata: Base64 encoded user-data. (optional)
     *     - notify_activate: 'yes' or 'no'. If yes, an activation email will be sent. (optional)
     *     - ddos_protection: 'yes' or 'no'.  If yes, DDOS protection will be enabled. (optional)
     *     - reserved_ip_v4: IP address of the floating IP to use on this server. (optional)
     *     - hostname: The hostname to assign to this server. (optional)
     *     - tag: The tag to assign to this server. (optional)
     *     - FIREWALLGROUPID: The firewall group to assign to this server. (optional)
     * @return stdClass An object containing the api response.
     */
    public function create($params = [])
    {
        return $this->api->apiRequest('/server/create', $params, 'POST');
    }

    /**
     * Add a new IPv4 address to a server. You will start being billed for this immediately.
     * The server will be rebooted unless you specify otherwise. You must reboot the server
     * before the IPv4 address can be configured.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - reboot: 'yes' or 'no'. If yes, the server is rebooted immediately. (optional)
     * @return stdClass An object containing the api response.
     */
    public function createIpv4($params = [])
    {
        return $this->api->apiRequest('/server/create_ipv4', $params, 'POST');
    }

    /**
     * Destroy (delete) a virtual machine. All data will be permanently lost, and the IP
     * address will be released.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function destroy($params = [])
    {
        return $this->api->apiRequest('/server/destroy', $params, 'POST');
    }

    /**
     * Removes a secondary IPv4 address from a server. Your server will be hard-restarted.
     * We suggest halting the machine gracefully before removing IPs.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - ip: IPv4 address to remove.
     * @return stdClass An object containing the api response.
     */
    public function destroyIpv4($params = [])
    {
        return $this->api->apiRequest('/server/destroy_ipv4', $params, 'POST');
    }

    /**
     * Set, change, or remove the firewall group currently applied to a server.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - FIREWALLGROUPID: The firewall group to apply to this server.
     *         A value of "0" means "no firewall group".
     * @return stdClass An object containing the api response.
     */
    public function firewallGroupSet($params = [])
    {
        return $this->api->apiRequest('/server/firewall_group_set', $params, 'POST');
    }

    /**
     * Retrieves the application information for this subscription.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function getAppInfo($params = [])
    {
        return $this->api->apiRequest('/server/get_app_info', $params);
    }

    /**
     * Retrieves the (base64 encoded) user-data for this subscription.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function getUserData($params = [])
    {
        return $this->api->apiRequest('/server/get_user_data', $params);
    }

    /**
     * Halt a virtual machine.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function halt($params = [])
    {
        return $this->api->apiRequest('/server/halt', $params, 'POST');
    }

    /**
     * Enables IPv6 networking on a server by assigning an IPv6 subnet to it.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function ipv6Enable($params = [])
    {
        return $this->api->apiRequest('/server/ipv6_enable', $params, 'POST');
    }

    /**
     * Attach an ISO and reboot the server.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - ISOID: The ISO that will be mounted.
     * @return stdClass An object containing the api response.
     */
    public function isoAttach($params = [])
    {
        return $this->api->apiRequest('/server/iso_attach', $params, 'POST');
    }

    /**
     * Detach the currently mounted ISO and reboot the server.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function isoDetach($params = [])
    {
        return $this->api->apiRequest('/server/iso_detach', $params, 'POST');
    }

    /**
     * Retrieve the current ISO state for a given subscription. The returned
     * state may be one of: ready | isomounting | isomounted.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function isoStatus($params = [])
    {
        return $this->api->apiRequest('/server/iso_status', $params);
    }

    /**
     * Set the label of a virtual machine.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - label: This is a text label that will be shown in the control panel.
     * @return stdClass An object containing the api response.
     */
    public function labelSet($params = [])
    {
        return $this->api->apiRequest('/server/label_set', $params, 'POST');
    }

    /**
     * List all active or pending virtual machines on the current account.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - tag: A tag string. Only subscription objects with this tag will be returned.
     *     - label: A text label string. Only subscription objects with this text
     *         label will be returned.
     *     - main_ip: An IPv4 address. Only the subscription matching this IPv4
     *         address will be returned.
     * @return stdClass An object containing the api response.
     */
    public function listServers($params = [])
    {
        return $this->api->apiRequest('/server/list', $params);
    }

    /**
     * List the IPv4 information of a virtual machine. IP information is only available
     * for virtual machines in the "active" state.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function listIpv4($params = [])
    {
        return $this->api->apiRequest('/server/list_ipv4', $params);
    }

    /**
     * List the IPv6 information of a virtual machine. IP information is only available
     * for virtual machines in the "active" state.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function listIpv6($params = [])
    {
        return $this->api->apiRequest('/server/list_ipv6', $params);
    }

    /**
     * Determine what other subscriptions are hosted on the same physical host as a
     * given subscription.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function neighbors($params = [])
    {
        return $this->api->apiRequest('/server/neighbors', $params);
    }

    /**
     * Changes the virtual machine to a different operating system. All data will
     * be permanently lost.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - OSID: Operating system to use.
     * @return stdClass An object containing the api response.
     */
    public function osChange($params = [])
    {
        return $this->api->apiRequest('/server/os_change', $params, 'POST');
    }

    /**
     * Retrieves a list of operating systems to which a virtual machine can be changed.
     * Always check against this list before trying to switch operating systems because
     * it is not possible to switch between every operating system combination.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function osChangeList($params = [])
    {
        return $this->api->apiRequest('/server/os_change_list', $params);
    }

    /**
     * Reboot a virtual machine.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function reboot($params = [])
    {
        return $this->api->apiRequest('/server/reboot', $params, 'POST');
    }

    /**
     * Reinstall the operating system on a virtual machine. All data will be permanently
     * lost, but the IP address will remain the same. There is no going back from this call.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - hostname: The new hostname to assign to this server. (optional)
     * @return stdClass An object containing the api response.
     */
    public function reinstall($params = [])
    {
        return $this->api->apiRequest('/server/reinstall', $params, 'POST');
    }

    /**
     * Restore the specified backup to the virtual machine. Any data already on the virtual
     * machine will be lost.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - BACKUPID: The id of the backup to restore.
     * @return stdClass An object containing the api response.
     */
    public function restoreBackup($params = [])
    {
        return $this->api->apiRequest('/server/restore_backup', $params, 'POST');
    }

    /**
     * Restore the specified snapshot to the virtual machine. Any data already on the virtual
     * machine will be lost.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - SNAPSHOTID: The id of the snapshot to restore.
     * @return stdClass An object containing the api response.
     */
    public function restoreSnapshot($params = [])
    {
        return $this->api->apiRequest('/server/restore_snapshot', $params, 'POST');
    }

    /**
     * Set a reverse DNS entry for an IPv4 address of a virtual machine to the
     * original setting.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - ip: IPv4 address used in the reverse DNS update.
     * @return stdClass An object containing the api response.
     */
    public function reverseDefaultIpv4($params = [])
    {
        return $this->api->apiRequest('/server/reverse_default_ipv4', $params, 'POST');
    }

    /**
     * Set a reverse DNS entry for an IPv6 address of a virtual machine to the
     * original setting.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - ip: IPv6 address used in the reverse DNS update.
     * @return stdClass An object containing the api response.
     */
    public function reverseDefaultIpv6($params = [])
    {
        return $this->api->apiRequest('/server/reverse_delete_ipv6', $params, 'POST');
    }

    /**
     * List the IPv6 reverse DNS entries of a virtual machine. Reverse DNS entries
     * are only available for virtual machines in the "active" state. If the virtual
     * machine does not have IPv6 enabled, then an empty array is returned.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function reverseListIpv6($params = [])
    {
        return $this->api->apiRequest('/server/reverse_list_ipv6', $params);
    }

    /**
     * Set a reverse DNS entry for an IPv4 address of a virtual machine.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - ip: IPv4 address used in the reverse DNS update.
     * @return stdClass An object containing the api response.
     */
    public function reverseSetIpv4($params = [])
    {
        return $this->api->apiRequest('/server/reverse_set_ipv4', $params, 'POST');
    }

    /**
     * Set a reverse DNS entry for an IPv6 address of a virtual machine.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - ip: IPv6 address used in the reverse DNS update.
     * @return stdClass An object containing the api response.
     */
    public function reverseSetIpv6($params = [])
    {
        return $this->api->apiRequest('/server/reverse_set_ipv6', $params, 'POST');
    }

    /**
     * Sets the user-data for this subscription. User-data is a generic data store,
     * which some provisioning tools and cloud operating systems use as a configuration
     * file. It is generally consumed only once after an instance has been launched,
     * but individual needs may vary.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - userdata: Base64 encoded user-data.
     * @return stdClass An object containing the api response.
     */
    public function setUserData($params = [])
    {
        return $this->api->apiRequest('/server/set_user_data', $params, 'POST');
    }

    /**
     * Start a virtual machine. If the machine is already running, it will be restarted.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function start($params = [])
    {
        return $this->api->apiRequest('/server/start', $params, 'POST');
    }

    /**
     * Set the tag of a virtual machine.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - tag: The tag to assign to this server. This tag is shown in the control panel.
     * @return stdClass An object containing the api response.
     */
    public function tagSet($params = [])
    {
        return $this->api->apiRequest('/server/tag_set', $params, 'POST');
    }

    /**
     * Upgrade the plan of a virtual machine. The virtual machine will be rebooted upon a
     * successful upgrade.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     *     - VPSPLANID: The id of the new plan.
     * @return stdClass An object containing the api response.
     */
    public function upgradePlan($params = [])
    {
        return $this->api->apiRequest('/server/upgrade_plan', $params, 'POST');
    }

    /**
     * Upgrade the plan of a virtual machine. The virtual machine will be rebooted upon a
     * successful upgrade.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Unique identifier for this subscription.
     * @return stdClass An object containing the api response.
     */
    public function upgradePlanList($params = [])
    {
        return $this->api->apiRequest('/server/upgrade_plan_list', $params);
    }
}
