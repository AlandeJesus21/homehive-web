<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Propiedad;
use App\Models\PropiedadImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;
use Exception;

class PropiedadController extends Controller
{
    public function dashboard()
    {
        return view('propietario.index');
    }

    public function index()
    {
        $user = Auth::user();
        
        $propiedades = Propiedad::with(['imagenes', 'barrio'])
            ->where('user_id', $user->id)
            ->get();

        return view('propietario.index', compact('propiedades', 'user'));
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
            'servicios'   => 'required|array|min:1',
            'descripcion' => 'required|string',
            'reglas'      => 'required|string',
            'cercanias'   => 'required|string',
            'imagenes'    => 'required|array|min:4|max:6',
            'imagenes.*'  => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
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
            $propiedad->servicio    = json_encode($request->servicios);
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

            return redirect()->route('propietario.index')
                             ->with('success', 'La propiedad se publicó correctamente.');

        } catch (Exception $e) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Ocurrió un error al publicar la propiedad.');
        }
    }

    public function show($id)
    {
        $propiedad = Propiedad::with(['imagenes', 'barrio'])->findOrFail($id);
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
    try {
        $propiedad = Propiedad::with('imagenes')->findOrFail($id);

    
        if ($propiedad->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar esta propiedad.');
        }

        $request->validate([
            'titulo'      => 'required|string|max:255',
            'precio'      => 'required|numeric|min:1',
            'tipo'        => 'required|string',
            'servicios'   => 'required|array|min:1',
            'reglas'      => 'required|string',
            'descripcion' => 'required|string',
            'imagenes'    => 'nullable|array|max:6',
            'imagenes.*'  => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

     
        $imagenesActuales = $propiedad->imagenes()->count();

        $imagenesEliminadas = $request->filled('imagenes_eliminadas')
            ? count(explode(',', $request->imagenes_eliminadas))
            : 0;

        $imagenesNuevas = $request->hasFile('imagenes')
            ? count($request->file('imagenes'))
            : 0;

        $totalFinal = ($imagenesActuales - $imagenesEliminadas) + $imagenesNuevas;

        if ($totalFinal < 1 || $totalFinal > 6) {
            return back()
                ->withInput()
                ->with('error', 'Debe haber entre 1 y 6 imágenes en total.');
        }

      
        $propiedad->update([
            'titulo'      => $request->titulo,
            'precio'      => $request->precio,
            'tipo'        => $request->tipo,
            'reglas'      => $request->reglas,
            'descripcion' => $request->descripcion,
            'servicio'    => json_encode($request->servicios),
        ]);

     
        if ($request->filled('imagenes_eliminadas')) {

            $ids = explode(',', $request->imagenes_eliminadas);

            foreach ($ids as $idFoto) {

                $foto = PropiedadImagen::find($idFoto);

                if ($foto && $foto->propiedad_id == $propiedad->id) {

                    if (Storage::disk('public')->exists($foto->ruta)) {
                        Storage::disk('public')->delete($foto->ruta);
                    }

                    $foto->delete();
                }
            }
        }

        if ($request->hasFile('imagenes')) {

            foreach ($request->file('imagenes') as $foto) {

                $path = $foto->store('propiedades', 'public');

                PropiedadImagen::create([
                    'propiedad_id' => $propiedad->id,
                    'ruta' => $path
                ]);
            }
        }

        return redirect()->route('propietario.index')
            ->with('success', 'La propiedad se actualizó correctamente.');

    } catch (Exception $e) {

        return redirect()->route('propietario.index')
            ->with('error', 'Ocurrió un error al actualizar la propiedad.');
    }
}

    

    public function destroy(Propiedad $propiedad)
    {
        try {
            foreach ($propiedad->imagenes as $imagen) {
                Storage::disk('public')->delete($imagen->ruta);
            }

            $propiedad->delete();

            return redirect()->route('propietario.index')
                             ->with('success', 'La propiedad se ocultó correctamente.');

        } catch (Exception $e) {
            return redirect()->route('propietario.index')
                             ->with('error', 'Ocurrió un error al ocultar la propiedad.');
        }
    }

    public function buscar(Request $request)
    {
        $query = Propiedad::with('imagenes');
        $cuartos = Propiedad::where('tipo', 'cuarto')->get();

        $casas = Propiedad::where('tipo', 'casa')->get();

        $departamentos = Propiedad::where('tipo', 'departamento')->get();


        $query->whereDoesntHave('solicitudes', function ($q) {
            $q->where('estatus', 'Aceptado');
        })->whereDoesntHave('pagos', function ($q) {
            $q->where('status', 'pagado');
        });

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

        if ($request->filled('servicio')) {
            foreach ($request->servicio as $servicio) {
                $query->where('servicio', 'like', '%' . trim($servicio) . '%');
            }
        }

        $propiedades = $query->get();
        $barrios = Barrio::all();

        return view('inquilino.index', compact('propiedades', 'barrios', 'cuartos', 'casas', 'departamentos'));
    }
}