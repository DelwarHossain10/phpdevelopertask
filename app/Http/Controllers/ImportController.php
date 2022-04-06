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
           
             $data= $pdf->getText();
           
            //preg_match_all("/(?<=\)\*\s)\d{2,}/i",$data,$arrayQuantitys);
            preg_match_all("/\s\d{2,3}\s/i",$data,$arrayQuantitys);
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
            $arrayQuantity1 = array_slice( $arrayQuantity1,6,41);
            $arrayQuantity1 = array_slice( $arrayQuantity1,0,36);
            //$totalTableData=array_combine($arrayQuantity1,$arraySize1);
		return view('welcome',compact('arrayQuantity1','arraySize1','Suplierno','Orderno'));
               
           }
     
        return "No File";
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
