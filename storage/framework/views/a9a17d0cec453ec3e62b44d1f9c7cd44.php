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

    <div class="container py-4">

        <h3 class="fw-bold mb-3">Comentarios sobre la aplicación</h3>

        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Comentarios</a>
            </li>
        </ul>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card border-0 shadow-sm p-3 mb-4">
                    <h4 class="fw-bold">
                        Promedio de reseñas:
                        <span class="text-warning">
                            <?php echo e(number_format($reviews->avg('rating'), 1) ?? '0.0'); ?> ★
                        </span>
                    </h4>
                </div>

                <!-- LISTA DE COMENTARIOS -->
                <div class="card border-0 shadow-sm p-3 mb-4">
                    <h5 class="fw-bold">Reseñas recientes</h5>

                    <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="border-bottom py-3">
                        <div class="d-flex justify-content-between">
                            <strong><?php echo e($review->usuario->name); ?></strong>
                            <span class="text-warning">
                                <?php echo e(str_repeat('★', $review->rating)); ?>

                            </span>
                        </div>
                        <p class="mb-1"><?php echo e($review->comentario); ?></p>
                        <small class="text-muted"><?php echo e($review->created_at->diffForHumans()); ?></small>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-muted">Aún no hay comentarios sobre la aplicación.</p>
                    <?php endif; ?>
                </div>

                <?php if(auth()->guard()->check()): ?>
                <div class="card border-0 shadow-sm p-3 mb-4">
                    <h5 class="fw-bold">Deja tu comentario</h5>

                    <form action="/save_review" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label">Calificación</label>
                            <select name="rating" class="form-select" required>
                                <option value="">Selecciona</option>
                                <option value="5">★★★★★</option>
                                <option value="4">★★★★</option>
                                <option value="3">★★★</option>
                                <option value="2">★★</option>
                                <option value="1">★</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Comentario</label>
                            <textarea name="comentario" class="form-control" rows="3" required></textarea>
                        </div>

                        <button class="btn btn-primary">
                            Publicar comentario
                        </button>
                    </form>
                </div>
                <?php endif; ?>

            </div>
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
<?php endif; ?><?php /**PATH C:\webapps\laravel\homehive-web\resources\views/main/comen.blade.php ENDPATH**/ ?>