<?php

namespace App\Services;

use App\Services\MySecondService;
use App\Services\ServiceInterface;
use Doctrine\ORM\Event\PostFlushEventArgs;

class MyService implements ServiceInterface {

  public $logger;
  public $my;



  public function __construct()
  {
    // dump($service);
    // $this->secService = $service;
    dump('some message from extended MyService');
    // dump($one);
  }

public function postFlush(PostFlushEventArgs $args)
{
  dump('some flush');
  dump($args);
}

public function clear()
{
  dump('clear...');
}

  // public function __construct($param, $admin_email, $globalParam)
  // {
  //   dump($param);
  //   dump($admin_email);
  //   dump($globalParam);
  // }
  // use OptionalServiceTrait;
  // public function someAction()
  // {
  //   dump($this->logger);
  //   dump($this->my);
  // }

  // /**
  // * @required
  // *
  // */

  // public function setSecondService(MySecondService $second_service)
  // {
  //   dump($second_service);
  // }
}
