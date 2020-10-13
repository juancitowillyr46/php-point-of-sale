<?php
namespace App\BackOffice\Products\Domain\Entities;

use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;

class ProductMapper
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
        $this->config->registerMapping('array', ProductDto::class)->withNamingConventions(
            new SnakeCaseNamingConvention(),
            new CamelCaseNamingConvention()
        )->forMember('active', function ($source) {
            return $source['active'];
        })->forMember('activeName', function ($source) {
            return ($source['active'] == true)? 'ACTIVE' : 'NO ACTIVE';
        })->forMember('createdAt', function ($source) {
            $time = strtotime($source['created_at']); // Y-m-d H:m:s
            return date('d/m/Y H:m:s', $time);
        })->forMember('categoryName', function ($source) {
            return $source['category']['name'];
        })->forMember('categoryId', function ($source) {
            return $source['category']['uuid'];
        })->forMember('measureUnitName', function ($source) {
            return ($source['measure_unit'])? $source['measure_unit'] : '';
        })->forMember('measureUnitId', function ($source) {
            return $source['measure_unit_id']? $source['measure_unit_id'] : '';
        })->forMember('providerName', function($source){
            return (is_null($source['provider']))? '' :  $source['provider']['name'];
        })->forMember('providerId', function($source){
            return (is_null($source['provider']))? '' :  $source['provider']['uuid'];
        })->forMember('id', function($source){
            return $source['uuid'];
        });
    }
}