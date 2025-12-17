<div class="mb-8" data-aos="fade-down">
    <h2 class="text-3xl font-bold text-slate-800">Dashboard Kaprodi</h2>
    <p class="text-slate-500 mt-1">Kelola kuisioner untuk Prodi: <span class="text-ocean font-bold"><?= $nama_prodi ?></span></p>
</div>

<div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 mb-8" data-aos="fade-up">
    <h3 class="font-bold text-lg mb-4 text-slate-700">Buat Periode Baru</h3>
    <form action="<?= base_url('kaprodi/create_periode') ?>" method="post" class="flex gap-4">
        <input type="text" name="keterangan" placeholder="Contoh: Evaluasi Semester Genap 2025" class="flex-1 border p-3 rounded-xl bg-slate-50 outline-none focus:ring-2 focus:ring-ocean/20" required>
        <button class="bg-ocean text-white px-6 py-3 rounded-xl font-bold hover:bg-ocean-dark transition">Buat Periode</button>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach($periodes as $p): ?>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition relative overflow-hidden group">
        <div class="flex justify-between items-start mb-4">
            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">AKTIF</span>
            <div class="flex gap-2">
                <a href="<?= base_url('kaprodi/manage/'.$p->id_periode) ?>" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition" title="Atur Soal">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </a>
                <a href="<?= base_url('kaprodi/summary/'.$p->id_periode) ?>" class="p-2 bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-600 hover:text-white transition" title="Lihat Hasil">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </a>
            </div>
        </div>
        <h3 class="font-bold text-slate-800 text-lg mb-1"><?= $p->keterangan ?></h3>
        <p class="text-xs text-slate-400">ID: <?= $p->id_periode ?></p>
    </div>
    <?php endforeach; ?>
</div>