<?php $__env->startSection('main-content'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo e(__('About')); ?></h1>

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card shadow mb-4">

                <div class="card-profile-image mt-4">
                    <img src="<?php echo e(asset('img/favicon.png')); ?>" class="rounded-circle" alt="user-image">
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">Laravel Is FUN</h5>
                            <p>Admin for laravel</p>
                            <p>Rekomendasikan untuk menginstal preset ini pada proyek yang Anda mulai dari awal, jika tidak desain proyek anda mungkin rusak.</p>
                            <p>Jika Anda merasa proyek ini bermanfaat, mohon pertimbangkan untuk memberikannya ⭐⭐⭐⭐⭐</p>
                            <a href="https://github.com/ukaasyahfathurriziq" target="_blank" class="btn btn-github">
                                <i class="fab fa-github fa-fw"></i> Go to repository
                            </a>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">Tentang Laravel</h5>
                            <p>Laravel ini menggunakan beberapa pustaka/paket pihak ketiga yang bersifat open source, terima kasih banyak kepada komunitas web.</p>
                            <ul>
                                <li><a href="https://laravel.com" target="_blank">Laravel</a> - Open source framework.</li>
                                <li><a href="https://github.com/DevMarketer/LaravelEasyNav" target="_blank">LaravelEasyNav</a> - Making managing navigation in Laravel easy.</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LaravelSpk_saw\LaravelSpk_Saw\resources\views/about.blade.php ENDPATH**/ ?>