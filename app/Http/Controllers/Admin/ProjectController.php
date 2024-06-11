<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use Illuminate\Support\Facades\Storage;
Use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$projects= Project::all();
        $id = Auth::id();
        $projects = Project::where('category_id', $id)->paginate(10);
       // dd($projects)  
        return view("admin.projects.index",compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::all();
        return view('admin.projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //$form_data = $request->all();
        $form_data = $request->validated();
        $form_data['slug'] = Project::generateSlug($form_data['title']);
        if($request->hasFile('image')){
            //dd($request->file('image')); 
            $name = $request->image->getClientOriginalName();
            $img_path =Storage::putFileAs('image', $request->image, $name); //storage/image//nomefile.jpeg
            //dd($img_path);
            $form_data['image'] = $img_path;
        }

        $newProject = Project::create($form_data);
        return redirect()->route('admin.projects.show', $newProject->slug)->with('message' , ' New project succesfull created ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view("admin.projects.show",compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = Category::all();
        return view("admin.projects.edit",compact("project", 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->all();
        $form_data['category_id'] = Auth::id();
        if ($project->title !== $form_data['title']) {
            $form_data['slug'] = Project::generateSlug($form_data['title']);
        };
        if($request->hasFile('image')){
            //controllo se prima c'era un'img
            if($project->image){
                Storage::delete($project->image);
            }
            //uso il metodo per salvare il file con il nome originale
            $name = $request->image->getClientOriginalName();
            $img_path =Storage::putFileAs('image', $request->image, $name); 

            $form_data['image'] = $img_path;
        }
        // DB::enableQueryLog();
        $project->update($form_data); //query da eseguire
        // $query = DB::getQueryLog();
        // dd($query);
        return redirect()->route("admin.projects.show", $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //per cancellare le immagini nello storage
        if($project->image){
            Storage::delete($project->image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', $project->title . 'succesfull delected ');

    }
}
