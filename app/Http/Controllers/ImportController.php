<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;

//use Spatie\PdfToText\Pdf;



class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         $fileName =public_path('size details.pdf');
        $parser = new Parser();
        $pdf = $parser->parseFile($fileName);
        $text = $pdf->getText();
        
        $data= $pdf->getText();
		preg_match_all("/(?<=\*)\d{2,}/i",$data,$arrayQuantity);
		preg_match_all("/\d{2}\/\d{2,}\s\(\d{2,}\/\d{2,}\)\*/i",$data,$arraySize);
		preg_match_all("/\d{4,}[-]\d+/i",$data,$arrayOrderNo);
	preg_match_all("/\d{4}/i",$data,$arrayS);
		//echo $arrayOrderNo[0][0];
		//echo $arraySupplierCode[0][0];
		//$array = explode(" ",$data);
		echo "<pre>";
		print_r($arrayS[0][12]);
	//print_r(array_unique($arrayQuantity));
		//print_r($arraySupplierCode);
		echo "<pre>";
		
		
		
		die();
     
      //  echo Pdf::getText('size details.pdf');
        // $text = (new Pdf('/usr/local/bin/pdftotext'))
        // ->setPdf('./size details.pdf')
        // ->text();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'file'  => 'required|mimes:pdf|max:2048',
          ]);

          $file = $request->file;
     
           if ($files = $request->file('file')) {
                   
          
            $fileName = $file->getClientOriginalName();
    
            $pdfParser = new Parser();
            $pdf = $pdfParser->parseFile($file->path());
            $content = $pdf->getText();
            $data= $pdf->getText();
            preg_match_all("/(?<=\)\*\s)\d{2,}/i",$data,$arrayQuantitys);
            preg_match_all("/\d{2}\/\d{2,}\s\(\d{2,}\/\d{2,}\)\*/i",$data,$arraySizes);
            preg_match_all("/\d{4,}[-]\d+/i",$data,$arrayOrderNo);
            preg_match_all("/\d{4}/i",$data,$arrayS);
           
           
            $Suplierno=$arrayS[0][12];

            $Orderno=$arrayOrderNo[0][0];
            $arrayQuantity1=[];
            foreach ($arrayQuantitys as $arrayQuantity) {
               
                $arrayQuantity1=$arrayQuantity;
            }
            $arraySize1=[];
            foreach ($arraySizes as $arraySize) {
               
                $arraySize1=$arraySize;
            }

            $arraySize1 = array_slice($arraySize1, 0, 36);

            //return $arraySize;
            //return Response()->json($arraySize);
        	//echo "<pre>";
		//print_r($arraySize1);
		//echo "<pre>";

        

		return view('welcome',compact('arrayQuantity1','arraySize1','Suplierno','Orderno'));
               
           }
     
        return "bad";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
