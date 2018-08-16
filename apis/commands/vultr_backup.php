<?php
/**
 * Vultr backup management.
 *
 * @package blesta
 * @subpackage blesta.components.modules.vultr
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class VultrBackup
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
     * List all backups on the current account.
     *
     * @param array $params An array contaning the following arguments:
     *     - SUBID: Filter result set to only contain backups of this subscription object. (optional)
     *     - BACKUPID: Filter result set to only contain this backup. (optional)
     * @return stdClass An object containing the api response
     */
    public function listBackups($params = [])
    {
        return $this->api->apiRequest('/backup/list', $params);
    }
}
