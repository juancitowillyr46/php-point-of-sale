<?php
namespace App\BackOffice\Purchases\Domain\Entities;

use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;

class PurchaseMapper
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
        $this->config->registerMapping('array', PurchaseDto::class)->withNamingConventions(
            new SnakeCaseNamingConvention(),
            new CamelCaseNamingConvention()
        )->forMember('active', function ($source) {
            return $source['active'];
        })->forMember('activeName', function ($source) {
            return ($source['active'] == true)? 'SI' : 'NO';
        })->forMember('createdAt', function ($source) {
            $time = strtotime($source['created_at']); // Y-m-d H:m:s
            return date('d-m-Y H:m:s', $time);
        })->forMember('date', function ($source) {
            $time = strtotime($source['date']); // Y-m-d H:m:s
            return date('d-m-Y', $time);
        })->forMember('id', function($source){
            return $source['uuid'];
        })->forMember('provider', function($source){
            return $source['provider']['name'];
        })->forMember('total', function($source){
            return "S/" . $source['total'];
        });
    }
}