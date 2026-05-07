<!DOCTYPE html>
<html>

<head>
    <title>Manajemen Karyawan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h2>Daftar Karyawan</h2>
        <div>
            <a href="<?php echo e(route('karyawan.pdf')); ?>" class="btn btn-danger">Cetak PDF</a>
            <button onclick="tambahKaryawan()" class="btn btn-primary">Tambah Karyawan</button>
            <button onclick="logout()" class="btn btn-outline-secondary">Logout</button>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Tgl Lahir</th>
                <th>Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($k->Id); ?></td>
                <td><?php echo e($k->Nama); ?></td>
                <td><?php echo e($k->{'Tgl Lahir'}); ?></td>
                <td>Rp <?php echo e(number_format($k->Gaji, 2)); ?></td>
                <td>
                    <button
                        onclick="editKaryawan(<?php echo e($k->Id); ?>, '<?php echo e($k->Nama); ?>', '<?php echo e($k->{'Tgl Lahir'}); ?>', <?php echo e($k->Gaji); ?>)"
                        class="btn btn-warning btn-sm">Edit</button>
                    <button onclick="hapusKaryawan(<?php echo e($k->Id); ?>)" class="btn btn-danger btn-sm">Hapus</button>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>


    <script>
        // Pastikan URL sesuai dengan php artisan route:list Anda
        const API_URL = window.location.origin + '/api/karyawan';

        async function tambahKaryawan() {
            const nama = prompt("Masukkan Nama:");
            const tgl = prompt("Masukkan Tanggal Lahir (YYYY-MM-DD):");
            const gaji = prompt("Masukkan Gaji:");

            if (!nama || !tgl || !gaji) return;

            try {
                const response = await fetch(API_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        // Sesuai soal No. 6, akses butuh token 
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    },
                    body: JSON.stringify({
                        'Nama': nama,
                        'Tgl Lahir': tgl,
                        'Gaji': gaji
                    })
                });

                if (response.status === 401) {
                    alert("Sesi habis atau belum login (JWT Expired 1 Menit) ");
                } else if (response.ok) {
                    alert('Data Berhasil Ditambah! Cek tabel TLOG untuk Audit Log ');
                    location.reload();
                }
            } catch (error) {
                console.error("Error:", error);
            }
        }

        async function editKaryawan(id, namaLama, tglLama, gajiLama) {
            const nama = prompt("Ubah Nama:", namaLama);
            const tgl = prompt("Ubah Tanggal Lahir (YYYY-MM-DD):", tglLama);
            const gaji = prompt("Ubah Gaji:", gajiLama);

            if (!nama || !tgl || !gaji) return;

            try {
                const response = await fetch(`${API_URL}/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    },
                    body: JSON.stringify({
                        'Nama': nama,
                        'Tgl Lahir': tgl,
                        'Gaji': gaji
                    })
                });

                if (response.ok) {
                    alert('Data Berhasil Diperbarui!');
                    location.reload();
                } else {
                    alert('Gagal mengupdate. Pastikan token masih aktif.');
                }
            } catch (error) {
                console.error("Error:", error);
            }
        }

        async function hapusKaryawan(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) return;

            try {
                const response = await fetch(`${API_URL}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    }
                });

                if (response.ok) {
                    alert('Data Berhasil Dihapus!');
                    location.reload();
                } else {
                    alert('Gagal menghapus. Pastikan Anda sudah login.');
                }
            } catch (error) {
                console.error("Error:", error);
            }
        }

        function logout() {
            localStorage.removeItem('access_token');
            window.location.href = '/login';
        }
    </script>
</body>

</html><?php /**PATH C:\xampp\htdocs\management_system\resources\views/karyawan/index.blade.php ENDPATH**/ ?>