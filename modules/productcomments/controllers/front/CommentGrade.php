<?php
/**
 * Copyright since 2007 fahsishop and Contributors
 * fahsishop is an International Registered Trademark & Property of fahsishop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
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
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */
use PrestaShop\Module\ProductComment\Repository\ProductCommentRepository;

class ProductCommentsCommentGradeModuleFrontController extends ModuleFrontController
{
    public function display()
    {
        $idProducts = Tools::getValue('id_products');
        /* @var ProductCommentRepository $productCommentRepository */

        header('Content-Type: application/json');

        if (!is_array($idProducts)) {
            return $this->ajaxRender(null);
        }

        $idProducts = array_unique(array_map('intval', $idProducts));

        $productCommentRepository = $this->context->controller->getContainer()->get('product_comment_repository');

        $productsCommentsNb = $productCommentRepository->getCommentsNumberForProducts($idProducts, Configuration::get('PRODUCT_COMMENTS_MODERATE'));
        $averageGrade = $productCommentRepository->getAverageGrades($idProducts, Configuration::get('PRODUCT_COMMENTS_MODERATE'));

        $resultFormated = [];

        foreach ($idProducts as $i => $id) {
            $resultFormated[] = [
                'id_product' => $id,
                'comments_nb' => $productsCommentsNb[$id],
                'average_grade' => $averageGrade[$id],
            ];
        }

        $this->ajaxRender(
            json_encode(
                [
                    'products' => $resultFormated,
                ]
            )
        );
    }
}
