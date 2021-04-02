<?php

namespace App\AWS;

use Aws\DynamoDb\DynamoDbClient as DynamoDB;
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;
class awsDemo
{
    public function hello(){
        echo "hello";
    }
    public function createTable($params){
        $client =  DynamoDB::factory([
            'region' => 'us-east-2',
            'version' => 'latest',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID', ''),
                'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
            ],
        ]);

        

        $client->createTable($params);
        $client->waitUntil('TableExists', [
            'TableName' =>  'users',
            '@waiter' => [
                'delay' => 5,
                'maxAttempts' => 20,
            ],
        ]);
    }

    public function create($params){
        $client =  DynamoDB::factory([
            'region' => 'us-east-2',
            'version' => 'latest',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID', ''),
                'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
            ],
        ]);


        try {
            $result = $client->putItem($params);
            return $result;
        } catch (DynamoDbException $e) {
            echo "Unable to add item:\n";
            echo $e->getMessage() . "\n";
        }
    }

    public function get($params){
        $client =  DynamoDB::factory([
            'region' => 'us-east-2',
            'version' => 'latest',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID', ''),
                'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
            ],
        ]);

        try {
            $result = $client->getItem($params);
            return $result;
        } catch (DynamoDbException $e) {
            echo "Unable to get item:\n";
            echo $e->getMessage() . "\n";
        }
    }

    public function update($params){
        $client =  DynamoDB::factory([
            'region' => 'us-east-2',
            'version' => 'latest',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID', ''),
                'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
            ],
        ]);

        try {
            $result = $client->updateItem($params);
            echo "Updated item.\n";
            print_r($result['Attributes']);
        } catch (DynamoDbException $e) {
            echo "Unable to update item:\n";
            echo $e->getMessage() . "\n";
        }
    }

    public function delete($params){
        $client =  DynamoDB::factory([
            'region' => 'us-east-2',
            'version' => 'latest',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID', ''),
                'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
            ],
        ]);

        try {
            $result = $client->deleteItem($params);
            echo "Updated item.\n";
            print_r($result['Attributes']);
        } catch (DynamoDbException $e) {
            echo "Bản ghi không tồn tại";
        }
    }

    public function query($params){
        $client =  DynamoDB::factory([
            'region' => 'us-east-2',
            'version' => 'latest',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID', ''),
                'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
            ],
        ]);

        try {
            $result = $client->query($params);

            $data = $result->toArray();
            return $data;
        } catch (DynamoDbException $e) {
            echo $e->getMessage();
        }
    }

    public function scan($params){
        $client =  DynamoDB::factory([
            'region' => 'us-east-2',
            'version' => 'latest',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID', ''),
                'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
            ],
        ]);

        try {
            $result = $client->scan($params);

            $data = $result->toArray();
            return $data;
        } catch (DynamoDbException $e) {
            echo $e->getMessage();
        }
    }    
}
