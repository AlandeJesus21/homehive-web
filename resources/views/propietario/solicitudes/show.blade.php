<x-layout>
    <main class="container-fluid" style="background: linear-gradient(180deg, #D7DCF3 0%, #ADB5D9 100%); min-height: 100vh;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="card bg-white border-0 shadow-lg rounded-5 overflow-hidden">
                        
                        <div class="p-4 p-md-5 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h1 class="fw-bold text-dark m-0 h2">Solicitud de renta</h1>
                                <span class="badge rounded-pill px-4 py-2 text-dark" 
                                      style="background-color: #F2D74D; font-size: 0.9rem;">
                                    {{ $solicitud->estatus }}
                                </span>
                            </div>
                            <hr class="border-secondary opacity-25 mt-4 mb-0">
                        </div>

                        <div class="px-4 px-md-5 mt-4">
                            <div class="d-flex align-items-center">
                                <img src="{{ $solicitud->aspirante->avatar ? asset('storage/' . $solicitud->aspirante->avatar) : asset('images/user.svg') }}" 
                                     class="rounded-circle shadow-sm" style="width:80px; height:80px; object-fit:cover;">
                                <div class="ms-4">
                                    <h4 class="fw-bold text-dark m-0">{{ $solicitud->aspirante->name }}</h4>
                                    <p class="text-secondary m-0">{{ $solicitud->ocupacion }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="px-4 px-md-5 mt-4">
                            <div class="row g-3 text-secondary" style="font-size: 1.1rem;">
                                <div class="col-sm-6">
                                    <p><i class="bi bi-cake me-3"></i> {{ $solicitud->edad }} años</p>
                                    <p><i class="bi bi-telephone me-3"></i> {{ $solicitud->telefono }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p><i class="bi bi-calendar3 me-3"></i> {{ \Carbon\Carbon::parse($solicitud->fecha)->format('d-m-Y') }}</p>
                                    <p><i class="bi bi-person-vcard me-3"></i> {{ $solicitud->curp }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 p-md-5 mt-5" style="background-color: #F8F9FA">
                            <div class="bg-white p-4 rounded-4 border shadow-sm">
                                <h5 class="fw-bold text-dark mb-3">Mensaje</h5>
                                <hr class="border-secondary opacity-25 mt-0 mb-3">
                                <p class="text-secondary lh-lg mb-0">{{ $solicitud->mensaje ?? 'Sin mensaje adicional.' }}</p>
                            </div>

                            <div class="d-flex justify-content-center gap-3 mt-5">
                                @if($solicitud->estatus == 'Pendiente')
                                    <form action="{{ route('propietario.solicitud.aceptar', $solicitud->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-lg px-5 text-white" style="background-color: #0B614B; border-radius: 12px;">Aceptar</button>
                                    </form>

                                    <form action="{{ route('propietario.solicitud.rechazar', $solicitud->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-lg px-5 text-white" style="background-color: #B40404; border-radius: 12px;">Rechazar</button>
                                    </form>
                                @endif

                                <a href="{{ route('solicitudes.index') }}" class="btn btn-lg px-5" style="background-color: #E2E2E2; border-radius: 12px;">Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>