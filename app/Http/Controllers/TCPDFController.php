<?php

namespace App\Http\Controllers;

use App\Models\FormDocument;
use App\Models\FormEngine;
use App\Models\FormSafety;
use App\Models\FormTools;
use App\Models\Pertanyaan;
use App\Models\ReportForm;
use Illuminate\Http\Request;
use TCPDF;

class TCPDFController extends Controller
{

    public function view(){
        return view('pdf.v_reportPdf');
    }

    public function reportFormAdmin($id){

        $pdf = new TCPDF('P', 'cm', 'A4', true, 'UTF-8', false);

        // Database
        $dataReport = ReportForm::where('id', $id)->first();

        $p_document = Pertanyaan::where('kategori', 'document')->get();
        $p_safety = Pertanyaan::where('kategori', 'safety')->get();
        $p_engine = Pertanyaan::where('kategori', 'engine')->get();
        $p_tools = Pertanyaan::where('kategori', 'tools')->get();

        $dataDocument = FormDocument::where('user_id', $dataReport->id_driver)->where('shift', $dataReport->shift)->where('no_polisi', $dataReport->no_polisi)->where('tgl_pemeriksaan', $dataReport->tanggal_input)->first();
        $dataSafety = FormSafety::where('user_id', $dataReport->id_driver)->where('shift', $dataReport->shift)->where('no_polisi', $dataReport->no_polisi)->where('tgl_pemeriksaan', $dataReport->tanggal_input)->first();
        $dataEngine = FormEngine::where('user_id', $dataReport->id_driver)->where('shift', $dataReport->shift)->where('no_polisi', $dataReport->no_polisi)->where('tgl_pemeriksaan', $dataReport->tanggal_input)->first();
        $dataTools = FormTools::where('user_id', $dataReport->id_driver)->where('shift', $dataReport->shift)->where('no_polisi', $dataReport->no_polisi)->where('tgl_pemeriksaan', $dataReport->tanggal_input)->first();

        $pdf->SetFont('dejavusans', '', 12);
        $pdf->SetMargins(1, 1, 1, true);
        // megnhapus header dan footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        $pdf->AddPage();
        // Header
        $pdf->SetFont('times', '', 10);
        $pdf->MultiCell(2, 1.5, '', 1, 'J', false, 0,);
        $logoSbs = public_path('asset/sbs.png');
        $pdf->Image($logoSbs, 1.1, 1, 1.8, 1.45, 'png');
        $pdf->SetFont('times', '', 14);
        $pdf->setCellPaddings( null, 0.1 );
        $pdf->MultiCell(12, 1.5, 'PEMERIKSAAN PERAWATAN HARIAN (P2H) KENDARAAN SARANA', 1, 'C', false, 0);
        $pdf->SetFont('times', '', 7);
        $pdf->setXY(15,1);
        $pdf->setCellPaddings( null, 0.1 );
        $pdf->MultiCell(5, 0.5, 'No. Dok : PSBSFFWI:ISLU:05:001:001', 1, 'L', false, 0);
        $pdf->setXY(15,1.5);
        $pdf->MultiCell(5, 0.5, 'No. Rev : 2', 1, 'L', false, 0,);
        $pdf->setXY(15,2);
        $pdf->MultiCell(5, 0.5, 'Halaman : 1 dari 1', 1, 'L', false, 0,);

        // tgl pemeriksaan
        $border = 0;
        $pdf->Ln();
        $pdf->SetFont('times', '', 10);
        $pdf->MultiCell(19, 3.55, '', 1, 'L', false, 1);
        $pdf->MultiCell(3.5, 0.5, 'Tgl. Pemeriksaan', $border, 'L', false, 1, 1, 2.5);
        $pdf->MultiCell(0.5, 0.5, ':', $border, 'C', false, 1, 4.5, 2.5);
        $pdf->MultiCell(4, 0.5, $dataDocument->tgl_pemeriksaan, $border, 'L', false, 1, 5, 2.5);
        $pdf->Ln();
        $pdf->MultiCell(3.5, 0.5, 'No Polisi', $border, 'L', false, 2, 1, 3.1);
        $pdf->MultiCell(0.5, 0.5, ':', $border, 'C', false, 2, 4.5, 3.1);
        $pdf->MultiCell(4, 0.5, $dataDocument->no_polisi, $border, 'L', false, 2, 5, 3.1);
        $pdf->Ln();
        $pdf->SetFont('times', 'B', 10);
        $pdf->MultiCell(3, 0.5, 'SHIFT 1', 0, 'C', false, 3, 5, 3.8);
        $pdf->MultiCell(3, 0.5, 'SHIFT 2', 0, 'C', false, 3, 8, 3.8);
        $pdf->Ln();
        $pdf->SetFont('times', '', 10);

        // cek Fuel tiap tiap shift
        $shift1Fuel = $dataDocument->shift === 'shift_1' ? $dataDocument->fuel : '-';
        $shift2Fuel = $dataDocument->shift === 'shift_2' ? $dataDocument->fuel : '-';
        
        $pdf->MultiCell(3.5, 0.5, 'Fuel', $border, 'L', false, 4, 1, 4.4);
        $pdf->MultiCell(0.5, 0.5, ':', $border, 'C', false, 4, 4.5, 4.4);
        $pdf->MultiCell(3, 0.5, $shift1Fuel, 1, 'C', false, 4, 5, 4.4);
        $pdf->MultiCell(3, 0.5, $shift2Fuel, 1, 'C', false, 4, 8, 4.4);
        $pdf->Ln();

        // cek Data KM Awal
        $shift1KM = $dataDocument->shift === 'shift_1' ? $dataDocument->km_awal : '-';
        $shift2KM = $dataDocument->shift === 'shift_2' ? $dataDocument->km_awal : '-';
        $pdf->MultiCell(3.5, 0.5, 'Data KM Awal', $border, 'L', false, 5, 1, 4.95);
        $pdf->MultiCell(0.5, 0.5, ':', $border, 'C', false, 5, 4.5,  4.95);
        $pdf->MultiCell(3, 0.5, $shift1KM, 1, 'C', false, 5, 5,  4.95);
        $pdf->MultiCell(3, 0.5, $shift2KM, 1, 'C', false, 5, 8,  4.95);
        $pdf->Ln();

        // Cek Driver pada tiap tiap shift
        $driver1 = $dataReport->shift === 'shift_1' ? $dataReport->nama_driver : '-';
        $driver2 = $dataReport->shift === 'shift_2' ? $dataReport->nama_driver : '-';
        $pdf->MultiCell(3.5, 0.5, 'User / Driver', $border, 'L', false, 5, 1, 5.5);
        $pdf->MultiCell(0.5, 0.5, ':', $border, 'C', false, 5, 4.5,  5.5);
        $pdf->MultiCell(3, 0.5, $driver1, 1, 'C', false, 5, 5,  5.5);
        $pdf->MultiCell(3, 0.5, $driver2, 1, 'C', false, 5, 8,  5.5);
        // kolom kosong
        $pdf->Ln();
        $pdf->MultiCell(19, 0.5, '', 1, 'L', false, 6, 1, 6.05);
        // item
        $pdf->Ln();
        $pdf->SetFont('times', 'B', 12);
        $pdf->setCellPaddings( null, 0.15 );
        $pdf->MultiCell(9.5, 0.8, 'ITEM', 1, 'C', false, 7, 1, 6.6);
        $pdf->SetFont('times', '', 7);
        $pdf->setCellPaddings( null, 0.05 );
        $pdf->MultiCell(9.5, 0.4, 'CONDITION', 1, 'C', false, 7, 10.5, 6.6);
        $pdf->MultiCell(9.5, 0.4, 'OK(V) TIDAK(X)', 1, 'C', false, 7, 10.5, 7);

        // Document
        $pdf->SetFont('times', 'B', 10);
        $pdf->SetFillColor(215, 215, 215);
        $pdf->MultiCell(9.5, 0.6, 'A. DOCUMENT : ', 1, 'L', true, 7, 1, 7.4);
        $pdf->MultiCell(2, 0.6, 'SHIFT 1', 1, 'C', true, 7, 10.5, 7.4);
        $pdf->MultiCell(2, 0.6, 'SHIFT 2', 1, 'C', true, 7, 12.5, 7.4);
        $pdf->MultiCell(5.5, 0.6, 'KETERANGAN', 1, 'C', true, 7, 14.5, 7.4);

        // Melakukan cek Point Penting pada pertanyaan
        $pointPenting = '';
        $penting = [1,2,3,4,5];
        
        $cekSalah = '';
        $no = 1;
        $jarakBaris=8;
        $pdf->SetFont('times', '', 10);
        foreach($p_document as $doc){
            if(in_array($doc->id, $penting)){
                $pointPenting = '*)';
            }else{
                $pointPenting = '';
            }

            $cekBenar = $dataDocument->{'pertanyaan_'.$doc->id} === 'benar' ? 'V' : '-';
            $cekSalah = $dataDocument->{'pertanyaan_'.$doc->id} === 'salah' ? 'V' : '-';
            $keterangan = $dataDocument->{'pertanyaan_'.$doc->id} === 'salah' ? $dataDocument->{'keterangan_'.$doc->id} : '-';
            
            $pdf->MultiCell(0.5, 0.5, $pointPenting, 1, 'L', false, 7, 1,  $jarakBaris);
            $pdf->MultiCell(0.7, 0.5, $no, 1, 'C', false, 7, 1.5, $jarakBaris);
            $pdf->MultiCell(8.3, 0.5, $doc->pertanyaan, 1, 'L', false, 7, 2.2,  $jarakBaris);
            $pdf->MultiCell(2, 0.5, $cekBenar, 1, 'C', false, 7, 10.5, $jarakBaris);
            $pdf->MultiCell(2, 0.5, $cekSalah, 1, 'C', false, 7, 12.5, $jarakBaris);
            $pdf->MultiCell(5.5, 0.5, $keterangan, 1, 'C', false, 7, 14.5, $jarakBaris);
            $no++;
            $jarakBaris += 0.5;
        }

        // SAFETY
        $pdf->SetFont('times', 'B', 10);
        $pdf->SetFillColor(215, 215, 215);
        $pdf->MultiCell(9.5, 0.5, 'B. SAFETY : ', 1, 'L', true, 7, 1, 10.5);
        $pdf->MultiCell(9.5, 0.5, 'OK(V) TIDAK(X)', 1, 'C', true, 7, 10.5, 10.5);
        // Melakukan cek Point Penting pada pertanyaan
        $penting = [10,11,12,14,15,17,18,19,20,21,22,23,24,25];

        $no = 1;
        $jarakBaris=11;
        $pdf->SetFont('times', '', 10);
        foreach($p_safety as $safe){
            if(in_array($safe->id, $penting)){
                $pointPenting = '*)';
            }else{
                $pointPenting = '';
            }
            $cekBenar = $dataSafety->{'pertanyaan_'.$safe->id} === 'benar' ? 'V' : '-';
            $cekSalah = $dataSafety->{'pertanyaan_'.$safe->id} === 'salah' ? 'V' : '-';
            $keterangan = $dataSafety->{'pertanyaan_'.$safe->id} === 'salah' ? $dataSafety->{'keterangan_'.$safe->id} : '-';

            $pdf->MultiCell(0.5, 0.5, $pointPenting, 1, 'L', false, 7, 1,  $jarakBaris);
            $pdf->MultiCell(0.7, 0.5, $no, 1, 'C', false, 7, 1.5, $jarakBaris);
            $pdf->MultiCell(8.3, 0.5, $safe->pertanyaan, 1, 'L', false, 7, 2.2,  $jarakBaris);
            $pdf->MultiCell(2, 0.5, $cekBenar, 1, 'C', false, 7, 10.5, $jarakBaris);
            $pdf->MultiCell(2, 0.5, $cekSalah, 1, 'C', false, 7, 12.5, $jarakBaris);
            $pdf->MultiCell(5.5, 0.5, $keterangan, 1, 'C', false, 7, 14.5, $jarakBaris);
            $no++;
            $jarakBaris += 0.5;
        }

        // ENGINE
        $pdf->SetFont('times', 'B', 10);
        $pdf->SetFillColor(215, 215, 215);
        $pdf->MultiCell(9.5, 0.5, 'C. ENGINE & SYSTEM :', 1, 'L', true, 7, 1, 21.5);
        $pdf->MultiCell(9.5, 0.5, 'OK(V) TIDAK(X)', 1, 'C', true, 7, 10.5, 21.5);
        // Melakukan cek Point Penting pada pertanyaan
        $penting = [1,2,3,4,5,6,7,8,9];

        $no = 1;
        $jarakBaris=22;
        $pdf->SetFont('times', '', 10);
        foreach($p_engine as $engine){
            if(in_array($engine->id, $penting)){
                $pointPenting = '*)';
            }else{
                $pointPenting = '';
            }
            $cekBenar = $dataEngine->{'pertanyaan_'.$engine->id} === 'benar' ? 'V' : '-';
            $cekSalah = $dataEngine->{'pertanyaan_'.$engine->id} === 'salah' ? 'V' : '-';
            $keterangan = $dataEngine->{'pertanyaan_'.$engine->id} === 'salah' ? $dataEngine->{'keterangan_'.$engine->id} : '-';

            $pdf->MultiCell(0.5, 0.5, '*)', 1, 'L', false, 7, 1,  $jarakBaris);
            $pdf->MultiCell(0.7, 0.5, $no, 1, 'C', false, 7, 1.5, $jarakBaris);
            $pdf->MultiCell(8.3, 0.5, $engine->pertanyaan, 1, 'L', false, 7, 2.2,  $jarakBaris);
            $pdf->MultiCell(2, 0.5, $cekBenar, 1, 'C', false, 7, 10.5, $jarakBaris);
            $pdf->MultiCell(2, 0.5, $cekSalah, 1, 'C', false, 7, 12.5, $jarakBaris);
            $pdf->MultiCell(5.5, 0.5, $keterangan, 1, 'C', false, 7, 14.5, $jarakBaris);
            $no++;
            $jarakBaris += 0.5;
        }

        $pdf->AddPage();
        // TOOLS
        $pdf->SetFont('times', 'B', 10);
        $pdf->SetFillColor(215, 215, 215);
        $pdf->MultiCell(9.5, 0.5, 'D. TOOLS :', 1, 'L', true, 7, 1, 1);
        $pdf->MultiCell(9.5, 0.5, 'OK(V) TIDAK(X)', 1, 'C', true, 7, 10.5, 1);
        $no = 1;
        $jarakBaris=1.5;
        $pdf->SetFont('times', '', 10);
        foreach($p_tools as $tools){
            $cekBenar = $dataTools->{'pertanyaan_'.$tools->id} === 'benar' ? 'V' : '-';
            $cekSalah = $dataTools->{'pertanyaan_'.$tools->id} === 'salah' ? 'V' : '-';
            $keterangan = $dataTools->{'pertanyaan_'.$tools->id} === 'salah' ? $dataTools->{'keterangan_'.$tools->id} : '-';

            $pdf->MultiCell(0.5, 0.5, '*)', 1, 'L', false, 7, 1,  $jarakBaris);
            $pdf->MultiCell(0.7, 0.5, $no, 1, 'C', false, 7, 1.5, $jarakBaris);
            $pdf->MultiCell(8.3, 0.5, $tools->pertanyaan, 1, 'L', false, 7, 2.2,  $jarakBaris);
            $pdf->MultiCell(2, 0.5, $cekBenar, 1, 'C', false, 7, 10.5, $jarakBaris);
            $pdf->MultiCell(2, 0.5, $cekSalah, 1, 'C', false, 7, 12.5, $jarakBaris);
            $pdf->MultiCell(5.5, 0.5, $keterangan, 1, 'C', false, 7, 14.5, $jarakBaris);
            $no++;
            $jarakBaris += 0.5;
        }

        $pdf->Ln();
        // $pdf->MultiCell(19, 5.5, '', 1, 'L', false, 6, 1, 3);
        $pdf->SetFont('times', '', 10);
        $pdf->MultiCell(19, 0.5, 'KERUSAKAN LAIN :', 0, 'L', false, 6, 1, 3.5);
        $pdf->MultiCell(19, 0.5, 'NOTE : Jika Item *) Tidak OK, maka kendaraan tidak boleh digunakan sebelum dilakukan terhadap item tersebut', 0, 'L', false, 6, 1, 4);

        $pdf->Ln();
        $pdf->MultiCell(19, 0.5, '', 0, 'L', false, 6, 1, 4.5);
        // kotak TTD
        $pdf->MultiCell(4, 2, '', 1, 'L', false, 6, 2, 5);
        $pdf->MultiCell(4, 2, '', 1, 'L', false, 6, 6, 5);
        $pdf->MultiCell(4, 2, '', 1, 'L', false, 6, 14, 5);
        $pdf->SetFont('times', 'B', 10);
        $pdf->MultiCell(4, 0.5, 'Driver Shift 1', 0, 'C', false, 6, 2, 7);
        $pdf->MultiCell(4, 0.5, 'Driver Shift 2', 0, 'C', false, 6, 6, 7);
        $pdf->MultiCell(4, 0.5, 'GA Transport', 0, 'C', false, 6, 14, 7);


        $namaFile = 'report-form.pdf';
        $pdf->Output($namaFile, 'I');
        exit;

    }
}

// Comment Kolom Multi Cell
// $w (float): Lebar kolom dalam satuan yang ditentukan (misalnya, mm atau pt). Parameter ini menentukan lebar dari kolom yang akan ditambahkan.
// $h (float): Tinggi kolom (opsional). Jika tidak diisi, tinggi kolom akan disesuaikan dengan ketinggian teks yang ada. Parameter ini menentukan tinggi dari kolom yang akan ditambahkan.
// $txt (string): Teks atau konten lain yang akan ditampilkan dalam kolom. Parameter ini adalah teks atau konten yang akan ditampilkan dalam kolom tersebut.
// $border (mixed): Konfigurasi batas kolom (opsional). Jika tidak diisi, nilai defaultnya adalah 0 (tidak ada batas). Parameter ini menentukan tampilan batas di sekitar kolom. Nilai yang valid adalah 0 untuk tidak ada batas, 1 untuk garis, dan sebagainya.
// $align (string): Posisi teks dalam kolom (opsional). Nilai yang valid adalah 'L' (kiri), 'C' (tengah), 'R' (kanan), dan 'J' (justify). Jika tidak diisi, nilai defaultnya adalah 'J' (justify). Parameter ini menentukan posisi teks di dalam kolom.
// $fill (boolean): Parameter untuk mengisi kolom dengan warna (opsional). Nilai yang valid adalah true (kolom diisi dengan warna) dan false (kolom tidak diisi dengan warna). Jika tidak diisi, nilai defaultnya adalah false. Parameter ini menentukan apakah kolom akan diisi dengan warna latar belakang atau tidak.
// $ln (int): Perubahan posisi setelah menambahkan kolom (opsional). Nilai 0 berarti tetap di baris yang sama, 1 berarti pindah ke baris berikutnya, dan 2 berarti pindah ke baris berikutnya secara vertikal. Jika tidak diisi, nilai defaultnya adalah 1. Parameter ini menentukan posisi selanjutnya setelah kolom ditambahkan.
// $x (float|null): Posisi horizontal dari kolom (opsional). Jika tidak diisi, nilai defaultnya adalah null dan kolom akan diletakkan sesuai dengan posisi saat ini pada baris yang sama. Parameter ini menentukan posisi horizontal dari kolom dalam halaman PDF.
// $y (float|null): Posisi vertikal dari kolom (opsional). Jika tidak diisi, nilai defaultnya adalah null dan kolom akan diletakkan sesuai dengan posisi saat ini pada halaman PDF. Parameter ini menentukan posisi vertikal dari kolom dalam halaman PDF.
// Dan masih ada beberapa parameter tambahan yang dapat Anda gunakan sesuai kebutuhan:
// $reseth (boolean): Jika diatur sebagai true, maka lebar kolom akan diatur ulang (reset) setelah menambahkan kolom. Jika diatur sebagai false, maka lebar kolom akan tetap sama setelah menambahkan kolom.
// $stretch (float): Jika diatur sebagai nilai selain 0, maka teks akan diperpanjang untuk mencapai tinggi yang diinginkan.
// $ishtml (boolean): Jika diatur sebagai true, maka teks dianggap sebagai kode HTML dan akan diinterpretasikan dengan benar.
// $autopadding (boolean): Jika diatur sebagai true, maka sel akan secara otomatis menambahkan padding sesuai dengan teks yang ditampilkan.
// $maxh (float): Tinggi maksimum dari sel. Jika teks lebih panjang dari tinggi maksimum, teks akan dipotong atau diatur dalam kolom baru.
// $valign (string): Posisi vertikal teks dalam kolom. Nilai yang valid adalah 'T' (atas), 'M' (tengah), dan 'B' (bawah).
// $fitcell (boolean): Jika diatur sebagai true, maka kolom akan disesuaikan dengan tinggi teks secara otomatis