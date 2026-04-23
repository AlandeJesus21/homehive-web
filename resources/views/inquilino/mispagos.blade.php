<x-layout>
    <div class="container" style="max-width: 1200px;" title="Sección de historial de pagos del usuario">
        <div style="position: relative; border-bottom: 2px solid #99A1B7; margin-bottom: 40px; margin-top: 20px;">
            <h2 style="font-size: 20px; font-weight: 700; color: #1F2937; margin-bottom: 5px; display: inline-block;" title="Listado de pagos realizados">Mis pagos</h2>

            <form action="{{ route('pagos') }}" method="GET" 
                  style="position: absolute; right: 0; bottom: -85px; background: white; padding: 10px 20px; border-radius: 18px; box-shadow: 0 10px 20px rgba(0,0,0,0.15); display: flex; align-items: center; gap: 15px; z-index: 10;"
                  title="Filtrar pagos por rango de fechas">

                <div style="display: flex; flex-direction: column;">
                    <label style="font-size: 13px; font-weight: 600; color: #1F2937;" title="Fecha inicial del filtro">Desde</label>
                    <input type="date" 
                           name="desde" 
                           value="{{ request('desde') }}" 
                           style="border: 1px solid #D1D5DB; border-radius: 8px; padding: 2px 8px; font-size: 14px;"
                           title="Seleccionar fecha inicial">
                </div>

                <div style="display: flex; flex-direction: column;">
                    <label style="font-size: 13px; font-weight: 600; color: #1F2937;" title="Fecha final del filtro">Hasta</label>
                    <input type="date" 
                           name="hasta" 
                           value="{{ request('hasta') }}" 
                           style="border: 1px solid #D1D5DB; border-radius: 8px; padding: 2px 8px; font-size: 14px;"
                           title="Seleccionar fecha final">
                </div>

                <div style="width: 1px; height: 40px; background: #E5E7EB; margin: 0 5px;" title="Separador visual"></div>

                <button type="submit" 
                        style="border: none; background: transparent; cursor: pointer;"
                        title="Buscar pagos por fecha">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            </form>
        </div>

        <div style="background: white; border-radius: 25px; padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); margin-top: 120px;" title="Tabla de registros de pagos">
            <div class="table-responsive">
                <div style="min-width: 900px;">
                    <div style="background: #D7DCF3; border-radius: 8px; display: flex; align-items: center; padding: 15px 25px; margin-bottom: 20px;" title="Encabezados de la tabla de pagos">
                        <div style="width: 25%; font-weight: 700; color: #000; font-size: 16px;" title="Nombre de la propiedad">Propiedad</div>
                        <div style="width: 15%; font-weight: 700; color: #000; font-size: 16px;" title="Monto del pago">Monto</div>
                        <div style="width: 25%; font-weight: 700; color: #000; font-size: 16px;" title="Fecha en que se realizó el pago">Fecha de pago</div>
                        <div style="width: 15%; font-weight: 700; color: #000; font-size: 16px;" title="Estado del pago">Estatus</div>
                        <div style="width: 20%; font-weight: 700; color: #000; font-size: 16px; text-align: center;" title="Opciones disponibles">Acciones</div>
                    </div>

                    @forelse ($pagos as $pago)
                        <div style="display: flex; align-items: center; padding: 15px 25px; border-bottom: 1px solid #99A1B7;" title="Registro individual de pago">
                            <div style="width: 25%; color: #000; font-size: 15px;" title="Nombre de la propiedad">
                                {{ $pago->propiedad->titulo ?? 'Sin título' }}
                            </div>

                            <div style="width: 15%; color: #000; font-size: 15px;" title="Cantidad pagada">
                                ${{ number_format($pago->monto, 2) }}
                            </div>

                            <div style="width: 25%; color: #000; font-size: 15px;" title="Fecha exacta del pago">
                                {{ $pago->created_at->format('Y-m-d H:i:s') }}
                            </div>

                            <div style="width: 15%;" title="Estado actual del pago">
                                @php $isPendiente = $pago->status == 'pendiente'; @endphp
                                <span style="background: {{ $isPendiente ? '#FBBF24' : '#065F46' }}; color: {{ $isPendiente ? '#000' : '#FFF' }}; padding: 6px 15px; border-radius: 8px; font-size: 14px; display: inline-block; font-weight: 600; text-transform: capitalize;"
                                      title="{{ $isPendiente ? 'Pago pendiente' : 'Pago completado' }}">
                                    {{ $pago->status }}
                                </span>
                            </div>

                            <div style="width: 20%; text-align: center;" title="Acciones disponibles para este pago">
                                @if($pago->status == 'pendiente')
                                    <a href="{{ route('pagos.checkout', $pago->id) }}" 
                                       style="background: #FCE7E7; color: #000; border: 1.5px solid #7F1D1D; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; white-space: nowrap; display: inline-block;"
                                       title="Realizar pago pendiente">
                                       Pagar mensualidad
                                    </a>
                                @else
                                    <div class="dropdown" style="display: inline-block;">
                                        <button class="btn p-0 border-0" type="button" data-bs-toggle="dropdown" title="Mostrar opciones">
                                            <div style="background: #FCE7E7; border: 1.5px solid #7F1D1D; width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-three-dots-vertical" style="color: #7F1D1D;" title="Menú de acciones"></i>
                                            </div>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius: 12px; padding: 8px; min-width: 180px;" title="Opciones disponibles">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-2 py-2" 
                                                   href="{{ route('pagos.recibo', $pago->id) }}?download=1"
                                                   title="Descargar comprobante de pago">
                                                    <i class="bi bi-file-earmark-check text-success"></i> Descargar recibo
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-2 py-2" 
                                                   href="{{ route('pagos.contrato', $pago->id) }}"
                                                   title="Generar contrato relacionado al pago">
                                                    <i class="bi bi-file-earmark-text text-primary"></i> Generar contrato
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div style="padding: 40px; text-align: center; color: #6B7280;" title="No hay pagos registrados">
                            No se encontraron registros de pagos.
                        </div>
                    @endforelse
                </div>
            </div>

            @if(method_exists($pagos, 'links'))
                <div style="margin-top: 20px;" title="Navegación entre páginas de resultados">
                    {{ $pagos->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layout>