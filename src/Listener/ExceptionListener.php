<?php

namespace App\Listener;

use App\Exception\UserInterfaceException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!$exception instanceof UserInterfaceException) {
            return;
        }

        $code = $exception instanceof UserInterfaceException ? 400 : 500;

        $responseData = [
            'code' => $code,
            'message' => $exception->getMessage(),
            'trace' => $exception->getTrace(),
        ];

        $event->setResponse(new JsonResponse($responseData, $code));
    }
}