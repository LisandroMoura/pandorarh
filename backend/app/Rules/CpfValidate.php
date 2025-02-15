<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfValidate implements ValidationRule
{
    /**
     * Algorítimo para validar o CPF
     * inspirações: tirado da internet como por ex:
     * https://gist.github.com/rafael-neri/ab3e58803a08cb4def059fce4e3c0e40,
     * https://stackoverflow.com/ entre outros...
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/\D/', '', $value);

        // Verifica se tem 11 dígitos
        if (strlen($cpf) != 11) {
            $fail('O CPF deve conter 11 dígitos.');
            return;
        }

        // Verifica se todos os dígitos são iguais (exemplo: 111.111.111-11)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $fail('O CPF informado não é válido.');
            return;
        }

        // Calcula os dígitos verificadores para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $fail('O CPF informado não é válido.');
                return;
            }
        }
    }
}
