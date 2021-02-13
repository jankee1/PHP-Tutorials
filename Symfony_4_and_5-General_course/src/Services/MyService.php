<?php

namespace App\Services;

use App\Services\MySecondService;

class MyService {



  // public function __construct($param, $admin_email, $globalParam)
  // {
  //   dump($param);
  //   dump($admin_email);
  //   dump($globalParam);
  // }
  use OptionalServiceTrait;
  public function __construct()
  {
    // dump($second_service);
  }

  // /**
  // * @required
  // *
  // */

  // public function setSecondService(MySecondService $second_service)
  // {
  //   dump($second_service);
  // }
}
