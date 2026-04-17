<x-layout>

    {{-- HERO --}}
    <div style="background: linear-gradient(180deg, #D2D4E5 0%, #B0B3D3 100%); min-height: 100vh; padding: 0px 0; font-family: 'Segoe UI', sans-serif;">
    <section class="position-relative"

        style="height: 300px; background: linear-gradient(rgba(0, 0, 0, 0.21), rgba(0, 0, 0, 0.21)), url('/images/propietario.png') center/cover no-repeat;">

        <div class=" h-100 d-flex align-items-center justify-content-center">
           
            <div style="max-width: 650px; margin-top: 250px;" class=" bg-white rounded-4 shadow p-4 text-center w-100"  >

                <h4 class="fw-semibold mb-3">
                    Todo gran cambio empieza con un buen lugar.
                </h4>

                <p class="text-muted mb-4">
                    Publica tu propiedad en HomeHive y conéctala con personas que están buscando su próximo hogar.
                </p>

                <a href="{{ route('propiedades.create') }}" 
                   class="btn px-4 py-2 rounded-3" style="background-color: #1E3A8A; color: white;">
                    Publicar propiedad
                </a>

            </div>
        </div>
    </section>

    {{-- CONTENIDO --}}
    <div  class="container mt-5">

        {{-- MENSAJE GLOBAL --}}
        @if(session('success') || session('info') || session('error'))
            <div id="mensaje-data"
                data-success="{{ session('success') }}"
                data-info="{{ session('info') }}"
                data-error="{{ session('error') }}">
            </div>
        @endif

        {{-- MÉTRICAS --}}
        <div style="margin-top: 130px;" class="row mb-5">

            <div class="col-md-4 mb-4">
                <div class="bg-white rounded-5 shadow p-4 h-100">
                    <div class="d-flex align-items-center">
                        <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                            style="width:60px; height:60px; background-color: #E7DEFF; color: #b300ff;">
                            <i class="bi bi-cash-stack fs-3"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold">{{ $totalPagos }}</h4>
                            <small class="text-muted text-uppercase">Pagos Totales</small>
                            <div class="text-success small">+{{ $pagosMes }} Este mes</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('pagos.index') }}" class="btn btn-primary w-50 mt-4" style="background-color: #1E3A8A; color: white;">
                            Ver más
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="bg-white rounded-5 shadow p-4 h-100">
                    <div class="d-flex align-items-center">
                        <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                            style="width:60px; height:60px; background-color: #f9d8346e; color: #d3b000;">
                            <i class="bi bi-exclamation-triangle fs-3"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold">{{ $totalSolicitudes }}</h4>
                            <small class="text-muted text-uppercase">Solicitudes Totales</small>
                            <div class="text-success small">+{{ $pendientesSolicitudes }} Para revisar</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('solicitudes.index') }}" class="btn w-50 mt-4" style="background-color: #1E3A8A; color: white;">
                            Ver más
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="bg-white rounded-5 shadow p-4 h-100">
                    <div class="d-flex align-items-center">
                        <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                            style="width:60px; height:60px; background-color: #E7DEFF; color: #b300ff;">
                            <i class="bi bi-chat-left-text fs-3"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold">{{ $totalReviews }}</h4>
                            <small class="text-muted text-uppercase">Reseñas Totales</small>
                            <div class="text-muted small">+{{ $nuevasReviews }} Nuevas</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn w-50 mt-4" style="background-color: #1E3A8A; color: white;">
                            Ver más
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- PROPIEDADES --}}
        <section class="py-5" id="propiedades-section"> 

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold">
                    <i"></i> Mis Propiedades
                </h3>

                <a href="{{ route('propiedades.create') }}"
                   class="btn px-4" style="background-color: #1E3A8A; color: white;">
                    <i class="bi bi-plus-lg me-1"></i> Nueva Propiedad
                </a>
            </div>

            <div class="row g-4">

                @forelse($propiedades as $propiedad)
                <div class="col-md-4">
                    <div class="bg-white rounded-4 shadow overflow-hidden h-100">

                        <img src="{{ $propiedad->imagenes->count() > 0 ? asset('storage/' . $propiedad->imagenes->first()->ruta) : asset('images/no-image.jpg') }}"
                             class="w-100"
                             style="height:180px; object-fit:cover;">

                        <div class="p-3">

                            <div class="d-flex justify-content-between">
                                <span class="fw-bold text-primary">
                                    ${{ number_format($propiedad->precio) }}
                                </span>
                                <span class="text-muted small">
                                    <i class="bi bi-star-fill text-warning"></i> 0.0
                                </span>
                            </div>

                            <p class="fw-semibold mb-1 mt-2">
                                {{ $propiedad->titulo }}
                            </p>

                            <p class="text-muted small mb-3">
                                <i class="bi bi-geo-alt me-1"></i>
                                {{ $propiedad->calle }}
                            </p>

                            <div class="d-flex flex-wrap gap-2">

                                <a href="{{ route('propiedades.edit', $propiedad->id) }}"
                                   class="btn btn-primary btn-sm flex-fill">
                                    Editar
                                </a>

                                <button class="btn btn-primary btn-sm flex-fill">
                                    Comentarios
                                </button>

                                <a href="{{ route('propiedades.show', $propiedad->id) }}"
                                   class="btn btn-primary btn-sm flex-fill">
                                    Ver
                                </a>

                                <form action="{{ route('propiedades.destroy', $propiedad->id) }}" method="POST" class="flex-fill form-eliminar">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm w-100">
                                        Eliminar
                                    </button>

                                    
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">
                        No tienes propiedades registradas aún.
                    </p>
                </div>
                @endforelse

            </div>

        </section>

    </div>

        <script>
document.addEventListener('DOMContentLoaded', () => {
    const data = document.getElementById('mensaje-data');

    if (!data) return;

    const mensaje = data.dataset.success || data.dataset.info || data.dataset.error;

    if (!mensaje) return;

    // Crear contenedor
    const alerta = document.createElement('div');
    alerta.innerText = mensaje;

    alerta.style.position = 'fixed';
    alerta.style.top = '20px';
    alerta.style.left = '50%';
    alerta.style.transform = 'translateX(-50%)';
    alerta.style.background = '#ffffff';
    alerta.style.padding = '14px 22px';
    alerta.style.borderRadius = '12px';
    alerta.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
    alerta.style.fontWeight = '500';
    alerta.style.color = '#333';
    alerta.style.zIndex = '9999';
    alerta.style.opacity = '0';
    alerta.style.transition = 'all 0.4s ease';

    document.body.appendChild(alerta);

    // Animación entrada
    setTimeout(() => {
        alerta.style.opacity = '1';
        alerta.style.top = '30px';
    }, 50);

    // Auto desaparecer
    setTimeout(() => {
        alerta.style.opacity = '0';
        alerta.style.top = '10px';

        setTimeout(() => {
            alerta.remove();
        }, 400);

    }, 3000);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const formularios = document.querySelectorAll('.form-eliminar');

    formularios.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const confirmar = confirm('¿Estás seguro de que deseas eliminar esta propiedad?');

            if (confirmar) {
                form.submit();
            }
        });
    });

});
</script>

</x-propietario.layout>

