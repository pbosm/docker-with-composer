<?php

namespace app\api\controller;

class FileController {
    private $root;

    public function __construct() {
        $this->root = ROOT;
    }

    public function scriptFile(string $past = null, string $fileJs) {
        if (!empty($past)) {
            echo "<script type=\"text/javascript\" src=\"{$this->root}src/js/{$past}/{$fileJs}\"></script>";
        } else {
            echo "<script type=\"text/javascript\" src=\"{$this->root}src/js/{$fileJs}\"></script>";
        }
    }

    public function cssFile(string $past = null, string $fileCss) {
        if (!empty($past)) {
            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->root}src/css/{$past}/{$fileCss}\">";
        } else {
            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->root}src/css/{$fileCss}\">";
        }
    }
}

?>