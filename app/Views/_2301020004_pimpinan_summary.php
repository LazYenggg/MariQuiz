<?php
// 1. PRE-PROCESSING DATA (GROUPING BY PERTANYAAN)
// Kita kelompokkan data mentah dari SQL agar menjadi array terstruktur per pertanyaan
$groupedData = [];
foreach($hasil as $row) {
    // Gunakan ID Pertanyaan sebagai key unik agar aman
    $key = $row->pertanyaan . " (" . $row->nama_prodi . ")"; 
    
    if (!isset($groupedData[$key])) {
        $groupedData[$key] = [
            'pertanyaan' => $row->pertanyaan,
            'prodi' => $row->nama_prodi,
            'labels' => [],
            'values' => []
        ];
    }
    // Masukkan Opsi dan Total ke group tersebut
    $groupedData[$key]['labels'][] = $row->deskripsi_pilihan;
    $groupedData[$key]['values'][] = $row->total;
}
?>

<div class="space-y-8 pb-12">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4" data-aos="fade-down">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Laporan Hasil Evaluasi</h2>
            <p class="text-slate-500">Analisa Data Kuisioner Fakultas <?= $fakultas->nama_fakultas ?></p>
        </div>
        <a href="<?= base_url('pimpinan/dashboard') ?>" class="px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-600 font-medium hover:text-ocean hover:border-ocean transition shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <?php if(empty($hasil)): ?>
        <div class="bg-white p-12 rounded-3xl shadow-sm text-center border-dashed border-2 border-slate-200">
            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" class="w-24 h-24 mx-auto mb-4 opacity-30" alt="Empty">
            <p class="text-slate-400">Belum ada responden yang mengisi pada periode ini.</p>
        </div>
    <?php else: ?>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" data-aos="fade-up">
            <?php 
            $chartIndex = 0;
            foreach($groupedData as $key => $data): 
                $chartId = "chart_" . $chartIndex;
            ?>
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex flex-col">
                <div class="mb-4">
                    <span class="inline-block px-2 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-bold uppercase tracking-wider rounded mb-2">
                        <?= $data['prodi'] ?>
                    </span>
                    <h3 class="font-bold text-slate-700 leading-tight min-h-[3rem]">
                        <?= $data['pertanyaan'] ?>
                    </h3>
                </div>
                
                <div class="relative h-64 w-full mt-auto">
                    <canvas id="<?= $chartId ?>"></canvas>
                </div>
            </div>
            <?php 
                $chartIndex++; 
            endforeach; 
            ?>
        </div>

        <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-slate-100 mt-8" data-aos="fade-up" data-aos-delay="200">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-700">Tabel Rincian Data Mentah</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider">
                        <tr>
                            <th class="p-4">Prodi</th>
                            <th class="p-4">Pertanyaan</th>
                            <th class="p-4">Jawaban</th>
                            <th class="p-4 text-center">Jml Responden</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php foreach($hasil as $row): ?>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-4 font-semibold text-ocean align-top w-1/6"><?= $row->nama_prodi ?></td>
                            <td class="p-4 text-slate-700 align-top w-1/3"><?= $row->pertanyaan ?></td>
                            <td class="p-4 text-slate-600 align-middle">
                                <?= $row->deskripsi_pilihan ?>
                            </td>
                            <td class="p-4 text-center align-middle">
                                <span class="inline-block w-8 h-8 leading-8 rounded-full bg-slate-100 text-slate-700 font-bold text-xs">
                                    <?= $row->total ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Ambil data PHP yang sudah digroup tadi ke variable JS
    const chartsData = <?= json_encode(array_values($groupedData)) ?>;

    // Loop untuk render setiap chart
    chartsData.forEach((item, index) => {
        const ctx = document.getElementById('chart_' + index).getContext('2d');
        
        new Chart(ctx, {
            type: 'bar', // Bisa diganti 'pie' atau 'doughnut' jika mau variasi
            data: {
                labels: item.labels,
                datasets: [{
                    label: 'Responden',
                    data: item.values,
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)', // Blue
                        'rgba(16, 185, 129, 0.7)', // Emerald
                        'rgba(245, 158, 11, 0.7)', // Amber
                        'rgba(239, 68, 68, 0.7)',  // Red
                        'rgba(99, 102, 241, 0.7)'  // Indigo
                    ],
                    borderColor: 'transparent',
                    borderWidth: 0,
                    borderRadius: 6,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }, // Hide legend karena label bawah sudah jelas
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.raw + ' Mahasiswa';
                            }
                        }
                    }
                },
                scales: {
                    y: { 
                        beginAtZero: true,
                        ticks: { stepSize: 1 }, // Agar tidak ada angka desimal (0.5 orang)
                        grid: { borderDash: [2, 4] }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    });
</script>