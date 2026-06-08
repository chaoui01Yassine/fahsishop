<?php
/**
 * Copyright since 2007 fahsishop and Contributors
 * fahsishop is an International Registered Trademark & Property of fahsishop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@fahsishop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade fahsishop to newer
 * versions in the future. If you wish to customize fahsishop for your
 * needs please refer to https://fahsishop.com/ for more information.
 *
 * @author    fahsishop and Contributors <contact@fahsishop.com>
 * @copyright Since 2007 fahsishop and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace PrestaShop\PrestaShop\Core\Image;

use Db;

class ImageTypeRepository
{
    /**
     * @var Db
     */
    private $db;
    /**
     * @var string
     */
    private $db_prefix;

    public function __construct(Db $db)
    {
        $this->db = $db;
        $this->db_prefix = $db->getPrefix();
    }

    public function setTypes(array $types)
    {
        $this->removeAllTypes();
        foreach ($types as $name => $data) {
            $this->createType(
                $name,
                $data['width'],
                $data['height'],
                $data['scope']
            );
        }

        return $this;
    }

    public function createType($name, $width, $height, array $scope)
    {
        $data = [
            'name' => $this->db->escape($name),
            'width' => $this->db->escape($width),
            'height' => $this->db->escape($height),
        ];

        foreach ($this->getScopeList() as $scope_item) {
            if (in_array($scope_item, $scope)) {
                $data[$scope_item] = 1;
            } else {
                $data[$scope_item] = 0;
            }
        }

        $this->db->insert('image_type', $data);

        return $this->getIdByName($name);
    }

    public function getScopeList()
    {
        return ['products', 'categories', 'manufacturers', 'suppliers', 'stores'];
    }

    public function getIdByName($name)
    {
        $escaped_name = $this->db->escape($name);

        $id_image_type = $this->db->getValue(
            "SELECT id_image_type FROM {$this->db_prefix}image_type WHERE name = '$escaped_name'"
        );

        return (int) $id_image_type;
    }

    protected function removeAllTypes()
    {
        Db::getInstance()->execute(
            "TRUNCATE TABLE {$this->db_prefix}image_type"
        );
    }
}
