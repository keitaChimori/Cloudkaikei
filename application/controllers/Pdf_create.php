<?php
require_once('application/third_party/tcpdf/tcpdf.php');
require_once('application/third_party/tcpdf/autoload.php');

class Pdf_create extends CI_controller
{
  
    // デフォルトの設定
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        // Pdfライブラリーを読み込み
        $this->load->library('Pdf');
    }

  
    public function index()
    {
      
      // $input_data = $this->input->post('data');
      // var_dump($input_data);
      // exit;

      $pdf = new setasign\Fpdi\Tcpdf\Fpdi();

      $pdf->setPrintHeader( false );
      
      $pdf->setSourceFile("application/third_party/tcpdf/Cloudkaikei.pdf");
      $pdf->AddPage();
      $tpl = $pdf->importPage(1);
      $pdf->useTemplate($tpl);
      
      // $number = $_POST["number"];
      // $name = $_POST["name"];
      // $price = $_POST["price"];
      // $proviso = $_POST["proviso"];
      $customer = 'クラウド会計株式会社';
      $date = '2020年10月10日';
      $id = '1';
      $total = "15200";
      $tax = "1520";
      $total_tax = "16720";
      $user_name = "サンプル株式会社";
      $user_post = "〒193-0942";
      $user_address1 = "東京都八王子市椚田町572−5";
      $user_address2 = "ベルゾーネ清水103";
      $bank = "多摩信用金庫";
      $bank_number = "1234567";
      $note = "ここに備考を入力する。";
      
      $syousai = "商品A";
      $tanka = "10000";
      $suuryou = "2";
      $goukei = "20000";

      


      
      
      // //$pdf->SetFont('kozminproregular', スタイル, サイズ);
      // //$pdf->Text(x座標, y座標, テキスト);

      $pdf->SetFont('kozminproregular', '',14 );
      $pdf->Text(22, 41, htmlspecialchars( $customer ));
      
      $pdf->SetFont('kozminproregular', '',12 );
      $pdf->Text(160, 32, htmlspecialchars( $date ));

      $pdf->SetFont('kozminproregular', '',12 );
      $pdf->Text(160, 40, htmlspecialchars( $id ));
      
      $pdf->SetFont('kozminproregular', '',20 );
      $pdf->Text(65, 72, htmlspecialchars( $total ));
      
      $pdf->SetFont('kozminproregular', '',13 );
      $pdf->Text(135, 60, htmlspecialchars( $user_name ));

      $pdf->SetFont('kozminproregular', '',10 );
      $pdf->Text(135, 67, htmlspecialchars( $user_post ));

      $pdf->SetFont('kozminproregular', '',10 );
      $pdf->Text(135, 72, htmlspecialchars( $user_address1 ));
      
      $pdf->SetFont('kozminproregular', '',10 );
      $pdf->Text(135, 77, htmlspecialchars( $user_address2 ));

      $pdf->SetFont('kozminproregular', '',14 );
      $pdf->Text(162, 210, htmlspecialchars( $total ));

      $pdf->SetFont('kozminproregular', '',14 );
      $pdf->Text(162, 221, htmlspecialchars( $tax ));
      
      $pdf->SetFont('kozminproregular', '',14 );
      $pdf->Text(162, 232, htmlspecialchars( $total_tax ));
      
      $pdf->SetFont('kozminproregular', '',12 );
      $pdf->Text(38, 210, htmlspecialchars( $bank ));

      $pdf->SetFont('kozminproregular', '',12 );
      $pdf->Text(38, 218, htmlspecialchars( $bank_number ));
      
      $pdf->SetFont('kozminproregular', '',10 );
      $pdf->Text(22, 251, htmlspecialchars( $note ));

      $pdf->SetFont('kozminproregular', '',13 );
      $pdf->Text(25, 96, htmlspecialchars( $syousai ));
      
      $pdf->SetFont('kozminproregular', '',13 );
      $pdf->Text(103, 96, htmlspecialchars( $tanka ));
      
      $pdf->SetFont('kozminproregular', '',13 );
      $pdf->Text(144, 96, htmlspecialchars( $suuryou ));

      $pdf->SetFont('kozminproregular', '',13 );
      $pdf->Text(169, 96, htmlspecialchars( $goukei ));
      
      // //金額
      // $pdf->SetFont('kozminproregular', '', 20);
      // $price = number_format($price) . "-";
      // $pdf->Text(70, 70, htmlspecialchars( $price ) );
      
      
      // //日付
      // $pdf->SetFont('kozminproregular', '', 11);
      // $today = date("Y年m月d日");
      // $pdf->Text(150, 21, $today);
      
      //$pdf->Output(出力時のファイル名, 出力モード);
      ob_end_clean();
      $pdf->Output("invoice_Cloudkaikei.pdf", "D");
    }
}