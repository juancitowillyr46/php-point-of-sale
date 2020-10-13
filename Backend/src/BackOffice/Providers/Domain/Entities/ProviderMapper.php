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
        )->forMember('name', function ($source) {
            return $source['name'];
        })->forMember('activeName', function ($source) {
            return ($source['active'] == true)? 'SI' : 'NO';
        })->forMember('active', function ($source) {
            return $source['active'];
        })->forMember('description', function ($source) {
            return ($source['description'])? $source['description'] : '';
        })->forMember('homePhoneNumber', function ($source) {
            return $source['cell_phone_number'];
        })->forMember('cellPhoneNumber', function ($source) {
            return $source['home_phone_number'];
        })->forMember('id', function($source){
            return $source['uuid'];
        })->forMember('ruc', function($source){
            return ($source['ruc'])? $source['ruc'] : '';
        })->forMember('address', function($source){
            return ($source['address'])? $source['address'] : '';
        })->forMember('createdAt', function ($source) {
            $time = strtotime($source['created_at']); // Y-m-d H:m:s
            return date('d/m/Y H:m:s', $time);
        })->forMember('departmentId', function ($source) {
            return ($source['department_uuid'])? $source['department_uuid'] : '';
        })->forMember('provinceId', function ($source) {
            return ($source['province_uuid'])? $source['province_uuid'] : '';
        })->forMember('districtId', function ($source) {
            return ($source['district_uuid'])? $source['district_uuid'] : '';
        });

        $this->config->registerMapping('array', CommonDto::class)->withNamingConventions(
            new SnakeCaseNamingConvention(),
            new CamelCaseNamingConvention()
        )->forMember('text', function ($source) {
            return $source['name'];
        })->forMember('value', function($source){
            return $source['uuid'];
        });

    }
}