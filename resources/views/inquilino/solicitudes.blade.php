<x-layout>
    <main class="container-fluid" style="font-family: Arial, sans-serif; margin-bottom: 60px;">
        <div class="container py-5">
            <div class="d-flex flex-column mb-4 gap-3">
                <div style="position: relative; border-bottom: 2px solid #99A1B7; margin-bottom: 40px; margin-top: 20px;">
                    <h2 class="fw-bold m-0 pb-1" style="font-size: 20px; color: #1F2937; display: inline-block;">Mis solicitudes</h2>
                    
                    <form action="{{ route('solicitudes') }}" method="GET" style="position: absolute; right: 0; bottom: -85px; background: white; padding: 10px 20px; border-radius: 18px; box-shadow: 0 10px 20px rgba(0,0,0,0.15); display: flex; align-items: center; gap: 15px; z-index: 10;">
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
            </div>

            <div class="bg-white rounded-5 shadow-sm p-4" style="margin-top: 80px;">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4 py-3 border-0" style="background-color: #d1d9f0; font-weight: 700; color: #000;">Propiedad</th>
                                <th class="py-3 border-0" style="background-color: #d1d9f0; font-weight: 700; color: #000;">Precio</th>
                                <th class="py-3 border-0" style="background-color: #d1d9f0; font-weight: 700; color: #000;">Fecha de solicitud</th>
                                <th class="py-3 border-0" style="background-color: #d1d9f0; font-weight: 700; color: #000;">Estatus</th>
                                <th class="pe-4 py-3 border-0 text-center" style="background-color: #d1d9f0; font-weight: 700; color: #000;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @foreach ($solicitudes as $solicitud)
                                <tr style="border-bottom: 1px solid #99A1B7;">
                                    <td class="ps-4" style="color: #000;">{{ $solicitud->propiedad }}</td>
                                    <td style="color: #000;">${{ number_format($solicitud->precio, 2) }}</td>
                                    <td style="color: #000;">{{ $solicitud->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @php
                                            $colorStatus = match($solicitud->estatus) {
                                                'Pendiente' => '#FBBF24',
                                                'Aceptado', 'Aceptada' => '#065F46',
                                                'Rechazado', 'Rechazada' => '#DC2626',
                                                default => '#6B7280'
                                            };
                                        @endphp
                                        <span style="background: {{ $colorStatus }}; color: white; padding: 6px 15px; border-radius: 8px; font-size: 14px; display: inline-block; font-weight: 600;">
                                            {{ $solicitud->estatus }}
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="dropdown">
                                            <button class="btn border-0 shadow-sm px-3"
                                                style="background-color: #f3e2e2; border: 1.5px solid #7F1D1D; border-radius: 8px;"
                                                data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots" style="color: #7F1D1D;"></i>
                                            </button>

                                            <ul class="dropdown-menu shadow border-0 rounded-3 py-2" style="font-family: Arial;">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3 py-2"
                                                        href="{{ route('inquilino.versolicitud', $solicitud->id) }}">
                                                        <i class="bi bi-eye fs-5"></i>
                                                        <span class="fw-normal">Ver solicitud</span>
                                                    </a>
                                                </li>
                                                @if($solicitud->estatus !== 'Aceptado' && $solicitud->estatus !== 'Aceptada')
                                                    <li>
                                                        <form action="{{ route('cancelarsolicitud', $solicitud->id) }}" method="POST" 
                                                            onsubmit="return confirm('¿Estás seguro de que deseas cancelar y eliminar esta solicitud?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item d-flex align-items-center gap-3 py-2 text-danger" type="submit">
                                                                <i class="bi bi-slash-circle fs-5"></i>
                                                                <span class="fw-normal">Cancelar</span>
                                                            </button>
                                                        </form>
                                                    </li>
                                                @else
                                                    <li>
                                                        <span class="dropdown-item d-flex align-items-center gap-3 py-2 text-muted italic">
                                                            <i class="bi bi-info-circle fs-5"></i>
                                                            <span class="fw-normal">No cancelable</span>
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
    </main>
</x-layout>