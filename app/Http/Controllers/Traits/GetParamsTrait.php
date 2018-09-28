<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Input;

trait GetParamsTrait
{
    /**
     * 依照value取得Input
     * @param array $params
     * @return array
     */
    public function getParams(Array $params)
    {
        $define = [];
        if ($params) {
            foreach ($params as $value) {
                $define[$value] = Input::get($value);
            }
        }
        return $define;
    }

    public function InitResponse()
    {
        $result = [];
        $result["Result"] = true;
        $result["Meta"] = "";
        $result["Data"] = "";
        $result["Message"] = "";

        return $result;
    }
}