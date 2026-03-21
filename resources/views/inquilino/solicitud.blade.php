<x-inquilino.layout>

        <main class="container-fluid min-vh-100 main">

            <div class="d-flex justify-content-center">
                <div class="card shadow-lg border-0 p-4" style="width: 100%; max-width: 420px; border-radius: 16px;">

                    <a href="/" class="position-absolute top-0 end-0 m-4 text-dark text-decoration-none fs-3">
                        &times;
                    </a>

                    <h3 class="text-center mb-4">Solicitud de renta</h3>

                    <form method="POST" action="">


                        <div class=" mb-3">
                            <label class="form-label">Nombre:</label>
                            <input type="text" name="name" class="form-control" value="" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Edad:</label>
                            <input type="text" name="password" class="form-control required">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ocupacion:</label>
                            <input type="text" name="ocupation " class="form-control required">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha estimada de mudanza:</label>
                            <input type="date" name="date-mudanza " class="form-control required">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefono:</label>
                            <input type="number" name="telefono " class="form-control required">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mensaje:</label>
                            <textarea class="form-control" rows="3" placeholder="Escriba un mensaje" name="mensaje"></textarea>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <a href="" class="btn boton me-5">Cancelar</a>
                            <a href="" class="btn boton ">Enviar</a>
                            </div>



                    </form>


                </div>
        </main>


</x-inquilino.layout>
