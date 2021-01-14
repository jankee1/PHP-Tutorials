<?php

namespace App\Services;

Class Fetcher
{
  public function get($url)
  {
    $file = file_get_contents($url);
    return json_decode($file, true);
  }


}
