<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : "updated_at";
        $order = (!empty($order_request = $request->get('order'))) ? $order_request : "DESC";

        $projects = Project::orderBy($sort, $order)->paginate(10)->withQueryString(); //me li ordina per update e mi mostra i primi 10 elementi


        return view('admin.projects.index', compact('projects', 'sort', 'order')); //passo anche sort e orderper sapere l'ordine
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:100',
                'text' => 'required|string',
                'image' => 'nullable|url',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.string' => 'Il titolo deve essere una stringa',
                'title.max' => 'Il titolo può avere un massimo di 100 caratteri',

                'text.required' => 'Il titolo è obbligatorio',
                'text.string' => 'Il testo deve essere una stringa',

                'image.url' => 'L\'immagine deve essere un url',
            ]
        );
        $project = new Project;
        $project->fill($request->all());
        $project->slug = Project::generateUniqueSlug($project->title);
        $project->save();

        return to_route('admin.projects.show', $project)
            ->with('message', 'Progetto creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate(
            [
                'title' => 'required|string|max:100',
                'text' => 'required|string',
                'image' => 'nullable|url',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.string' => 'Il titolo deve essere una stringa',
                'title.max' => 'Il titolo può avere un massimo di 100 caratteri',

                'text.required' => 'Il titolo è obbligatorio',
                'text.string' => 'Il testo deve essere una stringa',

                'image.url' => 'L\'immagine deve essere un url',
            ]
        );

        $project->fill($request->all()); //non usiamo update perchè avrebbe salvato prima di generare il nuovo slug
        $project->slug = Project::generateUniqueSlug($project->title);
        $project->save();

        return to_route('admin.projects.show', $project)
            ->with('message', 'Progetto modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index', $project)
            ->with('message_type', 'danger')
            ->with('message', 'Progetto eliminato definitivamente');
    }
}
