<?php

namespace App\Rules;

use Closure;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;

class DataNascimentoValidate implements ValidationRule
{
    /**
     * Algorítimo para validar o Data de Nascimento
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // converter a data para objeto Carbon
        $dataNascimento = Carbon::parse($value);

        // Validar se a data de nascimento é maior que 18 anos
        if ($dataNascimento->diffInYears(Carbon::now()) < 18) {
            $fail('A data de nascimento informada deve ser maior que 18 anos.');
            return;
        }
    }
}
