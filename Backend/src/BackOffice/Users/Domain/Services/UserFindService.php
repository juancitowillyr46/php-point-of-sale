<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\Users\Domain\Entities\UserDto;
use App\BackOffice\Users\Domain\Entities\UserInfoDto;
use App\BackOffice\Users\Domain\Entities\UserMenuDto;
use App\BackOffice\Users\Domain\Entities\UserModel;
use Exception;

class UserFindService extends UserService
{
    public function executeArg(string $uuid): object {

        try {

            $findUserId = $this->findResourceByUuid(new UserModel(), $uuid);
            $findUser = $this->userRepository->findUser($findUserId);
            return $this->userMapper->autoMapper->map($findUser, UserDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function getInfo(string $uuid): object {
        try {

            $findUserId = $this->findResourceByUuid(new UserModel(), $uuid);
            $findUser = $this->userRepository->findUser($findUserId);

            $permissions = $findUser['user_type']['permissions'];
            $menu = [];

            if(count($permissions) > 0){

                $permissionParents = array_filter($permissions, function($obj){
                    if(isset($obj['is_parent'])){
                        $isParent = (bool) $obj['is_parent'];
                        if($isParent === false){
                            return false;
                        }
                    }
                    return true;
                });

                $permissionChildren = array_filter($permissions, function($obj) {
                    if(isset($obj['is_children'])){
                        $isChildren = $obj['is_children'];
                        if($isChildren === 0){
                            return false;
                        }
                    }
                    return true;
                });


                if(count($permissionParents) > 0){

                    foreach($permissionParents as $parent) {
                        $subMenu = [];
                        if(count($permissionChildren) > 0){
                            foreach ($permissionChildren as $permission) {
                                if($parent['id'] === $permission['parent_id']){
                                    $subMenu[] = $this->roleItemDto($permission, []);
                                }
                            }
                        }
                        $menu[] = $this->roleItemDto($parent, $subMenu);
                    }
                }

                $findUser['menu'] = $menu;

            }

            return $this->userMapper->autoMapper->map($findUser, UserInfoDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    private function roleItemDto(array $item, array $submenu = []) {
        $userMenuDto = new UserMenuDto();
        $userMenuDto->setId($item['uuid']);
        $userMenuDto->setSlug(($item['slug'] != "")? $item['slug']: '' );
        $userMenuDto->setIcon(($item['icon'] != "")? $item['icon']: '' );
        $userMenuDto->setIsParent(($item['is_parent'] != "")? $item['is_parent']: '' );
        $userMenuDto->setIsChildren(($item['is_children'] != "")? $item['is_children']: '' );
        $userMenuDto->setOrder(($item['order'] != -1)? $item['order']: 0 );
        $userMenuDto->setName($item['name']);
        if(count($submenu) > 0){
            $userMenuDto->setSubmenu($submenu);
        }

        return $userMenuDto;
    }
}