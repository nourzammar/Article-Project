<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleTags;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use GuzzleHttp\Client;


class ProfileController extends Controller
{


    public function result(Request $request){

        $article = $request->article ;


        $data = [
            'article' => $article
        ];

        
        $client = new Client();

        $flaskUrl = 'http://localhost:4000/check_article'; 

        try {
            $response = $client->post($flaskUrl, [
                'json' => $data
            ]);
            $responseBody = json_decode($response->getBody(), true);

            // استخراج detected_adult_terms و detected_racist_terms ووضعها في مصفوفات منفصلة
            $detectedAdultTerms = $responseBody['detected_adult_terms'];
            $detectedRacistTerms = $responseBody['detected_racist_terms'];

            $allTerm = array_merge($detectedAdultTerms, $detectedRacistTerms);

            
            $label = $responseBody['label'] ;
            $adult = $responseBody['probability']['adult'] * 100 ;
            $racist = $responseBody['probability']['racist'] * 100 ;

            if($label == 0 && sizeof($allTerm) != 0) $typeArticle = 'adult' ;
            elseif($label == 1 && sizeof($allTerm) != 0) $typeArticle = 'racist' ;
            else  $typeArticle = 'normal' ;

            for($i = 0 ; $i < sizeof($allTerm) ; $i = $i + 1){
                if($allTerm[$i][0] == 0) $allTerm[$i][0] = 'adult' ;
                else $allTerm[$i][0] = 'racist' ;
            }
            
            return view('userProfile/resultCheck' ,
             [  
                'typeArticle'=> $typeArticle ,
                'adult'=> $adult ,
                'racist'=>$racist ,
                'allTerm'=>$allTerm    
            ]) ;

        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
 
    }

    public function check(){
        return view('userProfile/checkArticle');
    } 

   public function index()
   {
       
       $userId = Auth::id();
       $data['getRecord'] = Article::getRecordProfile($userId);
       return view('userProfile/profile', $data);
   }
 public function add()
 {
   $data['getCategory']=Category::getCategory();


    return view('userProfile/add', $data);
 }
 public function insert(Request $request)
 {
   $profile= new Article;
   $profile->user_id = Auth::user()->id;
   $profile->title = trim($request->title);
   $profile->category_id = trim($request->category_id);
   $profile->description = trim($request->description);
   $profile->meta_description = trim($request->meta_description);
   $profile->meta_keywords = trim($request->meta_keywords);
   $profile->is_publish = 1;
   $profile->status = 0;
   

   $slug = Str::slug($request->title);
   $checkSlug= Article::where('slug','=',$slug)->first();
   if(!empty($checkSlug))
   {
       $dbslug = $slug.'-'.$profile->id;
   }
   else
   {
       $dbslug =$slug;
   }

    $profile->slug = $dbslug;
    $profile->imge_file = null;
    $profile->save();

    $profile->addMedia($request->file('imge_file'))
        ->preservingOriginal()
        ->toMediaCollection();


   ArticleTags::InsertDeleteTag($profile->id,$request->tags);


   // send article to flask api check article

   $data = [
    'article' => $profile->description
];


$client = new Client();

$flaskUrl = 'http://localhost:4000/check_article'; 

try {
    $response = $client->post($flaskUrl, [
        'json' => $data
    ]);
    $responseBody = json_decode($response->getBody(), true);

    return redirect('profile')->with('success', 'Article Successfully Created');


} catch (\Exception $e) {
    return response()->json(['message' => 'Internal Server Error'], 500);
}


 }
 public function edit($id)
 {

     $data['getCategory']=Category::getCategory();   
     $data['getRecord']=Article::getSingle($id);
     return view('userProfile.edit' ,$data);
 }
 public function update(Request $request ,$id)
 {
   $profile=  Article::getSingle($id);   
        $profile->title = trim($request->title);
        $profile->category_id = trim($request->category_id);
        $profile->description = trim($request->description);
        $profile->meta_description = trim($request->meta_description);
        $profile->meta_keywords = trim($request->meta_keywords);
        $profile->is_publish = 1;
        $profile->status = 0;
        $profile->imge_file = null;
        $profile->save();


        $slug = Str::slug($request->title);
        $checkSlug = Article::where('slug', '=', $slug)->first();
        if (!empty($checkSlug)) {
            $dbslug = $slug . '-' . $profile->id;
        }
         else 
        {
            $dbslug = $slug;
        }
        $profile->slug = $dbslug;
        $profile->imge_file = null;
        $profile->save();

        if ($request->hasFile('imge_file')) {
            $profile->addMedia($request->file('imge_file')->path())
                ->usingFileName($request->imge_file->hashName())
                ->preservingOriginal()
                ->toMediaCollection();
        }

        ArticleTags::InsertDeleteTag($profile->id, $request->tags);
        return redirect('profile')->with('success', 'Article Successfully Updated');
    }
    public function delete($id)
    {
        $article = Article::getSingle($id);
        $article->is_delete = 1;
        $article->save();
        return redirect()->back()->with('success', 'Article Successfuly Deleted');

    }
 
}
