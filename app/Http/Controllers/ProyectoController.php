<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Proyecto;
use App\Models\Tarea;
use http\Env\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProyectoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');

        $proyectos = $this->FiltrosTabla($request);

        return view('proyecto.index', compact('proyectos'))
            ->with('i', ($request->input('page', 1) - 1) * $proyectos->perPage())
            ->with(['nombre' => $nombre, 'descripcion' => $descripcion]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $proyecto = new Proyecto();

        return view('proyecto.create', compact('proyecto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProyectoRequest $request): RedirectResponse
    {
        Proyecto::create($request->validated());

        return Redirect::route('proyectos.index')
            ->with('success', 'Proyecto creado correctatemnte.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $proyecto = Proyecto::find($id);

        //obtener lista de tareas del proyecto actual
        $listaTareas = Tarea::where('proyecto_id', $proyecto->id)->orderBy('id', 'desc')->paginate();

        return view('proyecto.show', compact('proyecto', 'listaTareas'))->with('i', 0);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $proyecto = Proyecto::find($id);

        return view('proyecto.edit', compact('proyecto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProyectoRequest $request, Proyecto $proyecto): RedirectResponse
    {
        $proyecto->update($request->validated());

        return Redirect::route('proyectos.index')
            ->with('success', 'Proyecto actualizado correctatemnte.');
    }

    public function destroy($id): RedirectResponse
    {
        Proyecto::find($id)->delete();

        return Redirect::route('proyectos.index')
            ->with('success', 'Proyecto eliminado correctatemnte.');
    }

    /**
     * Aplicas los filtros a la tabla
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function FiltrosTabla(Request $request)
    {
        $query = Proyecto::query();

        //Obtener las tareas por usuario
        $query->where('usuario_id', Auth::user()->id);

        // Aplicar filtros
        if ($request->has('nombre')) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        if ($request->has('descripcion')) {
            $query->where('descripcion', 'like', '%' . $request->input('descripcion') . '%');
        }

        return $query->orderBy('id', 'desc')->paginate();
    }
  }
