<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;



class TermController extends Controller
{
    
    public function index(){

        return view("backend.term.add") ;
    }

    public function add(Request $request){


        $typeTerm = $request->type ;
        $term = $request->term ;
        $Probability = $request->Probability ;

        $data = [
            'data' => [$typeTerm , $term , $Probability]
        ];

        
        $client = new Client();

        $flaskUrl = 'http://localhost:4000/add_term';

        try {
            $response = $client->post($flaskUrl, [
                'json' => $data
            ]);

            return  redirect("panel/dataset/get") ;

        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }

        // return  redirect("panel/term/add") ;

    }

}
