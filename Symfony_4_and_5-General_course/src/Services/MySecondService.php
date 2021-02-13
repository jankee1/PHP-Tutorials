<?php

namespace App\Services;

class MySecondService implements ServiceInterface {

  public function __construct()
  {
    dump('second service hello from extended');
  }

  public function someMethod()
  {
    return 'hello! from someMethod from secondService';
  }
}
