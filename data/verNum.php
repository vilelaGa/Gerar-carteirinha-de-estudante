<?php

require_once("../vendor/autoload.php");

use App\DbMysql\DbMysql;


$var = (new DbMysql('alunos'))->select("VERIFICA = 'valido' AND MIGRA = 'NAOMIGRADO'");

echo $var->rowCount();
