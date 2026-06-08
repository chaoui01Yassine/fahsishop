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

declare(strict_types=1);

namespace PrestaShop\PrestaShop\Core\Data;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

/**
 * @template T
 * @template-implements  IteratorAggregate<T>
 */
abstract class ImmutableCollection implements IteratorAggregate, Countable
{
    /** @var T[] */
    protected $values;

    /**
     * @param T[] $values
     *
     * Keep the constructor protected to keep immutability, the subclasses should not change this constructor
     * and rely on a static factory method for their construction:
     *
     *   public static function from(T ...$values): static
     */
    protected function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @return ArrayIterator<string|int, T>|T[]
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->values);
    }

    public function count(): int
    {
        return count($this->values);
    }

    /**
     * @return T
     */
    public function first()
    {
        return reset($this->values);
    }

    /**
     * @return static
     */
    public function filter(callable $callback): self
    {
        return new static(array_filter($this->values, $callback));
    }

    public function isEmpty(): bool
    {
        return empty($this->values);
    }
}
