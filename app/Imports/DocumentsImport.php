<?php

namespace App\Imports;

use App\Models\Document;
use App\Models\Category;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Illuminate\Support\Facades\Auth;

class DocumentsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    use SkipsErrors;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Cari atau buat kategori
        $category = null;
        if (!empty($row['kategori'])) {
            $category = Category::firstOrCreate(
                ['name' => $row['kategori']],
                ['description' => 'Auto created from import']
            );
        }

        // Format tahun
        $tahun = !empty($row['tahun']) ? $row['tahun'] . '-01-01' : date('Y') . '-01-01';

        return new Document([
            'title' => $row['judul'],
            'description' => $row['deskripsi'] ?? null,
            'kode_arsip' => $row['kode_arsip'],
            'jenis_arsip' => $row['jenis_arsip'],
            'tahun' => $tahun,
            'tingkat_perkembangan' => $row['tingkat_perkembangan'],
            'jumlah' => $row['jumlah'],
            'keterangan' => $row['keterangan'],
            'no_definitif' => $row['no_definitif'],
            'lokasi_simpan' => $row['lokasi_simpan'],
            'jangka_simpan' => $row['jangka_simpan'],
            'nasib_akhir' => $row['nasib_akhir'],
            'category_id' => $category ? $category->id : null,
            'user_id' => Auth::id(),
            'file_name' => 'imported-document.pdf',
            'file_path' => 'documents/placeholder.pdf',
            'file_type' => 'pdf',
            'file_size' => 0,
        ]);
    }

    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'kode_arsip' => 'required|string|max:255',
            'jenis_arsip' => 'required|string|max:255',
            'tahun' => 'required|digits:4',
            'tingkat_perkembangan' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'required|string|max:255',
            'no_definitif' => 'required|string|max:255',
            'lokasi_simpan' => 'required|string|max:255',
            'jangka_simpan' => 'required|string|max:255',
            'nasib_akhir' => 'required|string|max:255',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'judul.required' => 'Kolom Judul wajib diisi',
            'kode_arsip.required' => 'Kolom Kode Arsip wajib diisi',
            'jenis_arsip.required' => 'Kolom Jenis Arsip wajib diisi',
            'tahun.required' => 'Kolom Tahun wajib diisi',
            'tahun.digits' => 'Tahun harus 4 digit',
            'tingkat_perkembangan.required' => 'Kolom Tingkat Perkembangan wajib diisi',
            'jumlah.required' => 'Kolom Jumlah wajib diisi',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'keterangan.required' => 'Kolom Keterangan wajib diisi',
            'no_definitif.required' => 'Kolom No. Definitif wajib diisi',
            'lokasi_simpan.required' => 'Kolom Lokasi Simpan wajib diisi',
            'jangka_simpan.required' => 'Kolom Jangka Simpan wajib diisi',
            'nasib_akhir.required' => 'Kolom Nasib Akhir wajib diisi',
        ];
    }
}
