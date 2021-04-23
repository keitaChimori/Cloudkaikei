<?php
        if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Createpdf extends CI_Controller {

        public function __construct() {
            parent::__construct();
            // $this->load->model('Createpdf_model', 'createpdf');
            $this->load->library('Pdf');
        }
        public function index() {       
            $data['title'] = 'Create PDF | TechArise';
            $data['getInfo'] = $this->createpdf->getContent();  
            $this->load->view('pdf/index', $data);
        }    
        // generate PDF File
         public function generatePDFFile() {
            $data = array();            
            $htmlContent='';
            $data['getInfo'] = $this->createpdf->getContent();
            $htmlContent = $this->load->view('pdf/file', $data, TRUE);       
            $createPDFFile = time().'.pdf';
            $this->createPDF(ROOT_FILE_PATH.$createPDFFile, $htmlContent);
            redirect(HTTP_FILE_PATH.$createPDFFile);
         }

        // create pdf file 
        public function createPDF($fileName,$html) {
            ob_start(); 
            // Include the main TCPDF library (search for installation path).
            $this->load->library('Pdf');
            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TechArise');
            $pdf->SetTitle('TechArise');
            $pdf->SetSubject('TechArise');
            $pdf->SetKeywords('TechArise');

            // set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            
            $pdf->SetPrintHeader(false);
            $pdf->SetPrintFooter(false);

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(0);
            $pdf->SetFooterMargin(0);

            // set auto page breaks
            //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->SetAutoPageBreak(TRUE, 0);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }       

            // set font
            $pdf->SetFont('dejavusans', '', 10);

            // add a page
            $pdf->AddPage();

            // output the HTML content
            $pdf->writeHTML($html, true, false, true, false, '');

            // reset pointer to the last page
            $pdf->lastPage();       
            ob_end_clean();
            //Close and output PDF document
            $pdf->Output($fileName, 'F');        
        }
    }
?>