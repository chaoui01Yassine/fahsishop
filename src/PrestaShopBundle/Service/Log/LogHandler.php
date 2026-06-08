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

namespace PrestaShopBundle\Service\Log;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\Container;

class LogHandler extends AbstractProcessingHandler
{
    protected $container;

    public function __construct(Container $container, $level = Logger::DEBUG, $bubble = true)
    {
        $this->container = $container;
        parent::__construct($level, $bubble);
    }

    protected function write(array $record)
    {
        $logger = $this->container->get('prestashop.adapter.legacy.logger');
        $logger->log($record['level'], $record['message'], $record['context']);
    }
}
