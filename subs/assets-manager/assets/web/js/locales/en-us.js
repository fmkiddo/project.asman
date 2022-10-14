/**
 *
 **/

$(document).ready (function () {

	$doclocale	= {
		'title': 'Sistem Manajemen Aset',
		'setup': {
			'{0}': 'Halo dan Selamat Datang',
			'{1}': 'Sepertinya anda baru pertama kali menggunakan software manajer aset ini.',
			'{2}': 'Untuk melanjutkan silakan untuk membuat akun Administrator utama terlebih dahulu.',
			'{3}': 'Klik untuk memulai konfigurasi sistem',
			'{4}': 'Lanjutkan',
			'{5}': 'Silakan lengkapi informasi nama pengguna dan email',
			'{6}': 'Nama Pengguna',
			'{7}': 'john_doe',
			'{8}': 'Email',
			'{9}': 'johndoe117@google.com',
			'{10}': 'Klik untuk membersihkan form',
			'{11}': 'Ulangi',
			'{12}': 'Klik untuk isi form selanjutnya',
			'{13}': 'Berikutnya',
			'{14}': 'Halo',
			'{15}': 'Silakan tentukan kata sandi untuk pengguna ini',
			'{16}': 'Kata Sandi',
			'{17}': 'Konfirmasi Kata Sandi',
			'{18}': 'Klik untuk kembali ke form sebelumnya',
			'{19}': 'Sebelumnya',
			'{20}': 'sekarang silakan isi profile anda, klik "Berikutnya" untuk melewati langkah ini!',
			'{21}': 'Nama Depan',
			'{22}': 'Nama depan anda',
			'{23}': 'Nama Tengah',
			'{24}': 'Nama tengah anda',
			'{25}': 'Nama Belakang',
			'{26}': 'Nama belakang anda',
			'{27}': 'Alamat Utama',
			'{28}': 'Alamat domisili utama',
			'{29}': 'Alamat Lain',
			'{30}': 'Keterangan alamat tambahan',
			'{31}': 'No. Telepon',
			'{32}': 'Nomor telepon anda',
			'{33}': 'Klik untuk masuk ke halaman ringkasan!',
			'{34}': 'Informasi Pengguna',
			'{35}': 'Informasi Profil Pengguna',
			'{36}': 'Klik untuk mengulangi isian form dari awal',
			'{37}': 'Ulangi',
			'{38}': 'Klik untuk mulai mengirim informasi',
			'{39}': 'Kirim'
		},
		'user-login': {
			'{0}': 'Otentikasi',
			'{1}': 'untuk menggunakan Manajer Aset',
			'{2}': 'Otentikasi Lisensi',
			'{3}': 'Lupa',
			'{4}': 'Otentikasikan',
			'{5}': 'Masuk',
			'{6}': 'untuk melanjutkan ke Manajer Aset',
			'{7}': 'Nama Pengguna/Email',
			'{8}': 'Lupa Nama Pengguna',
			'{9}': 'Klik untuk mendaftar',
			'{10}': 'Daftar Akun',
			'{11}': 'Klik untuk verifikasi nama pengguna',
			'{12}': 'Berikut',
			'{13}': 'Kata Sandi',
			'{14}': 'Lupa Kata Sandi',
			'{15}': 'Kembali ke akun',
			'{16}': 'Kembali',
			'{17}': 'Mulai masuk ke Manajer Aset',
			'{18}': 'Halo',
			'{19}': 'Kunci Otentikasi'
		},
		'pages': {
			'{0}': 'Dashboard',
			'{1}': 'Assets',
			'{2}': 'Asset Menu',
			'{3}': 'Assets Master Data',
			'{4}': 'Asset Registration',
			'{5}': 'Asset Categories',
			'{6}': 'Asset Request Menu',
			'{7}': 'Assets Requests',
			'{8}': 'Asset Movements Menu',
			'{9}': 'New Asset Request',
			'{10}': 'Asset Movements',
			'{11}': 'Asset Receipt',
			'{12}': 'Asset Destruction',
			'{15}': 'Location',
			'{16}': 'Pengguna Sistem',
			'{17}': 'Menu Pengguna',
			'{18}': 'Daftar Pengguna',
			'{19}': 'Buat Pengguna Baru',
			'{20}': 'Menu Grup',
			'{21}': 'Daftar Grup Pengguna',
			'{22}': 'Buat Grup Baru',
			'{23}': 'Unggahan',
			'{24}': 'Pengaturan',
			'{25}': 'Pengaturan Pengguna',
			'{26}': 'Profil',
			'{27}': 'Pengaturan',
			'{28}': 'Keluar',
			'{29}': 'Pesan Pesan',
			'{30}': 'Lihat Semua Pesan',
			'{31}': 'Pemberitahuan',
			'{32}': 'Lihat Semua Pemberitahuan',
			'{33}': 'Tidak Ada Pesan Baru',
			'{34}': 'Tidak Ada Pemberitahuan',
			'{35}': 'Profile Pengguna',
			'{37}': 'Tentang'
		},
		'contents': {
			'master-assets': {
				'{0}': 'Data Aset'
			},
			'new-asset': {
				'{0}': 'Pendaftaran Aset Baru',
				'{1}': 'Kode Barang',
				'{2}': 'Deskripsi Barang',
				'{3}': 'Kategori Barang',
				'{4}': 'Catatan',
				'{5}': 'No. Purchase Order',
				'{6}': 'Nilai Perolehan',
				'{7}': 'Data Lokasi',
				'{8}': 'Pilihan Lokasi',
				'{9}': 'Pilihan Sublokasi',
				'{10}': 'Klik untuk menambahkan lokasi',
				'{11}': 'Lokasi',
				'{12}': 'Klik untuk menambahkan atribut kategori item',
				'{13}': 'Atribut',
				'{14}': 'Klik untuk menyimpan data item aset baru',
				'{15}': 'Simpan'
			},
			'location': {
				'{0}': 'Daftar Lokasi',
				'{1}': 'Register Lokasi Baru',
				'{2}': 'Kode',
				'{3}': 'Deskripsi',
				'{4}': 'No. Telpon',
				'{5}': 'Alamat',
				'{6}': 'Penanggung Jawab',
				'{7}': 'Email',
				'{8}': 'Catatan',
				'{9}': 'Operasi'
			},
			'location-detail': {
				'{0}': 'Detail Informasi Lokasi - ',
				'{1}': 'Informasi Detil',
				'{2}': 'Informasi Detil Lokasi',
				'{3}': 'Kode',
				'{4}': 'Deskripsi',
				'{5}': 'No. Telpon',
				'{6}': 'Alamat',
				'{7}': 'Penanggung Jawab',
				'{8}': 'Email',
				'{9}': 'Catatan',
				'{10}': 'Total Aset',
				'{11}': 'Klik untuk mengubah informasi lokasi',
				'{12}': 'Ubah',
				'{13}': 'Data Sublokasi',
				'{14}': 'Data Sublokasi - ',
				'{15}': 'Tambah Sublokasi',
				'{16}': 'Kode',
				'{17}': 'Deskripsi',
				'{18}': 'Operasi',
				'{19}': 'Ubah',
				'{20}': 'Hapus',
				'{21}': 'Daftar Aset Per Lokasi',
				'{22}': 'Daftar Aset di ',
				'{23}': 'Register Aset Baru'
			},
			'form-sublocation': {
				'{0}': 'Tambah/Update Informasi Sublokasi - Lokasi ',
				'{1}': 'Form Sublokasi',
				'{2}': 'Kode',
				'{3}': 'Deskripsi',
				'{4}': 'Klik untuk mengirimkan formulir sublokasi',
				'{5}': 'Kirim',
				'{6}': 'Klik untuk mengulangi isian',
				'{7}': 'Ulangi',
				'{8}': 'Informasi Lokasi',
				'{9}': 'Kode',
				'{10}': 'Nama',
				'{11}': 'Alamat',
				'{12}': 'PIC'
			},
			'doc-assetreq': {
				'{0}': 'Permintaan Aset',
				'{1}': 'Ringkasan Permintaan',
				'{2}': 'Permintaan Aset Baru',
				'{3}': 'Permintaan Perpindahan Aset',
				'{4}': 'Permintaan Pemusnahan Aset',
				'{5}': 'Total Dokumen Permintaan',
				'{6}': 'Dokumen Permintaan Baru',
				'{7}': 'Permintaan Pemindahan Aset',
				'{8}': 'Permintaan Pemusnahan Aset',
				'{9}': 'Perbarui',
				'{10}': 'No. Dokumen',
				'{11}': 'Tgl. Dokumen',
				'{12}': 'Permintaan',
				'{13}': 'Pemohon',
				'{14}': 'Status',
				'{15}': '--- Permintaan Aset Baru ---',
				'{16}': 'Belum Terdaftar',
				'{17}': 'Sudah Terdaftar',
				'{18}': 'Aset Baru Belum Terdaftar',
				'{19}': 'Aset Baru Terdaftar',
				'{20}': 'Pilih Lokasi',
				'{21}': 'Nama',
				'{22}': 'ex. PC 1 set acer aspire',
				'{23}': 'Deskripsi Barang',
				'{24}': 'ex. PC 1 set dengan spesifikasi etc.',
				'{25}': 'Jumlah',
				'{26}': 'ex. 2',
				'{27}': 'Estimasi Nilai',
				'{28}': 'ex. 8.000.000',
				'{29}': 'Tambahkan Gambar',
				'{30}': 'Hapus Gambar',
				'{31}': 'Simpan Permintaan',
				'{32}': 'Ulangi',
				'{33}': 'Cari ...',
				'{34}': 'Kode',
				'{35}': 'Nama',
				'{36}': 'Lokasi Asal',
				'{37}': 'Lokasi Tujuan',
				'{38}': 'Tambah Aset',
				'{39}': 'Sublokasi Asal',
				'{40}': '--- Pilih Lokasi ---',
				'{41}': 'Sublokasi',
				'{42}': 'Data Pemusnahan',
				'{43}': 'Klik untuk mengirimkan pengajuan',
				'{44}': 'Ajukan',
				'{45}': 'Klik untuk Ulangi pengajuan anda'
			},
			'doc-assetin': {
				'{0}': 'Penerimaan Aset',
				'{1}': 'Kedatangan Perpindahan Aset',
				'{2}': 'Pusat Distribusi Penerimaan Aset',
				'{3}': 'Dokumen Perpindahan Aset',
				'{4}': 'Dokumen Aset Menunggu Dikirim',
				'{5}': 'Dokumen Aset Terkirim',
				'{6}': 'Dokumen Aset Diterima',
				'{7}': 'Perbarui',
				'{8}': 'No. Dokumen',
				'{9}': 'Tgl. Dokumen', 
				'{10}': 'Lokasi Asal',
				'{11}': 'Lokasi Tujuan',
				'{12}': 'Pembuat',
				'{13}': 'Status',
				'{14}': 'Dokumen Perpindahan Aset Sudah Diterima',
				'{15}': 'Belum Ada Dokumen!',
				'{16}': 'Kode',
				'{17}': 'Nama',
				'{18}': 'Sublokasi Awal',
				'{19}': 'Sublokasi Tujuan',
				'{20}': 'Jumlah'
			},
			'doc-assetout': {
				'{0}': 'Perpindahan Aset'
			},
			'doc-assetremoval': {
				'{0}': 'Pemusnahan Aset',
				'{1}': 'Ringkasan Pemusnahan Aset',
				'{2}': 'Pemusnahan Aset',
				'{3}': 'Ringkasan Permintaan Pemusnahan Aset',
				'{4}': 'Dokumen Pemusnahan Aset',
				'{5}': 'Dokumen Menunggu Approval Pemusnahan',
				'{6}': 'Dokumen Ditolak / Disetujui / Selesai',
				'{7}': 'No. Dokumen',
				'{8}': 'Tgl. Dokumen',
				'{9}': 'Pemohon',
				'{10}': 'Lokasi',
				'{11}': 'Disetujui',
				'{12}': 'Tgl. Persetujuan',
				'{13}': 'Status',
				'{14}': 'Pemusnahan Aset',
				'{15}': 'Belum Ada Dokumen!'
			},
			'user-profile': {
				'{0}': 'Profile Pengguna',
				'{1}': 'Nama Depan',
				'{2}': 'Nama Tengah',
				'{3}': 'Nama Belakang',
				'{4}': 'No. Telpon',
				'{5}': 'Email',
				'{6}': 'Alamat 1',
				'{7}': 'Alamat 2',
				'{8}': 'Simpan',
				'{9}': 'Klik untuk menyimpan profil anda',
				'{10}': 'Batal',
				'{11}': 'Klik untuk mengulangi isi profil anda',
				'{12}': 'Ambil Gambar',
				'{13}': 'Klik untuk mengupload foto anda!'
			},
			'file-manager': {
				'{0}': 'Pengelola File Unggahan',
				'{1}': 'Daftar Gambar',
				'{2}': 'Gambar',
				'{3}': 'Nama File',
				'{4}': 'Tgl. Ditambahkan',
				'{5}': 'Ukuran',
				'{6}': 'Link',
				'{7}': 'Pusat Pemrosesan File',
				'{8}': 'Unggah Gambar',
				'{9}': 'Klik untuk memilih file untuk di unggah',
				'{10}': 'Pilih Gambar',
				'{11}': 'Klik untuk memulai kembali',
				'{12}': 'Reset',
				'{13}': 'Klik untuk mengunggah file',
				'{14}': 'Unggah',
				'{15}': 'Unggah Data Induk',
				'{16}': '--- Pilih Tipe Data Induk ---',
				'{17}': 'Lokasi',
				'{18}': 'Sublokasi',
				'{19}': 'Kategori Atribut',
				'{20}': 'Kategori',
				'{21}': 'Item Aset',
				'{22}': 'Detil Item Aset',
				'{23}': 'Tipe Data Induk',
				'{24}': 'Pilih File',
				'{25}': 'Klik untuk mulai mengunggah file',
				'{26}': 'Arahan Pengunggahan File Master Data Pertama Kali',
				'{27}': 'Unggah master data lokasi terlebih dahulu jika belum ada data lokasi',
				'{28}': 'Unggah master data sublokasi jika sudah mengunggah data lokasi',
				'{29}': 'Unggah master data atribut kategori/konfigurasi item sebelum melakukan pengunggahan master data kategori item',
				'{30}': 'Unggah master data kategori/konfigurasi item setelah master data attribute telah selesai diunggah',
				'{31}': 'Pastikan master data lokasi, sublokasi, kategori item dan atribut kategori telah berhasil terunggah sebelum memulai pengunggahan master data item aset ke basis data',
				'{32}': 'Unggah master data item aset jika semua master data poin 1-4 telah diunggah ke dalam basis data',
				'{33}': 'Unggah master data detail item aset setelah master data item aset telah berhasil di unggah ke dalam basis data',
				'{34}': 'Selamat! Anda siap untuk menggunakan sistem manajemen aset ini.',
				'{35}': 'Tabel Gambar',
				'{36}': 'Hapus Gambar',
				'{37}': 'Pilih gambar terlebih dahulu sebelum anda dapat melakukan unggahan!'
			}
		}
	};
	
	Object.freeze ($doclocale);
	
	$(function () {
		$.getScript ($.base_url ('assets/web/js/locale.js'));
	});
});