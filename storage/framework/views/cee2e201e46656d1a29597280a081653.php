<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>HomeHive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
body {
    animation: fadeIn 0.8s ease forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}
</style>

<body class="page-transition" style="background-color: #e9ecf2;">

    <div class="container-fluid vh-100">
        <div class="row h-100">


            <div class="col-md-5 d-flex align-items-center justify-content-center position-relative">

                <div class="card shadow-lg border-0 p-4" style="width: 100%; max-width: 450px; border-radius: 16px;">

                    <a href="/" class="position-absolute top-0 end-0 m-4 text-dark text-decoration-none fs-3">
                        &times;
                    </a>

                    <h3 class="text-center mb-4">Crear cuenta</h3>

                    <form method="POST" action="/select_role">
                        <?php echo csrf_field(); ?>

                        
                        <div class="mb-3 align-content-center">
                            <label class="form-label">Seleccione su rol</label>

                            <select name="role" class="form-select <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">Selecciona una opción</option>
                                <option value="inquilino" <?php echo e(old('role') == 'inquilino' ? 'selected' : ''); ?>>
                                    Inquilino
                                </option>
                                <option value="propietario" <?php echo e(old('role') == 'propietario' ? 'selected' : ''); ?>>
                                    Propietario
                                </option>
                            </select>

                            <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill py-2">
                                Registrarse
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
    <script>
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.href && !this.href.includes('#')) {
                e.preventDefault();
                document.body.classList.add('fade-out');
                setTimeout(() => {
                    window.location = this.href;
                }, 300);
            }
        });
    });
    </script>
</body>

</html>

</html><?php /**PATH C:\webapps\laravel\homehive-web\resources\views/auth/select_rol.blade.php ENDPATH**/ ?>