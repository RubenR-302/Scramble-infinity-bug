<?php

namespace App\Http\Controllers\Api;

use App\Api\Http\Data\DepartmentData;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class DepartmentController extends Controller
{
    /**
     * Get list of departments
     *
     * @return DepartmentData[]
     */
    public function index(Request $request)
    {
        $departments = QueryBuilder::for(Department::class)
            ->allowedFilters(['name', 'code'])
            ->allowedIncludes(['budget', 'candidates', 'candidates.address'])
            ->get();

        return DepartmentData::collect($departments);
    }

    /**
     * Get a single department
     *
     * @return DepartmentData
     */
    public function show(int $id)
    {
        $department = QueryBuilder::for(Department::class)
            ->where('id', $id)
            ->allowedIncludes(['budget', 'candidates', 'candidates.address'])
            ->firstOrFail();

        return DepartmentData::from($department);
    }
}
