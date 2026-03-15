<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>HomeHive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/Styles.css')); ?>">

</head>


<body class="fadeIn" style="background-color: #e9ecf2;">

    <div class="container-fluid vh-100">
        <div class="row h-100">

            
            <div class="col-md-7 d-none d-md-block p-0 position-relative">
                <div class="h-100 w-100" style="background: url('<?php echo e(asset('images/j.jpg')); ?>') center/cover no-repeat;">

                    <div class="position-absolute top-50 start-50 translate-middle text-white text-center px-4">
                        <h4 class="fw-bold">
                            Encuentra tu nuevo comienzo.
                        </h4>
                        <p>
                            Crea tu cuenta y forma parte de la colmena HomeHive.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-5 d-flex align-items-center justify-content-center position-relative">



                <div class="card shadow-lg border-0 p-4" style="width: 100%; max-width: 450px; border-radius: 16px;">

                    <a href="/" class="position-absolute top-0 end-0 m-4 text-dark text-decoration-none fs-3">
                        &times;
                    </a>

                    <h3 class="text-center mb-4">Crear cuenta</h3>

                    <form method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                            <?php $__errorArgs = ['name'];
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

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="email" value="<?php echo e(old('email')); ?>" required>

                            <?php $__errorArgs = ['email'];
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


                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input id="password" type="password"
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required>

                            <?php $__errorArgs = ['password'];
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

                        <div class="mb-3">
                            <label class="form-label">Confirmar contraseña</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required>
                        </div>

                        
                        <div class="mb-3">
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

                    <div class="text-center mt-4">
                        <small>
                            ¿Ya tienes cuenta?
                            <a href="<?php echo e(route('login')); ?>">Inicia sesión</a>
                        </small>
                    </div>

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

</html><?php /**PATH C:\webapps\laravel\homehive-web\resources\views/auth/register.blade.php ENDPATH**/ ?>