<x-propietario.layout>

<div style="background: linear-gradient(180deg, #D7DCF3 0%, #C5CBE6 100%); min-height: 100vh; padding: 60px 0;">
    <div class="container">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h3 class="fw-bold m-0" style="color:#1A1A1A;">Pagos</h3>

            <!-- FILTRO -->
            <form method="GET" action="{{ route('pagos.index') }}"
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
                        style="
                            border:none;
                            outline:none;
                            font-size:14px;
                            color:#374151;
                        ">
                </div>

                <!-- SEPARADOR -->
                <div style="width:1px; height:30px; background:#E5E7EB;"></div>

                <!-- HASTA -->
                <div class="d-flex align-items-center gap-2 px-2">
                    <span style="font-size: 13px; color:#6B7280; font-weight:600;">Hasta</span>
                    <input type="date" name="end_date"
                        value="{{ request('end_date') }}"
                        style="
                            border:none;
                            outline:none;
                            font-size:14px;
                            color:#374151;
                        ">
                </div>

                <!-- SEPARADOR -->
                <div style="width:1px; height:30px; background:#E5E7EB;"></div>

                <!-- BOTON -->
                <button type="submit"
                    style="
                        border:none;
                        background:transparent;
                        padding:0 5px;
                    ">
                    <img src="{{ asset('images/busqueda.png') }}" width="22">
                </button>

            </form>
        </div>

        <!-- CARD -->
        <div
            style="
                background:#FFFFFF;
                border-radius:20px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.08);
                padding: 25px;
            ">

            <div class="table-responsive">
                <table class="table align-middle mb-0">

                    <!-- HEADER TABLA -->
                    <thead>
                        <tr style="background:#C9D1EB;">
                            <th style="padding:18px 20px; border:none; border-radius:12px 0 0 12px;">Propiedad</th>
                            <th style="padding:18px; border:none;">Inquilino</th>
                            <th style="padding:18px; border:none;">Monto</th>
                            <th style="padding:18px; border:none;">Fecha de pago</th>
                            <th style="padding:18px; border:none;">Estatus</th>
                            <th style="padding:18px; border:none; border-radius:0 12px 12px 0; text-align:center;">Acciones</th>
                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody>
                        @forelse ($pagos as $pago)
                        <tr>

                            <td style="padding:20px; border-bottom:1px solid #E5E7EB;">
                                {{ $pago->propiedad->titulo }}
                            </td>

                            <td style="padding:20px; border-bottom:1px solid #E5E7EB;">
                                {{ $pago->inquilino->name }}
                            </td>

                            <td style="padding:20px; border-bottom:1px solid #E5E7EB;">
                                ${{ number_format($pago->monto, 2) }}
                            </td>

                            <td style="padding:20px; border-bottom:1px solid #E5E7EB;">
                                {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d \d\e M Y, h:i a') }}
                            </td>

                            <td style="padding:20px; border-bottom:1px solid #E5E7EB;">
                                <span
                                    style="
                                        background:#0F766E;
                                        color:white;
                                        padding:6px 16px;
                                        border-radius:8px;
                                        font-size:14px;
                                        font-weight:500;
                                    ">
                                    Pagado
                                </span>
                            </td>

                            <td style="padding:20px; text-align:center; border-bottom:1px solid #E5E7EB;">
                                <a href="#"
                                    style="
                                        border:1px solid #7F1D1D;
                                        background:#F5DCDC;
                                        color:#111827;
                                        padding:6px 14px;
                                        border-radius:8px;
                                        text-decoration:none;
                                        font-size:14px;
                                    ">
                                    Ver comprobante
                                </a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="padding:40px; text-align:center;">
                                No se encontraron registros.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>

</x-propietario.layout>