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

/**
 * @since 1.5.0
 */
abstract class ModuleAdminControllerCore extends AdminController
{
    /** @var Module */
    public $module;

    /**
     * @throws PrestaShopException
     */
    public function __construct()
    {
        parent::__construct();

        $this->controller_type = 'moduleadmin';

        $tab = new Tab($this->id);
        if (!$tab->module) {
            throw new PrestaShopException('Admin tab ' . get_class($this) . ' is not a module tab');
        }

        $this->module = Module::getInstanceByName($tab->module);
        if (!$this->module->id) {
            throw new PrestaShopException("Module {$tab->module} not found");
        }
    }

    /**
     * Creates a template object.
     *
     * @param string $tpl_name Template filename
     *
     * @return Smarty_Internal_Template
     */
    public function createTemplate($tpl_name)
    {
        if ($this->viewAccess()) {
            foreach ($this->getTemplateLookupPaths() as $path) {
                if (file_exists($path . $tpl_name)) {
                    return $this->context->smarty->createTemplate($path . $tpl_name);
                }
            }
        }

        return parent::createTemplate($tpl_name);
    }

    /**
     * Get path to back office templates for the module.
     *
     * @return string
     */
    public function getTemplatePath()
    {
        return _PS_MODULE_DIR_ . $this->module->name . '/views/templates/admin/';
    }

    /**
     * @return string[]
     */
    protected function getTemplateLookupPaths()
    {
        $templatePath = $this->getTemplatePath();

        return [
            _PS_THEME_DIR_ . 'modules/' . $this->module->name . '/views/templates/admin/',
            $templatePath . $this->override_folder,
            $templatePath,
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated Use $this->trans instead
     */
    protected function l($string, $class = null, $addslashes = false, $htmlentities = true)
    {
        $translated = parent::l($string, $class, $addslashes, $htmlentities);

        if ($translated === $string) {
            // legacy fallback

            if ($class === null || $class == 'AdminTab') {
                $class = get_class($this);
            }

            $translated = Translate::getModuleTranslation($this->module->name, $string, $class, null, $addslashes, null, true, $htmlentities);
        }

        return $translated;
    }
}
