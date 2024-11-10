<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tecnology;
use App\Models\Type;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    public function getTecnology()
    {
        $tecnologies = Tecnology::all();
        return response()->json($tecnologies);
    }

    public function getTypes()
    {
        $types = Type::all();
        return response()->json($types);
    }

    public function getProjectBySlug($slug)
    {
        $project = Project::where('slug', $slug)->with('tecnologies', 'type')->first();
        if ($project) {
            $success = true;
            if ($project->image) {
                $project->image = asset('storage/' . $project->image);
            } else {
                $project->image = asset('storage/uploads/no-image.jpeg');
            }
        } else {
            $success = false;
        }
        return response()->json(compact('success', 'project'));
    }
}
