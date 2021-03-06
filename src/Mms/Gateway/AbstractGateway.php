<?php
/**
 * @category Mms
 * @package Mms\Gateway
 * @author Andreas Gerhards <andreas@lero9.co.nz>
 * @copyright Copyright (c) 2014 LERO9 Ltd.
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause - Please view LICENSE.md for more information
 */

namespace Mms\Gateway;

use Magelink\Exception\MagelinkException;
use Magelink\Exception\GatewayException;
use Node\AbstractGateway as BaseAbstractGateway;
use Node\AbstractNode;
use Node\Entity;


abstract class AbstractGateway extends BaseAbstractGateway
{

    const GATEWAY_NODE_CODE = 'mms';
    const GATEWAY_ENTITY = 'generic';
    const GATEWAY_ENTITY_CODE = 'gty';

    const MMS_STORE_PREFIX = 'mms/';


    /** @var \Entity\Service\EntityConfigService $entityConfigService */
    protected $entityConfigService = NULL;

    /** @var \Mms\Api\RestV1 */
    protected $rest = NULL;


    /**
     * Initialize the gateway and perform any setup actions required.
     * @param string $entityType
     * @throws MagelinkException
     * @return bool $success
     */
    protected function _init($entityType)
    {
        $this->rest = $this->_node->getApi('rest');

        if (!$this->rest) {
            throw new GatewayException('Rest is required for MMS/Tmall '.ucfirst($entityType));
            $success = FALSE;
        }else{
            $this->entityConfigService = $this->getServiceLocator()->get('mmsConfigService');
            $success = TRUE;
        }

        return $success;
    }

}
