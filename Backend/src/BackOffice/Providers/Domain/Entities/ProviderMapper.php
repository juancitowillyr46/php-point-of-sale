<?php
namespace App\BackOffice\Providers\Domain\Entities;

use App\Shared\Domain\Entities\CommonDto;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;

class ProviderMapper
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
        $this->config->registerMapping('array', ProviderDto::class)->withNamingConventions(
            new SnakeCaseNamingConvention(),
            new CamelCaseNamingConvention()
        )->forMember('activeName', function ($source) {
            return ($source['active'] == true)? 'SI' : 'NO';
        })->forMember('active', function ($source) {
            return $source['active'];
        })->forMember('createdAt', function ($source) {
            $time = strtotime($source['created_at']); // Y-m-d H:m:s
            return date('d/m/Y H:m:s', $time);
        })->forMember('id', function($source){
            return $source['uuid'];
        });

        $this->config->registerMapping('array', CommonDto::class)->withNamingConventions(
            new SnakeCaseNamingConvention(),
            new CamelCaseNamingConvention()
        )->forMember('text', function ($source) {
            return $source['business_name'];
        })->forMember('value', function($source){
            return $source['uuid'];
        });

    }
}