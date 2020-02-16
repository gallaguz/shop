<?php


namespace app\engine;


class Logger
{
    private $all = false;
    private $high = false;
    private $mid = false;
    private $low = false;

    public function __construct($mode = 'high')
    {
        $this->{$mode} = true;
    }

    public function __get($name)
    {
        return $this->{$name};
    }

    public function _log($s, $suffix = '')
    {
        if (LOG === true) {
            if (is_array($s) || is_object($s)) $s = print_r($s, 1);
            $s = "### " . date("d.m.Y H:i:s") . "\r\n" . $s . "\r\n\r\n\r\n";

            if (mb_strlen($suffix))
                $suffix = "_" . $suffix;

            _writeToFile($_SERVER['DOCUMENT_ROOT'] . "/_log/logs" . $suffix . ".log", $s, "a+");

            return $s;
        }

    }

    private function _writeToFile($fileName, $content, $mode = "w")
    {
        $dir = mb_substr($fileName, 0, strrpos($fileName, "/"));
        if (!is_dir($dir)) {
            _makeDir($dir);
        }

        if ($mode != "r") {
            $fh = fopen($fileName, $mode);
            if (fwrite($fh, $content)) {
                fclose($fh);
                @chmod($fileName, 0644);
                return true;
            }
        }

        return false;
    }

    private function _makeDir($dir, $is_root = true, $root = '')
    {
        $dir = rtrim($dir, "/");
        if (is_dir($dir)) return true;
        if (mb_strlen($dir) <= mb_strlen($_SERVER['DOCUMENT_ROOT']))
            return true;
        if (str_replace($_SERVER['DOCUMENT_ROOT'], "", $dir) == $dir)
            return true;

        if ($is_root) {
            $dir = str_replace($_SERVER['DOCUMENT_ROOT'], '', $dir);
            $root = $_SERVER['DOCUMENT_ROOT'];
        }
        $dir_parts = explode("/", $dir);

        foreach ($dir_parts as $step => $value) {
            if ($value != '') {
                $root = $root . "/" . $value;

                if (!is_dir($root)) {
                    mkdir($root, 0755);
                    chmod($root, 0755);
                }
            }
        }
        return $root;
    }
}

$log = new Logger('low');
var_dump($log->low);