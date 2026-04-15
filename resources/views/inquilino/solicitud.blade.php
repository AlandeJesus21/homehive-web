<x-inquilino.layout>
    <main class="container-fluid">
        <div class="row g-0">
            <div class="col-md-7 d-none d-md-block position-sticky top-0 p-0" style="height:100vh;">
                <img src="{{ asset('images/fondo-soli.jpeg') }}" class="w-100 h-100"
                    style="object-fit:cover; object-position:30% center;">
                <div class="position-absolute top-50 start-50 translate-middle text-center text-white p-4 w-100">
                    <p class="fs-5 fw-bold">
                        Da el siguiente paso hacia tu nuevo hogar.<br>
                        Completa tus datos y envía tu solicitud de renta en unos segundos.
                    </p>
                </div>
            </div>

            <div class="col-md-5 d-flex justify-content-center py-3 ">
                <div class="card shadow-lg p-4 my-3"
                    style="width:100%; max-width:500px; border-radius:15px; border:none;">

                    <h2 class="mb-4 fw-bold">Solicitud de renta</h2>

                    <form method="POST" action="{{ route('crearsolicitud', $propiedad->id)  }}" enctype="multipart/form-data">

                        @csrf
                        
                        <input type="hidden" name="titulo" value="{{ $propiedad->titulo }}">
                        <input type="hidden" name="precio" value="{{ $propiedad->precio }}">
                        

                        <div class="mb-3">
                            <label class="form-label">CURP:</label>
                            <input type="text" class="form-control" name="curp" maxlength="18" required 
                                   placeholder="Ingresa tu CURP">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Edad:</label>
                            <input type="number" class="form-control" name="edad" min="18" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ocupación:</label>
                            <input type="text" class="form-control" name="ocupacion" required 
                                   placeholder="Ej. Estudiante, Empleado">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha estimada de mudanza:</label>
                            <input type="date" class="form-control" name="fecha" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" name="telefono" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mensaje:</label>
                            <textarea class="form-control" name="mensaje" rows="4" 
                                      placeholder="Escriba un mensaje"></textarea>
                        </div>

                        <button type="submit" class="btn w-100 btn-lg shadow-sm boton">
                            Enviar Solicitud
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-inquilino.layout>