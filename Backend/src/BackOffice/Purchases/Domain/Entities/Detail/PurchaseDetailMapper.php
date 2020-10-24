<?php
namespace App\BackOffice\Purchases\Domain\Entities\Detail;


use App\BackOffice\Purchases\Domain\Entities\PurchaseDto;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;

class PurchaseDetailMapper
{
    public AutoMapperInterface $autoMapper;
    public AutoMapperConfigInterface $config;

    public function __construct(AutoMapperInterface $autoMapper)
    {
        $this->autoMapper = $autoMapper;
        $this->config = $this->autoMapper->getConfiguration();
        $this->registerMapping();
    }

    public function registerMapping()
    {
        $this->config->registerMapping('array', PurchaseDetailDto::class)->withNamingConventions(
            new SnakeCaseNamingConvention(),
            new CamelCaseNamingConvention()
        )->forMember('active', function ($source) {
            return $source['active'];
        })->forMember('activeName', function ($source) {
            return ($source['active'] == true)? 'SI' : 'NO';
        })->forMember('createdAt', function ($source) {
            $time = strtotime($source['created_at']); // Y-m-d H:m:s
            return date('d-m-Y H:m:s', $time);
        })->forMember('purchaseId', function ($source) {
            return $source['purchase_uuid'];
        })->forMember('id', function($source){
            return $source['uuid'];
        })->forMember('productId', function($source){
            return $source['product_uuid'];
        })->forMember('quantity', function($source){
            return $source['quantity'];
        })->forMember('priceName', function($source){
            return "S/" . $source['price'];
        })->forMember('subtotalName', function($source){
            return "S/" . $source['subtotal'];
        });
    }
}