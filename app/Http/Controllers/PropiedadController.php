<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Propiedad;
use App\Models\PropiedadImagen;
use App\Models\Barrio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;

class PropiedadController extends Controller
{

    public function dashboard()
    {
        return view('propietario.index');
    }


    public function index()
    {
        $user = Auth::user();
        $propiedades = Propiedad::with('imagenes', 'barrio')->where('user_id', $user->id)->get();
        return view('propietario.propiedades.index', compact('propiedades', 'user'));
    }


    public function create()
    {
        $barrios = Barrio::all();
        return view('propietario.propiedades.create', compact('barrios'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'titulo'      => 'required|string|max:255',
            'tipo'        => 'required|string',
            'barrio_id'   => 'required|numeric|exists:barrios,id',
            'calle'       => 'required|string',
            'latitud'     => 'required|numeric',
            'longitud'    => 'required|numeric',
            'precio'      => 'required|numeric|min:1',
            'forma_pago'  => 'required|string',
            'servicio'    => 'nullable|string',
            'descripcion' => 'required|string',
            'reglas'      => 'required|string',
            'cercanias'   => 'required|string',
            'imagenes'    => 'required',
            'imagenes.*'  => 'image|max:2048',
        ]);

        $propiedad = new Propiedad();
        $propiedad->user_id     = Auth::id();
        $propiedad->titulo      = $request->titulo;
        $propiedad->tipo        = $request->tipo;
        $propiedad->barrio_id   = $request->barrio_id;
        $propiedad->calle       = $request->calle;
        $propiedad->latitud     = $request->latitud;
        $propiedad->longitud    = $request->longitud;
        $propiedad->precio      = $request->precio;
        $propiedad->forma_pago  = $request->forma_pago;
        $propiedad->servicio    = $request->servicio;
        $propiedad->descripcion = $request->descripcion;
        $propiedad->reglas      = $request->reglas;
        $propiedad->cercanias   = $request->cercanias;
        $propiedad->save();

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $foto) {
                $path = $foto->store('propiedades', 'public');
                PropiedadImagen::create([
                    'propiedad_id' => $propiedad->id,
                    'ruta' => $path
                ]);
            }
        }

        return redirect()->route('propiedades.index')
                         ->with('success', '¡Propiedad publicada con éxito!');
    }


    public function show($id)
    {
        $propiedad = Propiedad::with('imagenes')->findOrFail($id);
        return view('propietario.propiedades.show', compact('propiedad'));
    }


    public function edit($id)
    {
        $propiedad = Propiedad::with('imagenes')->findOrFail($id);


        if ($propiedad->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta propiedad.');
        }

        return view('propietario.propiedades.edit', compact('propiedad'));
    }


    public function update(Request $request, $id)
    {
        $propiedad = Propiedad::findOrFail($id);


        $request->validate([
            'titulo'      => 'required|string|max:255',
            'precio'      => 'required|numeric|min:1',
            'tipo'        => 'required|string',
            'reglas'      => 'required|string',
            'descripcion' => 'required|string',
            'imagenes.*'  => 'image|max:2048',
        ]);


        $propiedad->update($request->only([
            'titulo', 'precio', 'tipo', 'reglas', 'descripcion'
        ]));


        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $foto) {
                $path = $foto->store('propiedades', 'public');
                PropiedadImagen::create([
                    'propiedad_id' => $propiedad->id,
                    'ruta' => $path
                ]);
            }
        }

        return redirect()->route('propiedades.index')
                         ->with('success', 'La propiedad ha sido actualizada.');
    }


    public function destroyFoto($id)
    {
        $foto = PropiedadImagen::findOrFail($id);


        if (Storage::disk('public')->exists($foto->ruta)) {
            Storage::disk('public')->delete($foto->ruta);
        }


        $foto->delete();

        return response()->json(['success' => true]);
    }


    public function destroy(Propiedad $propiedad)
    {

        foreach($propiedad->imagenes as $imagen) {
            Storage::disk('public')->delete($imagen->ruta);
        }


        $propiedad->delete();

        return redirect()->route('propiedades.index')
                         ->with('success', 'Propiedad eliminada correctamente.');
    }

    public function buscar(Request $request)
{


    $query = Propiedad::with('imagenes');
    if ($request->filled('barrios')) {
        $query->whereIn('barrio', $request->barrios);
    }
    if ($request->filled('tipo')) {
        $query->where('tipo', $request->tipo);
    }
    if ($request->filled('min')) {
        $query->where('precio', '>=', $request->min);
    }
    if ($request->filled('max')) {
        $query->where('precio', '<=', $request->max);
    }
    // if ($request->has('servicio') && is_array($request->servicio)) {
    //     foreach ($request->servicios as $servicioSeleccionado) {
    //         // Buscamos el nombre del servicio dentro de tu cadena de texto
    //         $query->where('servicio', 'like', '%' . $servicioSeleccionado . '%');
    //     }
    // }

    if ($request->filled('servicio')) {
    foreach($request->servicio as $servicio) {
        $query->where('servicio', 'like', '%' .trim ($servicio). '%');
    }
}

    $propiedades = $query->get();
    $barrio = Barrio::all();

    return view('inquilino.index', compact('propiedades', 'barrio'));

}
}
}
