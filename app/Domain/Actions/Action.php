<?php
/**
 * Actions are intended to be low-level atomic business operations.
 *
 * Any piece of code which has side effects (eg data writing, file writing or email sending) should be done inside an action.
 * Pure functions and functions that only read (not write) data should not be implemented as Action methods.
 *
 * Each Action class is constructed with a RULES constant, and this can be loaded from the Laravel Container. The
 * Rules will be used to configure the validator when the do() method is called.
 */

namespace App\Domain\Actions;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

abstract class Action implements ActionInterface
{
    public function do(array $data): array
    {
        //https://www.php.net/manual/en/language.oop5.late-static-bindings.php#language.oop5.late-static-bindings.usage
        $validator = Validator::make($data, static::RULES);

        if ($validator->fails()) {
            Log::info('Validation error: ' . $validator->errors()->toJson() . ' Data: ' . json_encode($data));
            throw new ValidationException($validator);
        }

        return [];
    }
}
