<x-propietario.layout>
    <div style="background: linear-gradient(180deg, #D7DCF3 0%, #ADB5D9 100%); padding: 20px 0 60px 0; font-family: 'Segoe UI', sans-serif;">
        <div class="container" style="max-width: 1200px;">

            <div style="position: relative; border-bottom: 2px solid #99A1B7; margin-bottom: 40px; margin-top: 20px;">
                <h2 style="font-size: 20px; font-weight: 700; color: #1F2937; margin-bottom: 5px; display: inline-block;">
                    Pagos
                </h2>
                
                <div style="position: absolute; right: 0; bottom: -85px; background: white; padding: 10px 20px; border-radius: 18px; box-shadow: 0 10px 20px rgba(0,0,0,0.15); display: flex; align-items: center; gap: 15px; z-index: 10;">
                    <div style="display: flex; flex-direction: column;">
                        <label style="font-size: 13px; font-weight: 600; color: #1F2937;">Desde</label>
                        <input type="date" value="2026-02-07" style="border: 1px solid #D1D5DB; border-radius: 8px; padding: 2px 8px; font-size: 14px;">
                    </div>
                    
                    <div style="display: flex; flex-direction: column;">
                        <label style="font-size: 13px; font-weight: 600; color: #1F2937;">Hasta</label>
                        <input type="date" value="2026-02-08" style="border: 1px solid #D1D5DB; border-radius: 8px; padding: 2px 8px; font-size: 14px;">
                    </div>
                    
                    <div style="width: 1px; height: 40px; background: #E5E7EB; margin: 0 5px;"></div>
                    
                    <button style="border: none; background: transparent;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </div>
            </div>

            <div style="background: white; border-radius: 25px; padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); margin-top: 120px;">
                
                <div style="background: #D7DCF3; border-radius: 8px; display: flex; align-items: center; padding: 15px 25px; margin-bottom: 20px;">
                    <div style="width: 20%; font-weight: 700; color: #000; font-size: 16px;">Propiedad</div>
                    <div style="width: 20%; font-weight: 700; color: #000; font-size: 16px;">Inquilino</div>
                    <div style="width: 15%; font-weight: 700; color: #000; font-size: 16px;">Monto</div>
                    <div style="width: 25%; font-weight: 700; color: #000; font-size: 16px;">Fecha de pago</div>
                    <div style="width: 10%; font-weight: 700; color: #000; font-size: 16px;">Estatus</div>
                    <div style="width: 10%; font-weight: 700; color: #000; font-size: 16px; text-align: center;">Acciones</div>
                </div>

                @forelse ($pagos as $pago)
                    <div style="display: flex; align-items: center; padding: 15px 25px; border-bottom: 1px solid #99A1B7;">
                        <div style="width: 20%; color: #000; font-size: 15px;">
                            {{ $pago->propiedad->titulo }}
                        </div>
                        <div style="width: 20%; color: #000; font-size: 15px; padding-right: 10px;">
                            {{ $pago->inquilino->name }}
                        </div>
                        <div style="width: 15%; color: #000; font-size: 15px;">
                            ${{ number_format($pago->monto, 2) }}
                        </div>
                        <div style="width: 25%; color: #000; font-size: 15px;">
                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d \d\e M Y, h:i a') }}
                        </div>
                        <div style="width: 10%;">
                            <span style="background: #065F46; color: white; padding: 6px 15px; border-radius: 8px; font-size: 14px; display: inline-block;">
                                Pagado
                            </span>
                        </div>
                        <div style="width: 10%; text-align: center;">
                            <a href="#" style="background: #FCE7E7; color: #000; border: 1.5px solid #7F1D1D; padding: 6px 12px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 500; white-space: nowrap;">
                                Ver comprobante
                            </a>
                        </div>
                    </div>
                @empty
                    <div style="padding: 40px; text-align: center; color: #6B7280;">
                        No se encontraron registros.
                    </div>
                @endforelse

                <div style="border-top: 1px solid #99A1B7; margin-top: 20px;"></div>
            </div>
        </div>
    </div>
</x-propietario.layout>