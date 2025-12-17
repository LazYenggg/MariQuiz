<div class="mb-6" data-aos="fade-down">
    <h2 class="text-3xl font-bold text-slate-800">Panel Admin Terpadu</h2>
    <p class="text-slate-500">Kelola Pengguna, Struktur Akademik, dan Akses Sistem.</p>
</div>

<div x-data="{ 
    tab: 'users', 
    editUserModal: false, editUserData: {},
    editFakultasModal: false, editFakData: {},
    editJurusanModal: false, editJurData: {},
    editProdiModal: false, editProdiData: {}
}">
    
    <div class="flex gap-4 mb-6 border-b border-slate-200 pb-2 overflow-x-auto" data-aos="fade-right">
        <button @click="tab = 'users'" :class="tab === 'users' ? 'text-ocean border-b-2 border-ocean font-bold' : 'text-slate-500 hover:text-ocean'" class="px-4 py-2 transition">User</button>
        <button @click="tab = 'fakultas'" :class="tab === 'fakultas' ? 'text-ocean border-b-2 border-ocean font-bold' : 'text-slate-500 hover:text-ocean'" class="px-4 py-2 transition">Fakultas</button>
        <button @click="tab = 'jurusan'" :class="tab === 'jurusan' ? 'text-ocean border-b-2 border-ocean font-bold' : 'text-slate-500 hover:text-ocean'" class="px-4 py-2 transition">Jurusan</button>
        <button @click="tab = 'prodi'" :class="tab === 'prodi' ? 'text-ocean border-b-2 border-ocean font-bold' : 'text-slate-500 hover:text-ocean'" class="px-4 py-2 transition">Prodi</button>
    </div>

    <div x-show="tab === 'users'" class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-in-up">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 h-fit">
            <h3 class="font-bold text-lg mb-4 text-slate-700">Buat Akun Baru</h3>
            <form action="<?= base_url('admin/create_user') ?>" method="post" x-data="{ role: 'mahasiswa' }">
                <div class="mb-3">
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Pilih Role</label>
                    <select name="role" x-model="role" class="w-full border p-2 rounded bg-slate-50 outline-none">
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="kaprodi">Kaprodi</option>
                        <option value="pimpinan">Pimpinan Dekanat</option>
                    </select>
                </div>
                <div class="mb-3"><label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama</label><input type="text" name="nama" class="w-full border p-2 rounded" required></div>
                <div class="mb-3"><label class="block text-xs font-bold text-slate-500 uppercase mb-1">ID Login (NIM/NIDN)</label><input type="text" name="username" class="w-full border p-2 rounded" required></div>
                <div class="mb-3"><label class="block text-xs font-bold text-slate-500 uppercase mb-1">Password</label><input type="password" name="password" class="w-full border p-2 rounded" required></div>
                <div x-show="role === 'mahasiswa'" class="mb-4 p-3 bg-blue-50 rounded border border-blue-100">
                    <label class="block text-xs font-bold text-ocean uppercase mb-1">Asal Prodi</label>
                    <select name="id_prodi" class="w-full border p-2 rounded">
                        <?php foreach($prodi as $p): ?><option value="<?= $p->id_prodi ?>"><?= $p->nama_prodi ?></option><?php endforeach; ?>
                    </select>
                </div>
                <button class="w-full bg-ocean text-white py-2 rounded font-bold hover:bg-ocean-dark transition">Buat User</button>
            </form>
        </div>
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h3 class="font-bold text-lg mb-4 text-slate-700">Daftar Pengguna</h3>
            <div class="overflow-auto max-h-[500px]">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 sticky top-0"><tr><th class="p-3">Nama</th><th class="p-3">ID Login</th><th class="p-3">Role</th><th class="p-3 text-right">Aksi</th></tr></thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach($users as $u): ?>
                        <tr class="hover:bg-slate-50">
                            <td class="p-3 font-medium"><?= $u->nama_user ?></td>
                            <td class="p-3 text-slate-500"><?= $u->username ?></td>
                            <td class="p-3"><span class="px-2 py-1 rounded text-xs font-bold uppercase <?= $u->role == 'kaprodi' ? 'bg-purple-100 text-purple-600' : ($u->role == 'pimpinan' ? 'bg-orange-100 text-orange-600' : 'bg-blue-100 text-blue-600') ?>"><?= $u->role ?></span></td>
                            <td class="p-3 text-right flex justify-end gap-2">
                                <button @click="editUserModal = true; editUserData = {id: '<?= $u->id_user ?>', nama: '<?= addslashes($u->nama_user) ?>', username: '<?= $u->username ?>', role: '<?= $u->role ?>'}" class="text-blue-500 hover:bg-blue-50 p-1 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg></button>
                                <a href="<?= base_url('admin/delete_user/'.$u->id_user) ?>" onclick="return confirm('Hapus permanen?')" class="text-red-500 hover:bg-red-50 p-1 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div x-show="tab === 'fakultas'" class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-in-up">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 h-fit">
            <h3 class="font-bold text-lg mb-4">Tambah Fakultas</h3>
            <form action="<?= base_url('admin/store_fakultas') ?>" method="post">
                <div class="mb-3"><label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Fakultas</label><input type="text" name="nama_fakultas" class="w-full border p-2 rounded" required></div>
                <div class="mb-3"><label class="block text-xs font-bold text-slate-500 uppercase mb-1">Pimpinan (Dekan)</label><select name="id_user_pimpinan" class="w-full border p-2 rounded"><option value="">-- Pilih --</option><?php foreach($list_pimpinan as $lp): ?><option value="<?= $lp->id_user ?>"><?= $lp->nama_user ?></option><?php endforeach; ?></select></div>
                <button class="w-full bg-slate-700 text-white py-2 rounded font-bold">Simpan</button>
            </form>
        </div>
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <table class="w-full text-left text-sm"><thead class="bg-slate-50"><tr><th class="p-3">Fakultas</th><th class="p-3">Pimpinan</th><th class="p-3 text-right">Aksi</th></tr></thead>
            <tbody>
                <?php foreach($fakultas as $f): ?>
                <tr class="border-b"><td class="p-3 font-bold"><?= $f->nama_fakultas ?></td><td class="p-3"><?= $f->nama_pimpinan ?? '-' ?></td>
                <td class="p-3 text-right flex justify-end gap-2">
                    <button @click="editFakultasModal = true; editFakData = {id: '<?= $f->id_fakultas ?>', nama: '<?= addslashes($f->nama_fakultas) ?>', id_pim: '<?= $f->id_user_pimpinan ?>'}" class="text-blue-500 bg-blue-50 p-1 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg></button>
                    <a href="<?= base_url('admin/delete_fakultas/'.$f->id_fakultas) ?>" onclick="return confirm('Hapus Fakultas ini? Jurusan & Prodi terkait akan hilang!')" class="text-red-500 bg-red-50 p-1 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></a>
                </td></tr>
                <?php endforeach; ?>
            </tbody></table>
        </div>
    </div>

    <div x-show="tab === 'jurusan'" class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-in-up">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 h-fit">
            <h3 class="font-bold text-lg mb-4">Tambah Jurusan</h3>
            <form action="<?= base_url('admin/store_jurusan') ?>" method="post">
                <div class="mb-3"><label class="block text-xs font-bold text-slate-500 uppercase mb-1">Induk Fakultas</label><select name="id_fakultas" class="w-full border p-2 rounded" required><?php foreach($fakultas as $f): ?><option value="<?= $f->id_fakultas ?>"><?= $f->nama_fakultas ?></option><?php endforeach; ?></select></div>
                <div class="mb-3"><label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Jurusan</label><input type="text" name="nama_jurusan" class="w-full border p-2 rounded" required></div>
                <button class="w-full bg-slate-700 text-white py-2 rounded font-bold">Simpan</button>
            </form>
        </div>
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <table class="w-full text-left text-sm"><thead class="bg-slate-50"><tr><th class="p-3">Jurusan</th><th class="p-3">Fakultas</th><th class="p-3 text-right">Aksi</th></tr></thead>
            <tbody>
                <?php foreach($jurusan as $j): ?>
                <tr class="border-b"><td class="p-3 font-bold"><?= $j->nama_jurusan ?></td><td class="p-3"><?= $j->nama_fakultas ?></td>
                <td class="p-3 text-right flex justify-end gap-2">
                    <button @click="editJurusanModal = true; editJurData = {id: '<?= $j->id_jurusan ?>', nama: '<?= addslashes($j->nama_jurusan) ?>', id_fak: '<?= $j->id_fakultas ?>'}" class="text-blue-500 bg-blue-50 p-1 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg></button>
                    <a href="<?= base_url('admin/delete_jurusan/'.$j->id_jurusan) ?>" onclick="return confirm('Hapus Jurusan ini?')" class="text-red-500 bg-red-50 p-1 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></a>
                </td></tr>
                <?php endforeach; ?>
            </tbody></table>
        </div>
    </div>
    
    <div x-show="tab === 'prodi'" class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-in-up">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 h-fit">
            <h3 class="font-bold text-lg mb-4">Tambah Prodi</h3>
            <form action="<?= base_url('admin/store_prodi') ?>" method="post">
                <div class="mb-3"><label class="block text-xs font-bold text-slate-500 uppercase mb-1">Induk Jurusan</label><select name="id_jurusan" class="w-full border p-2 rounded" required><?php foreach($jurusan as $j): ?><option value="<?= $j->id_jurusan ?>"><?= $j->nama_jurusan ?></option><?php endforeach; ?></select></div>
                <div class="mb-3"><label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Prodi</label><input type="text" name="nama_prodi" class="w-full border p-2 rounded" required></div>
                <div class="mb-3"><label class="block text-xs font-bold text-slate-500 uppercase mb-1">Kaprodi</label><select name="id_user_kaprodi" class="w-full border p-2 rounded"><option value="">-- Pilih --</option><?php foreach($list_kaprodi as $lk): ?><option value="<?= $lk->id_user ?>"><?= $lk->nama_user ?></option><?php endforeach; ?></select></div>
                <button class="w-full bg-slate-700 text-white py-2 rounded font-bold">Simpan</button>
            </form>
        </div>
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <table class="w-full text-left text-sm"><thead class="bg-slate-50"><tr><th class="p-3">Prodi</th><th class="p-3">Jurusan</th><th class="p-3">Kaprodi</th><th class="p-3 text-right">Aksi</th></tr></thead>
            <tbody>
                <?php foreach($prodi as $p): ?>
                <tr class="border-b"><td class="p-3 font-bold"><?= $p->nama_prodi ?></td><td class="p-3"><?= $p->nama_jurusan ?></td><td class="p-3"><?= $p->nama_kaprodi ?? '-' ?></td>
                <td class="p-3 text-right flex justify-end gap-2">
                    <button @click="editProdiModal = true; editProdiData = {id: '<?= $p->id_prodi ?>', nama: '<?= addslashes($p->nama_prodi) ?>', id_jur: '<?= $p->id_jurusan ?>', id_kap: '<?= $p->id_user_kaprodi ?>'}" class="text-blue-500 bg-blue-50 p-1 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg></button>
                    <a href="<?= base_url('admin/delete_prodi/'.$p->id_prodi) ?>" onclick="return confirm('Hapus Prodi ini?')" class="text-red-500 bg-red-50 p-1 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></a>
                </td></tr>
                <?php endforeach; ?>
            </tbody></table>
        </div>
    </div>

    <div x-show="editUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
        <div class="bg-white p-6 rounded-2xl w-full max-w-md animate-fade-in-up">
            <h3 class="font-bold mb-4">Edit User</h3>
            <form action="<?= base_url('admin/update_user') ?>" method="post">
                <input type="hidden" name="id_user" :value="editUserData.id">
                <input type="hidden" name="role" :value="editUserData.role">
                <div class="mb-3"><label class="text-xs font-bold text-gray-500">Nama</label><input type="text" name="nama" x-model="editUserData.nama" class="w-full border p-2 rounded"></div>
                <div class="mb-3"><label class="text-xs font-bold text-gray-500">Username</label><input type="text" name="username" x-model="editUserData.username" class="w-full border p-2 rounded"></div>
                <div class="mb-4"><label class="text-xs font-bold text-gray-500">Pass Baru (Opsional)</label><input type="password" name="password" class="w-full border p-2 rounded"></div>
                <div class="flex justify-end gap-2"><button type="button" @click="editUserModal = false" class="px-4 py-2 text-gray-500">Batal</button><button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button></div>
            </form>
        </div>
    </div>

    <div x-show="editFakultasModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
        <div class="bg-white p-6 rounded-2xl w-full max-w-md animate-fade-in-up">
            <h3 class="font-bold mb-4">Edit Fakultas</h3>
            <form action="<?= base_url('admin/update_fakultas') ?>" method="post">
                <input type="hidden" name="id_fakultas" :value="editFakData.id">
                <div class="mb-3"><label class="text-xs font-bold text-gray-500">Nama</label><input type="text" name="nama_fakultas" x-model="editFakData.nama" class="w-full border p-2 rounded"></div>
                <div class="mb-4"><label class="text-xs font-bold text-gray-500">Pimpinan</label><select name="id_user_pimpinan" x-model="editFakData.id_pim" class="w-full border p-2 rounded"><option value="">-- Pilih --</option><?php foreach($list_pimpinan as $lp): ?><option value="<?= $lp->id_user ?>"><?= $lp->nama_user ?></option><?php endforeach; ?></select></div>
                <div class="flex justify-end gap-2"><button type="button" @click="editFakultasModal = false" class="px-4 py-2 text-gray-500">Batal</button><button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button></div>
            </form>
        </div>
    </div>

    <div x-show="editJurusanModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
        <div class="bg-white p-6 rounded-2xl w-full max-w-md animate-fade-in-up">
            <h3 class="font-bold mb-4">Edit Jurusan</h3>
            <form action="<?= base_url('admin/update_jurusan') ?>" method="post">
                <input type="hidden" name="id_jurusan" :value="editJurData.id">
                <div class="mb-3"><label class="text-xs font-bold text-gray-500">Nama</label><input type="text" name="nama_jurusan" x-model="editJurData.nama" class="w-full border p-2 rounded"></div>
                <div class="mb-4"><label class="text-xs font-bold text-gray-500">Fakultas Induk</label><select name="id_fakultas" x-model="editJurData.id_fak" class="w-full border p-2 rounded"><?php foreach($fakultas as $f): ?><option value="<?= $f->id_fakultas ?>"><?= $f->nama_fakultas ?></option><?php endforeach; ?></select></div>
                <div class="flex justify-end gap-2"><button type="button" @click="editJurusanModal = false" class="px-4 py-2 text-gray-500">Batal</button><button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button></div>
            </form>
        </div>
    </div>

    <div x-show="editProdiModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
        <div class="bg-white p-6 rounded-2xl w-full max-w-md animate-fade-in-up">
            <h3 class="font-bold mb-4">Edit Prodi</h3>
            <form action="<?= base_url('admin/update_prodi') ?>" method="post">
                <input type="hidden" name="id_prodi" :value="editProdiData.id">
                <div class="mb-3"><label class="text-xs font-bold text-gray-500">Nama</label><input type="text" name="nama_prodi" x-model="editProdiData.nama" class="w-full border p-2 rounded"></div>
                <div class="mb-3"><label class="text-xs font-bold text-gray-500">Jurusan Induk</label><select name="id_jurusan" x-model="editProdiData.id_jur" class="w-full border p-2 rounded"><?php foreach($jurusan as $j): ?><option value="<?= $j->id_jurusan ?>"><?= $j->nama_jurusan ?></option><?php endforeach; ?></select></div>
                <div class="mb-4"><label class="text-xs font-bold text-gray-500">Kaprodi</label><select name="id_user_kaprodi" x-model="editProdiData.id_kap" class="w-full border p-2 rounded"><option value="">-- Pilih --</option><?php foreach($list_kaprodi as $lk): ?><option value="<?= $lk->id_user ?>"><?= $lk->nama_user ?></option><?php endforeach; ?></select></div>
                <div class="flex justify-end gap-2"><button type="button" @click="editProdiModal = false" class="px-4 py-2 text-gray-500">Batal</button><button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button></div>
            </form>
        </div>
    </div>
</div>