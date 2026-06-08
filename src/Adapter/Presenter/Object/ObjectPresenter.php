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

namespace PrestaShop\PrestaShop\Adapter\Presenter\Object;

use Exception;
use Hook;
use ObjectModel;
use PrestaShop\PrestaShop\Adapter\Presenter\PresenterInterface;

class ObjectPresenter implements PresenterInterface
{
    /**
     * @param ObjectModel $object
     *
     * @return array<string, mixed>
     *
     * @throws Exception
     */
    public function present($object)
    {
        if (!($object instanceof ObjectModel)) {
            throw new Exception('ObjectPresenter can only present ObjectModel classes');
        }

        $presentedObject = [];

        $fields = $object::$definition['fields'];
        foreach ($fields as $fieldName => $null) {
            $presentedObject[$fieldName] = $object->{$fieldName};
        }

        $presentedObject['id'] = $object->id;

        $this->filterHtmlContent($object::$definition['table'], $presentedObject, $object->getHtmlFields());

        return $presentedObject;
    }

    /**
     * Execute filterHtml hook for html Content for objectPresenter.
     *
     * @param string $type
     * @param ObjectModel $presentedObject
     * @param array $htmlFields
     */
    private function filterHtmlContent($type, &$presentedObject, $htmlFields)
    {
        if (!empty($htmlFields) && is_array($htmlFields)) {
            // Chained hook call - if multiple modules are hooked here, they will receive the result of the previous one as a parameter
            $filteredHtml = Hook::exec(
                'filterHtmlContent',
                [
                    'type' => $type,
                    'htmlFields' => $htmlFields,
                    'object' => $presentedObject,
                ],
                null,
                false,
                true,
                false,
                null,
                true
            );

            if (!empty($filteredHtml['object'])) {
                $presentedObject = $filteredHtml['object'];
            }
        }
    }
}
