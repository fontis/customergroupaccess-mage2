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

namespace Fontis\CustomerGroupAccess\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Customer\Api\GroupManagementInterface;
use Magento\Framework\Convert\DataObject as DataObjectConverter;

class CustomerGroup implements OptionSourceInterface
{
    /**
     * GroupManagementInterface
     */
    protected $groupManagement;

    /**
     * DataObjectConverter
     */
    protected $converter;

    /**
     * @var array
     */
    protected $options = null;

    public function __construct(
        GroupManagementInterface $groupManagement,
        DataObjectConverter $converter
    ) {
        $this->groupManagement = $groupManagement;
        $this->converter = $converter;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->options === null) {
            $notLoggedInGroup = $this->groupManagement->getNotLoggedInGroup();
            $loggedInGroups = $this->groupManagement->getLoggedInGroups();
            $this->options = $this->converter->toOptionArray(array_merge(array($notLoggedInGroup), $loggedInGroups), "id", "code");
        }
        return $this->options;
    }
}
