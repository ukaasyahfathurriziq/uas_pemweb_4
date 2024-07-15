<?php $__env->startSection('main-content'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo e(__('Create Kriteria')); ?></h1>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?php echo e(route('kriteria.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group focused">
                            <label class="form-control-label" for="kode_kriteria">Kode Kriteria<span class="small text-danger">*</span></label>
                            <input type="text" id="kode_kriteria" class="form-control" name="kode_kriteria" placeholder="Kode Kriteria" value="<?php echo e(old('kode_kriteria')); ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group focused">
                            <label class="form-control-label" for="nama_kriteria">Nama Kriteria<span class="small text-danger">*</span></label>
                            <input type="text" id="nama_kriteria" class="form-control" name="nama_kriteria" placeholder="Nama Kriteria" value="<?php echo e(old('nama_kriteria')); ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="jenis_kriteria">Jenis Kriteria<span class="small text-danger">*</span></label>
                            <select name="jenis_kriteria" id="jenis_kriteria" class="form-control">
                                <option value="Cost">Cost</option>
                                <option value="Benefit">Benefit</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group focused">
                            <label class="form-control-label" for="bobot">Bobot<span class="small text-danger">*</span></label>
                            <input type="number" step="0.01" id="bobot" class="form-control" name="bobot" placeholder="Bobot" value="<?php echo e(old('bobot')); ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Alim Terrible\OneDrive\Gambar\DokumentasiLaravelSPK-main\resources\views/kriteria/create.blade.php ENDPATH**/ ?>