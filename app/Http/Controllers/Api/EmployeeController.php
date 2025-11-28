<?php

namespace App\Http\Controllers\Api;

use App\Api\Http\Data\EmployeeData;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class EmployeeController extends Controller
{
    /**
     * Get list of employees
     *
     * @return EmployeeData[]
     */
    public function index(Request $request)
    {
        $employees = QueryBuilder::for(Employee::class)
            ->allowedFilters(['name', 'position'])
            ->allowedIncludes(['contract'])
            ->get();

        return EmployeeData::collect($employees);
    }

    /**
     * Get a single employee
     *
     * @return EmployeeData
     */
    public function show(int $id)
    {
        $employee = QueryBuilder::for(Employee::class)
            ->where('id', $id)
            ->allowedIncludes(['contract'])
            ->firstOrFail();

        return EmployeeData::from($employee);
    }
}
