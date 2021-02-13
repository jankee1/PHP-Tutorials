<?php

namespace App\Services;

use App\Services\MySecondService;

class OptionalServiceTrait {

  private $service;

  /**
  * @required
  *
  */
  public function setSecondService(MySecondService $second_service)
  {
    $this->service = $second_service;
  }
}
