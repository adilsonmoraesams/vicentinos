<?php

namespace Core;

use Exception;

class Controller
{
    protected function view($view, $data = [], $layout = "layout")
    {
        // Extrai as variáveis para uso na view
        if ($data)
            extract($data);

        $viewPath =  dirname(__DIR__) . "/App/Views/" . $view . ".php";

        // Verifica se a view existe
        if (file_exists($viewPath)) {
            // Inicia a captura de saída (output buffering)
            ob_start();

            // Inclui a view específica
            require $viewPath;

            // Armazena o conteúdo da view
            $content = ob_get_clean();

            // Inclui o layout principal e passa o conteúdo da view
            require "App/Views/" . $layout . ".php";
        } else {
            throw new \Exception("View {$view} não encontrada");
        }
    }

    public function UrlFile($url)
    {
        return  URL . "/public/uploads/" . $url;
    }

    protected function Error($mensagem, $layout = "layout")
    {

        $viewPath =  dirname(__DIR__) . "/App/Views/error.php";

        // Verifica se a view existe
        if (file_exists($viewPath)) {
            // Inicia a captura de saída (output buffering)
            ob_start();

            // Inclui a view específica
            require $viewPath;

            // Armazena o conteúdo da view
            $content = ob_get_clean();

            // Inclui o layout principal e passa o conteúdo da view
            require "App/Views/" . $layout . ".php";
            exit;
        } else {
            throw new \Exception("View {$view} não encontrada");
        }
    }

    public function linkSlug($texto, $url, $param = null)
    {
        // Converter para minúsculas
        $slug = mb_strtolower($texto, 'UTF-8');

        // Remover acentuações e caracteres especiais
        $slug = preg_replace('/[áàâãä]/u', 'a', $slug);
        $slug = preg_replace('/[éèêë]/u', 'e', $slug);
        $slug = preg_replace('/[íìîï]/u', 'i', $slug);
        $slug = preg_replace('/[óòôõö]/u', 'o', $slug);
        $slug = preg_replace('/[úùûü]/u', 'u', $slug);
        $slug = preg_replace('/[ç]/u', 'c', $slug);
        $slug = preg_replace('/[ñ]/u', 'n', $slug);

        // Substituir espaços por hifens
        $slug = preg_replace('/\s+/', '-', $slug);

        // Remover múltiplos hifens consecutivos
        $slug = preg_replace('/-+/', '-', $slug);

        // Remover hifens do início e do final da string
        $slug = trim($slug, '-');

        $link = URL . $url . $slug;

        if ($param)
            $link .= "/" . $this->encode($param);


        return $link;
    }

    /**
     * Codifica os dados com uma chave secreta usando criptografia AES-256-CBC e Base64.
     *
     * @param string $data Dados a serem codificados.
     * @param string $secretKey Chave secreta para a criptografia.
     * @return string Dados codificados em Base64.
     */
    public function encode($data)
    {
        // Gerar um vetor de inicialização (IV) seguro
        $ivLength = openssl_cipher_iv_length('AES-256-CBC');
        $iv = openssl_random_pseudo_bytes($ivLength);

        // Criptografar os dados
        $encryptedData = openssl_encrypt($data, 'AES-256-CBC', SECRET_KEY, 0, $iv);
        if ($encryptedData === false) {
            throw new Exception('Falha na criptografia dos dados.');
        }

        // Combinar o IV com os dados criptografados
        $combinedData = $iv . $encryptedData;

        // Codificar em Base64 seguro para URLs
        $encodedData = base64_encode($combinedData);
        $urlSafeEncodedData = str_replace(['+', '/', '='], ['-', '_', ''], $encodedData);

        return $urlSafeEncodedData;
    }

    /**
     * Decodifica os dados Base64 com uma chave secreta usando descriptografia AES-256-CBC.
     *
     * @param string $encodedData Dados codificados em Base64.
     * @param string $secretKey Chave secreta para a descriptografia.
     * @return string Dados descriptografados.
     */
    public function decode($encodedData)
    {
        // Converter de Base64 seguro para URLs para Base64 padrão
        $base64EncodedData = str_replace(['-', '_'], ['+', '/'], $encodedData);
        $padding = strlen($base64EncodedData) % 4;
        if ($padding > 0) {
            $base64EncodedData .= str_repeat('=', 4 - $padding);
        }

        // Decodificar os dados Base64
        $decodedData = base64_decode($base64EncodedData);
        if ($decodedData === false) {
            throw new Exception('Falha ao decodificar os dados Base64.');
        }

        // Obter o tamanho do IV e extrair o IV e os dados criptografados
        $ivLength = openssl_cipher_iv_length('AES-256-CBC');
        $iv = substr($decodedData, 0, $ivLength);
        $encryptedData = substr($decodedData, $ivLength);

        // Descriptografar os dados
        $decryptedData = openssl_decrypt($encryptedData, 'AES-256-CBC', SECRET_KEY, 0, $iv);
        if ($decryptedData === false) {
            throw new Exception('Falha na descriptografia dos dados.');
        }

        return $decryptedData;
    }
}
