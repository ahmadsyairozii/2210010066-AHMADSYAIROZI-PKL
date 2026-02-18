<?php 
include ('fpdf186/fpdf.php');
include ('koneksi.php');

// Ambil data laporan
$query = "
    SELECT 
        os.id_observasi,
        ps.nama_petugas,    
        lp.kode_lokasi,
        lp.nama_lokasi,
        os.kategori,
        os.level,
        os.shu,
        np.ph,
        sm.nilai_ip,
        sm.status_mutu_air
    FROM observasi_sungai os
    JOIN petugas_sampling ps ON os.id_petugas = ps.id_petugas
    JOIN lokasi_pemantauan lp ON os.id_lokasi = lp.id_lokasi
    JOIN nilai_pemantauan np ON os.id_nilai = np.id_nilai
    JOIN status_mutu sm ON os.id_status = sm.id_status
    ORDER BY ps.nama_petugas ASC
";
$result = mysqli_query($koneksi, $query);

// ============================
// SIAPKAN PDF
// ============================
$pdf = new FPDF('P', 'cm', 'A4');
$pdf->AddPage();

// ============================
// HEADER TENGAH + LOGO (SUDAH DISEJAJARKAN)
// ============================

// Logo ukuran pas + sejajar
$pdf->Image('img/logo_kalsel.png', 1.3, 1.4, 2.6, 3); 

// Set posisi awal teks agar tinggi sejajar dengan logo (y = 1.5)
$pdf->SetY(1.5);

$pdf->SetFont('Arial', '', 13);
$pdf->Cell(0, 0.7, 'PEMERINTAH PROVINSI KALIMANTAN SELATAN', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 17);
$pdf->Cell(0, 0.7, 'DINAS LINGKUNGAN HIDUP', 0, 1, 'C');

$pdf->SetFont('Arial', '', 9.5);
$pdf->Cell(0, 0.5, 'Jl. Bangun Praja Kawasan Perkantoran Pemerintah Provinsi Kalimantan Selatan,', 0, 1, 'C');
$pdf->Cell(0, 0.5, 'Palam, Kecamatan Cempaka, Kota Banjarbaru, Kalimantan Selatan', 0, 1, 'C');
$pdf->Cell(0, 0.5, 'Kode Pos: 70732. Telp/Faks: 0511-6749-241   Email: blhdkalsel@gmail.com', 0, 1, 'C');
$pdf->Cell(0, 0.5, 'Website: www.dlh.kalselprov.go.id', 0, 1, 'C');

// Garis bawah header
$y = $pdf->GetY();
$pdf->Line(1, $y + 0.2, 20, $y + 0.2);
$pdf->Ln(1);

// ============================
// JUDUL LAPORAN
// ============================
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 0.7, 'LAPORAN REKAPITULASI PEMANTAUAN AIR SUNGAI', 0, 1, 'C');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 0.5, 'Dicetak pada: ' . date('d-m-Y'), 0, 1, 'C');

$pdf->Ln(0.7);

// ============================
// HEADER TABEL
// ============================
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(2.7, 0.8, 'Nama Petugas', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Kode Lokasi', 1, 0, 'C');
$pdf->Cell(2.7, 0.8, 'Nama Lokasi', 1, 0, 'C');
$pdf->Cell(1.7, 0.8, 'Kategori', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Level', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'SHU', 1, 0, 'C');
$pdf->Cell(1, 0.8, 'pH', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Nilai IP', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Status Mutu', 1, 1, 'C');

// ============================
// ISI TABEL
// ============================
$pdf->SetFont('Arial', '', 7);
$no = 1;

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(1, 0.6, $no++, 1, 0, 'C');
    $pdf->Cell(2.7, 0.6, $row['nama_petugas'], 1, 0, 'C');
    $pdf->Cell(2.5, 0.6, $row['kode_lokasi'], 1, 0, 'C');
    $pdf->Cell(2.7, 0.6, $row['nama_lokasi'], 1, 0, 'C');
    $pdf->Cell(1.7, 0.6, $row['kategori'], 1, 0, 'C');
    $pdf->Cell(1.5, 0.6, $row['level'], 1, 0, 'C');
    $pdf->Cell(2, 0.6, $row['shu'], 1, 0, 'C');
    $pdf->Cell(1, 0.6, $row['ph'], 1, 0, 'C');
    $pdf->Cell(1.5, 0.6, $row['nilai_ip'], 1, 0, 'C');
    $pdf->Cell(3, 0.6, $row['status_mutu_air'], 1, 1, 'C');
}

$pdf->Ln(2);

// ============================
// TANDA TANGAN (KANAN)
// ============================
$startX = 12;

$pdf->SetFont('Arial', '', 10);
$pdf->SetX($startX);
$pdf->Cell(8, 0.5, 'Mengetahui,', 0, 1, 'L');

$pdf->SetX($startX);
$pdf->Cell(8, 0.5, 'Kepala Dinas Lingkungan Hidup', 0, 1, 'L');

$pdf->SetX($startX);
$pdf->Cell(8, 0.5, 'Provinsi Kalimantan Selatan', 0, 1, 'L');

$pdf->Ln(2.2);

$pdf->SetFont('Arial', 'BU', 10);
$pdf->SetX($startX);
$pdf->Cell(8, 0.5, 'Rahmat Prapto Udoyo, S.Hut., MP', 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->SetX($startX);
$pdf->Cell(8, 0.5, 'Pembina Utama Muda (IV/C)', 0, 1, 'L');

$pdf->SetX($startX);
$pdf->Cell(8, 0.5, 'NIP. 19730228 199212 1 004', 0, 1, 'L');

// ============================
// ANTI CACHE
// ============================
header("Expires: 0");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=Report_Rekapitulasi_Pemantauan_Air_Sungai.pdf");

// ============================
// OUTPUT
// ============================
$pdf->Output('D', 'Report_Rekapitulasi_Pemantauan_Air_Sungai.pdf');
exit;

?>
