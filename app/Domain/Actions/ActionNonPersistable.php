<?php
/**
 * ActionNonPersistable inherits all the capabilities of the standard Action, but adds the ability to be run in
 * dummy mode. This is useful for testing commands without writing any data.
 */

namespace App\Domain\Actions;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

abstract class ActionNonPersistable implements ActionNonPersistableInterface
{
    public function do(array $data, bool $persist = true): array
    {
        if ($persist) {
            //https://www.php.net/manual/en/language.oop5.late-static-bindings.php#language.oop5.late-static-bindings.usage
            $validator = Validator::make($data, static::RULES);
            if ($validator->fails()) {
                Log::info('Validation error: ' . $validator->errors()->toJson() . ' Data: ' . json_encode($data));
                throw new ValidationException($validator);
            }
        }
        return [];
    }
}
