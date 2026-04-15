<x-inquilino.layout>

    <main class="container-fluid">
        <div class="container py-5">
            <div class="d-flex flex-column mb-4  gap-3">
                <div>
                    <h2 class="fw-bold m-0 border-bottom border-secondary border-2 pb-1">Mis solicitudes</h2>
                </div>
                
                <div class="d-flex justify-content-end" >
                    <div class="d-inline-flex align-items-center bg-white rounded-4 shadow-sm border px-4 py-2">
                        <div class="px-3">
                            <label class="d-block small fw-semibold text-dark mb-1">Desde</label>
                            <input type="date" id="fechaDesde"
                                class="form-control form-control-sm border rounded-3 px-2 text-muted" value="2026-02-07"
                                style="font-size: 0.85rem;">
                        </div>

                    <div class="px-3">
                        <label class="d-block small fw-semibold text-dark mb-1">Hasta</label>
                        <input type="date" id="fechaHasta"
                            class="form-control form-control-sm border rounded-3 px-2 text-muted" value="2026-02-08"
                            style="font-size: 0.85rem;">
                    </div>
                    <div class="vr mx-2 opacity-25" style="height: 40px;"></div>

                        <button id="btnFiltrar" class="btn btn-link text-dark ms-2 p-0">
                            <i class="bi bi-search fs-4 fw-bold">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg>-->
                            </i> 
                        </button>
                </div>

            </div>
            
        

            <div class="bg-white rounded-5 shadow-sm p-4">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4 py-3 border-0" style="background-color: #d1d9f0;">Propiedad</th>
                                <th class="py-3 border-0" style="background-color: #d1d9f0;">Precio</th>
                                <th class="py-3 border-0" style="background-color: #d1d9f0;">Fecha de solicitud</th>
                                <th class="py-3 border-0" style="background-color: #d1d9f0;">Estatus</th>
                                <th class="pe-4 py-3 border-0 text-center" style="background-color: #d1d9f0;">Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @foreach ($solicitudes as $solicitud)
                                <tr>
                                    <td class="ps-4">{{ $solicitud->propiedad }}</td>
                                    <td>${{ number_format($solicitud->precio, 2) }}</td>
                                    <td>{{ $solicitud->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @php
                                            $color = 'bg-warning text-dark';
                                            if ($solicitud->estatus == 'Aceptado') {
                                                $color = 'bg-success text-white';
                                            }
                                            if ($solicitud->estatus == 'Rechazado') {
                                                $color = 'bg-danger text-white';
                                            }
                                        @endphp
                                        <span class="badge rounded-pill {{ $color }} px-3">
                                            {{ $solicitud->estatus }}
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="dropdown">
                                            <button class="btn border-0 shadow-sm px-3"
                                                style="background-color: #f3e2e2; border-radius: 8px;"
                                                data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots"></i>
                                            </button>

                                            <ul class="dropdown-menu shadow border-0 rounded-3 py-2">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3 py-2"
                                                        href="{{ route('versolicitud', $solicitud->id) }}">
                                                        <i class="bi bi-eye fs-5"></i>
                                                        <span class="fw-normal">
                                                            <!-- <svg xmlns="http://www.w3.org/2000/svg"
                                                                width="16" height="16" fill="currentColor"
                                                                class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                                <path
                                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                            </svg> -->
                                                            Ver solicitud</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item d-flex align-items-center gap-3 py-2"
                                                        type="button">
                                                        <i class="bi bi-slash-circle text-danger fs-5"></i>
                                                        <span class="fw-normal">
                                                            <!-- <svg xmlns="http://www.w3.org/2000/svg"
                                                                width="16" height="16" fill="currentColor"
                                                                class="bi bi-ban" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />
                                                            </svg> -->
                                                            Cancelar</span>
                                                    </button>
                                                </li>
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
                    // Convertimos los valores de los inputs a objetos Date para comparar
                    // Usamos "00:00" y "23:59" para incluir todo el día seleccionado
                    const desde = new Date(inputDesde.value + "T00:00:00");
                    const hasta = new Date(inputHasta.value + "T23:59:59");

                    // Seleccionamos todas las filas del cuerpo de la tabla
                    const filas = document.querySelectorAll('table tbody tr');

                    filas.forEach(fila => {
                        // Buscamos la celda que tiene la fecha (es la tercera columna, índice 2)
                        const celdaFecha = fila.cells[2];

                        if (celdaFecha) {
                            // Convertimos el texto de la celda (dd/mm/yyyy) a un formato que JS entienda
                            const partes = celdaFecha.innerText.split(' ')[0].split('/');
                            const fechaFila = new Date(
                                `${partes[2]}-${partes[1]}-${partes[0]}T12:00:00`);

                            // Si la fecha está en el rango, mostramos; si no, ocultamos
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


</x-inquilino.layout>
