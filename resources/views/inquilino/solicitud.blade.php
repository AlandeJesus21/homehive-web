<x-layout>
    <main class="container-fluid" title="Formulario para enviar solicitud de renta">
        <div class="row g-0">
            <div class="col-md-7 d-none d-md-block position-sticky top-0 p-0" style="height:100vh;" title="Imagen ilustrativa del proceso de renta">
                <img src="{{ asset('images/fondo-soli.jpeg') }}" 
                     class="w-100 h-100"
                     style="object-fit:cover; object-position:30% center;"
                     alt="Fondo de solicitud de renta"
                     title="Imagen representativa de renta">
                <div class="position-absolute top-50 start-50 translate-middle text-center text-white p-4 w-100" title="Mensaje informativo">
                    <p class="fs-5 fw-bold" title="Descripción del proceso de solicitud">
                        Da el siguiente paso hacia tu nuevo hogar.<br>
                        Completa tus datos y envía tu solicitud de renta en unos segundos.
                    </p>
                </div>
            </div>

            <div class="col-md-5 d-flex justify-content-center py-3" title="Formulario de captura de datos">
                <div class="card shadow-lg p-4 my-3"
                    style="width:100%; max-width:500px; border-radius:15px; border:none;"
                    title="Tarjeta de solicitud de renta">

                    <h2 class="mb-4 fw-bold" title="Título del formulario">Solicitud de renta</h2>

                    <form method="POST" 
                          action="{{ route('crearsolicitud', $propiedad->id) }}" 
                          enctype="multipart/form-data"
                          title="Formulario para enviar solicitud">

                        @csrf
                        
                        <input type="hidden" name="propiedad_id" value="{{ $propiedad->id }}">
                        <input type="hidden" name="titulo" value="{{ $propiedad->titulo }}">
                        <input type="hidden" name="precio" value="{{ $propiedad->precio }}">

                        <div class="mb-3">
                            <label class="form-label" title="Clave Única de Registro de Población">CURP:</label>
                            <input type="text" 
                                   class="form-control" 
                                   name="curp" 
                                   maxlength="18" 
                                   required 
                                   placeholder="Ingresa tu CURP"
                                   title="Ingresa tu CURP de 18 caracteres">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" title="Edad del solicitante">Edad:</label>
                            <input type="number" 
                                   class="form-control" 
                                   name="edad" 
                                   min="18" 
                                   required
                                   title="Debes tener al menos 18 años">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" title="Actividad o profesión">Ocupación:</label>
                            <input type="text" 
                                   class="form-control" 
                                   name="ocupacion" 
                                   required 
                                   placeholder="Ej. Estudiante, Empleado"
                                   title="Describe tu ocupación actual">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" title="Fecha estimada de mudanza">Fecha estimada de mudanza:</label>
                            <input type="date" 
                                   class="form-control" 
                                   name="fecha" 
                                   min="{{ date('Y-m-d') }}" 
                                   required
                                   title="Selecciona la fecha en que planeas mudarte">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" title="Número de contacto">Teléfono:</label>
                            <input type="text" 
                                   class="form-control" 
                                   name="telefono" 
                                   required
                                   title="Ingresa tu número de teléfono">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" title="Mensaje adicional">Mensaje:</label>
                            <textarea class="form-control" 
                                      name="mensaje" 
                                      rows="4" 
                                      placeholder="Escriba un mensaje"
                                      title="Agrega información adicional para el arrendador"></textarea>
                        </div>

                        <button type="submit" 
                                class="btn w-100 btn-lg shadow-sm boton"
                                title="Enviar solicitud de renta">
                            Enviar Solicitud
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-layout>