<?php

namespace App\Services;

class GiftsService
{
    public $gifts = ['flowers', 'car', 'piano', 'money'];

    public function __construct()
    {
      shuffle($this->gifts);
    }
}
