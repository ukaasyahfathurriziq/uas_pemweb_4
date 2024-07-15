<?php $__env->startSection('main-content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url('https://lh4.googleusercontent.com/proxy/ZnjyK0sNPE27_oWfFL9k6dvnpEs6AcK9I0fQ8FZiAVScAVy-5lcLxBS3eTyYpP_4Ruqgex3Ui81R1Rg0_0KZFEXu5t3SNTnI_o-wdMuYqw'); background-size: cover; background-position: center;"></div>
                        <div class="col-lg-6" style="background-color: #f8f9fa;"> <!-- Mengubah background ke warna terbaik -->
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><?php echo e(__('Login')); ?></h1>
                                </div>

                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger border-left-danger" role="alert">
                                        <ul class="pl-4 my-2">
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="<?php echo e(route('login')); ?>" class="user">
                                    <?php echo csrf_field(); ?>

                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" placeholder="<?php echo e(__('E-Mail Address')); ?>" value="<?php echo e(old('email')); ?>" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="<?php echo e(__('Password')); ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                            <label class="custom-control-label" for="remember"><?php echo e(__('Remember Me')); ?></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            <?php echo e(__('Login')); ?>

                                        </button>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> <?php echo e(__('Login with Google')); ?>

                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> <?php echo e(__('Login with Facebook')); ?>

                                        </button>
                                    </div>
                                </form>
                                
                                <?php if(Route::has('password.request')): ?>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo e(route('password.request')); ?>">
                                            <?php echo e(__('Forgot Password?')); ?>

                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if(Route::has('register')): ?>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo e(route('register')); ?>"><?php echo e(__('Create an Account!')); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LaravelSpk_saw\LaravelSpk_Saw\resources\views/auth/login.blade.php ENDPATH**/ ?>