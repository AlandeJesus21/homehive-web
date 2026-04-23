<x-layout>

    <main class="container-fluid" title="Sección para visualizar y gestionar solicitudes de renta">
        <div class="container py-5">
            <div class="d-flex flex-column mb-4 gap-3">
                <div>
                    <h2 class="fw-bold m-0 border-bottom border-secondary border-2 pb-1" title="Listado de solicitudes realizadas">Mis solicitudes</h2>
                </div>
                
                <div class="d-flex justify-content-end">
                    <div class="d-inline-flex align-items-center bg-white rounded-4 shadow-sm border px-4 py-2" title="Filtro por rango de fechas">
                        <div class="px-3">
                            <label class="d-block small fw-semibold text-dark mb-1" title="Fecha inicial">Desde</label>
                            <input type="date" 
                                id="fechaDesde"
                                class="form-control form-control-sm border rounded-3 px-2 text-muted" 
                                value="2026-02-07"
                                style="font-size: 0.85rem;"
                                title="Selecciona la fecha inicial">
                        </div>

                        <div class="px-3">
                            <label class="d-block small fw-semibold text-dark mb-1" title="Fecha final">Hasta</label>
                            <input type="date" 
                                id="fechaHasta"
                                class="form-control form-control-sm border rounded-3 px-2 text-muted" 
                                value="2026-02-08"
                                style="font-size: 0.85rem;"
                                title="Selecciona la fecha final">
                        </div>

                        <div class="vr mx-2 opacity-25" style="height: 40px;" title="Separador visual"></div>

                        <button id="btnFiltrar" 
                                class="btn btn-link text-dark ms-2 p-0"
                                title="Filtrar solicitudes por fecha">
                            <i class="bi bi-search fs-4 fw-bold" title="Buscar"></i> 
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-5 shadow-sm p-4" title="Tabla de solicitudes">
                <div class="table-responsive">
                    <table class="table align-middle" title="Listado de solicitudes">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4 py-3 border-0" style="background-color: #d1d9f0;" title="Nombre de la propiedad">Propiedad</th>
                                <th class="py-3 border-0" style="background-color: #d1d9f0;" title="Precio de la propiedad">Precio</th>
                                <th class="py-3 border-0" style="background-color: #d1d9f0;" title="Fecha en que se realizó la solicitud">Fecha de solicitud</th>
                                <th class="py-3 border-0" style="background-color: #d1d9f0;" title="Estado de la solicitud">Estatus</th>
                                <th class="pe-4 py-3 border-0 text-center" style="background-color: #d1d9f0;" title="Acciones disponibles">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @foreach ($solicitudes as $solicitud)
                                <tr title="Registro de solicitud">
                                    <td class="ps-4" title="Nombre de la propiedad">{{ $solicitud->propiedad }}</td>
                                    <td title="Precio de la solicitud">${{ number_format($solicitud->precio, 2) }}</td>
                                    <td title="Fecha de creación">{{ $solicitud->created_at->format('d/m/Y H:i') }}</td>
                                    <td title="Estado actual">
                                        @php
                                            $color = 'bg-warning text-dark';
                                            if ($solicitud->estatus == 'Aceptado') {
                                                $color = 'bg-success text-white';
                                            }
                                            if ($solicitud->estatus == 'Rechazado') {
                                                $color = 'bg-danger text-white';
                                            }
                                        @endphp
                                        <span class="badge rounded-pill {{ $color }} px-3"
                                              title="Estado: {{ $solicitud->estatus }}">
                                            {{ $solicitud->estatus }}
                                        </span>
                                    </td>

                                    <td class="text-center align-middle" title="Opciones disponibles">
                                        <div class="dropdown">
                                            <button class="btn border-0 shadow-sm px-3"
                                                style="background-color: #f3e2e2; border-radius: 8px;"
                                                data-bs-toggle="dropdown"
                                                title="Mostrar acciones">
                                                <i class="bi bi-three-dots" title="Menú"></i>
                                            </button>

                                            <ul class="dropdown-menu shadow border-0 rounded-3 py-2" title="Opciones de solicitud">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3 py-2"
                                                        href="{{ route('inquilino.versolicitud', $solicitud->id) }}"
                                                        title="Ver detalles de la solicitud">
                                                        <i class="bi bi-eye fs-5"></i>
                                                        <span class="fw-normal">Ver solicitud</span>
                                                    </a>
                                                </li>

                                                @if($solicitud->estatus !== 'Aceptado')
                                                    <li>
                                                        <form action="{{ route('cancelarsolicitud', $solicitud->id) }}" 
                                                              method="POST" 
                                                              onsubmit="return confirm('¿Estás seguro de que deseas cancelar y eliminar esta solicitud?');"
                                                              title="Cancelar solicitud">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item d-flex align-items-center gap-3 py-2 text-danger" 
                                                                    type="submit"
                                                                    title="Eliminar solicitud">
                                                                <i class="bi bi-slash-circle fs-5"></i>
                                                                <span class="fw-normal">Cancelar</span>
                                                            </button>
                                                        </form>
                                                    </li>
                                                @else
                                                    <li>
                                                        <span class="dropdown-item d-flex align-items-center gap-3 py-2 text-muted italic"
                                                              title="No se puede cancelar una solicitud aceptada">
                                                            <i class="bi bi-info-circle fs-5"></i>
                                                            <span class="fw-normal">No se puede cancelar (Aceptado)</span>
                                                        </span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const btn = document.getElementById('btnFiltrar');
                const inputDesde = document.getElementById('fechaDesde');
                const inputHasta = document.getElementById('fechaHasta');

                btn.addEventListener('click', function() {
                    const desde = new Date(inputDesde.value + "T00:00:00");
                    const hasta = new Date(inputHasta.value + "T23:59:59");

                    const filas = document.querySelectorAll('table tbody tr');

                    filas.forEach(fila => {
                        const celdaFecha = fila.cells[2];

                        if (celdaFecha) {
                            const partes = celdaFecha.innerText.split(' ')[0].split('/');
                            const fechaFila = new Date(
                                `${partes[2]}-${partes[1]}-${partes[0]}T12:00:00`
                            );

                            if (fechaFila >= desde && fechaFila <= hasta) {
                                fila.style.display = "";
                            } else {
                                fila.style.display = "none";
                            }
                        }
                    });
                });
            });
        </script>

    </main>

</x-layout>