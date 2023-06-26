<?php

namespace App\SelectUsuario;


use App\DbSqlServer\DbSqlServer;
use PDO;


class SelectUsuario
{
    /**
     * Função que traz chapa (OBS: CHAPA E A MATRICOLA MAIS ANTIGA QUE PEGA SO UM ZERO)
     * 1 Parametro
     * @var int ra
     */
    public static function TRAZCHAPA($ra)
    {
        $var = (new DbSqlServer('GUSUARIO'))->LOGIN("PFUNC PFU    (NOLOCK) INNER JOIN
        PPESSOA PPE  (NOLOCK) ON PFU.CODPESSOA = PPE.CODIGO INNER JOIN
        GUSUARIO GUS (NOLOCK)ON   RIGHT(REPLICATE('0', 6) + GUS.CODUSUARIO, 6) = PFU.CHAPA INNER JOIN 
        GUSRPERFIL  (NOLOCK) ON GUS.CODUSUARIO = GUSRPERFIL.CODUSUARIO ", "CODSITUACAO <> 'D' AND PFU.CODTIPO <> 'A' AND CHAPA = '$ra' AND CODPERFIL IN ('NTI', 'Secret_Guichê') AND GUSRPERFIL.CODSISTEMA = 'S'")
            ->fetch(PDO::FETCH_ASSOC);

        global $varGestor;
        global $raReturnDb;

        //Variavel recebida no gestor/verify.php
        $varGestor = $var;

        //Variavel recebida no aluno/recebeKey.php
        $raReturnDb = $var['CODUSUARIO'];
    }
}
