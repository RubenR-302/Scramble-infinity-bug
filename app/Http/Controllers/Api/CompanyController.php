<?php

namespace App\Http\Controllers\Api;

use App\Api\Http\Data\CompanyData;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class CompanyController extends Controller
{
    /**
     * Get list of companies
     *
     * @return CompanyData[]
     */
    public function index(Request $request)
    {
        $companies = QueryBuilder::for(Company::class)
            ->allowedFilters(['name', 'industry'])
            ->allowedIncludes(['profile'])
            ->get();

        return CompanyData::collect($companies);
    }

    /**
     * Get a single company
     *
     * @return CompanyData
     */
    public function show(int $id)
    {
        $company = QueryBuilder::for(Company::class)
            ->where('id', $id)
            ->allowedIncludes(['profile'])
            ->firstOrFail();

        return CompanyData::from($company);
    }
}
