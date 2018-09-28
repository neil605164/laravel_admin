<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Traits\GetParamsTrait;
use Illuminate\Mail\Message;

class ApiAuth
{
    use GetParamsTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $result = $this->InitResponse();

        // 檢查是否存在api_key
        if(!$request->has("api_token")){
            $result["Result"] = false;
            $result["Message"] = "Api token is not exist";
            return response()->json($result);
        }

        $api_key = $request->input("api_token");
        if($api_key != "yjo4rup4eji42k71j6hji4i") {
            $result["Result"] = false;
            $result["Message"] = "Api token is wrong";
            return response()->json($result);
        }


        return $next($request);
    }
}
