<div class="prop-card">

    @php
        $imagen = $propiedad->imagenes->first();
    @endphp

    <!-- IMAGEN -->
    <div class="prop-img">
        @if($imagen)
        <img src="{{ $imagen ? asset('storage/' . $imagen->ruta) : 'https://via.placeholder.com/300x200' }}">
         @else
         <div class="bg-light rounded-4 d-flex align-items-center justify-content-center"
            style="height: 180px;">
            <small>Sin foto</small>
         </div>
        @endif
    </div>

    <div class="prop-body">

        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="prop-price">${{ $propiedad->precio }}</span>
            @auth
            <form action="{{ route('misfavoritos', $propiedad->id) }}" method="POST"
                class="m-0">
                @csrf
                <button type="submit" class="btn p-0 border-0 shadow-none">
                    @if (auth()->user()->favoritos->contains($propiedad->id))
                    <i class="bi bi-bookmark-fill text-dark" style="font-size: 1.2rem;"></i>
                    @else
                    <i class="bi bi-bookmark text-secondary" style="font-size: 1.2rem;"></i>
                    @endif
                </button>
            </form>
            @endauth
        </div>

        <div class="prop-title">
            {{ $propiedad->titulo }}
        </div>

        <div class="prop-location">
            {{ $propiedad->barrio->nombre }}, {{ $propiedad->calle }}
        </div>

        <a href="{{ route('main.vermas', $propiedad->id) }}"
           class="btn btn-primary w-100 mt-3 prop-btn">
            Ver más
        </a>

    </div>

</div>