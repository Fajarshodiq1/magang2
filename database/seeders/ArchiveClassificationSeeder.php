<?php

namespace Database\Seeders;

use App\Models\ArchiveClassification;
use Illuminate\Database\Seeder;

class ArchiveClassificationSeeder extends Seeder
{
    public function run(): void
    {
        $classifications = [
            // OT - ORGANISASI DAN TATA LAKSANA
            ['code' => 'OT.00',   'name' => 'Organisasi',                                   'category' => 'OT'],
            ['code' => 'OT.01',   'name' => 'Tata Laksana',                                 'category' => 'OT'],
            ['code' => 'OT.01.1', 'name' => 'Perencanaan',                                  'category' => 'OT'],
            ['code' => 'OT.01.2', 'name' => 'Laporan',                                      'category' => 'OT'],
            ['code' => 'OT.01.3', 'name' => 'Penyusunan Prosedur Kerja',                    'category' => 'OT'],
            ['code' => 'OT.01.4', 'name' => 'Penyusunan Pembakuan Sarana Kerja',            'category' => 'OT'],

            // HM - KEHUMASAN
            ['code' => 'HM.00',   'name' => 'Penerangan',                                                        'category' => 'HM'],
            ['code' => 'HM.01',   'name' => 'Hubungan',                                                          'category' => 'HM'],
            ['code' => 'HM.02',   'name' => 'Dokumentasi dan Keputusan',                                         'category' => 'HM'],
            ['code' => 'HM.02.1', 'name' => 'Dokumentasi',                                                       'category' => 'HM'],
            ['code' => 'HM.02.2', 'name' => 'Kepustakaan (penyediaan dan pengumpulan kepustakaan)',               'category' => 'HM'],
            ['code' => 'HM.03',   'name' => 'Keprotokolan (Upacara dan HUT Kemenag)',                            'category' => 'HM'],

            // KP - KEPEGAWAIAN
            ['code' => 'KP.00',   'name' => 'Pengadaan',                                                         'category' => 'KP'],
            ['code' => 'KP.00.1', 'name' => 'Formasi (Perencanaan, Nota Usul, Formasi)',                         'category' => 'KP'],
            ['code' => 'KP.00.2', 'name' => 'Penerimaan (Pengumuman, Panggilan, termasuk GTT/PTT)',              'category' => 'KP'],
            ['code' => 'KP.00.3', 'name' => 'Pengangkatan',                                                      'category' => 'KP'],
            ['code' => 'KP.01',   'name' => 'Tata Usaha Kepegawaian',                                            'category' => 'KP'],
            ['code' => 'KP.01.1', 'name' => 'Izin/Dispensasi',                                                   'category' => 'KP'],
            ['code' => 'KP.01.2', 'name' => 'Keterangan',                                                        'category' => 'KP'],

            // Kepegawaian lanjutan (kolom tengah - bagian dari KP)
            ['code' => 'KP.02',   'name' => 'Pendidikan Latihan',                                                 'category' => 'KP'],
            ['code' => 'KP.02.1', 'name' => 'Diklat Prajabatan',                                                  'category' => 'KP'],
            ['code' => 'KP.02.2', 'name' => 'Diklat Dalam Jabatan',                                              'category' => 'KP'],
            ['code' => 'KP.02.3', 'name' => 'Latihan Kursus (Workshop/Lokakarya/Orientasi/Konsultasi/Seminar/Sosialisasi/Penataran/dll)', 'category' => 'KP'],
            ['code' => 'KP.03',   'name' => 'KORPRI (Pramuka, Pemilu dll)',                                       'category' => 'KP'],
            ['code' => 'KP.04',   'name' => 'Penilaian dan Hukuman',                                              'category' => 'KP'],
            ['code' => 'KP.04.1', 'name' => 'Penilaian',                                                          'category' => 'KP'],
            ['code' => 'KP.04.2', 'name' => 'Hukuman',                                                            'category' => 'KP'],
            ['code' => 'KP.05',   'name' => 'Screening',                                                          'category' => 'KP'],
            ['code' => 'KP.06',   'name' => 'Pembinaan Mental',                                                   'category' => 'KP'],
            ['code' => 'KP.07',   'name' => 'Mutasi',                                                             'category' => 'KP'],
            ['code' => 'KP.07.1', 'name' => 'Kepangkatan',                                                        'category' => 'KP'],
            ['code' => 'KP.07.2', 'name' => 'Kenaikan Berkala',                                                   'category' => 'KP'],
            ['code' => 'KP.07.3', 'name' => 'Penyesuaian Masa Kerja',                                            'category' => 'KP'],
            ['code' => 'KP.07.4', 'name' => 'Penyesuaian Tunjangan Keluarga',                                    'category' => 'KP'],
            ['code' => 'KP.07.5', 'name' => 'Alih Tugas',                                                         'category' => 'KP'],
            ['code' => 'KP.07.6', 'name' => 'Jabatan Struktural/Fungsional',                                      'category' => 'KP'],
            ['code' => 'KP.08',   'name' => 'Kesejahteraan',                                                      'category' => 'KP'],
            ['code' => 'KP.08.1', 'name' => 'Kesehatan (Askes, Chek Up dll)',                                    'category' => 'KP'],
            ['code' => 'KP.08.2', 'name' => 'Cuti',                                                               'category' => 'KP'],
            ['code' => 'KP.08.3', 'name' => 'Rekreasi',                                                           'category' => 'KP'],
            ['code' => 'KP.08.4', 'name' => 'Bantuan Sosial',                                                     'category' => 'KP'],
            ['code' => 'KP.08.5', 'name' => 'Koperasi',                                                           'category' => 'KP'],
            ['code' => 'KP.08.6', 'name' => 'Perumahan',                                                          'category' => 'KP'],
            ['code' => 'KP.08.7', 'name' => 'Antar Jemput',                                                       'category' => 'KP'],
            ['code' => 'KP.08.8', 'name' => 'Penghargaan (tanda jasa, piagam, setya lencana dll)',               'category' => 'KP'],
            ['code' => 'KP.09',   'name' => 'Pemutusan Hubungan Kerja (Pensiun, asuransi, meninggal dunia dll)', 'category' => 'KP'],

            // HK - HUKUM
            ['code' => 'HK.00',   'name' => 'PERATURAN PERUNDANG-UNDANGAN',                          'category' => 'HK'],
            ['code' => 'HK.00.1', 'name' => 'Undang-undang termasuk PERPU',                          'category' => 'HK'],
            ['code' => 'HK.00.2', 'name' => 'Peraturan Pemerintah',                                  'category' => 'HK'],
            ['code' => 'HK.00.3', 'name' => 'Keputusan Presiden, Instruksi Presiden',                'category' => 'HK'],
            ['code' => 'HK.00.4', 'name' => 'Peraturan Menteri, Instruksi Menteri',                  'category' => 'HK'],
            ['code' => 'HK.00.5', 'name' => 'Keputusan Menteri/ Pimpinan unit eselon I, II',         'category' => 'HK'],
            ['code' => 'HK.00.6', 'name' => 'SKB Menteri-Menteri/ Pimpinan unit eselon I, II',       'category' => 'HK'],
            ['code' => 'HK.00.7', 'name' => 'Edaran Menteri/ Pimpinan unit eselon I, II',            'category' => 'HK'],
            ['code' => 'HK.00.8', 'name' => 'Peraturan Kanil/Kankemenag',                            'category' => 'HK'],
            ['code' => 'HK.00.9', 'name' => 'Peraturan PEMDA',                                       'category' => 'HK'],
            ['code' => 'HK.01',   'name' => 'PIDANA',                                                'category' => 'HK'],
            ['code' => 'HK.01.1', 'name' => 'PENCURIAN',                                             'category' => 'HK'],
            ['code' => 'HK.01.2', 'name' => 'KORUPSI',                                               'category' => 'HK'],
            ['code' => 'HK.02',   'name' => 'PERDATA',                                               'category' => 'HK'],
            ['code' => 'HK.02.1', 'name' => 'Perikatan',                                             'category' => 'HK'],
            ['code' => 'HK.03',   'name' => 'HUKUM AGAMA',                                           'category' => 'HK'],
            ['code' => 'HK.03.1', 'name' => 'Fatwa',                                                 'category' => 'HK'],
            ['code' => 'HK.03.2', 'name' => 'Rukyat/Hisab',                                         'category' => 'HK'],
            ['code' => 'HK.03.3', 'name' => 'Hari Besar Islam',                                      'category' => 'HK'],
            ['code' => 'HK.04',   'name' => 'BANTUAN HUKUM',                                         'category' => 'HK'],
            ['code' => 'HK.04.1', 'name' => 'Kasus Hukum Pidana',                                   'category' => 'HK'],
            ['code' => 'HK.04.2', 'name' => 'Kasus Hukum Perdata',                                  'category' => 'HK'],
            ['code' => 'HK.04.3', 'name' => 'Kasus Hukum Tata Usaha Negara (TUN)',                  'category' => 'HK'],
            ['code' => 'HK.04.4', 'name' => 'Penelaahan Hukum',                                     'category' => 'HK'],

            // PW - PERKAWINAN
            ['code' => 'PW.00', 'name' => 'Penyuluhan',                      'category' => 'PW'],
            ['code' => 'PW.01', 'name' => 'Perkawinan',                      'category' => 'PW'],
            ['code' => 'PW.02', 'name' => 'Campuran Antar Agama dan Bangsa', 'category' => 'PW'],

            // KU - KEUANGAN
            ['code' => 'KU.00',   'name' => 'Anggaran',                                    'category' => 'KU'],
            ['code' => 'KU.00.1', 'name' => 'Rutin',                                       'category' => 'KU'],
            ['code' => 'KU.00.2', 'name' => 'Pembangunan',                                 'category' => 'KU'],
            ['code' => 'KU.00.3', 'name' => 'Non Budgetter',                               'category' => 'KU'],
            ['code' => 'KU.01',   'name' => 'S P P',                                       'category' => 'KU'],
            ['code' => 'KU.01.1', 'name' => 'SPP Beban Tetap dan Sementara Rutin',         'category' => 'KU'],
            ['code' => 'KU.01.2', 'name' => 'SPP Beban Tetap dan Sementara Pembangunan',  'category' => 'KU'],
            ['code' => 'KU.02',   'name' => 'SPJ Rutin/Pembangunan',                      'category' => 'KU'],
            ['code' => 'KU.02.1', 'name' => 'SPJ Rutin',                                  'category' => 'KU'],
            ['code' => 'KU.02.2', 'name' => 'SPJ Pembangunan',                            'category' => 'KU'],
            ['code' => 'KU.02.3', 'name' => 'SPJ Non Budgetter',                          'category' => 'KU'],
            ['code' => 'KU.03',   'name' => 'Pendapatan Negara',                          'category' => 'KU'],
            ['code' => 'KU.03.1', 'name' => 'Pajak',                                      'category' => 'KU'],
            ['code' => 'KU.03.2', 'name' => 'Bukan Pajak',                                'category' => 'KU'],
            ['code' => 'KU.04',   'name' => 'Perbankan',                                  'category' => 'KU'],
            ['code' => 'KU.04.1', 'name' => 'Valuta asing/Transfer',                     'category' => 'KU'],
            ['code' => 'KU.04.2', 'name' => 'Saldo rekening',                            'category' => 'KU'],
            ['code' => 'KU.05',   'name' => 'Sumbangan/Bantuan',                         'category' => 'KU'],

            // KS - KESEKRETARIATAN
            ['code' => 'KS.00',   'name' => 'Kerumahtanggaan (pinjam fasilitas, konsumsi, keamanan, pakaian dinas, papan nama)', 'category' => 'KS'],
            ['code' => 'KS.01',   'name' => 'Perlengkapan (Perencanaan, pengadaan, pendistribusian, pemeliharaan, penghapusan)', 'category' => 'KS'],
            ['code' => 'KS.01.1', 'name' => 'Gedung (Asrama, kantor, sekolah dll)',       'category' => 'KS'],
            ['code' => 'KS.01.2', 'name' => 'Alat Kantor (ATK, Formulir, Faktur)',        'category' => 'KS'],
            ['code' => 'KS.01.3', 'name' => 'Mesin Kantor/Alat Elektronik',              'category' => 'KS'],
            ['code' => 'KS.01.4', 'name' => 'Perabot Kantor',                            'category' => 'KS'],
            ['code' => 'KS.01.5', 'name' => 'Kendaraan',                                 'category' => 'KS'],
            ['code' => 'KS.01.6', 'name' => 'Inventaris Perlengkapan',                   'category' => 'KS'],
            ['code' => 'KS.01.7', 'name' => 'Penawaran Umum',                            'category' => 'KS'],
            ['code' => 'KS.02',   'name' => 'Ketatausahaan (Korespondensi dan kearsipan, surat, cap dinas)', 'category' => 'KS'],

            // HJ - HAJI
            ['code' => 'HJ.00', 'name' => 'Calon Haji',                   'category' => 'HJ'],
            ['code' => 'HJ.01', 'name' => 'Bimbingan',                    'category' => 'HJ'],
            ['code' => 'HJ.02', 'name' => 'Petugas Haji',                 'category' => 'HJ'],
            ['code' => 'HJ.03', 'name' => 'Ongkos Naik Haji',             'category' => 'HJ'],
            ['code' => 'HJ.04', 'name' => "Jama'ah Calon Haji",           'category' => 'HJ'],
            ['code' => 'HJ.05', 'name' => 'Angkutan',                     'category' => 'HJ'],
            ['code' => 'HJ.06', 'name' => 'Pengasramaan',                 'category' => 'HJ'],
            ['code' => 'HJ.07', 'name' => 'Pembekalan',                   'category' => 'HJ'],
            ['code' => 'HJ.08', 'name' => 'Dispensasi / Rekomendasi Khusus', 'category' => 'HJ'],
            ['code' => 'HJ.09', 'name' => 'Umroh',                        'category' => 'HJ'],

            // BA - PEMBINAAN AGAMA
            ['code' => 'BA.00',   'name' => 'Penyuluhan',                     'category' => 'BA'],
            ['code' => 'BA.01',   'name' => 'Bimbingan',                      'category' => 'BA'],
            ['code' => 'BA.01.1', 'name' => 'Lembaga Keagamaan',              'category' => 'BA'],
            ['code' => 'BA.01.2', 'name' => 'Aliran Kerohanian/Keagamaan',    'category' => 'BA'],
            ['code' => 'BA.02',   'name' => 'Kerukunan Hidup Beragama',       'category' => 'BA'],
            ['code' => 'BA.03',   'name' => 'Ibadah Dan Ibadah Sosial',       'category' => 'BA'],
            ['code' => 'BA.03.1', 'name' => 'Ibadah',                         'category' => 'BA'],
            ['code' => 'BA.03.2', 'name' => 'Ibadah Sosial',                  'category' => 'BA'],
            ['code' => 'BA.04',   'name' => 'Pengembangan Keagamaan',         'category' => 'BA'],
            ['code' => 'BA.05',   'name' => 'Rohaniwan',                      'category' => 'BA'],

            // PP - PENDIDIKAN DAN PENGAJARAN
            ['code' => 'PP.00',   'name' => 'Kurikulum',                                       'category' => 'PP'],
            ['code' => 'PP.00.1', 'name' => 'Sekolah Umum Tingkat TK dan SD',                 'category' => 'PP'],
            ['code' => 'PP.00.2', 'name' => 'Sekolah Umum Tingkat SMTP',                      'category' => 'PP'],
            ['code' => 'PP.00.3', 'name' => 'Sekolah Umum Tingkat SMTA',                      'category' => 'PP'],
            ['code' => 'PP.00.4', 'name' => 'Perguruan Agama Tk. RA dan Ibtidaiyah',          'category' => 'PP'],
            ['code' => 'PP.00.5', 'name' => 'Perguruan Agama Tk. Tsanawiyah',                 'category' => 'PP'],
            ['code' => 'PP.00.6', 'name' => 'Perguruan Agama Tk. Aliyah',                     'category' => 'PP'],
            ['code' => 'PP.00.7', 'name' => 'Pondok Pesantren',                               'category' => 'PP'],
            ['code' => 'PP.00.8', 'name' => 'Diniyah',                                        'category' => 'PP'],

            // PP lanjutan (kolom kanan)
            ['code' => 'PP.00.9',  'name' => 'Perguruan Tinggi Agama',                        'category' => 'PP'],
            ['code' => 'PP.00.10', 'name' => 'Perguruan Tinggi Umum',                         'category' => 'PP'],
            ['code' => 'PP.00.11', 'name' => 'Pengembangan Sarjana Pendidikan',               'category' => 'PP'],
            ['code' => 'PP.01',    'name' => 'Evaluasi dan Ijazah',                           'category' => 'PP'],
            ['code' => 'PP.01.1',  'name' => 'Perguruan Agama',                               'category' => 'PP'],
            ['code' => 'PP.01.2',  'name' => 'Perguruan Umum',                                'category' => 'PP'],
            ['code' => 'PP.02',    'name' => 'Kepemilikan, Pengawasan dan Pembinaan',         'category' => 'PP'],
            ['code' => 'PP.02.1',  'name' => 'Kepemilikan',                                   'category' => 'PP'],
            ['code' => 'PP.02.2',  'name' => 'Pengawasan',                                    'category' => 'PP'],
            ['code' => 'PP.02.3',  'name' => 'Pembinaan',                                     'category' => 'PP'],
            ['code' => 'PP.03',    'name' => 'Kelembagaan',                                   'category' => 'PP'],
            ['code' => 'PP.03.1',  'name' => 'Organisasi (Ekstra Kurikuler)',                 'category' => 'PP'],
            ['code' => 'PP.03.2',  'name' => 'Pengembangan (Filial, kelas Jauh, Penyesuaian Status Swasta-Negeri)', 'category' => 'PP'],
            ['code' => 'PP.04',    'name' => 'Beasiswa',                                      'category' => 'PP'],
            ['code' => 'PP.05',    'name' => 'Sumbangan (uang sekolah, uang ujian dll)',      'category' => 'PP'],
            ['code' => 'PP.06',    'name' => 'Pengabdian (KKN dll)',                          'category' => 'PP'],
            ['code' => 'PP.07',    'name' => 'Perizinan (Izin Belajar dll)',                  'category' => 'PP'],

            // PS - PENGAWASAN
            ['code' => 'PS.00',   'name' => 'Pengawasan Adminisrasi Umum', 'category' => 'PS'],
            ['code' => 'PS.01',   'name' => 'Tugas Umum',                  'category' => 'PS'],
            ['code' => 'PS.02',   'name' => 'Proyek Pembangunan',          'category' => 'PS'],
            ['code' => 'PS.02.1', 'name' => 'Fisik',                       'category' => 'PS'],
            ['code' => 'PS.02.2', 'name' => 'Non Fisik',                   'category' => 'PS'],

            // TL - PENELITIAN
            ['code' => 'TL.00',   'name' => 'Penelitian Umum',             'category' => 'TL'],
            ['code' => 'TL.01',   'name' => 'Penelitian Keagamaan',        'category' => 'TL'],
            ['code' => 'TL.02',   'name' => 'Penelitian Lektur Agama',     'category' => 'TL'],
            ['code' => 'TL.02.1', 'name' => 'Surat - surat',              'category' => 'TL'],
            ['code' => 'TL.02.2', 'name' => 'Penelitian Buku-Buku Agama', 'category' => 'TL'],
            ['code' => 'TL.03',   'name' => 'Pengembangan Penelitian',     'category' => 'TL'],
        ];

        foreach ($classifications as $classification) {
            ArchiveClassification::create($classification);
        }
    }
}
