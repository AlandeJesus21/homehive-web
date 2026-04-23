<x-layout>

<div >
    <div class="container">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h3 class="fw-bold m-0 border-bottom border-secondary border-2 pb-1">Listado de Usuarios</h3>

            <!-- FILTRO -->
            <form method="GET" action="{{ route('users.search') }}"
                class="d-flex align-items-center shadow"
                style="
                    background: #FFFFFF;
                    border-radius: 40px;
                    padding: 10px 15px;
                    gap: 10px;
                ">

                <!-- DESDE -->
                <div class="d-flex align-items-center gap-2 px-2">
                    <span style="font-size: 13px; color:#6B7280; font-weight:600;">Desde</span>
                    <input type="date" name="start_date"
                        value="{{ request('start_date') }}"
                        style="border:none; outline:none; font-size:14px;">
                </div>

                <div style="width:1px; height:30px; background:#E5E7EB;"></div>

                <!-- HASTA -->
                <div class="d-flex align-items-center gap-2 px-2">
                    <span style="font-size: 13px; color:#6B7280; font-weight:600;">Hasta</span>
                    <input type="date" name="end_date"
                        value="{{ request('end_date') }}"
                        style="border:none; outline:none; font-size:14px;">
                </div>

                <div style="width:1px; height:30px; background:#E5E7EB;"></div>

                <!-- ROL -->
                <div class="d-flex align-items-center gap-2 px-2">
                    <span style="font-size: 13px; color:#6B7280; font-weight:600;">Usuario</span>
                    <select name="role" style="border:none; outline:none; font-size:14px;">
                        <option value="">Todos</option>
                        <option value="inquilino" {{ request('role') == 'inquilino' ? 'selected' : '' }}>Inquilino</option>
                        <option value="arrendador" {{ request('role') == 'arrendador' ? 'selected' : '' }}>Arrendador</option>
                    </select>
                </div>

                <div style="width:1px; height:30px; background:#E5E7EB;"></div>

                <!-- BOTON -->
                <button type="submit" style="border:none; background:transparent;">
                    <img src="{{ asset('images/busqueda.png') }}" width="22">
                </button>

            </form>
        </div>

        <!-- BOTON REPORTE -->
        <div class="mb-3 text-end">
            <a href="/reporte?{{ http_build_query(request()->all()) }}"
                style="
                    background:#FFFFFF;
                    border-radius:10px;
                    padding:8px 14px;
                    text-decoration:none;
                    color:#111827;
                    box-shadow: 0 5px 10px rgba(0,0,0,0.05);
                ">
                <i class="bi bi-plus"></i> Generar reporte
            </a>
        </div>

        <!-- CARD -->
        <div
            style="
                background:#FFFFFF;
                /* border-radius:20px; */
                box-shadow: 0 10px 25px rgba(0,0,0,0.08);
                padding: 25px;
            ">

            <div class="table-responsive">
                <table class="table align-middle mb-0">

                    <!-- HEADER TABLA -->
                    <thead>
                        <tr style="background:#C9D1EB;">
                            <th style="padding:18px 20px; border:none;">Nombre</th>
                            <th style="padding:18px; border:none;">Correo Electrónico</th>
                            <th style="padding:18px; border:none;">Rol</th>
                            <th style="padding:18px; border:none;">Fecha de Registro</th>
                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody>
                        @forelse ($users as $user)
                        <tr>

                            <td style="padding:20px; border-bottom:1px solid #E5E7EB;">
                                {{ $user->name }}
                            </td>

                            <td style="padding:20px; border-bottom:1px solid #E5E7EB;">
                                {{ $user->email }}
                            </td>

                            <td style="padding:20px; border-bottom:1px solid #E5E7EB;">
                                {{ ucfirst($user->role) }}
                            </td>

                            <td style="padding:20px; border-bottom:1px solid #E5E7EB;">
                                {{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d H:i:s') }}
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding:40px; text-align:center;">
                                No se encontraron usuarios.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>

</x-layout>