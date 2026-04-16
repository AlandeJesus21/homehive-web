<x-inquilino.layout>
    <div style="background: linear-gradient(180deg, #D7DCF3 0%, #ADB5D9 100%); padding: 20px 0 60px 0; font-family: 'Segoe UI', sans-serif; min-height: 100vh;">
        <div class="container" style="max-width: 1200px;">

            <div style="position: relative; border-bottom: 2px solid #99A1B7; margin-bottom: 40px; margin-top: 20px;">
                <h2 style="font-size: 20px; font-weight: 700; color: #1F2937; margin-bottom: 5px; display: inline-block;">
                    Mis pagos
                </h2>
                
                <form action="{{ route('pagos') }}" method="GET" style="position: absolute; right: 0; bottom: -85px; background: white; padding: 10px 20px; border-radius: 18px; box-shadow: 0 10px 20px rgba(0,0,0,0.15); display: flex; align-items: center; gap: 15px; z-index: 10;">
                    <div style="display: flex; flex-direction: column;">
                        <label style="font-size: 13px; font-weight: 600; color: #1F2937;">Desde</label>
                        <input type="date" name="desde" value="{{ request('desde') }}" style="border: 1px solid #D1D5DB; border-radius: 8px; padding: 2px 8px; font-size: 14px;">
                    </div>
                    
                    <div style="display: flex; flex-direction: column;">
                        <label style="font-size: 13px; font-weight: 600; color: #1F2937;">Hasta</label>
                        <input type="date" name="hasta" value="{{ request('hasta') }}" style="border: 1px solid #D1D5DB; border-radius: 8px; padding: 2px 8px; font-size: 14px;">
                    </div>
                    
                    <div style="width: 1px; height: 40px; background: #E5E7EB; margin: 0 5px;"></div>
                    
                    <button type="submit" style="border: none; background: transparent; cursor: pointer;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </form>
            </div>

            <div style="background: white; border-radius: 25px; padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); margin-top: 120px;">
                
                <div style="background: #D7DCF3; border-radius: 8px; display: flex; align-items: center; padding: 15px 25px; margin-bottom: 20px;">
                    <div style="width: 25%; font-weight: 700; color: #000; font-size: 16px;">Propiedad</div>
                    <div style="width: 15%; font-weight: 700; color: #000; font-size: 16px;">Monto</div>
                    <div style="width: 25%; font-weight: 700; color: #000; font-size: 16px;">Fecha de pago</div>
                    <div style="width: 15%; font-weight: 700; color: #000; font-size: 16px;">Estatus</div>
                    <div style="width: 20%; font-weight: 700; color: #000; font-size: 16px; text-align: center;">Acciones</div>
                </div>

                @forelse ($pagos as $pago)
                    <div style="display: flex; align-items: center; padding: 15px 25px; border-bottom: 1px solid #99A1B7;">
                        <div style="width: 25%; color: #000; font-size: 15px;">
                            {{ $pago->propiedad->titulo ?? 'Sin título' }}
                        </div>
                        <div style="width: 15%; color: #000; font-size: 15px;">
                            ${{ number_format($pago->monto, 2) }}
                        </div>
                        <div style="width: 25%; color: #000; font-size: 15px;">
                            {{ $pago->created_at->format('Y-m-d H:i:s') }}
                        </div>
                        <div style="width: 15%;">
                            @php
                                $isPendiente = $pago->status == 'pendiente';
                            @endphp
                            <span style="background: {{ $isPendiente ? '#FBBF24' : '#065F46' }}; color: {{ $isPendiente ? '#000' : '#FFF' }}; padding: 6px 15px; border-radius: 8px; font-size: 14px; display: inline-block; font-weight: 600; text-transform: capitalize;">
                                {{ $pago->status }}
                            </span>
                        </div>
                        <div style="width: 20%; text-align: center;">
                            @if($pago->status == 'pendiente')
                                <a href="{{ route('pagos.checkout', $pago->id) }}" 
                                style="background: #FCE7E7; color: #000; border: 1.5px solid #7F1D1D; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; white-space: nowrap;">
                                    Pagar mensualidad
                                </a>
                            @else
                                <a href="{{ route('pagos.recibo', $pago->id) }}" target="_blank" style="background: #FCE7E7; color: #000; border: 1.5px solid #7F1D1D; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; white-space: nowrap;">
                                    Descargar recibo
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div style="padding: 40px; text-align: center; color: #6B7280;">
                        No se encontraron registros de pagos.
                    </div>
                @endforelse

                @if(method_exists($pagos, 'links'))
                    <div style="margin-top: 20px;">
                        {{ $pagos->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-inquilino.layout>