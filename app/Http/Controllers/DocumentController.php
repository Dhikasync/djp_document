<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    public function upload(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Upload endpoint hit. Files count: ' . (is_array($request->file('documents')) ? count($request->file('documents')) : 0));
        
        $request->validate([
            'documents' => 'required|array',
            'documents.*' => 'required|file',
        ]);

        $parser = new Parser();
        $uploadedDocs = [];

        foreach ($request->file('documents') as $file) {
            try {
                $nomorBukti = null;

                // Hanya PDF yang kita parse untuk mencari nomor bukti (sekarang)
                if ($file->getClientOriginalExtension() === 'pdf') {
                    $pdf = $parser->parseFile($file->getPathname());
                    $text = $pdf->getText();
                    
                    // Bersihkan teks
                    $textClean = preg_replace('/\s+/', ' ', $text);
                    
                    // Ekstrak SEMUA kata yang terdiri dari kombinasi huruf kapital dan angka (8 hingga 20 karakter)
                    if (preg_match_all('/([A-Z0-9]{8,20})/', $textClean, $matches)) {
                        foreach ($matches[1] as $candidate) {
                            // Cek apakah candidate memiliki SETIDAKNYA SATU HURUF dan SATU ANGKA
                            // NIK (16 digit) dan NPWP (15 digit) hanya berisi angka, jadi akan dilewati
                            if (preg_match('/[0-9]/', $candidate) && preg_match('/[A-Z]/', $candidate)) {
                                $nomorBukti = trim($candidate);
                                break; // Langsung ambil yang pertama kali ketemu
                            }
                        }
                    }
                    
                    // Fallback jika tidak ada yang punya huruf (siapa tahu format nomornya murni angka)
                    // Tapi pastikan bukan NIK/NPWP (biasanya panjangnya pas 15/16).
                    // Ambil yang panjangnya misal sekitar 8-14 karakter.
                    if (!$nomorBukti && preg_match_all('/([0-9]{8,14})/', $textClean, $matches)) {
                        $nomorBukti = trim($matches[1][0]);
                    }
                    
                    if (!$nomorBukti) {
                        // Simpan teks mentah ke file log untuk debugging
                        file_put_contents(storage_path('logs/pdf_debug.txt'), $text);
                        $snippet = substr($textClean, 0, 200);
                        throw new \Exception("Pola kombinasi angka dan huruf tidak ditemukan. Cuplikan teks PDF yang terbaca: " . $snippet);
                    }
                } else {
                    // Untuk Word (DOC/DOCX), karena belum ada parser-nya, kita buat nomor acak atau pakai nama file
                    // Sebagai contoh sementara
                    $nomorBukti = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                }

                if ($nomorBukti) {
                    $nomorBukti = strtoupper(trim($nomorBukti)); // Normalisasi
                    
                    // Simpan file ke Storage dengan NAMA ASLINYA
                    // Agar tetap terhubung dengan nomor bukti, kita buatkan sub-folder berdasarkan nomor buktinya
                    $originalName = $file->getClientOriginalName();
                    $path = $file->storeAs('public/documents/' . $nomorBukti, $originalName);
                    
                    if (!$path) {
                        throw new \Exception("Gagal menyimpan file secara fisik ke storage/app/public/documents.");
                    }
                    
                    $uploadedDocs[] = $nomorBukti;
                } else {
                    return back()->with('error', 'Gagal menemukan Nomor Bukti Pemotongan pada file PDF: ' . $file->getClientOriginalName());
                }

            } catch (\Exception $e) {
                return back()->with('error', 'Terjadi kesalahan saat memproses file ' . $file->getClientOriginalName() . ': ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Berhasil mengupload dokumen. Nomor Dokumen yang terdeteksi: ' . implode(', ', $uploadedDocs));
    }

    public function download(Request $request)
    {
        $request->validate([
            'nomor_dokumen' => 'required|string'
        ]);

        $nomor = strtoupper(trim($request->nomor_dokumen));
        
        // Cari langsung secara fisik di folder storage
        if (Storage::exists('public/documents')) {
            // Karena kita menyimpan file di dalam sub-folder bernama {NOMOR_BUKTI}
            $directories = Storage::directories('public/documents');
            
            foreach ($directories as $dir) {
                $dirName = basename($dir); // Nama foldernya adalah nomor bukti (misal 2508B2FTN01)
                
                // Gunakan str_starts_with untuk mencocokkan nomor yang diketik dengan nama folder
                if (str_starts_with($dirName, $nomor)) {
                    // Jika cocok, ambil file asli di dalam folder tersebut
                    $files = Storage::files($dir);
                    if (!empty($files)) {
                        // Unduh file pertama (karena 1 nomor bukti = 1 file asli)
                        return Storage::download($files[0]);
                    }
                }
            }
        }

        // Jika tidak ketemu di folder storage
        return back()->with('error', 'Dokumen dengan nomor "' . $nomor . '" tidak ditemukan. Pastikan Anda telah menguploadnya dan nomor yang diketik benar.');
    }

    public function clear(Request $request)
    {
        // Hapus folder dokumen berserta seluruh isinya
        if (Storage::exists('public/documents')) {
            Storage::deleteDirectory('public/documents');
            // Buat lagi foldernya kosong
            Storage::makeDirectory('public/documents');
        }

        return back()->with('success', 'Penyimpanan server telah direset! Semua dokumen sebelumnya sudah dihapus.');
    }
}

