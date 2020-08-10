<?php
namespace App\Shared\Action;

use App\Shared\Domain\Services\BaseService;
use App\Shared\Exception\BaseValidatorRequest;
use Psr\Log\LoggerInterface;

abstract class BaseActionCommand extends Action
{
    public BaseService $service;
    public BaseValidatorRequest $validator;

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }

    /**
     * @return BaseService
     */
    public function getService(): BaseService
    {
        return $this->service;
    }

    /**
     * @param BaseService $service
     */
    public function setService(BaseService $service): void
    {
        $this->service = $service;
    }

    /**
     * @return BaseValidatorRequest
     */
    public function getValidator(): BaseValidatorRequest
    {
        return $this->validator;
    }

    /**
     * @param BaseValidatorRequest $validator
     */
    public function setValidator(BaseValidatorRequest $validator): void
    {
        $this->validator = $validator;
    }

}
