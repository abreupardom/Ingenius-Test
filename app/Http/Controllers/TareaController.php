<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Tarea;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TareaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $nombre = $request->input('nombre');
        $estado = $request->input('estado');
        $prioridad = $request->input('prioridad');
        $proyecto_id = $request->input('proyecto_id');

        $tareas = $this->FiltrosTabla($request);

        return view('tarea.index', compact('tareas'))
            ->with('i', ($request->input('page', 1) - 1) * $tareas->perPage())
            ->with(['nombre' => $nombre, 'estado' => $estado, 'prioridad' => $prioridad, 'proyecto_id' => $proyecto_id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tarea = new Tarea();
        //obtener el listado de proyectos por usuario
        $listaProyectos = Proyecto::where('usuario_id', Auth::user()->id)->get();

        return view('tarea.create', compact('tarea', 'listaProyectos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TareaRequest $request): RedirectResponse
    {
        Tarea::create($request->validated());
        if (!$request->has('guardartarea')) {
            return Redirect::route('tareas.index')
                ->with('success', 'Tarea creada correctamente.');
        } else {
            return Redirect::route('proyectos.show', $request->proyecto_id)
                ->with('success', 'Tarea creada correctamente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tarea = Tarea::find($id);

        return view('tarea.show', compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $tarea = Tarea::find($id);
        //obtener el listado de proyectos por usuario
        $listaProyectos = Proyecto::where('usuario_id', Auth::user()->id)->get();

        return view('tarea.edit', compact('tarea', 'listaProyectos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TareaRequest $request, Tarea $tarea): RedirectResponse
    {
        $tarea->update($request->validated());

        return Redirect::route('tareas.index')
            ->with('success', 'Tarea actualizada correctamente.');
    }

    public function destroy($id): RedirectResponse
    {
        Tarea::find($id)->delete();

        return Redirect::route('tareas.index')
            ->with('success', 'Tarea eliminada correctamente.');
    }

    /**
     * Aplicas los filtros a la tabla
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function FiltrosTabla(Request $request)
    {
        $query = Tarea::query();

        //Obtener las tareas por usuario
        $query->with('proyecto')->whereHas('proyecto', function ($query) {
            $query->where('usuario_id', Auth::user()->id);
        })->get();

        // Aplicar filtros
        if ($request->has('nombre')) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        if ($request->has('estado')) {
            $query->where('estado', 'like', '%' . $request->input('estado') . '%');
        }

        if ($request->has('prioridad')) {
            $query->where('prioridad', 'like', '%' . $request->input('prioridad') . '%');
        }

        if ($request->has('proyecto_id')) {
            $query->where('proyecto_id', 'like', '%' . $request->input('proyecto_id') . '%');
        }

        return $query->orderBy('id', 'desc')->paginate();
    }
}
