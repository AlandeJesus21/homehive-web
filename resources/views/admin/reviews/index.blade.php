<x-admin.layout>
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

            <h4 class="fw-bold">Listado de comentarios</h4>

            <form method="GET" action="{{ route('reviews.search') }}" class="d-flex gap-2 flex-wrap align-items-end">

                <div>
                    <label class="form-label small">Desde</label>
                    <input type="date" name="start_date" class="form-control form-control-sm">
                </div>

                <div>
                    <label class="form-label small">Hasta</label>
                    <input type="date" name="end_date" class="form-control form-control-sm">
                </div>

                <button class="btn btn-sm mt-2">
                    <img src="{{ asset('images/busqueda.png') }}" alt="Buscar" width="20" height="20">

                </button>

            </form>

        </div>

        <div class="text-end mb-3">
            <a href="#" class="btn btn-light shadow-sm">
                ➕ Generar reporte
            </a>
        </div>

        <div class="table-card p-3">

            <div class="table-responsive">
                <table class="table align-middle">

                    <thead class="table-header text-center">
                        <tr>
                            <th>Nombre</th>
                            <th>Propiedad</th>
                            <th>Calificación</th>
                            <th>Comentario</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">

                        @forelse ($reviews as $r)
                        <tr>
                            <td>{{ $r->usuario->name }}</td>
                            <td>{{ $r->propiedad->titulo }}</td>
                            <td>@for ($i = 1; $i <= 5; $i++) <i
                                    class="bi bi-star{{ $i <= $r->rating ? '-fill' : '' }}"></i>
                                 @endfor</td>
                            <td>{{ $r->comentario }}</td>
                            <td>{{ $r->created_at->format('d/m/Y') }}</td>
                            <!-- ACCIONES -->
                            <td>
                                <div class="dropdown">
                                    <ul>
                                        <li>
                                            <form action="#" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item text-danger">
                                                    🗑 Eliminar
                                                </button>
                                            </form>
                                        </li>

                                    </ul>
                                </div>
                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="8">No hay reseñas</td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

    </div>
</x-admin.layout>