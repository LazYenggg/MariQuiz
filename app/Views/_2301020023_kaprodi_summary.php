<div class="space-y-6">
    <div class="flex justify-between items-center" data-aos="fade-down">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Analisis Hasil Kuisioner</h2>
            <p class="text-slate-500">Visualisasi data dan detail jawaban responden.</p>
        </div>
        <a href="javascript:history.back()" class="px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-lg hover:bg-slate-50 transition shadow-sm">
            Kembali
        </a>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100" data-aos="fade-up">
        <h3 class="text-lg font-bold text-slate-700 mb-4">Grafik Sebaran Jawaban</h3>
        <div class="h-80 w-full">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-slate-100" data-aos="fade-up" data-aos-delay="100">
        <div class="p-6 border-b border-slate-100">
            <h3 class="font-bold text-slate-700">Detail Data Tabular</h3>
        </div>
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wider font-semibold">
                <tr>
                    <th class="p-4">Pertanyaan</th>
                    <th class="p-4">Opsi Jawaban</th>
                    <th class="p-4 text-center">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php 
                // Persiapan Data untuk Chart JS
                $labels = [];
                $dataPoints = [];
                $colors = [];
                
                foreach($hasil as $row): 
                    // Simpan data untuk chart
                    $labels[] = substr($row->deskripsi_pilihan, 0, 15) . '...'; 
                    $dataPoints[] = $row->total;
                ?>
                <tr class="hover:bg-blue-50 transition">
                    <td class="p-4 font-medium text-slate-700 w-1/2"><?= $row->pertanyaan ?></td>
                    <td class="p-4 text-slate-600"><?= $row->deskripsi_pilihan ?></td>
                    <td class="p-4 text-center font-bold text-ocean"><?= $row->total ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            // PHP Array to JS Array
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Jumlah Responden',
                data: <?= json_encode($dataPoints) ?>,
                backgroundColor: 'rgba(14, 165, 233, 0.6)', // Ocean Light
                borderColor: 'rgba(3, 105, 161, 1)', // Ocean Dark
                borderWidth: 1,
                borderRadius: 5,
                barPercentage: 0.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>