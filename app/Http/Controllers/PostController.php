<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Model\PostModel;
use Validator;

class PostController extends Controller
{
    public function __construct()
{
    $this->middleware('auth:sanctum')->only('index');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

      return response()->json(["id"=>$user,"data"=>PostModel::get()],200);
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

            $rule = [
                'title'=>"required|string|min:4|max:15",
                'context'=>"required|string|min:4|max:20"];
        $validator = Validator::make($request->all(),$rule);
        if($validator->fails())
        {
            return  response()->json($validator->errors(),401);
        }
       $post = PostModel::create($request->all());
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = PostModel::find($id);
        if(is_null($post)){
            return response()->json(["message"=>"no data"], 404);
        }

        return  response()->json($post, 200);

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
        $rule = [
            'title'=>"required|string|min:4|max:15",
            'context'=>"required|string|min:4|max:20"];

        $validator = Validator::make($request->all(),$rule);
        if($validator->fails()){

            return response()->json(["message"=>$validator->errors()], 404);

        }

        $post = PostModel::find($id);
        $post->update($request->all());

        return response()->json($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = PostModel::find($id);
        if(is_null($post)){
            return response()->json("item dos not exict", 200);
        }
        $post->delete();
        return response()->json("item deleted", 200);


    }
}
