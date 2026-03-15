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
    <div class="container">

        <div class="mt-4 mb-4 text-center">
            <h1 class="fw-bold">Generar Reporte de Usuarios</h1>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <form method="GET" action="/reporte">

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Tipo de usuario</label>
                            <select name="role" class="form-select">
                                <option value="">Todos</option>
                                <option value="inquilino">Inquilinos</option>
                                <option value="propietario">Propietarios</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Fecha inicio</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Fecha fin</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>

                    </div>

                    <div class="mt-3 text-end">
                        <button type="submit" class="btn btn-primary">
                            Generar reporte
                        </button>
                    </div>

                </form>

            </div>
        </div>

        <?php if(isset($users)): ?>

        <div class="mb-2 fw-bold">
            Total de usuarios: <?php echo e($users->count()); ?>

        </div>

        <div class="table-responsive border shadow-sm">
            <table class="table table-striped table-hover align-middle mb-0">

                <thead class="table-dark text-center">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha registro</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="text-center">
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->role); ?></td>
                        <td><?php echo e($user->created_at); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center">No se encontraron resultados</td>
                    </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

        <?php endif; ?>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7651faf8e4a1e278424aad70c82de3ba)): ?>
<?php $attributes = $__attributesOriginal7651faf8e4a1e278424aad70c82de3ba; ?>
<?php unset($__attributesOriginal7651faf8e4a1e278424aad70c82de3ba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7651faf8e4a1e278424aad70c82de3ba)): ?>
<?php $component = $__componentOriginal7651faf8e4a1e278424aad70c82de3ba; ?>
<?php unset($__componentOriginal7651faf8e4a1e278424aad70c82de3ba); ?>
<?php endif; ?><?php /**PATH C:\webapps\laravel\homehive-web\resources\views/admin/users/index.blade.php ENDPATH**/ ?>