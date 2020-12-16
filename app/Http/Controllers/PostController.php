<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Repositories\PostRepository;

class PostController extends Controller
{
   /* protected $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }*/

    public function index()
    {
       // return response()->json(['status' => 0, 'posts' => $this->postRepo->index()]);
       return response()->json(['status' => 0, 'posts' => 9]);
    }

    public function store()
    //public function store(Request $request)
    {
       // $post = $this->postRepo->create(request()->only('title', 'content'));

        //if (!$post) {
        //    return response()->json(['status' => 1]);
       // }

        return response()->json(['status' => 0, 'post' => 2]);
        //return response()->json(['status' => 0, 'post' => $request]);

    }
    public function show(Request $request,$id)
    //public function show($id)
    {
        //$post = $this->postRepo->find($id);

       // if (!$post) {
          //  return response()->json(['status' => 1, 'message' => 'Post not found'], 404);
       // }


        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'http://tgap.atb.bse.ntu.edu.tw/sparql?query=PREFIX%20rdfs%3A%20<http%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23>%0APREFIX%20tgap%3A%20<http%3A%2F%2Ftgap.atb.bse.ntu.edu.tw%2F>%0ASELECT%20%3FProduct%20%20%3FOperation%20%20%3FProduct_label%20%3FOperation_label%20%20WHERE%20%7B%0A%20%20%20%3FProduct%20%20tgap%3AisProcessedBy%20%20%3FOperation%20%20.%0A%20%20%20%3FProduct%20%20rdfs%3Alabel%20%3FProduct_label%20.%0A%0A%20%20%20%3FOperation%20rdfs%3Alabel%20%3FOperation_label%20.%0A%20%20%20%20FILTER%20regex%20(%3FProduct_label%2C%20"2019-2鹿鳴米_張天賞")%20%0A%7D%0A%20%20%20%20%20%20&output=JSON');
        
$url='http://tgap.atb.bse.ntu.edu.tw/sparql?query=';
$urlend=$request->sparql;
//$urlend=$id;
$res2= $client->request('GET', $url.$urlend);

//$res = $client->request('GET', 'http://tgap.atb.bse.ntu.edu.tw/sparql?query='+$request->sparql);

$obj = json_decode($request);
        //echo $response->getParsedResponse();
      //   return $res->getBody();
        //return $request->json()->all();
return $res2->getBody();
        //return $request->sparql;
        // return $request->json()->all()->sparql();
        //return response()->json(['status' => 0, 'post' => 3]);
    }

    public function update($id)
    {
       // $result = $this->postRepo->update($id, request()->only('title', 'content'));

        //if (!$result) {
         //   return response()->json(['status' => 1, 'message' => 'Post not found'], 404);
        //}

       // return response()->json(['status' => 0]);
         return response()->json(['status' => 0, 'post' => 4]);
    }

    public function destroy($id)
    {
       // $result = $this->postRepo->delete($id);

        //if (!$result) {
        //    return response()->json(['status' => 1, 'message' => 'Post not found'], 404);
       // }

       // return response()->json(['status' => 0]);
       return response()->json(['status' => 0, 'post' => 5]);
    }
}
