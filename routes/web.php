<?php

use Aws\DynamoDb\Marshaler;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $client = new \Aws\DynamoDb\DynamoDbClient([
        'region' => 'ap-south-1',
        'version' => 'latest',
        'credentials' => [
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
        ],
    ]);
    $marshaler = new Marshaler();
    $data = [
        'name' => 'John Doe',
        'email' => 'john@email.com',
        'address' => 'India'
    ];
    $item = $marshaler->marshalJson(json_encode($data));
    return $client->putItem([
        'TableName' => 'student_data',
        'Item' => $item
    ]);
});
