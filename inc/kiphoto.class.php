<?php

/*
  KiPhoto's Project - Internal PHP Core
  vers. 0.0.1a - January 2014

  From an idea of Gianluigi 'A35G' Maurilio
  http://www.hackworld.it/ - http://www.gmcode.it/
*/

class Core {

  private $folder = array();
  private $images = array();
  var $prc_not = perc_ext;
  var $root_plat = root_base;

  function __construct() {
  }

  private function inPath($onpath) {

    $dir_c = $img_c = '';

    if (array_key_exists($onpath, $this->folder)) {

      for ($cs = 0; $cs < count($this->folder[$onpath]); $cs++)
        $dir_c .= $this->folder[$onpath][$cs];

    }

    if (array_key_exists($onpath, $this->images)) {

      for ($xa = 0; $xa < count($this->images[$onpath]); $xa++)
        $img_c .= $this->images[$onpath][$xa];

    }

    return $dir_c . $img_c;

  }

  private function getContent($path_read = '') {

    $directory = (empty($path_read)) ? $this->root_plat : $this->root_plat.$path_read.'/';

    $excl_path = json_decode($this->prc_not, true);

    if (is_dir($directory)) {

      if ($directory_handle = opendir($directory)) {

        while (($file = readdir($directory_handle)) !== false) {

          if (in_array($file, $excl_path) === false) {

            if (is_dir($directory.$file))
              $this->folder[$path_read][] = $file;
            else
              $this->images[$path_read][] = $file;

          }

        }

        closedir($directory_handle);

      }

      return $this->inPath($path_read);

    }

  }

  public function readFolder($percorso = '') {
    return $this->getContent($percorso);
  }

}