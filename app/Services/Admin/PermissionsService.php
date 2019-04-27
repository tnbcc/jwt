<?php
namespace App\Services\Admin;

use App\Handlers\Tree;
use App\Http\Requests\Api\Admin\Permission\CreatePermissionRequest;
use App\Repositories\Admin\Permission\PermissionsRepository;

class PermissionsService
{
    protected $tree;
    protected $permissionsRepository;


    public function __construct(PermissionsRepository $permissionsRepository, Tree $tree)
    {
        $this->tree = $tree;

        $this->permissionsRepository = $permissionsRepository;
    }


    public function create(CreatePermissionRequest $request)
    {
        return $this->permissionsRepository->store($request);
    }

    /**
     * 根据id获取权限的详细信息
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->permissionsRepository->ById($id);
    }

    /**
     * 获取树形结构权限列表
     * @return array
     */
    public function getRulesTree()
    {
        $rules = $this->permissionsRepository->getRules()->toArray();

        return Tree::tree($rules, 'name', 'id', 'parent_id');
    }
}