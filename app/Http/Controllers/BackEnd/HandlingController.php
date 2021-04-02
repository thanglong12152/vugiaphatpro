<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Aws\DynamoDb\Marshaler;
use Illuminate\Http\Request;
use AwsDynamoDB;
class HandlingController extends Controller
{
    public static function scanTable($table){
        $arr = [];
        $marshaler = new Marshaler();
        $params = [
            'TableName' => $table
        ];

        $data = AwsDynamoDB::scan($params);
        foreach ($data['Items'] as $key => $value) {
            $dataArr = json_decode($marshaler->unmarshalJson($value));
            array_push($arr, $dataArr);
        }

        return $arr;
    }
    public static function scanTableByIdAnItem($table, $column){
        $arr = [];
        $marshaler = new Marshaler();
        $params = [
            'TableName' => $table,
            'ScanIndexForward' => false
        ];

        $array_sort = array();
        $data = AwsDynamoDB::scan($params);
        foreach ($data['Items'] as $key => $value) {
            $dataArr = json_decode($marshaler->unmarshalJson($value));
            array_push($arr, $dataArr);
        }
        $id = array_column($arr, $column);
        array_multisort($id, SORT_DESC, $arr);
        return $arr;
    }
    public static function getAnItemTable($params){
        $arr = [];
        $marshaler = new Marshaler();

        $data = AwsDynamoDB::scan($params);
        foreach ($data['Items'] as $key => $value) {
            $dataArr = json_decode($marshaler->unmarshalJson($value));
            array_push($arr, $dataArr);
        }
        return $arr[0];
    }
    public static function getItemTable($params){
        $arr = [];
        $marshaler = new Marshaler();

        $data = AwsDynamoDB::scan($params);
        foreach ($data['Items'] as $key => $value) {
            $dataArr = json_decode($marshaler->unmarshalJson($value));
            array_push($arr, $dataArr);
        }
        return $arr;
    }
}
