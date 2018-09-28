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

    /**
     * 註冊會員（執行DB行為）
     * @param $data username,password
     * @return array api 格式
     */
    public function RegisterMember($data) {
        // 初始化回傳格式
        $result = $this->InitResponse();
        $result["Meta"] = $data["username"];

        try {
            // 檢查用戶是否存在
            $isExist = $this->model::where("username", $data["username"])->first();
            if($isExist) {
                $result["Result"] = false;
                $result["Message"] = "User is exist";
            }

            // 存資料
            $this->model->fill($data);
            if($this->model -> save() != true) {
                $result["Result"] = false;
                $result["Message"] = "register member error";
            }

        } catch (\Exception $e) {
            $result["Result"] = false;
            $result["Message"] = "unexpected err when get register member, error msg is: ". $e->getMessage(). "\n";
        }


        return $result;
    }

    /**
     *  取用戶清單（執行DB行為）
     * @return array api 格式
     */
    public function GetUserList() {
        // 初始化回傳格式
        $result = $this->InitResponse();

        try {
            $userlist = $this->model::all();
            $result["Data"] = $userlist;

        }catch (\Exception $e) {
            $result["Result"] = false;
            $result["Message"] = "unexpected err when get user list, error msg is: ". $e->getMessage(). "\n";
        }
        return $result;
    }

    /**
     * 變更用戶密碼
     * @param $param username,password
     * @return array api 格式
     */
    public function EditUserPassword($param) {
        // 初始化回傳格式
        $result = $this->InitResponse();
        $result["Meta"] = $param;

        try {
            $affectedRows = $this->model::where('username', $param["username"])->update(['password' => $param["password"]]);
            if ($affectedRows <= 0) {
                $result["Result"] = false;
                $result["Message"] = "Does not exist user to change password";
            }

        }catch (\Exception $e) {
            $result["Result"] = false;
            $result["Message"] = "unexpected err when edit user password, error msg is: ". $e->getMessage(). "\n";
        }
        return $result;
    }

    /**
     * 刪除用戶(軟刪除)
     * @param $param username
     * @return array api 格式
     */
    public function DeleteUser($param) {
        // 初始化回傳格式
        $result = $this->InitResponse();
        $result["Meta"] = $param;

        try {
            $affectedRows = $this->model::where('username', $param["username"])->delete();
            if ($affectedRows <= 0) {
                $result["Result"] = false;
                $result["Message"] = "Does not exist user to delete";
            }

        }catch (\Exception $e) {
            $result["Result"] = false;
            $result["Message"] = "unexpected err when delete user , error msg is: ". $e->getMessage(). "\n";
        }
        return $result;
    }
}