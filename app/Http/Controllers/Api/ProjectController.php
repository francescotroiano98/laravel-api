<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function index(){

        $projects = Project::with('type', 'technologies')->paginate(20);

        return response()->json(
            
            [ 'success' => true,
              'results' => $projects,
            
            ]
        );
    }

    
    // la risposta funziona!
}
