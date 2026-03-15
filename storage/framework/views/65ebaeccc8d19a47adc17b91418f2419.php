<?php if (isset($component)) { $__componentOriginal7651faf8e4a1e278424aad70c82de3ba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7651faf8e4a1e278424aad70c82de3ba = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <main class="main-contenent">
        <div class="container cards-wrapper">
            <div class="row justify-content-center">
                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-secondary text-center shadow" onclick="location.href= '/admin/users';"
                        style="cursor: pointer;">
                        <img class="rounded-circle d-block mx-auto mt-3" width="80" height="80"
                            src=" <?php echo e(asset('images/users.jpeg')); ?> " alt="Logo">
                        <div class="card-body">
                            <h4 class="card-title">Usuarios</h4>
                            <p class="card-text">Gestión de usuarios</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-secondary text-center shadow">
                        <img class="rounded-circle d-block mx-auto mt-3" width="80" height="80"
                            src=" <?php echo e(asset('images/casa.jpeg')); ?> " alt="Logo">
                        <div class="card-body">
                            <h4 class="card-title">Propiedades</h4>
                            <p class="card-text">Gestión de propiedades</p>
                        </div>
                    </div>
                </div>

                <div class="col-8 col-md-4 mb-4 position-relative">
                    <div class="card border-secondary text-center shadow">
                        <img class="rounded-circle d-block mx-auto mt-3" width="80" height="80"
                            src=" <?php echo e(asset('images/escribiendo.png')); ?> " alt="Logo">
                        <div class="card-body">
                            <h4 class="card-title">Comentarios</h4>
                            <p class="card-text">Gestión de comentarios</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7651faf8e4a1e278424aad70c82de3ba)): ?>
<?php $attributes = $__attributesOriginal7651faf8e4a1e278424aad70c82de3ba; ?>
<?php unset($__attributesOriginal7651faf8e4a1e278424aad70c82de3ba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7651faf8e4a1e278424aad70c82de3ba)): ?>
<?php $component = $__componentOriginal7651faf8e4a1e278424aad70c82de3ba; ?>
<?php unset($__componentOriginal7651faf8e4a1e278424aad70c82de3ba); ?>
<?php endif; ?><?php /**PATH C:\webapps\laravel\homehive-web\resources\views/admin/index.blade.php ENDPATH**/ ?>