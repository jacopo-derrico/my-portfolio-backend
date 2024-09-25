<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('images')->get();

        // $images = Image::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = Technology::all();

        $categories = Category::all();

        $images = Image::all();

        return view('projects.create', compact('technologies', 'categories', 'images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        $slug = Project::generateSlug($request->title);

        $validated['slug'] = $slug;

        if ($request->hasFile('cover_path')) {
            $path = Storage::disk('public')->put('projects_cover', $request['cover_path']);
            $validated['cover_path'] = $path;
        };

        $new_project = Project::create($validated);
        
        // add technologies if they are selected
        if ($request->has('technologies')) {
            
            $selected_technologies = $request->input('technologies');

            $new_project->technologies()->attach($selected_technologies);
        }

        // add categories if they are selected
        if ($request->has('categories')) {
            
            $selected_categories = $request->input('categories');

            $new_project->categories()->attach($selected_categories);
        }

        // add uploaded images
        $uploadedImages = $request->file('image_path');

        if ($request->hasFile('image_path')) {
            $projectName = Str::slug($new_project->title, '-');
            $projectId = $new_project->id;
            $imagePaths = [];
    
            foreach ($uploadedImages as $index => $image) {
                $originalFileName = $image->getClientOriginalName();
                $newFilename = "{$projectId}-{$projectName}-{$index}-{$originalFileName}";

                $path = Storage::disk('public')->putFileAs('projects_images', $image, $newFilename);

                Image::create([
                    'project_id' => $new_project->id,
                    'image_path' => $path,
                    'title' => null,
                    'description' => null,
                ]);
            }
        }
        
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::findOrFail($id);

        $technologies = Technology::all();

        $categories = Category::all();

        return view('projects.show', compact('project', 'technologies', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);

        $technologies = Technology::all();

        $categories = Category::all();

        return view('projects.edit', compact('project', 'technologies', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $id)
    {
        $validated = $request->validated();

        $project = Project::findOrFail($id);

        if ($request->hasFile('cover_path')) {
            $path = Storage::disk('public')->put('projects_cover', $request['cover_path']);
            $validated['cover_path'] = $path;
        } else {
            $path = $project->cover_path;
        }
        
        // autogenerate the new slug from title
        $slug = Project::generateSlug($request->title);
        $validated['slug'] = $slug;

        $project->update($validated);

        // update technologies if modified
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        }

        // update categories if modified
        if ($request->has('categories')) {
            $project->categories()->sync($request->categories);
        }
        return redirect()->route('projects.show', ['project' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        
        Storage::disk('local')->delete('public/'.$project->cover_path);

        return redirect()->route('projects.index');
    }
}
