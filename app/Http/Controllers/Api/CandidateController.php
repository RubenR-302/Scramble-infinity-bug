<?php

namespace App\Http\Controllers\Api;

use App\Api\Http\Data\CandidateData;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class CandidateController extends Controller
{
    /**
     * Get list of candidates
     *
     * @return CandidateData[]
     */
    public function index(Request $request)
    {
        $candidates = QueryBuilder::for(Candidate::class)
            ->allowedFilters(['name', 'email'])
            ->allowedIncludes(['address'])
            ->get();

        return CandidateData::collect($candidates);
    }

    /**
     * Get a single candidate
     *
     * @return CandidateData
     */
    public function show(int $id)
    {
        $candidate = QueryBuilder::for(Candidate::class)
            ->where('id', $id)
            ->allowedIncludes(['address'])
            ->firstOrFail();

        return CandidateData::from($candidate);
    }
}
