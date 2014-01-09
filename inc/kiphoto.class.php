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
  private $info = array();
  private $fix_text;
  var $prc_not = perc_ext;
  var $root_plat = root_base;

  function __construct() {
    $this->info['lang_user'] = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ?
    substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : NULL;

    $this->getLocale();
  }

  private function getLocale() {
    if (($this->info['lang_user'] != NULL) && @file_exists("locale/".$this->
    info['lang_user'].".php")) {
      @include("locale/".$this->info['lang_user'].".php");
      $this->fix_text = $xdc;
    }
    return $this->fix_text;
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

    $directory = (empty($path_read)) ? $this->root_plat : $this->root_plat.
    $path_read.'/';

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

  private function actTemplate($ts, $tpl) {

    if (@file_exists($tpl))
      @$this->template = @file_get_contents($tpl);
    else
      die(sprintf($this->fix_text['NotFile'], $tpl));

    $this->parserT($ts);

  }

  private function parserT($ts) {

    if (@count($ts) > 0) {

      foreach ($ts as $t => $d) {
        $d = (@file_exists($d)) ? $this->getFile($d) : $d;
        $this->template = @str_replace("{" . $t . "}", $d, $this->template);
      }

    } else {
      die($this->fix_text['NotRep']);
    }

  }

  private function getFile($doc) {

    $contenuto = '';

    @ob_start();

    if (@file_exists($doc)) {
      @include($doc);
      $contenuto = @ob_get_contents();
    }

    @ob_end_clean();

    return $contenuto;

  }

  private function showTemplate() {
    return $this->template;
  }

  public function readFolder($percorso = '') {
    return $this->getContent($percorso);
  }

  public function genTemplate($ts, $tpl) {
    $this->actTemplate($ts, $tpl);
    return $this->showTemplate();
  }

}