<div x-data="{ editModal: false, editItem: {} }" class="min-h-screen pb-10">
    
    <div class="flex items-center justify-between mb-8" data-aos="fade-down">
        <div>
            <h2 class="text-3xl font-bold text-slate-800">Manajemen Soal</h2>
            <p class="text-slate-500 text-sm mt-1">Atur pertanyaan untuk periode kuisioner ini.</p>
        </div>
        
        <a href="<?= base_url('kaprodi/dashboard') ?>" 
           class="group flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-full shadow-sm hover:shadow-md hover:border-ocean-light transition-all duration-300 text-slate-600 hover:text-ocean">
            <div class="bg-slate-100 p-1.5 rounded-full group-hover:bg-ocean-light group-hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </div>
            <span class="font-medium text-sm">Kembali ke Dashboard</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-3xl shadow-lg border border-slate-100 sticky top-24" data-aos="fade-right">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                    <div class="bg-blue-100 p-2 rounded-xl text-ocean">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-700">Buat Pertanyaan</h3>
                </div>

                <form action="<?= base_url('kaprodi/store_pertanyaan') ?>" method="post">
                    <input type="hidden" name="id_periode" value="<?= $id_periode ?>">
                    
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Redaksi Pertanyaan</label>
                        <textarea name="pertanyaan" class="w-full border-slate-200 bg-slate-50 focus:bg-white focus:border-ocean rounded-2xl p-4 text-slate-700 shadow-inner h-32 transition outline-none resize-none" placeholder="Tulis pertanyaan di sini..." required></textarea>
                    </div>

                    <div class="space-y-3 mb-6">
                        <label class="block text-xs font-bold text-slate-500 uppercase ml-1">Opsi Jawaban</label>
                        <div class="flex items-center gap-2"><span class="text-slate-400 text-xs w-4">A</span><input type="text" name="pilihan[]" class="flex-1 border p-2 rounded-lg text-sm bg-slate-50 focus:bg-white outline-none focus:ring-1 focus:ring-ocean" placeholder="Pilihan A" required></div>
                        <div class="flex items-center gap-2"><span class="text-slate-400 text-xs w-4">B</span><input type="text" name="pilihan[]" class="flex-1 border p-2 rounded-lg text-sm bg-slate-50 focus:bg-white outline-none focus:ring-1 focus:ring-ocean" placeholder="Pilihan B" required></div>
                        <div class="flex items-center gap-2"><span class="text-slate-400 text-xs w-4">C</span><input type="text" name="pilihan[]" class="flex-1 border p-2 rounded-lg text-sm bg-slate-50 focus:bg-white outline-none focus:ring-1 focus:ring-ocean" placeholder="Pilihan C (Opsional)"></div>
                        <div class="flex items-center gap-2"><span class="text-slate-400 text-xs w-4">D</span><input type="text" name="pilihan[]" class="flex-1 border p-2 rounded-lg text-sm bg-slate-50 focus:bg-white outline-none focus:ring-1 focus:ring-ocean" placeholder="Pilihan D (Opsional)"></div>
                        <div class="flex items-center gap-2"><span class="text-slate-400 text-xs w-4">E</span><input type="text" name="pilihan[]" class="flex-1 border p-2 rounded-lg text-sm bg-slate-50 focus:bg-white outline-none focus:ring-1 focus:ring-ocean" placeholder="Pilihan E (Opsional)"></div>
                    </div>

                    <button class="w-full bg-ocean hover:bg-ocean-dark text-white py-3 rounded-xl font-bold shadow-lg shadow-blue-500/20 transition transform hover:-translate-y-1 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Soal
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-4">
            
            <?php if(empty($pertanyaan)): ?>
                <div class="flex flex-col items-center justify-center h-64 bg-white rounded-3xl border-2 border-dashed border-slate-200 text-slate-400" data-aos="zoom-in">
                    <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <p>Belum ada pertanyaan dibuat.</p>
                </div>
            <?php else: ?>
                <div class="flex justify-between items-end mb-2 px-2">
                    <h3 class="font-bold text-slate-700">Daftar Pertanyaan (<?= count($pertanyaan) ?>)</h3>
                </div>

                <?php foreach($pertanyaan as $index => $p): ?>
                <div class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition relative overflow-hidden" data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                    <div class="absolute -right-2 -top-4 text-9xl font-bold text-slate-50 opacity-20 pointer-events-none select-none">
                        <?= $index + 1 ?>
                    </div>

                    <div class="relative z-10">
                        <div class="flex justify-between items-start gap-4">
                            <h4 class="text-lg font-semibold text-slate-800 leading-snug mb-3 flex-1">
                                <?= $p->pertanyaan ?>
                            </h4>
                            
                            <div class="flex gap-2 shrink-0">
                                <button @click="editModal = true; editItem = { id: '<?= $p->id_pertanyaan ?>', text: '<?= addslashes($p->pertanyaan) ?>' }" 
                                        class="p-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-500 hover:text-white transition shadow-sm" title="Edit Typo">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <a href="<?= base_url('kaprodi/delete_pertanyaan/'.$p->id_pertanyaan) ?>" onclick="return confirm('Yakin hapus soal ini?')" 
                                   class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-500 hover:text-white transition shadow-sm" title="Hapus Soal">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div x-show="editModal" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
         
        <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-lg mx-4" @click.outside="editModal = false">
            <h3 class="text-xl font-bold text-slate-800 mb-4">Edit Pertanyaan</h3>
            
            <form action="<?= base_url('kaprodi/update_pertanyaan') ?>" method="post">
                <input type="hidden" name="id_pertanyaan" :value="editItem.id">
                
                <div class="mb-6">
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Koreksi Teks</label>
                    <textarea name="pertanyaan" x-model="editItem.text" class="w-full border-slate-200 bg-slate-50 focus:bg-white focus:border-ocean rounded-2xl p-4 h-32 resize-none outline-none" required></textarea>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" @click="editModal = false" class="px-5 py-2.5 text-slate-500 hover:bg-slate-100 rounded-xl transition">Batal</button>
                    <button class="px-6 py-2.5 bg-ocean text-white font-bold rounded-xl hover:bg-ocean-dark transition shadow-lg shadow-blue-500/30">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

</div>