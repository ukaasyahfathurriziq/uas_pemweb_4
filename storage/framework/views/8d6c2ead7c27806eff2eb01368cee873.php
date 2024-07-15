<?php $__env->startSection('main-content'); ?>
    <h1 class="h3 mb-4 text-gray-800"><?php echo e(__('Simple Additive Weighting (SAW)')); ?></h1>

    <!-- Langkah 1: Normalisasi Nilai -->
    <div class="card shadow mb-4">
        <div class="card-header">Normalisasi Nilai</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            <?php $__currentLoopData = $kriterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th><?php echo e($kriteria->nama_kriteria); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $alternatifs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alternatif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($alternatif->nama_alternatif); ?></td>
                                <?php $__currentLoopData = $kriterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $penilaian = $penilaians->where('alternatif_id', $alternatif->id)->where('kriteria_id', $kriteria->id)->first();
                                        $nilai = $penilaian ? floatval($penilaian->nilai) : 0.0;
                                        if ($kriteria->jenis_kriteria == 'Benefit') {
                                            $nilaiNormalized = $nilai / max($penilaians->where('kriteria_id', $kriteria->id)->pluck('nilai')->toArray());
                                        } else {
                                            $nilaiNormalized = min($penilaians->where('kriteria_id', $kriteria->id)->pluck('nilai')->toArray()) / $nilai;
                                        }
                                    ?>
                                    <td><?php echo e(number_format($nilaiNormalized, 4)); ?></td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Langkah 2: Menghitung Skor Akhir -->
    <div class="card shadow mb-4">
        <div class="card-header">Menghitung Skor Akhir</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            <th>Skor Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $skorAkhirArray = [];
                            foreach ($alternatifs as $alternatif) {
                                $skorAkhir = 0;
                                foreach ($kriterias as $kriteria) {
                                    $penilaian = $penilaians->where('alternatif_id', $alternatif->id)->where('kriteria_id', $kriteria->id)->first();
                                    $nilai = $penilaian ? floatval($penilaian->nilai) : 0.0;
                                    if ($kriteria->jenis_kriteria == 'Benefit') {
                                        $nilaiNormalized = $nilai / max($penilaians->where('kriteria_id', $kriteria->id)->pluck('nilai')->toArray());
                                    } else {
                                        $nilaiNormalized = min($penilaians->where('kriteria_id', $kriteria->id)->pluck('nilai')->toArray()) / $nilai;
                                    }
                                    $skorAkhir += $nilaiNormalized * floatval($kriteria->bobot);
                                }
                                $skorAkhirArray[$alternatif->nama_alternatif] = $skorAkhir;
                            }
                        ?>
                        <?php $__currentLoopData = $skorAkhirArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namaAlternatif => $nilaiAkhir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($namaAlternatif); ?></td>
                                <td><?php echo e(number_format($nilaiAkhir, 4)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Langkah 3: Perankingan -->
    <div class="card shadow mb-4">
        <div class="card-header">Peringkat</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            <th>Skor Akhir</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            arsort($skorAkhirArray);
                            $rank = 1;
                        ?>
                        <?php $__currentLoopData = $skorAkhirArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namaAlternatif => $nilaiAkhir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($namaAlternatif); ?></td>
                                <td><?php echo e(number_format($nilaiAkhir, 4)); ?></td>
                                <td><?php echo e($rank++); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LaravelSpk_saw\LaravelSpk_Saw\resources\views/perhitungan/wp.blade.php ENDPATH**/ ?>