<?php


namespace System;

class Logs
{
    public function __construct()
    {
        $this->CriarDocumento();
    }

    public static function Registrar($message)
    {
        $txt = date("d-m-Y H:i:s") . " - " . $message . "\n";
        $dirname = self::getLogFile();
        $fp = fopen($dirname, 'a');
        fwrite($fp, $txt);
        fclose($fp);
    }

    private function CriarDocumento()
    {
        $dirname = $this->getLogFile();
        if (!file_exists($dirname)) {
            $this->chmod_r(__DIR__ . "/../assets/logs/");
            $fp = fopen($dirname, "w") or die("Unable to open file!");
            fclose($fp);
        }
    }

    private static function getLogFile()
    {
        $date = date("dd-mm-yyy");
        $filename = "logs_" . $date . ".txt";
        $dirname = __DIR__ . "/../assets/logs/" . $filename;
        return $dirname;
    }

    private function chmod_r($Path)
    {
        $dp = opendir($Path);
        while ($File = readdir($dp)) {
            if ($File != "." and $File != "..") {
                if (is_dir($File)) {
                    chmod($File, 0777);
                    $this->chmod_r($Path . "/" . $File);
                } else {
                    chmod($Path . "/" . $File, 0644);
                }
            }
        }
        closedir($dp);
    }
}
