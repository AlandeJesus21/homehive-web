<x-inquilino.layout>



    <main class="container-fluid">
        <div class="container py-4">

            <div class="row justify-content-center">

                <div class="col-12 col-lg-10 col-xl-8">

                    <div class="card bg-white border-0 shadow rounded-5 overflow-hidden">

                        <div class="p-4 p-md-5 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h1 class="fw-bold text-dark m-0 h2">Solicitud de renta</h1>
                                <span class="badge rounded-pill px-4 py-2 text-dark"
                                    style="background-color: #F2D74D; font-size: 0.9rem;">{{ $solicitud->estatus }}</span>
                            </div>
                            <hr class="border-secondary opacity-25 mt-4 mb-0">
                        </div>

                        <div class="px-4 px-md-5 mt-4">
                            <div class="d-flex align-items-center ">
                                <img src="{{ optional($solicitud->aspirante)->avatar 
                                                ? asset('storage/' . $solicitud->aspirante->avatar) 
                                                : asset('images/user.svg') }}" 
                                            class="rounded-circle  shadow-sm"
                                            style="width:70px; height:70px; object-fit:cover; background-size: cover;" >
                                
                                <div class="ms-4">

                                    <h4 class="fw-bold text-dark m-0 h4">
                                        {{ $solicitud->aspirante->name}}</h4>
                                    <p class="text-secondary m-0">{{ $solicitud->ocupacion }}</p>
                                </div>

                            </div>
                        </div>

                        <div class="px-4 px-md-5 mt-4">
                            <div class="row g-3 text-secondary" style="font-size: 1.1rem;">
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-cake me-3"></i> 
                                        <!-- <svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-cake me-3" viewBox="0 0 16 16">
                                            <path
                                                d="m7.994.013-.595.79a.747.747 0 0 0 .101 1.01V4H5a2 2 0 0 0-2 2v3H2a2 2 0 0 0-2 2v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a2 2 0 0 0-2-2h-1V6a2 2 0 0 0-2-2H8.5V1.806A.747.747 0 0 0 8.592.802zM4 6a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v.414a.9.9 0 0 1-.646-.268 1.914 1.914 0 0 0-2.708 0 .914.914 0 0 1-1.292 0 1.914 1.914 0 0 0-2.708 0A.9.9 0 0 1 4 6.414zm0 1.414c.49 0 .98-.187 1.354-.56a.914.914 0 0 1 1.292 0c.748.747 1.96.747 2.708 0a.914.914 0 0 1 1.292 0c.374.373.864.56 1.354.56V9H4zM1 11a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.793l-.354.354a.914.914 0 0 1-1.293 0 1.914 1.914 0 0 0-2.707 0 .914.914 0 0 1-1.292 0 1.914 1.914 0 0 0-2.708 0 .914.914 0 0 1-1.292 0 1.914 1.914 0 0 0-2.708 0 .914.914 0 0 1-1.292 0L1 11.793zm11.646 1.854a1.915 1.915 0 0 0 2.354.279V15H1v-1.867c.737.452 1.715.36 2.354-.28a.914.914 0 0 1 1.292 0c.748.748 1.96.748 2.708 0a.914.914 0 0 1 1.292 0c.748.748 1.96.748 2.707 0a.914.914 0 0 1 1.293 0Z" />
                                        </svg> -->
                                        {{ $solicitud->edad }} años
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-telephone me-3"></i>
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-telephone me-3"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                                        </svg> -->
                                        {{ $solicitud->telefono }}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-calendar3 me-3"></i>
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-calendar me-3"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                        </svg> -->
                                        {{ \Carbon\Carbon::parse($solicitud->fecha)->format('d-m-Y') }}
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person-vcard me-3"></i>
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor"
                                            class="bi bi-credit-card-2-front me-3" viewBox="0 0 16 16">
                                            <path
                                                d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z" />
                                            <path
                                                d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                                        </svg> -->
                                        {{ $solicitud->curp }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 p-md-5 mt-5" style="background-color: #E9E9E9">

                            <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm">
                                <h5 class="fw-bold text-dark mb-3">Mensaje</h5>
                                <hr class="border-secondary opacity-25 mt-0 mb-4">
                                <p class="text-secondary lh-lg mb-0">
                                    {{ $solicitud->mensaje ?? 'Sin mensaje adicional.' }}
                                </p>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('solicitudes')}}" class="btn" style="background-color: #E2E2E2">
                                    Volver
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

</x-inquilino.layout>
