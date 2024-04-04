<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        try {
            $data = Role::all();
            return $this->successResponse($data, 'Roles data', 200);
        } catch (\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }
}
