<x-admin.layout>



    <!-- 🔶 HERO -->
    <section class="hero-admin">
        <div class="container hero-content text-white">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="fw-bold">
                        El motor de la colmena está en tus manos.
                    </h3>
                    <p class="mt-3">
                        Supervisa el crecimiento de la plataforma, gestiona comentarios,
                        genera reportes de usuarios y propiedades.
                        Asegura que cada rincón funcione con excelencia.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 🔷 CARDS -->
    <div class="container admin-stats">
        <div class="row">

            <!-- PROPIEDADES -->
            <div class="col-md-4 mb-4">
                <div class="admin-card">
                    <div class="d-flex align-items-center">
                        <div class="admin-icon bg-primary bg-opacity-25 me-3">
                            🏠
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $totalPropiedades }}</h4>
                            <small class="text-muted">Propiedades TOTALES</small>
                        </div>
                    </div>

                    <a href="/admin/propiedades" class="btn btn-primary mt-3">Ver más</a>
                </div>
            </div>

            <!-- USUARIOS -->
            <div class="col-md-4 mb-4">
                <div class="admin-card">
                    <div class="d-flex align-items-center">
                        <div class="admin-icon bg-secondary bg-opacity-25 me-3">
                            👤
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $totalUsers }}</h4>
                            <small class="text-muted">Usuarios TOTALES</small>
                        </div>
                    </div>

                    <a href="/admin/users" class="btn btn-primary mt-3">Ver más</a>
                </div>
            </div>

            <!-- COMENTARIOS -->
            <div class="col-md-4 mb-4">
                <div class="admin-card">
                    <div class="d-flex align-items-center">
                        <div class="admin-icon bg-warning bg-opacity-25 me-3">
                            ⚠️
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $totalReviews }}</h4>
                            <small class="text-muted">Comentarios TOTALES</small>
                            <div class="text-danger small">+5 Para revisar</div>
                        </div>
                    </div>

                    <a href="#" class="btn btn-primary mt-3">Ver más</a>
                </div>
            </div>

        </div>
    </div>

</x-admin.layout>