<?php
declare(strict_types=1);

namespace App\BackOffice\Home\Application\Actions;


use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class HomeAction extends Action
{
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }
}