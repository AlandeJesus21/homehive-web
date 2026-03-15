<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    <section class="hero slide-out-up fondo">
        <div class="hero-content">
            <h1 class="fw-bold">Bienvenidos a HomeHive</h1>

            <h3 class="mt-3">
                Encuentra Tu Hogar, Vive Un Nuevo <br>
                Comienzo... en Ocosingo
            </h3>

            <a href="#propiedades" class="btn btn-light btn-lg mt-4 px-4 rounded-pill shadow h">
                Ver propiedades
            </a>
        </div>
    </section>

    <div class="fondo">
        <div class="container py-5">
            <h2 class="text-center mb-4">Busca una propiedad</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <!-- aquí va la api de mapas -->
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="container py-5 slide-out-up" id="propiedades">
        <h2 class="text-center mb-5">Propiedades destacadas</h2>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Casa en el centro</h5>
                        <p class="card-text">3 habitaciones, 2 baños, jardín amplio.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Departamento moderno</h5>
                        <p class="card-text">2 habitaciones, cocina equipada.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Cuarto económico</h5>
                        <p class="card-text">Ideal para estudiantes.</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary">
                Ver todas las propiedades
            </a>
        </div>
    </div>

    <hr>

    <div>
        <div class="container py-5 text-center">
            <h2 class="text-center mb-4">¿Tienes alguna propiedad?</h2>
            <p class="text-center">Publica tu cuarto, casa o departamento gratis</p>
            <a class="btn btn-lg mt-4" style="background-color: #C9C00F;" href="<?php echo e(route('login')); ?>">Publicar
                propiedad</a>
        </div>
    </div>



 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?><?php /**PATH C:\webapps\laravel\homehive-web\resources\views/index.blade.php ENDPATH**/ ?>