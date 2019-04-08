<?php
/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Laravel Swagger",
 *         description="",
 *         termsOfService="terms urls will be here",
 *         @OA\Contact(
 *             email="apiteam@swagger.io"
 *         ),
 *         @OA\License(
 *             name="Apache 2.0",
 *             url="licence url will be here"
 *         )
 *     ),
 *     @OA\Server(
 *         description="Api host",
 *         url="http://localhost:8000/"
 *     ),
 *     @OA\ExternalDocumentation(
 *         description="Find out more about Swagger",
 *         url="http://swagger.io"
 *     )
 * )
 */

/**
	@OA\Schema(
		schema="Post",
		required={
		  "title", "body"
		},  
		type="object",
		@OA\Property(property="title", type="string"),
		@OA\Property(property="body", type="string"),
		
		@OA\Xml(name="Post")
	)
*/