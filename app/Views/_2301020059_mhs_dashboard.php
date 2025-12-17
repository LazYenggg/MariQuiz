<?php if(isset($mode) && $mode == 'isi'): ?>
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-8" data-aos="fade-down">
            <h2 class="text-3xl font-bold text-ocean-dark">Isi Kuisioner</h2>
            <p class="text-slate-500">Berikan penilaian objektif Anda.</p>
        </div>

        <form action="<?= base_url('mahasiswa/submit') ?>" method="post" class="space-y-8">
            <input type="hidden" name="id_periode" value="<?= $id_periode ?>">
            
            <?php foreach($pertanyaan as $index => $p): ?>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                <div class="flex gap-4 mb-4">
                    <span class="flex-shrink-0 h-8 w-8 bg-ocean-light text-white rounded-full flex items-center justify-center font-bold">
                        <?= $index + 1 ?>
                    </span>
                    <p class="text-lg font-medium text-slate-800 pt-1"><?= $p->pertanyaan ?></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 pl-12" 
                     x-data="{ selected: '<?= $jawaban_existing[$p->id_pertanyaan] ?? '' ?>' }">
                    
                    <?php foreach($p->pilihan as $pil): ?>
                    <label class="cursor-pointer relative">
                        <input type="radio" 
                               name="jawaban[<?= $p->id_pertanyaan ?>]" 
                               value="<?= $pil->id_pilihan_jawaban ?>" 
                               class="peer sr-only" 
                               @click="selected = '<?= $pil->id_pilihan_jawaban ?>'"
                               :checked="selected == '<?= $pil->id_pilihan_jawaban ?>'"
                               required>
                        
                        <div class="p-4 rounded-xl border-2 transition-all duration-200"
                             :class="selected == '<?= $pil->id_pilihan_jawaban ?>' ? 'border-ocean bg-blue-50 text-ocean-dark ring-2 ring-blue-100' : 'border-slate-200 hover:border-blue-300 bg-white text-slate-600'">
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full border border-current flex items-center justify-center">
                                    <div class="w-2 h-2 rounded-full bg-current" x-show="selected == '<?= $pil->id_pilihan_jawaban ?>'"></div>
                                </div>
                                <span class="font-medium"><?= $pil->deskripsi_pilihan ?></span>
                            </div>
                        </div>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="flex justify-end pt-4" data-aos="fade-up">
                <button type="submit" class="bg-ocean hover:bg-ocean-dark text-white px-8 py-4 rounded-xl font-bold shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-1 flex items-center gap-2">
                    <span>Kirim Jawaban</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" /></svg>
                </button>
            </div>
        </form>
    </div>

<?php else: ?>
    <div class="mb-8" data-aos="fade-right">
        <h2 class="text-3xl font-bold text-slate-800">Halo, <?= session()->get('nama_user') ?>!</h2>
        <p class="text-slate-500">Berikut daftar kuisioner yang tersedia untuk Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach($periodes as $p): ?>
        <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition border border-slate-100 relative overflow-hidden group" data-aos="fade-up">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <svg class="w-24 h-24 text-ocean" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" /><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" /></svg>
            </div>
            
            <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2 py-1 rounded uppercase mb-4 inline-block">
                <?= $p->status_periode ?>
            </span>
            <h3 class="text-xl font-bold text-slate-800 mb-2"><?= $p->keterangan ?></h3>
            <p class="text-slate-500 text-sm mb-6">Silakan isi kuisioner ini sebelum tenggat waktu berakhir.</p>
            
            <a href="<?= base_url('mahasiswa/isi/'.$p->id_periode) ?>" class="inline-block w-full text-center bg-ocean text-white py-2 rounded-xl font-semibold hover:bg-ocean-dark transition shadow-lg shadow-blue-500/30">
                Mulai Mengisi
            </a>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>