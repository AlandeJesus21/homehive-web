<x-layout>

    <!-- HERO -->
    <section class="hero-admin">
        <div class="container hero-content text-white text-center">
            <h2 class="fw-bold">
                El motor de la colmena está en tus manos.
            </h2>

            <p class="mt-3 fs-5 mx-auto hero-text">
                Supervisa el crecimiento de la plataforma, gestiona comentarios,
                genera reportes de usuarios y propiedades.
                Asegura que cada rincón funcione con excelencia.
            </p>
        </div>
    </section>

    <!-- CARDS (YA SIN admin-stats con fondo) -->
    <div class="container mt-5">

        <div class="row">

            <div class="col-md-4 mb-4">
                <div class="admin-card">
                    <div class="d-flex align-items-center">
                        <div class="admin-icon bg-primary bg-opacity-25 me-3">
                            <i class="bi bi-house"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $totalPropiedades }}</h4>
                            <small class="text-muted">Propiedades TOTALES</small>
                        </div>
                    </div>
                    <a href="/admin/propiedades" class="btn btn-primary mt-3">Ver más</a>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="admin-card">
                    <div class="d-flex align-items-center">
                        <div class="admin-icon bg-secondary bg-opacity-25 me-3">
                            <i class="bi bi-person"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $totalUsers }}</h4>
                            <small class="text-muted">Usuarios TOTALES</small>
                        </div>
                    </div>
                    <a href="/admin/users" class="btn btn-primary mt-3">Ver más</a>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="admin-card">
                    <div class="d-flex align-items-center">
                        <div class="admin-icon bg-warning bg-opacity-25 me-3">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $totalReviews }}</h4>
                            <small class="text-muted">Comentarios TOTALES</small>
                        </div>
                    </div>
                    <a href="/admin/reviews" class="btn btn-primary mt-3">Ver más</a>
                </div>
            </div>

        </div>

        <!-- BOTÓN -->
        <div class="text-center mt-4 mb-5">
            <a href="{{ route('admin.backup') }}" class="btn btn-success px-4">
                <i class="bi bi-download"></i> Respaldar base de datos
            </a>
        </div>

    </div>

</x-layout>