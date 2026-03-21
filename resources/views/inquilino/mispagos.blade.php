<x-inquilino.layout>

        <main class="container-fluid min-vh-100 main">
            <div class="container mt-5" style="padding: 40px">


                <div class="comentarios-encabezado">
                                <h2 class="section-title">Mis pagos</h2>
                                <p> Consulta el estado de tus pagos, realiza tu mensualidad correspondiente y descarga tu recibo de manera rápida y segura.</p>
                            </div>


                <div class="custom-card p-4 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead class="header-solicitudes">
                                <tr>
                                    <th class="py-3 ps-4 text-center">Propiedad</th>
                                    <th class="py-3 text-center">Monto</th>
                                    <th class="py-3 text-center">Fecha de pago</th>
                                    <th class="py-3 text-center">Estatus</th>
                                    <th class="py-3 text-center pe-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    <td class="ps-4">Las lomas</td>
                                    <td>$1000.00</td>
                                    <td></td>
                                    <td class="text-center">
                                        <span class="badge bg-success-custom">Aceptado</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm rounded-pill px-3" type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots"></i> •••
                                            </button>
                                            <ul class="dropdown-menu shadow border-0">
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-eye"></i> Ver
                                                        solicitud</a></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i
                                                            class="bi bi-slash-circle"></i> Cancelar</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            </div>


        </main>


</x-inquilino.layout>


