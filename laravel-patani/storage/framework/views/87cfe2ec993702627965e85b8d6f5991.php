<?php $__env->startSection('page-title', 'Laporan & Statistik'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Laporan & Statistik</h1>
            <p class="text-gray-500 text-sm mt-0.5">Data produksi panen petani berdasarkan periode</p>
        </div>
        <div class="flex gap-2">
            <a href="<?php echo e(route('admin.laporan.export.excel', ['tahun' => $tahun, 'bulan' => $bulan])); ?>"
               class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors shadow">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="<?php echo e(route('admin.laporan.export.pdf', ['tahun' => $tahun, 'bulan' => $bulan])); ?>"
               class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors shadow">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
        </div>
    </div>

    
    <?php if(session('success')): ?>
        <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 flex items-center gap-2">
            <i class="fas fa-check-circle text-green-500"></i>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <?php if(session('error')): ?>
        <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 flex items-center gap-2">
            <i class="fas fa-exclamation-circle text-red-500"></i>
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    
    <?php if(session('filter_error')): ?>
        <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 flex items-center gap-2">
            <i class="fas fa-exclamation-circle text-red-500"></i>
            <?php echo e(session('filter_error')); ?>

        </div>
    <?php endif; ?>

    
    <div class="bg-white rounded-lg shadow p-4">
        <form method="GET" action="<?php echo e(route('admin.laporan')); ?>" class="flex flex-wrap gap-3 items-end">

            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tahun</label>
                <select name="tahun" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <?php $__currentLoopData = $tahunTersedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($t); ?>" <?php echo e($t == $tahun ? 'selected' : ''); ?>><?php echo e($t); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Bulan</label>
                <select name="bulan" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Bulan</option>
                    <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($m); ?>" <?php echo e($m == $bulan ? 'selected' : ''); ?>>
                            <?php echo e(\Carbon\Carbon::create(null, $m)->locale('id')->isoFormat('MMMM')); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tanggal Awal</label>
                <input type="date" name="tgl_awal" value="<?php echo e(request('tgl_awal')); ?>"
                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tanggal Akhir</label>
                <input type="date" name="tgl_akhir" value="<?php echo e(request('tgl_akhir')); ?>"
                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            <button type="submit"
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                <i class="fas fa-filter mr-1"></i> Terapkan Filter
            </button>

            <?php if($bulan): ?>
                <a href="<?php echo e(route('admin.laporan', ['tahun' => $tahun])); ?>"
                   class="px-4 py-2 border border-gray-300 text-gray-600 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times mr-1"></i> Reset
                </a>
            <?php endif; ?>

        </form>
    </div>

    
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <div class="bg-white rounded-lg shadow p-5 border-l-4 border-green-500">
            <p class="text-xs text-gray-500 uppercase tracking-wide">Total Produksi</p>
            <p class="text-2xl font-bold text-gray-800 mt-1"><?php echo e($stats['totalProduksiTon']); ?> <span class="text-sm font-normal text-gray-500">ton</span></p>
            <p class="text-xs text-gray-400 mt-0.5"><?php echo e($stats['totalProduksiKg']); ?> Kg</p>
        </div>
        <div class="bg-white rounded-lg shadow p-5 border-l-4 border-blue-500">
            <p class="text-xs text-gray-500 uppercase tracking-wide">Total Pendapatan</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">Rp <?php echo e($stats['totalPendapatan']); ?></p>
            <p class="text-xs text-gray-400 mt-0.5">Akumulasi seluruh petani</p>
        </div>
        <div class="bg-white rounded-lg shadow p-5 border-l-4 border-yellow-500">
            <p class="text-xs text-gray-500 uppercase tracking-wide">Rata-rata / Ha</p>
            <p class="text-2xl font-bold text-gray-800 mt-1"><?php echo e($stats['rataHasilPerHa']); ?></p>
            <p class="text-xs text-gray-400 mt-0.5"><?php echo e($stats['totalPanen']); ?> kali panen tercatat</p>
        </div>
        <div class="bg-white rounded-lg shadow p-5 border-l-4 border-purple-500">
            <p class="text-xs text-gray-500 uppercase tracking-wide">Total Lahan</p>
            <p class="text-2xl font-bold text-gray-800 mt-1"><?php echo e($stats['totalLuas']); ?> <span class="text-sm font-normal text-gray-500">Ha</span></p>
            <p class="text-xs text-gray-400 mt-0.5"><?php echo e($stats['totalPetani']); ?> petani terdaftar</p>
        </div>
    </div>

    
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-4">
                Produksi & Pendapatan Bulanan
                <span class="text-xs text-gray-400 font-normal ml-1">(Tahun <?php echo e($tahun); ?>)</span>
            </h3>
            <?php if(collect($produksiBulanan)->sum('produksi') == 0): ?>
                <div class="flex flex-col items-center justify-center h-48 text-gray-400">
                    <i class="fas fa-chart-bar text-4xl mb-2"></i>
                    <p class="text-sm">Belum ada data panen untuk tahun <?php echo e($tahun); ?>.</p>
                </div>
            <?php else: ?>
                <canvas id="chartProduksi" height="200"></canvas>
            <?php endif; ?>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-4">Distribusi Kualitas</h3>
            <?php if($kualitasData->isEmpty()): ?>
                <div class="flex flex-col items-center justify-center h-48 text-gray-400">
                    <i class="fas fa-chart-pie text-4xl mb-2"></i>
                    <p class="text-sm">Belum ada data.</p>
                </div>
            <?php else: ?>
                <canvas id="chartKualitas" height="200"></canvas>
                <div class="mt-4 space-y-2">
                    <?php $kualitasColors = ['#22c55e','#eab308','#3b82f6','#ef4444','#a855f7']; ?>
                    <?php $__currentLoopData = $kualitasData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between text-xs text-gray-600">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full inline-block"
                                      style="background: <?php echo e($kualitasColors[$i % 5]); ?>"></span>
                                <?php echo e($k['kualitas']); ?>

                            </div>
                            <span class="font-medium"><?php echo e($k['total_ton']); ?> ton (<?php echo e($k['jumlah']); ?>x)</span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-base font-semibold text-gray-800 mb-4">
            Top 10 Petani Berdasarkan Produksi
            <span class="text-xs text-gray-400 font-normal ml-1">
                (<?php echo e($bulan ? \Carbon\Carbon::create($tahun, $bulan)->locale('id')->isoFormat('MMMM Y') : 'Tahun ' . $tahun); ?>)
            </span>
        </h3>
        <?php if($topPetani->isEmpty()): ?>
            <div class="flex flex-col items-center justify-center py-12 text-gray-400">
                <i class="fas fa-users text-4xl mb-2"></i>
                <p class="text-sm">Belum ada data panen tercatat untuk periode ini.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-green-50 border-b border-green-100">
                            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">Rank</th>
                            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">Nama Petani</th>
                            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">Sawah</th>
                            <th class="text-right py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">Luas (Ha)</th>
                            <th class="text-right py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">Jml Panen</th>
                            <th class="text-right py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">Total (Ton)</th>
                            <th class="text-right py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__currentLoopData = $topPetani; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $rowBg = match(true) {
                                    $i === 0 => 'bg-yellow-50 border-l-4 border-yellow-400',
                                    $i === 1 => 'bg-gray-50 border-l-4 border-gray-400',
                                    $i === 2 => 'bg-amber-50 border-l-4 border-amber-600',
                                    default  => 'hover:bg-gray-50',
                                };
                            ?>
                            <tr class="transition-colors <?php echo e($rowBg); ?>">
                                <td class="py-3 px-4">
                                    <span class="font-bold text-sm <?php echo e($i === 0 ? 'text-yellow-500' : ($i === 1 ? 'text-gray-500' : ($i === 2 ? 'text-amber-600' : 'text-gray-400'))); ?>">
                                        <?php echo e($i + 1); ?>

                                    </span>
                                </td>
                                <td class="py-3 px-4 font-medium text-gray-800"><?php echo e($p['nama_petani']); ?></td>
                                <td class="py-3 px-4 text-gray-600"><?php echo e($p['nama_sawah']); ?></td>
                                <td class="py-3 px-4 text-right text-gray-600"><?php echo e($p['luas']); ?></td>
                                <td class="py-3 px-4 text-right text-gray-600"><?php echo e($p['jumlah_panen']); ?>x</td>
                                <td class="py-3 px-4 text-right font-semibold text-green-700"><?php echo e($p['total_ton']); ?> ton</td>
                                <td class="py-3 px-4 text-right text-gray-700">Rp <?php echo e($p['total_pendapatan']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-base font-semibold text-gray-800 mb-4">
            Detail Data Panen
            <span class="text-xs text-gray-400 font-normal ml-1">
                (<?php echo e($bulan ? \Carbon\Carbon::create($tahun, $bulan)->locale('id')->isoFormat('MMMM Y') : 'Tahun ' . $tahun); ?>)
            </span>
        </h3>
        <?php if($dataPanen->isEmpty()): ?>
            <div class="flex flex-col items-center justify-center py-12 text-gray-400">
                <i class="fas fa-seedling text-4xl mb-2"></i>
                <p class="text-sm">Belum ada data panen untuk periode ini.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-green-50 border-b border-green-100">
                            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">No</th>
                            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">Tanggal</th>
                            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">Petani</th>
                            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">Sawah</th>
                            <th class="text-right py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">Hasil (Ton)</th>
                            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">Kualitas</th>
                            <th class="text-right py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">Pendapatan</th>
                            <th class="text-center py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wide">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__currentLoopData = $dataPanen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $panen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-4 text-gray-400"><?php echo e($i + 1); ?></td>
                                <td class="py-3 px-4 text-gray-600"><?php echo e(\Carbon\Carbon::parse($panen->tanggal_panen)->format('d/m/Y')); ?></td>
                                <td class="py-3 px-4 font-medium text-gray-800"><?php echo e(optional(optional($panen->sawah)->user)->name ?? '-'); ?></td>
                                <td class="py-3 px-4 text-gray-600"><?php echo e(optional($panen->sawah)->nama_sawah ?? '-'); ?></td>
                                <td class="py-3 px-4 text-right font-semibold text-green-700"><?php echo e(round($panen->hasil_panen / 1000, 2)); ?> ton</td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $panen->kualitas ?? '-'))); ?>

                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right text-gray-700">
                                    Rp <?php echo e(number_format($panen->total_pendapatan, 0, ',', '.')); ?>

                                </td>
                                <td class="py-3 px-4 text-center">
                                    <form action="<?php echo e(route('admin.laporan.destroy', $panen->id)); ?>" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data panen ini? Tindakan tidak dapat dibatalkan.')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded-lg transition-colors">
                                            <i class="fas fa-trash text-xs"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
Chart.defaults.font.family = "'Inter', sans-serif";
Chart.defaults.font.size = 11;

<?php if(collect($produksiBulanan)->sum('produksi') > 0): ?>
const produksiBulanan = <?php echo json_encode($produksiBulanan, 15, 512) ?>;

new Chart(document.getElementById('chartProduksi'), {
    type: 'bar',
    data: {
        labels: produksiBulanan.map(d => d.bulan),
        datasets: [
            {
                label: 'Produksi (Ton)',
                data: produksiBulanan.map(d => d.produksi),
                backgroundColor: 'rgba(34, 197, 94, 0.85)',
                borderRadius: 4,
                yAxisID: 'yTon',
                order: 2,
            },
            {
                label: 'Pendapatan (Juta Rp)',
                data: produksiBulanan.map(d => d.pendapatan),
                type: 'line',
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 2,
                pointBackgroundColor: 'rgb(59, 130, 246)',
                pointRadius: 4,
                tension: 0.4,
                fill: false,
                yAxisID: 'yRp',
                order: 1,
            },
        ],
    },
    options: {
        responsive: true,
        interaction: { mode: 'index', intersect: false },
        plugins: {
            legend: { position: 'top' },
            tooltip: {
                callbacks: {
                    label: ctx => ctx.dataset.label.includes('Ton')
                        ? ` Produksi: ${ctx.parsed.y.toFixed(2)} ton`
                        : ` Pendapatan: Rp ${ctx.parsed.y.toFixed(1)} juta`,
                },
            },
        },
        scales: {
            yTon: {
                type: 'linear',
                position: 'left',
                beginAtZero: true,
                grid: { color: 'rgba(0,0,0,0.04)' },
                ticks: { callback: v => v + ' ton' },
            },
            yRp: {
                type: 'linear',
                position: 'right',
                beginAtZero: true,
                grid: { drawOnChartArea: false },
                ticks: { callback: v => 'Rp ' + v + ' jt' },
            },
            x: { grid: { display: false } },
        },
    },
});
<?php endif; ?>

<?php if(!$kualitasData->isEmpty()): ?>
const kualitasData = <?php echo json_encode($kualitasData, 15, 512) ?>;
const kualitasColors = ['#22c55e','#eab308','#3b82f6','#ef4444','#a855f7'];

new Chart(document.getElementById('chartKualitas'), {
    type: 'doughnut',
    data: {
        labels: kualitasData.map(d => d.kualitas),
        datasets: [{
            data: kualitasData.map(d => d.total_ton),
            backgroundColor: kualitasColors.slice(0, kualitasData.length),
            borderWidth: 2,
            borderColor: '#fff',
            hoverOffset: 6,
        }],
    },
    options: {
        responsive: true,
        cutout: '60%',
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: ctx => ` ${ctx.label}: ${ctx.parsed.toFixed(2)} ton`,
                },
            },
        },
    },
});
<?php endif; ?>
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\patani\laravel-patani\resources\views/admin/laporan.blade.php ENDPATH**/ ?>