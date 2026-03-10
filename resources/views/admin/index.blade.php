<x-admin.layout>
    <main class="main-contenent">
        <div class="container cards-wrapper">
            <div class="row justify-content-center">
                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-secondary text-center shadow" onclick="location.href= '/admin/users';"
                        style="cursor: pointer;">
                        <img class="rounded-circle d-block mx-auto mt-3" width="80" height="80"
                            src=" {{ asset('images/users.jpeg') }} " alt="Logo">
                        <div class="card-body">
                            <h4 class="card-title">Usuarios</h4>
                            <p class="card-text">Gestión de usuarios</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-secondary text-center shadow">
                        <img class="rounded-circle d-block mx-auto mt-3" width="80" height="80"
                            src=" {{ asset('images/casa.jpeg') }} " alt="Logo">
                        <div class="card-body">
                            <h4 class="card-title">Propiedades</h4>
                            <p class="card-text">Gestión de propiedades</p>
                        </div>
                    </div>
                </div>

                <div class="col-8 col-md-4 mb-4 position-relative">
                    <div class="card border-secondary text-center shadow">
                        <img class="rounded-circle d-block mx-auto mt-3" width="80" height="80"
                            src=" {{ asset('images/escribiendo.png') }} " alt="Logo">
                        <div class="card-body">
                            <h4 class="card-title">Comentarios</h4>
                            <p class="card-text">Gestión de comentarios</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-admin.layout>