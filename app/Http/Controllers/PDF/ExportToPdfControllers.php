<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jobposts;

class ExportToPdfControllers extends Controller
{
    public function allJobsToPdf(){

     $pdfdata =Jobposts::get();
     $fileName ='KIkosi Limited Jobs.pdf';
     $mpdf = new \Mpdf\Mpdf([
         'margin_left'=>10,
         'margin_right'=>10,
         'margin_top'=>20,
         'margin_bottom'=>10,
         'margin_header'=>10,
         'margin_footer'=>10
     ]);
     $html =\View::make('PDF.jobpdf')->with('pdfdata',$pdfdata);
     $html = $html->render();

     $mpdf->SetHeader('Kikosi Limited|Kikosi Limited Jobs|{PAGENO}');
     $mpdf->SetFooter('We accept new projects and meet new people');
     $mpdf->WriteHTML($html);
     $mpdf->Output($fileName,'I');

    }
    public function jobapplicats(){
        return 'job applicants';
    }
    public function specificjob(){
        return 'Specific job';
    }
}