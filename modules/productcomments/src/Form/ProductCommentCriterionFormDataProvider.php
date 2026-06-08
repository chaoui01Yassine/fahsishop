<?php
/**
 * Copyright since 2007 fahsishop and Contributors
 * fahsishop is an International Registered Trademark & Property of fahsishop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@fahsishop.com so we can send you a copy immediately.
 *
 * @author    fahsishop and Contributors <contact@fahsishop.com>
 * @copyright Since 2007 fahsishop and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */
declare(strict_types=1);

namespace PrestaShop\Module\ProductComment\Form;

use PrestaShop\Module\ProductComment\Repository\ProductCommentCriterionRepository;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataProvider\FormDataProviderInterface;
use PrestaShopBundle\Entity\Repository\LangRepository;

class ProductCommentCriterionFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var ProductCommentCriterionRepository
     */
    private $pccriterionRepository;

    /**
     * @var LangRepository
     */
    private $langRepository;

    /**
     * @param ProductCommentCriterionRepository $pccriterionRepository
     * @param LangRepository $langRepository
     */
    public function __construct(
        ProductCommentCriterionRepository $pccriterionRepository,
        LangRepository $langRepository
    ) {
        $this->pccriterionRepository = $pccriterionRepository;
        $this->langRepository = $langRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getData($criterionId)
    {
        $criterion = $this->pccriterionRepository->find($criterionId);

        $criterionData = [
            'type' => $criterion->getType(),
            'active' => $criterion->isActive(),
        ];
        foreach ($criterion->getCriterionLangs() as $criterionLang) {
            $criterionData['name'][$criterionLang->getLang()->getId()] = $criterionLang->getName();
        }

        return $criterionData;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultData()
    {
        $default_name = [];

        $langEntities = $this->langRepository->findBy(['active' => 1]);
        foreach ($langEntities as $langEntity) {
            $default_name[$langEntity->getId()] = $langEntity->getIsoCode();
        }

        return [
            'type' => '',
            'active' => false,
            'name' => $default_name,
        ];
    }
}
