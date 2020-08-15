<?php
namespace App\BackOffice\Products\Infrastructure\Persistence;

use App\BackOffice\Products\Domain\Entities\ProductModel;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Psr\Log\LoggerInterface;

class ProductRepository extends BaseRepository
{
    public function __construct(ProductModel $model)
    {
        $this->setModel($model);
        //parent::__construct($logger);
    }

}