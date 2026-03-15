<?php if (isset($component)) { $__componentOriginald699afbe86d401c7360abfdac9af27b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald699afbe86d401c7360abfdac9af27b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.propietario.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('propietario.layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<div class="container mt-5">

    <div class="row justify-content-center g-4">


        <div class="col-md-4">
            <a href="/pagos" class="text-decoration-none text-dark">
                <div class="card shadow text-center p-4 card-hover">
                    <div class="card-body">

                        <img class="d-block mx-auto mb-3"
                        width="80"
                        height="80"
                        src="<?php echo e(asset('images/factura.png')); ?>">

                        <h4 class="mt-3">Pagos</h4>

                        <p class="text-muted">Gestión de pagos</p>

                    </div>
                </div>
            </a>
        </div>



        <div class="col-md-4">
            <a href="/propiedades" class="text-decoration-none text-dark">
                <div class="card shadow text-center p-4 card-hover">
                    <div class="card-body">

                        <img class="d-block mx-auto mb-3"
                        width="80"
                        height="80"
                        src="<?php echo e(asset('images/home.png')); ?>">

                        <h4 class="mt-3">Propiedades</h4>

                        <p class="text-muted">Gestión de propiedades</p>

                    </div>
                </div>
            </a>
        </div>


        <div class="row justify-content-center g-4 mt-3">
        <div class="col-md-4">
            <a href="/solicitudes" class="text-decoration-none text-dark">
                <div class="card shadow text-center p-4 card-hover">
                    <div class="card-body">

                        <img class="d-block mx-auto mb-3"
                        width="80"
                        height="80"
                        src="<?php echo e(asset('images/notificacion.png')); ?>">

                        <h4 class="mt-3">Solicitudes</h4>

                        <p class="text-muted">Gestión de solicitudes</p>

                    </div>
                </div>
            </a>
        </div>
        </div>

    </div>

</div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald699afbe86d401c7360abfdac9af27b1)): ?>
<?php $attributes = $__attributesOriginald699afbe86d401c7360abfdac9af27b1; ?>
<?php unset($__attributesOriginald699afbe86d401c7360abfdac9af27b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald699afbe86d401c7360abfdac9af27b1)): ?>
<?php $component = $__componentOriginald699afbe86d401c7360abfdac9af27b1; ?>
<?php unset($__componentOriginald699afbe86d401c7360abfdac9af27b1); ?>
<?php endif; ?>
<?php /**PATH C:\webapps\laravel\homehive-web\resources\views/propietario/index.blade.php ENDPATH**/ ?>