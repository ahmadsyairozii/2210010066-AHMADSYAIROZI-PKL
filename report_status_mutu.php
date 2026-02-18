<?php 
include ('fpdf186/fpdf.php');
include ('koneksi.php');

// Ambil data laporan
$query = "
    SELECT 
        sm.id_status,
        lp.kode_lokasi,
        lp.nama_lokasi,
        wp.tanggal_pemantauan,
        sm.status_mutu_air,
        sm.nilai_ip
    FROM status_mutu sm
    JOIN lokasi_pemantauan lp ON sm.id_lokasi = lp.id_lokasi
    JOIN waktu_pemantauan wp ON sm.id_waktu = wp.id_waktu
    ORDER BY lp.kode_lokasi DESC
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
$pdf->Cell(0, 0.7, 'LAPORAN STATUS MUTU AIR SUNGAI', 0, 1, 'C');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 0.5, 'Dicetak pada: ' . date('d-m-Y'), 0, 1, 'C');

$pdf->Ln(0.7);

// ============================
// HEADER TABEL
// ============================
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Kode Lokasi', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Nama Lokasi', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal Pemantauan', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Nilai Indeks Pencemar', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Status Mutu Air', 1, 1, 'C');

// ============================
// ISI TABEL
// ============================
$pdf->SetFont('Arial', '', 7);
$no = 1;

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(1, 0.7, $no++, 1, 0, 'C');
    $pdf->Cell(3, 0.7, $row['kode_lokasi'], 1, 0, 'C');
    $pdf->Cell(4, 0.7, $row['nama_lokasi'], 1, 0, 'C');
    $pdf->Cell(4, 0.7, date('d-m-Y', strtotime($row['tanggal_pemantauan'])), 1, 0, 'C');
    $pdf->Cell(4, 0.7, $row['nilai_ip'], 1, 0, 'C');
    $pdf->Cell(3.5, 0.7, $row['status_mutu_air'], 1, 1, 'C');
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
header("Content-Disposition: attachment; filename=Report_Status_Mutu_Air_Sungai.pdf");

// ============================
// OUTPUT
// ============================
$pdf->Output('D', 'Report_Status_Mutu_Air_Sungai.pdf');
exit;

?>
