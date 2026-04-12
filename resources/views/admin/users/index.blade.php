<x-admin.layout>
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

            <h4 class="fw-bold">Listado de usuarios</h4>

            <form method="GET" action="{{ route('users.search') }}" class="d-flex gap-2 flex-wrap align-items-end">

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
                    <select name="role" class="form-select form-select-sm">
                        <option value="">Todos</option>
                        <option value="inquilino" {{ request('role') == 'inquilino' ? 'selected' : '' }}>Inquilinos
                        </option>
                        <option value="propietario" {{ request('role') == 'propietario' ? 'selected' : '' }}>
                            Propietarios</option>
                    </select>
                </div>

                <button class="btn btn-sm mt-2">
                    <img src="{{ asset('images/busqueda.png') }}" alt="Buscar" width="20" height="20">

                </button>

            </form>

        </div>

        <div class="text-end mb-3">
            <a href="/reporte" class="btn btn-light shadow-sm">
                ➕ Generar reporte
            </a>
        </div>

        <div class="table-card p-3">

            @isset($users)
            <div class="mb-2 fw-bold">
                Total de usuarios: {{ $users->count() }}
            </div>
            @endisset

            <div class="table-responsive">
                <table class="table align-middle">

                    <thead class="table-header text-center">
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">

                        @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>

                            <td>
                                <span class="badge 
                                {{ $user->role == 'admin' ? 'bg-dark' : '' }}
                                {{ $user->role == 'propietario' ? 'bg-primary' : '' }}
                                {{ $user->role == 'inquilino' ? 'bg-success' : '' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No se encontraron resultados</td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

    </div>
</x-admin.layout>