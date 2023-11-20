<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'Success',
            'result' => Project::paginate(10),
        ]);
    }

    /* public function show()
    {

        //creo una nuova istanza di project e gli passo i modelli type e tecnologies selezionandoli per id
        $project = Project::with('type', 'technologies')->where('id', $id)->first();

        //se il progetto esiste fallo vedere
        if ($project) {
            return response()->json([
                    'success' => true,
                    'result' => $project,
                ]);
            } else {
            return response()->json([
                    'success' => false,
                    'result' => 'Ops! Page not found'
            ]);
        
        }
    }    */
}
