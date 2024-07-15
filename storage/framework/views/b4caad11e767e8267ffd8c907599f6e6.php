<!-- resources/views/perhitungan/wp.blade.php -->


<?php $__env->startSection('main-content'); ?>
    <h1 class="h3 mb-4 text-gray-800"><?php echo e(__('Perhitungan Weighted Product (WP)')); ?></h1>

    <!-- Langkah 1: Normalisasi Bobot -->
    <div class="card shadow mb-4">
        <div class="card-header">Normalisasi Bobot</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <?php $__currentLoopData = $kriterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th><?php echo e($kriteria->nama_kriteria); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $__currentLoopData = $kriterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td><?php echo e(number_format($kriteria->bobot_normalized, 4)); ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Langkah 2: Menghitung Vektor S -->
    <div class="card shadow mb-4">
        <div class="card-header">Menghitung Vektor S</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            <?php $__currentLoopData = $kriterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th><?php echo e($kriteria->nama_kriteria); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th>Vektor S</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $alternatifs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alternatif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($alternatif->nama_alternatif); ?></td>
                                <?php
                                    $vektorSAlt = 1.0;
                                    foreach ($kriterias as $kriteria) {
                                        $penilaian = $penilaians->where('alternatif_id', $alternatif->id)->where('kriteria_id', $kriteria->id)->first();
                                        $nilai = $penilaian ? floatval($penilaian->nilai) : 1.0;
                                        $bobotNormalized = floatval($kriteria->bobot_normalized);

                                        if ($kriteria->jenis_kriteria == 'Cost') {
                                            $vektorSAlt *= pow($nilai, -$bobotNormalized);
                                        } else {
                                            $vektorSAlt *= pow($nilai, $bobotNormalized);
                                        }
                                    }
                                    $vektorS[$alternatif->id] = $vektorSAlt;
                                ?>
                                <?php $__currentLoopData = $kriterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $penilaian = $penilaians->where('alternatif_id', $alternatif->id)->where('kriteria_id', $kriteria->id)->first();
                                        $nilai = $penilaian ? floatval($penilaian->nilai) : 1.0;
                                    ?>
                                    <td><?php echo e($nilai); ?></td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <td><?php echo e(number_format($vektorSAlt, 4)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Langkah 3: Menghitung Vektor V -->
    <div class="card shadow mb-4">
        <div class="card-header">Menghitung Vektor V</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            <th>Vektor V</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalVektorS = array_sum($vektorS); ?>
                        <?php $__currentLoopData = $vektorS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $altId => $nilaiS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($alternatifs->find($altId)->nama_alternatif); ?></td>
                                <td><?php echo e(number_format($nilaiS / $totalVektorS, 4)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Langkah 4: Perankingan -->
    <div class="card shadow mb-4">
        <div class="card-header">Peringkat</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            <th>Vektor V</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $rank = 1; ?>
                        <?php $__currentLoopData = $vektorV; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $altId => $nilaiV): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($alternatifs->find($altId)->nama_alternatif); ?></td>
                                <td><?php echo e(number_format($nilaiV, 4)); ?></td>
                                <td><?php echo e($rank++); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Alim Terrible\OneDrive\Gambar\DokumentasiLaravelSPK-main\resources\views/perhitungan/wp.blade.php ENDPATH**/ ?>