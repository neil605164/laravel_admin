<?php

namespace APP\Http\Service;

use App\Http\Repository\UserRepository;
use App\Http\Controllers\Traits\GetParamsTrait;

class UserService{

    use GetParamsTrait;
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function RegisterMember($data) {
        // 註冊會員
        $result = $this->repository->RegisterMember($data);

        if($result["Result"] == false){
            return $result;
        }

        $result["Message"] = "register member access";
        return $result;
    }
}
