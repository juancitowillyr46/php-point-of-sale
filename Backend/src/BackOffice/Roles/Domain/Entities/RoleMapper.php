<?php
namespace App\BackOffice\Roles\Domain\Entities;

use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;

class RoleMapper
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
        $this->config->registerMapping('array', RoleDto::class)->withNamingConventions(
            new SnakeCaseNamingConvention(),
            new CamelCaseNamingConvention()
        )->forMember('active', function ($source) {
            return ($source['active'] == true)? 'ACTIVE' : 'NO ACTIVE';
        })->forMember('createdAt', function ($source) {
            $time = strtotime($source['created_at']); // Y-m-d H:m:s
            return date('d/m/Y H:m:s', $time);
        })->forMember('id', function($source){
            return $source['uuid'];
        });
    }
}