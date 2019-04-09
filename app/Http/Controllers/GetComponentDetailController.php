<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;

class GetComponentDetailController extends Controller
{

	/*
		Response Code with appropriate message
		422 = Missing Parameter
		405 = Validation Error
	*/

    /**
    * @OA\Get(
    *	  tags={"Post"},
    *     path="/getPosts",
    *     description="Return all posts",
    *     @OA\Response(
    *         response=200,
    *         description="OK",
    *     ),
    *     @OA\Response( response=404, description="Please provide both data")
    * )
    */

    public function getPost() {

    	$post = Post::all()->toArray();

    	if (!empty($post)) {
    		$response = response($post,200);
    	} else {
    		$response = response('Post not found.',404);
    	}

    	return $response;
    }

    /**
		@OA\Get(
			tags={"Post"},
			path="/getPostById/{id}",
			description="Fetch post details by id",
			operationId="getPostById",
			@OA\Parameter(
				name="id",
				in="path",
				description="Reffered as post id",
				required=true,
				@OA\Schema(
					type="integer"
				)
			),

			@OA\Response( response=200, description="OK" ),
			@OA\Response( response=404, description="Please provide id" ),
			@OA\Response( response=422, description="Missing or Invalid Parameter " ),
		)
    */

    public function getPostById(Request $request) {

    	$post_id = $request->route('id');

    	if (is_numeric($post_id)) {

    		$post = Post::find($post_id);
    		if (!empty($post)) {
    			$response = response($post, 200);
    		} else {
    			$response = response('There is no post', 404);
    		} 
    	} else {
    		$response = response('Invalid post id', 422);
    	}

    	return $response;
    }

    /**
		@OA\Post(
			tags={"Post"},
			path="/createPost",
			description="Create New Post",
			operationId="createPost",
			@OA\RequestBody(
				required=true,
				description="Post object that needs to be added to post", 
				@OA\JsonContent(ref="#/components/schemas/Post"),
			),
			@OA\Response( response=200, description="OK"),
			@OA\Response( response=405, description="Validation Error"),
		)
    */

    public function createPost(Request $request) {

    	$input = $request->input();


    	if (array_key_exists('body', $input) && array_key_exists('title', $input)) {

    		$validator = Validator::make($request->all(),[
    			'title' => 'required',
    			'body' => 'required',
    		]);


    		if (!$validator->fails()) {
    			$data = ['title' => $validator->getData()['title'],  'body' => $validator->getData()['body']];

    			$createPost = Post::create($data);

    			if (!empty($createPost)) {
    				$responseData = [
    					"success" => TRUE,
    					"post" => $createPost->toArray()
    				];

    				$response = response($responseData, 200);    				
    			} else {

    				$response = response(["error" => "Something went wrong while creating post"], 501);
    			}
    		} else {
    			$response = response(["error" => $validator->errors()], 405);
    		}
    	} else {
    		$response = response("Request parameter must have body and title.", 405);
    	}

    	return $response;
    }
}
