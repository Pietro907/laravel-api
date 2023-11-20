<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Project;
use App\Models\Tecnology;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isNull;


class ProjectController extends Controller
{

    /*  Display a listing of the resource.*/
    public function index()
    {
        $projects = Project::all();
        $types = Type::all();
        $technologies = Tecnology::all();
        return view('admin.projects.index', compact('projects','types', 'technologies'));
    }

    /* Show the form for creating a new resource. */
    public function create()
    {
        /* $project = Project::all(); */

        $types = Type::all();

        $technologies = Tecnology::all();

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
        $technologies = Tecnology::all();
        return view('admin.projects.edit', compact('project', 'types','technologies'));
    }

    /* Update the specified resource in storage. */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        
        if($request->has('thumb')){
            $new_thumb = $request->thumb;

            $path = Storage::put('thumb', $new_thumb);

            if (!isNull($project->thumb) && Storage::fileExists($project->thumb)) {
                Storage::delete($project->thumb);
            }
            $val_data['thumb'] = $path;
        }

        $data = $request->all();
        $project->update($data);
        //$types->update($data);
        return redirect()->route('project.show', $project->id); //aggiungere qui compact('types')    ????
    }

    /**
     *
     *Remove the specified resource from storage.*/
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('project.index')->with('messaggio', 'Your Project has deleted! 💥');
    }

    public function recycle() {
        $trashed = Project::onlyTrashed()->orderByDesc('id')->paginate('10');
        
        return view('admin.projects.recycle', compact('trashed'));
        
    }
    
    public function restore($id) {
        $project = Project::onlyTrashed()->find($id);

        if($project){
            $project->restore();
            return redirect()->route('project.recycle')->with('recycle_mess', 'The project was restored ♻');
        }
        
    }
}
