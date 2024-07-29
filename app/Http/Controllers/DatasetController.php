<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Article;
class DatasetController extends Controller
{
    public function index(){

        $client = new Client();

        $flaskUrl = 'http://localhost:4000/get_articles';

        try {
            $response = $client->get($flaskUrl);
            $responseBody = json_decode($response->getBody(), true);

            $articles = $responseBody['articles'] ;

            for($i = 0 ; $i < sizeof($articles) ; $i = $i + 1){
                if($articles[$i][3] == 1) $articles[$i][3] = 'racist' ;
                else if($articles[$i][3] == 0) $articles[$i][3] = 'adult' ;
                else  $articles[$i][3] = 'normal' ;
            }
            

        
            return view('backend/dataset/getDataset' , ['articles' => $articles]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }


    }

    public function update(Request $request){

        $index = $request -> index ;
        $racism = $request -> racism ;
        $adult = $request -> adult ;
        $articles = $request -> article ;
        $type = $request -> type ;
        $model=$request-> model;
        if($type == "2"){
            $status = 1 ;
            $racism = 0 ;
            $adult = 0 ;
        } 
        else $status = 0 ;



        $data = [
            'index' => intval($index),
            'probabilities' => [
                'racist' => doubleval($racism),
                'adult' => doubleval($adult)
            ],
            'type'=> intval($type),
            'model'=>intval($model)
        ];
    
        
        $client = new Client();

        $flaskUrl = 'http://localhost:4000/update_article';

        try {
            $response = $client->post($flaskUrl, [
                'json' => $data
            ]);



            // update article status in database 
            
            Article::where("description" , $articles)
            -> update([
                'status' => $status,
            ]);

           


            return  redirect('panel/dataset/get') ;

        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }




    }
}