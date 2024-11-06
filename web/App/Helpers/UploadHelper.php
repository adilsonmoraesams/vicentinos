<?php

namespace App\Helpers;

class UploadHelper
{
 

    public function UploadEditImagem($file, $dir, $fileOld)
    {
        $this->deleteFile($fileOld, $dir);

        return $this->UploadImagem($file, $dir);
    }

    public function UploadImagem($file, $dir)
    {
        // Defina o diretório onde os arquivos serão armazenados
        //$targetDir = realpath( __DIR__ . "/../../public/uploads/" . $dir . "/");
        $targetDir = __DIR__ . "../../../public/uploads/" . $dir . "/";

        // Verifique se o diretório existe, se não, crie-o
        $this->CheckagemDir($targetDir);

        // Verifique se um arquivo foi enviado via método POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifique se um arquivo foi enviado corretamente
            if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $file['tmp_name'];
                $fileName = $file['name'];
                $fileSize = $file['size'];
                $fileType = $file['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                // Extensões permitidas
                $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                // Verifique se a extensão do arquivo é permitida
                if (in_array($fileExtension, $allowedfileExtensions)) {
                    // Gere um novo nome de arquivo para evitar colisões
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                    // Caminho completo do arquivo de destino
                    $dest_path = $targetDir . $newFileName;

                    // Move o arquivo do diretório temporário para o diretório de destino
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        return array(
                            "name" => $newFileName,
                            "size" => $fileSize,
                            "type" => $fileType
                        );
                    } else {
                        return "Erro ao mover o arquivo para o diretório de upload.";
                    }
                } else {
                    return "Tipo de arquivo não permitido. Apenas formatos JPG, JPEG, PNG e GIF são aceitos.";
                }
            } else {
                return "Nenhum arquivo foi enviado ou ocorreu um erro no upload.";
            }
        } else {
            return "Método de requisição inválido.";
        }
    }

    public function deleteFile($file, $dir)
    {
        // Construir o caminho absoluto do arquivo
        $targetDirfilename = realpath( __DIR__ . "/../../public/uploads/" . $dir . "/" . $file);

        // Verifique se o caminho é válido
        if ($targetDirfilename === false) {
            echo "Erro: Caminho do arquivo não é válido ou não existe.";
            return;
        }

        // Verifique se o arquivo existe
        if (!file_exists($targetDirfilename)) {
            echo "Erro: Arquivo não encontrado.";
            return;
        }

        // Verifique permissões de escrita
        if (!is_writable($targetDirfilename)) {
            echo "Erro: O arquivo não possui permissões de escrita.";
            return;
        }

        // Verifique permissões do diretório
        $directory = dirname($targetDirfilename);
        if (!is_writable($directory)) {
            echo "Erro: O diretório não possui permissões de escrita.";
            return;
        }

        // Tentativa de deletar o arquivo
        if (!unlink($targetDirfilename)) { 
            echo "Erro ao tentar deletar o arquivo.";
            return;
        }
    }


    private function CheckagemDir($targetDir)
    {
        // Verifique se o diretório existe, se não, crie-o
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
    }
}
