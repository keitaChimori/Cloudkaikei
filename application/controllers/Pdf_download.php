<?php
class pdf_download extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $this->printPdf();
  }

  private function printPdf()
  {
    // PDFライブラリ呼出
    $this->load->library('pdf');

    // ページ向き(横)
    $pageOrientation = 'L';
    // ページフォーマット
    $pageFormat = 'B5';

    $pdf = new TCPDF($pageOrientation, 'pt', $pageFormat, true, 'UTF-8', false);

    // ここにTCPDFのロジック
    $pdf->SetFont("kozgopromedium", "", 10);

    // ページの追加
    $pdf->AddPage();

    $html = <<< EOF

      <h1>請求書</h1>
     
      EOF;

    $pdf->writeHTML($html); // 表示htmlを設定
    $pdf->Close();
    $pdf->Output('seikyu_Cloudkaikei.pdf', 'D');

    exit;
  }
}
