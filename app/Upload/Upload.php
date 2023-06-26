<?php

namespace App\Upload;

class Upload
{
    /**
     * Função de upload de arquivos
     * @param 1
     * @var string $post que vem do form
     */
    public static function uploadAluno($post, $ra)
    {
        $file = $post;
        $name = $file['name'];
        $tmp = $file['tmp_name'];

        $ext = pathinfo($name, PATHINFO_EXTENSION);

        $novoArquivo =  $ra . "." . $ext;
        move_uploaded_file($tmp, 'uploadAluno/' . $novoArquivo);
        return $novoArquivo;
    }
}
