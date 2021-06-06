<?php

namespace App\Utils;

// use Symfony\Component\Cache\Adapter\TagAwareAdapter;

class FileCache implements CacheInterface
{
  public $cache;

  public function __construct()
  {

  }
}
