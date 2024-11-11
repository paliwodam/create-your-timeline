<?php

namespace CreateYourTimeline\Controllers;

use CreateYourTimeline\Controller;

global $userToken;

class UserController extends Controller
    {
        
    private function callAPI($method, $url, $data = false, $token = null)
    {
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        if($token && !empty($token)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
        }

        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $url = "http://13.60.170.77:8000/auth/login";
        $data = [
            "username"=> $username,
            "password"=> $password
        ];

        $response = $this-> callAPI("POST", $url,  $data);
        if(!json_decode($response, true)["success"]) {
            $_SESSION["failedLogin"] = true;
        } else {
            $_SESSION['userToken']  = json_decode($response, true)["data"]["access_token"];
        }

        $timelineId = $_POST['timeline_id'] ?? null;
        if($timelineId) {
            header('Location: /timeline?id=' . $timelineId);
        } else {
            header('Location: /');
        }
    }   

    public function logout() {
        $url = "http://13.60.170.77:8000/auth/logout";
        $response = $this-> callAPI("POST", $url, null, $_SESSION['userToken']);
        if(json_decode($response, true)["success"]) {
            $_SESSION['userToken'] = "";
        }
        $timelineId = $_POST['timeline_id'] ?? null;
        if($timelineId) {
            header('Location: /timeline?id=' . $timelineId);
        } else {
            header('Location: /timeline' . $timelineId);
        }
    }
}
