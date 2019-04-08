<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;
use Elasticsearch\ClientBuilder;


class PostController extends Controller
{

  function __construct() {
    $this->middleware(function ($request, $next) {
      checkPermission();
      return $next($request);
    });
  }

  function index(Request $request) {

    /*
    // for bulk indexing documents
    $posts = Post::all()->toArray();

    $client = ClientBuilder::create()->build();

    $params = ['body' => []];

    foreach ($posts as $post) {
      $params['body'][] = [
        'index' => [
          '_index' => 'posts',
          '_type' => 'post',
          '_id' => $post['id']
        ]
      ];

      $params['body'][] = [
        'title' => $post['title'],
        'body' => $post['body']
      ];
    }

    $response = $client->bulk($params);*/


  	$data['posts'] = Post::orderBy('id','desc')->paginate(10); 
  	return view('post.index', $data);
  }

  function create(Request $request) {
  	$data['update_id'] = 0;
  	$data['form_location'] = '/post/create'; 
  	return view('post.create', $data);
  }

  function edit(Request $request) {
  	$update_id = $request->route('update_id');
  	if (!is_numeric($update_id)) {
  		return redirect()->back();
  	}

  	$post = Post::find($update_id)->toArray();
  	if (empty($post)) {
  		return redirect()->back();
  	}

		$data['update_id'] = $update_id;
		$data['form_location'] = '/post/'.$update_id.'/edit';
		$data['post'] = $post; 
		return view('post.create', $data);
  }

  function validatePost(Request $request) {
  	// check whether this is a update or create a new post
  	$update_id = is_numeric($request->route('update_id')) ? $request->route('update_id') : 0;
  	
  	$validator = Validator::make($request->all(),
  		[
  			'title' => 'required',
  			'description' => 'required'
  		],
  		[
  			'title.required' => 'Title field is required.',
  			'description.required' => 'Description field is required.',
  		]
		);

    $elasticClient = ClientBuilder::create()->build(); 

  	if (!$validator->fails()) {

  		$validatedData = $validator->getData();

  		$data = ['title' => $validatedData['title'] , 'body' => $validatedData['description']];

 			if ($update_id > 0) {
 				// update post
 				$getPost = Post::find($update_id)->toArray();

 				if (!empty($getPost)) {

 					$updatePost = Post::where('id',$update_id)->update($data);

          $elasticSearchData = [
            'index' => 'posts',
            'type' => 'post',
            'id'  => $update_id,
            'body' => ['doc' => $data]
          ];


          $response = $elasticClient->update($elasticSearchData); 

 					if ($updatePost) {
 						$return['success'] = "Post data has been successfully updated.";
 					} else {
 						$return['error'] = "Something went wrong while updating post.";
 					}

 				} else {
 					$return['error'] = "Something went wrong while updating post.";
 				}

 			} else {
 				// create a new post
 				$createPost = Post::create($data);
        
        // store data into elastic 
        $elasticSearchData = [
          'index' => 'posts',
          'type' => 'post',
          'id'  => $createPost->id,
          'body' => $data
        ];

        $response = $elasticClient->index($elasticSearchData); 

 				if ($createPost) {
 					$return['success'] = "Your new post has been successfully posted.";
 				} else {
 					$return['error'] = "Something went wrong while creating post.";
 				}
 			}
  		return redirect()->back()->with($return);
  	} else{
  		return redirect()->back()->withErrors($validator)->withInput();
  	}
  }
}