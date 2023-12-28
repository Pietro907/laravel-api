<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;


class ProjectController extends Controller
{

    /*  Display a listing of the resource.*/
    public function index()
    {
        $projects = Project::all();
        // Esempio di query per ottenere i dati di progetto insieme al tipo associato
        $projects = Project::join('types', 'projects.type_id', '=', 'types.id')
            ->select('projects.*', 'types.type as type_name')
            ->get();
        /* $types = Type::all();
        $technologies = Technology::all(); */
        return view('admin.projects.index', compact('projects'/* , 'types', 'technologies' */));
    }

    /* Show the form for creating a new resource. */
    public function create()
    {
        /* $project = Project::all(); */

        $types = Type::all();

        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /* Store a newly created resource in storage. */
    public function store(StoreProjectRequest $request)
    {

        /*      $project = new Project();
        $project->title = $request->title;
        $project->thumb = $request->thumb;
        $project->description = $request->description;
        $project->authors = $request->authors;
        $project->slug = $request->slug;
        $project->tech = $request->tech;
        $project->link = $request->link;
        $project->github_link = $request->github_link;

        $project->type_id = $request->type_id; 
        
        $project->save();*/


        $val_data = $request->validated();

        if ($request->has('thumb')) {
            $path = Storage::put('thumb', $request->thumb);
            $val_data['thumb'] = $path;
        }


        //dd($val_data);

        $project =  Project::create($val_data);

        //dd($project);

        $project->technologies()->attach($request->technologies);

        return to_route('project.index')->with('create_mess', 'Created Project success 💚');
    }

    /* Display the specified resource.*/
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /* Show the form for editing the specified resource. */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /* Update the specified resource in storage. */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        $data = $request->all();
        //dd($request->all());

        if ($request->has('thumb')) {
            $new_thumb = $request->thumb;

            $path = Storage::put('thumb', $new_thumb);

            if (!isNull($project->thumb) && Storage::fileExists($project->thumb)) {
                Storage::delete($project->thumb);
            }
            $val_data['thumb'] = $path;
        }
        // eseguo un detach per rimuovere tutti i vecchi collegamenti con le tecnologie
        if ($request->has('technologies')) {
            $project->technologies()->sync($data['technologies']);
        }

        // prendo i dati della richiesta e lo passo nel model Technology e tramite attach,
        // creo il collegamento nella tabella condivisa tra project e Technology
        /* $project->technologies()->attach($request->technologies); */

        $project->update($data);

        return redirect()->route('project.show', $project->id);
    }

    /**
     *
     *Remove the specified resource from storage.*/
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('project.index')->with('messaggio', 'Your Project has deleted! 💥');
    }

    public function recycle()
    {
        $trashed = Project::onlyTrashed()->orderByDesc('id')->paginate('10');

        return view('admin.projects.recycle', compact('trashed'));
    }

    public function restore($id)
    {
        $project = Project::onlyTrashed()->find($id);

        if ($project) {
            $project->restore();
            return redirect()->route('project.recycle')->with('recycle_mess', 'The project was restored ♻');
        }
    }
}
