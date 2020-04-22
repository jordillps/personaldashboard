<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use App\Imports\PartnersImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Mail\DonationCertificate;

class ImportController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index()
     {
         $partners = Partner::all();
         return view('import', compact('partners'));
     }

    /**
    * @return \Illuminate\Support\Collection
    *
    */
    public function import(Request $request) 
    {
        $validatedData = $request->validate([
            'file' => 'required',
        ]);

        Partner::truncate();
        Excel::import(new PartnersImport,request()->file('file'));
           
        return back()->with('success', "global.importedcorrectly");;
    }


    public function printPDF(Partner $partner)
    {
       // This  $data array will be passed to our PDF blade
       $data = [
          'sender_name' => 'Fundació Angel Olaran',
          'sender_address' => 'C/Avinguda Canal',
          'sender_city' => '25230 Mollerussa',
          'receiver_name' => $partner->name,
          'receiver_address' => $partner->address,
          'receiver_postalcode' => $partner->postalcode,
          'receiver_city' => $partner->city,
          'subject' => 'Certificado de donaciones 2019',
          'salutation' => 'Sehr geehrte Frau Graf,',
          'content' => 'Lorem Ipsum is simply dummy text of the 
          printing and typesetting industry. Lorem Ipsum has been 
          the industry\'s standard dummy text ever since the 1500s, 
          when an unknown printer took a galley of type and scrambled 
          it to make a type specimen book. It has survived not only 
          five centuries, but also the leap into electronic typesetting, 
          remaining essentially unchanged.',
          'date' => '30 d\'abril de 2020'        
            ];
        
        $pdf = PDF::loadView('pdfview', $data);
        //Sending email to the partner
        \Mail::to($partner->email)->send(new DonationCertificate($partner->name,$partner->email));
        return $pdf->download('certificat.pdf');
    }
}
