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

namespace PrestaShop\PrestaShop\Core\MailTemplate;

use PrestaShop\PrestaShop\Core\Language\LanguageInterface;
use PrestaShop\PrestaShop\Core\MailTemplate\Layout\LayoutInterface;
use PrestaShop\PrestaShop\Core\MailTemplate\Transformation\TransformationInterface;

/**
 * MailTemplateRendererInterface is used to render a specific MailLayoutInterface
 * with the specified LanguageInterface.
 */
interface MailTemplateRendererInterface
{
    public const GET_MAIL_LAYOUT_TRANSFORMATIONS = 'actionGetMailLayoutTransformations';

    /**
     * @param LayoutInterface $layout
     * @param LanguageInterface $language
     *
     * @return string
     */
    public function renderTxt(LayoutInterface $layout, LanguageInterface $language);

    /**
     * @param LayoutInterface $layout
     * @param LanguageInterface $language
     *
     * @return string
     */
    public function renderHtml(LayoutInterface $layout, LanguageInterface $language);

    /**
     * Adds a transformer to the renderer, when template is rendered all transformers
     * matching its type (html or txt) are applied to the output content.
     *
     * @param TransformationInterface $transformer
     *
     * @return $this
     */
    public function addTransformation(TransformationInterface $transformer);
}
