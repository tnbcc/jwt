<?php
namespace App\Repositories\Admin\Permission;

use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class RolesRepository extends BaseRepository
{
    public function index(Request $request)
    {
        dd($request->all());
    }
}