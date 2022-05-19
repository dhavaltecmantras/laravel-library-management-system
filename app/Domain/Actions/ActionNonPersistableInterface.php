<?php
/**
 * Similar to the standard Action interface, but with a switch to turn data-writing on and off
 */

namespace App\Domain\Actions;

interface ActionNonPersistableInterface
{
    public function do(array $data, bool $persist = true): array;
}
