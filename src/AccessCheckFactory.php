<?php
/**
 * Fontis Magento 2 Customer Group Access
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Fontis
 * @package    Fontis_CustomerGroupAccess
 * @copyright  Copyright (c) 2016 Fontis Pty. Ltd. (https://www.fontis.com.au)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Fontis\CustomerGroupAccess;

use Magento\Framework\ObjectManagerInterface;


/**
 * Factory class for @see \Fontis\CustomerGroupAccess\AccessCheck
 */
class AccessCheckFactory
{
    /**
     * Object Manager instance
     *
     * @var ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * @var string
     */
    protected $configPathPrefix;

    /**
     * Factory constructor
     *
     * @param ObjectManagerInterface $objectManager
     * @param string $configPathPrefix
     * @param string $instanceName
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        $configPathPrefix,
        $instanceName = 'Fontis\\CustomerGroupAccess\\AccessCheck'
    ) {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
        $this->configPathPrefix = $configPathPrefix;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Fontis\CustomerGroupAccess\AccessCheck
     */
    public function create(array $data = array())
    {
        if (!isset($data["configPathPrefix"])) {
            $data["configPathPrefix"] = $this->configPathPrefix;
        }
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
