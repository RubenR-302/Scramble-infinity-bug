<?php

namespace App\Http\Controllers\Api;

use App\Api\Http\Data\ProjectData;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ProjectController extends Controller
{
    /**
     * Get list of projects
     *
     * @return ProjectData[]
     */
    public function index(Request $request)
    {
        $projects = QueryBuilder::for(Project::class)
            ->allowedFilters(['name', 'status'])
            ->allowedIncludes(['timeline', 'candidates', 'candidates.address'])
            ->get();

        return ProjectData::collect($projects);
    }

    /**
     * Get a single project
     *
     * @return ProjectData
     */
    public function show(int $id)
    {
        $project = QueryBuilder::for(Project::class)
            ->where('id', $id)
            ->allowedIncludes(['timeline', 'candidates', 'candidates.address'])
            ->firstOrFail();

        return ProjectData::from($project);
    }
}
