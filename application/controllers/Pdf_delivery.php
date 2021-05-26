<?php
require_once('application/third_party/tcpdf/tcpdf.php');
require_once('application/third_party/tcpdf/autoload.php');

class Pdf_delivery extends CI_controller
{
  
    // デフォルトの設定
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->model('Invoice_model');
        $this->load->model('Pdf_model');
        $this->load->library('javascript');
        date_default_timezone_set('Asia/Tokyo');
        // Pdfライブラリーを読み込み
        $this->load->library('Pdf');
    }

    public function index()
    {
      $pdf = new setasign\Fpdi\Tcpdf\Fpdi();

      $pdf->setPrintHeader( false );
      
      $pdf->setSourceFile("application/third_party/tcpdf/Cloudkaikei_delivery.pdf");
      $pdf->AddPage();
      $tpl = $pdf->importPage(1);
      $pdf->useTemplate($tpl);

      // 納品書情報の取得
      $user_id = $_SESSION['id'];
      $invoice_id = $this->input->get("invoice_id");//PDF化するID取得
      // var_dump($invoice_id);
      // exit;
      if(empty($invoice_id) || is_numeric($invoice_id) === false){
        return show_404();
      }
      $invoice_data = $this->Invoice_model->invoice_preview($invoice_id,$user_id);//PDF化するinvoiceテーブルデータを取得
      $invoice_detail_data = $this->Invoice_model->detail_preview($invoice_id,$user_id);//PDF化するinvoice_detailテーブルデータを取得
      $user_data = $this->Pdf_model->fetch_userdata($invoice_data['user_id']);//ユーザー情報を取得

      //顧客名
      $customer = $this->Pdf_model->fetch_customerdata($invoice_data['customer']);
      $customer = $customer['name'];
      // 納品日
      $date = $this->Pdf_model->fetch_customerdata($invoice_data['customer']);
      $y = substr($date['updated_at'],0,4);
      $m = substr($date['updated_at'],5,2);
      $d = substr($date['updated_at'],8,2);
      $date = $y."年".$m.'月'.$d."日";

      // 納品書番号
        // $invoice_id;
      // ユーザー名
      $user_name = $user_data['name'];
      // 郵便番号
      $a = substr($user_data['post'],0,3);
      $b = substr($user_data['post'],3,4);
      $user_post = '〒'.$a.'−'.$b;
      // 住所１
      // 都道府県
      $prefectures = array ('選択してください','北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','新潟県','富山県','石川県','福井県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
      $i = $user_data['prefecture'];
      $prefecture = $prefectures[$i];

      $user_address1 = $prefecture.$user_data['address1'];
      // 住所２
      $user_address2 = $user_data['address2'];
      // 小計
      $total = $invoice_data['total'];
      // 消費税
      $tax = $total * 0.1;
      // 合計金額
      $total_tax = $total + $tax; 
      // 備考欄
      $note = $invoice_data['note'];
      function mb_wordwrap( $str, $width=51, $break=PHP_EOL, $encode="UTF-8" )
      {
        $c = mb_strlen($str, $encode);
        $arr = [];
        for ($i=0; $i<=$c; $i+=$width) {
          $arr[] = mb_substr($str, $i, $width, $encode);
        }
        return implode($break, $arr);
      }
      $note = mb_wordwrap($note,51,"<br/>");

      // //$pdf->SetFont('kozminproregular', スタイル, サイズ);
      // //$pdf->Text(x座標, y座標, テキスト);

      $pdf->SetFont('kozminproregular', '',14 );
      $pdf->Text(24, 40, htmlspecialchars( $customer ));
      
      $pdf->SetFont('kozminproregular', '',12 );
      $pdf->Text(160, 32, htmlspecialchars( $date ));

      $pdf->SetFont('kozminproregular', '',12 );
      $pdf->Text(160, 40, htmlspecialchars( $invoice_id ));
      
      $pdf->SetFont('kozminproregular', '',20 );
      $pdf->Text(55, 72, htmlspecialchars( '¥'.number_format($total) ));
      
      $pdf->SetFont('kozminproregular', '',13 );
      $pdf->Text(130, 60, htmlspecialchars( $user_name ));

      $pdf->SetFont('kozminproregular', '',10 );
      $pdf->Text(130, 67, htmlspecialchars( $user_post ));

      $pdf->SetFont('kozminproregular', '',10 );
      $pdf->Text(130, 72, htmlspecialchars( $user_address1 ));
      
      $pdf->SetFont('kozminproregular', '',10 );
      $pdf->Text(130, 77, htmlspecialchars( $user_address2 ));

      $pdf->SetFont('kozminproregular', '',14 );
      $pdf->Text(158, 204, htmlspecialchars( '¥'.number_format($total) ));

      $pdf->SetFont('kozminproregular', '',14 );
      $pdf->Text(161, 215, htmlspecialchars( '¥'.number_format($tax) ));
      
      $pdf->SetFont('kozminproregular', '',14 );
      $pdf->Text(158, 225, htmlspecialchars( '¥'.number_format($total_tax) ));
      
      $pdf->SetFont('kozminproregular', '',10 );
      $pdf->Text(22, 251, $note );

      // 以下 詳細・内訳
      $invoice_detail_count = count($invoice_detail_data);
      $product_name = null;
      $price = null;
      $num = null;
      $detail_total = null;
      for($i=0;$i<$invoice_detail_count;$i++){

        $product_name[$i] = $invoice_detail_data[$i]['product_name'];
        $price[$i] = $invoice_detail_data[$i]['price'];
        $num[$i] = $invoice_detail_data[$i]['num'];
        $detail_total[$i] = $price[$i] * $num[$i];

        if($i == 0 ){
          $x = '96';
        }elseif($i == 1){
          $x = '105';
        }elseif($i == 2){
          $x = '114';
        }elseif($i == 3){
          $x = '123';
        }elseif($i == 4){
          $x = '132';
        }elseif($i == 5){
          $x = '141';
        }elseif($i == 6){
          $x = '150';
        }elseif($i == 7){
          $x = '158';
        }elseif($i == 8){
          $x = '167';
        }elseif($i == 9){
          $x = '176';
        }elseif($i == 10){
          $x = '185';
        }elseif($i == 11){
          $x = '193';
        }
    
        $pdf->SetFont('kozminproregular', '',13 );//詳細
        $pdf->Text(25, $x, htmlspecialchars( $product_name[$i] ));
        $pdf->SetFont('kozminproregular', '',13 );//単価
        $pdf->Text(103, $x, htmlspecialchars( '¥'.number_format($price[$i]) ));
        $pdf->SetFont('kozminproregular', '',13 );//数量
        $pdf->Text(144, $x, htmlspecialchars( $num[$i] ));
        $pdf->SetFont('kozminproregular', '',13 );//合計
        $pdf->Text(168, $x, htmlspecialchars( '¥'.number_format($detail_total[$i]) ));
      }
      
      //$pdf->Output(出力時のファイル名, 出力モード);
      ob_end_clean();
      $pdf->Output("delivery_Cloudkaikei.pdf", "D");
    }
}