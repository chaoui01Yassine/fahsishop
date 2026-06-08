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

namespace PrestaShopBundle\Controller\Admin\Improve\Modules;

use PrestaShopBundle\Security\Annotation\AdminSecurity;
use Symfony\Component\HttpFoundation\Response;

/**
 * Responsible of "Improve > Modules > Modules & Services > Updates" page display.
 */
class UpdatesController extends ModuleAbstractController
{
    /**
     * @AdminSecurity("is_granted('read', request.get('_legacy_controller'))")
     *
     * @return Response
     */
    public function indexAction()
    {
        $moduleList = $this->getModuleRepository()->getUpgradableModules();
        $pageData = $this->getNotificationPageData($moduleList);

        // In update view, the only available action for module is update.
        // Can't use AdminModuleDataProvider::setActionUrls $specific_action attribute while abstract definition isn't clear.
        foreach ($pageData['modules'] as $key => $module) {
            if (isset($module['attributes']['urls']['upgrade'])) {
                $pageData['modules'][$key]['attributes']['urls'] = ['upgrade' => $module['attributes']['urls']['upgrade']];
                $pageData['modules'][$key]['attributes']['url_active'] = 'upgrade';
            }
        }

        return $this->render('@PrestaShop/Admin/Module/updates.html.twig', $pageData);
    }
}
