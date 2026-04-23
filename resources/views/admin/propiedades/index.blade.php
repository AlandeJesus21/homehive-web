<x-layout>
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

            <h4 class="fw-bold m-0 border-bottom border-secondary border-2 pb-1">Listado de propiedades</h4>

            <form method="GET" action="{{ route('propiedades.search') }}"
                class="d-flex gap-2 flex-wrap align-items-end">

                <div>
                    <label class="form-label small">Desde</label>
                    <input type="date" value="{{ request('start_date') }}" name="start_date"
                        class="form-control form-control-sm">
                </div>

                <div>
                    <label class="form-label small">Hasta</label>
                    <input type="date" value="{{ request('end_date') }}" name="end_date"
                        class="form-control form-control-sm">
                </div>

                <div>
                    <label class="form-label small">Tipo</label>
                    <select name="tipo" class="form-select border-0">
                        <option value="">Todos</option>
                        <option value="casa" {{ request('tipo') == 'casa' ? 'selected' : '' }}>Casa</option>
                        <option value="departamento" {{ request('tipo') == 'departamento' ? 'selected' : '' }}>
                            Departamento</option>
                        <option value="cuarto" {{ request('tipo') == 'cuarto' ? 'selected' : '' }}>Cuarto</option>
                    </select>
                </div>

                <button class="btn btn-sm mt-2">
                    <img src="{{ asset('images/busqueda.png') }}" alt="Buscar" width="20" height="20">

                </button>

            </form>

        </div>

        <div class="text-end mb-3">
            <a href="/reportepropiedades?{{ http_build_query(request()->all()) }}" class="btn btn-light shadow-sm">
                <i class="bi bi-plus"></i>Generar reporte
            </a>
        </div>

        <div class="table-card p-3">

            <div class="table-responsive">
                <table class="table align-middle">

                    <thead class="table-header text-center">
                        <tr>
                            <th>Nombre</th>
                            <th>Barrio</th>
                            <th>Calle</th>
                            <th>Precio</th>
                            <th>Tipo</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">

                        @forelse ($propiedades as $propiedad)
                        <tr>
                            <td>{{ $propiedad->titulo }}</td>
                            <td>{{ $propiedad->barrio->nombre }}</td>
                            <td>{{ $propiedad->calle }}</td>
                            <td>${{ $propiedad->precio }}</td>
                            <td>{{ ucfirst($propiedad->tipo) }}</td>

                            <!-- ESTATUS -->
                            <td>
                                <span class="badge 
                                {{ $propiedad->estatus == 'activo' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($propiedad->estatus) }}
                                </span>
                            </td>

                            <!-- IMAGEN -->
        

                            <!-- ACCIONES -->
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm" data-bs-toggle="dropdown">
                                        ⋯
                                    </button>

                                    <ul class="dropdown-menu">

                                        <li>
                                            <a class="dropdown-item" href="#">
                                                👁 Ver
                                            </a>
                                        </li>

                                        <li>
                                            <form action="#" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item text-danger">
                                                    🗑 Eliminar
                                                </button>
                                            </form>
                                        </li>

                                        <li>
                                            <a class="dropdown-item text-warning" href="#">
                                                🚫 Suspender
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="8">No hay propiedades</td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

    </div>
</x-layout>