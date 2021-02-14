<?php
namespace App\Services;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\Response;

class KernelResponseListener {

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = new Response('dupa');
        $event->setResponse($response);
    }
}
