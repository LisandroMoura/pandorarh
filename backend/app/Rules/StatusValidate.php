<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StatusValidate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        // Lista de valores válidos
        $statusValidos = ['Ativo', 'Inativo'];

        if (!in_array($value, $statusValidos, true)) {
            $fail("O Status informado é inválido. Digite 'Ativo' ou 'Inativo'.");
        }
    }
}
