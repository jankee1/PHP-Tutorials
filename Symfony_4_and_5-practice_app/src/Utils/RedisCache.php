<?php

namespace App\Utils;

// use Symfony\Component\Cache\Adapter\TagAwareAdapter;
// use Symfony\Component\Cache\Adapter\RedisAdapter;

class RedisCache implements CacheInterface
{
  public $cache;

  public function __construct()
  {

  }
}
