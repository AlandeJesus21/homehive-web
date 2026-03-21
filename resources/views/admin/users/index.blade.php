<x-admin.layout>
    <div class="container">

        <div class="mt-4 mb-4 text-center">
            <h1 class="fw-bold">Generar Reporte de Usuarios</h1>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <form method="GET" action="/reporte">

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Tipo de usuario</label>
                            <select name="role" class="form-select">
                                <option value="">Todos</option>
                                <option value="inquilino">Inquilinos</option>
                                <option value="propietario">Propietarios</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Fecha inicio</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Fecha fin</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>

                    </div>

                    <div class="mt-3 text-end">
                        <button type="submit" class="btn btn-primary">
                            Generar reporte
                        </button>
                    </div>

                </form>

            </div>
        </div>

        @isset($users)

        <div class="mb-2 fw-bold">
            Total de usuarios: {{ $users->count() }}
        </div>

        <div class="table-responsive border shadow-sm">
            <table class="table table-striped table-hover align-middle mb-0">

                <thead class="table-dark text-center">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha registro</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                    <tr class="text-center">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No se encontraron resultados</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        @endisset

    </div>
</x-admin.layout>