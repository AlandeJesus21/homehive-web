<x-admin.layout>
    <div class="container">
        <div class="mt-4 mb-3 fw-bold text-center">
            <h1>Gestión de usuarios</h1>
            <div class="d-flex justify-content-end">
                <a href="" class="btn btn-primary d-flex justify-content-end">Generar reporte</a>
            </div>
            <div class="row justify-content-center">
                <div class="table-responsive border shadow-sm">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="text-center">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>