<?php

namespace APP\Http\Repository;

use App\Http\Controllers\Traits\GetParamsTrait;
use App\Http\Models\User;
use DB;

class UserRepository{

    use GetParamsTrait;
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function RegisterMember($data) {
        // 初始化回傳格式
        $result = $this->InitResponse();
        $result["Meta"] = $data["username"];

        // 檢查用戶是否存在
        $isExist = $this->model::where("username", $data["username"])->first();
        if($isExist) {
            $result["Result"] = false;
            $result["Message"] = "User is exist";
            return $result;
        }

        // 存資料
        $this->model->fill($data);
        if($this->model -> save() != true) {
            $result["Result"] = false;
            $result["Message"] = "Unexpected error when register member";
            return $result;
        }

        return $result;
    }
}