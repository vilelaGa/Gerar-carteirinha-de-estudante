<?php

namespace App\Funcoes;

class Funcoes
{

    public static function validCPF($cpf)
    {

        // Verifica se o número de dígitos informados é igual a 11
        if (strlen($cpf) != 11) {
            return "O CPF deve conter 11 dígitos";
        }
        // Verifica se nenhuma das sequências inválidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if (
            $cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999'
        ) {
            return '<div class="alert alert-danger" role="alert">
            CPF inválido
            </div>';
            // Calcula os dígitos verificadores para verificar se o
            // CPF é válido
        } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return false;
                    // return "<strong class='invalido'>CPF Inválido</strong>";
                }
            }

            return true;
            // return "<strong class='valido'>CPF Valido</strong>";
        }
    }

    public static function sanitizeString($var)
    {

        // matriz de entrada
        $what = array('ä', 'ã', 'à', 'á', 'â', 'ê', 'ë', 'è', 'é', 'ï', 'ì', 'í', 'ö', 'õ', 'ò', 'ó', 'ô', 'ü', 'ù', 'ú', 'û', 'À', 'Á', 'À', 'Ã', 'Â', 'É', 'È', 'Ê', 'Í', 'Ì', 'Ó', 'Õ', 'Ú', 'Ü', 'ñ', 'Ñ', 'ç', 'Ç', ' ', '-', '(', ')', ',', ';', ':', '|', '!', '"', '#', '$', '%', '&', '/', '=', '?', '~', '^', '>', '<', 'ª', 'º', "\n", '°');

        // matriz de saída
        $by   = array('a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'A', 'A', 'A', 'A', 'A', 'E', 'E', 'E', 'I', 'I', 'O', 'O', 'U', 'U', 'n', 'N', 'c', 'C', ' ', '-', '_', '_', '_', '_', '_', '|', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '', '');

        // devolver a string
        return str_replace($what, $by, $var);
    }
}
