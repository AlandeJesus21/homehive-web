<!doctype html>
<html lang="es">

<head>
    <title>Editar Perfil - HomeHive</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
    :root {
        --primary-color: #1f3a8a;
        --secondary-bg: #e9ecf2;
    }

    body {
        background-color: var(--secondary-bg);
    }

    .profile-card {
        border-radius: 20px;
        padding: 30px;
    }

    .profile-img-container {
        position: relative;
        display: inline-block;
    }

    .profile-img {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
    }

    .edit-icon {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: white;
        border-radius: 50%;
        padding: 6px;
        cursor: pointer;
        border: 1px solid #ccc;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-radius: 10px;
        padding: 6px 25px;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- NAV -->
    <nav class="navbar navbar-light bg-white shadow-sm px-4">
        <span class="fw-bold">HomeHive</span>
    </nav>

    <!-- CONTENIDO -->
    <main class="flex-grow-1 d-flex align-items-center justify-content-center">

        <div class="col-md-5">

            <div class="card shadow profile-card text-center">

                <h4 class="fw-bold mb-3">Editar Perfil</h4>

                <!-- ERRORES -->
                @if ($errors->any())
                <div class="alert alert-danger text-start">
                    @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                    @endforeach
                </div>
                @endif

                <!-- FORM -->
                <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- FOTO -->
                    <div class="mb-3">

                        <div class="profile-img-container">

                            <img src="{{ Auth::user()->avatar
                                ? asset('images/perfiles/' . Auth::user()->avatar)
                                : asset('images/user.svg') }}" class="profile-img">

                            <!-- ICONO LÁPIZ -->
                            <label for="avatar" class="edit-icon">
                                ✏️
                            </label>

                            <input type="file" name="avatar" id="avatar" hidden>

                        </div>

                    </div>

                    <!-- NOMBRE -->
                    <div class="mb-3 text-start">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3 text-start">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}"
                            required>
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3 text-start">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password">
                    </div>

                    <!-- CONFIRM -->
                    <div class="mb-3 text-start">
                        <label class="form-label">Confirmar contraseña</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>

                    <!-- BOTÓN -->
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>

                </form>

            </div>

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <small>© 2026 DevSquad</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>