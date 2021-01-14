<?php

namespace App\Services;

class Paginator
{
  public function getPartial($data, $offset, $length)
  {
    return array_slice($data, $offset, $length);
  }
}
