<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects=Project::all();
        return view('admin.projects.index', compact('projects'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Project $project, StoreProjectRequest $request)
    {
        // dd($request);
        $form_data = $request->validated();
        $form_data['slug'] = Project::generateSlug($form_data['title']);
        if($request->hasFile('image')){
            $path = Storage::put('img_up', $request->image);
            $form_data['image'] = $path;
        };
        $new_project = Project::create($form_data);
        return redirect()->route('admin.projects.show', $new_project->slug)->with('created', $new_project->title . ' è stato aggiunto');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();
        if ($project->title !== $form_data['title']) {
            $form_data['slug'] = Project::generateSlug($form_data['title']);
        }
        $project->update($form_data);
        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('deleted', $project->title . ' è stato eliminato');
    }
}
