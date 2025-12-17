<div class="mb-8" data-aos="fade-down">
    <h2 class="text-3xl font-bold text-slate-800">Dashboard Pimpinan</h2>
    <?php if(isset($fakultas)): ?>
        <p class="text-slate-500 mt-1">Monitoring Evaluasi Akademik - <span class="text-ocean font-bold"><?= $fakultas->nama_fakultas ?></span></p>
    <?php else: ?>
        <p class="text-red-500 mt-1">Anda belum ditugaskan memimpin fakultas apapun.</p>
    <?php endif; ?>
</div>

<?php if(empty($periodes)): ?>
    <div class="bg-white p-12 rounded-3xl shadow-sm border border-slate-100 text-center" data-aos="zoom-in">
        <div class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-700">Belum Ada Data Evaluasi</h3>
        <p class="text-slate-500">Belum ada periode kuisioner yang dibuat untuk fakultas Anda.</p>
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach($periodes as $index => $p): ?>
        <div class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 relative overflow-hidden" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
            <div class="absolute top-0 left-0 w-1 h-full bg-ocean"></div>
            
            <div class="flex justify-between items-start mb-4">
                <div class="p-2 rounded-lg bg-blue-50 text-ocean">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <span class="px-3 py-1 text-xs font-bold uppercase tracking-wide rounded-full <?= $p->status_periode == 'aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' ?>">
                    <?= $p->status_periode ?>
                </span>
            </div>

            <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-ocean transition"><?= $p->keterangan ?></h3>
            <p class="text-slate-500 text-sm mb-6">Klik untuk melihat analisis grafik dan detail jawaban.</p>

            <a href="<?= base_url('pimpinan/summary/'.$p->id_periode) ?>" 
               class="block w-full text-center bg-slate-50 text-slate-700 py-2.5 rounded-xl font-semibold hover:bg-ocean hover:text-white transition-colors duration-300 shadow-sm">
               Lihat Laporan & Analisa
            </a>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>