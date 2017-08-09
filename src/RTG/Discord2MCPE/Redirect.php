<?php
/**
 * Created by PhpStorm.
 * User: RTG
 * Date: 9/8/2017
 * Time: 7:39 PM
 */

namespace RTG\Discord2MCPE;

class Redirect {

    public $message;
    public $username;
    public $avatar;
    public $sender;
    public $url;

    public function __construct($url, $message, $username, $avatar, $sender)
    {
        $this->message = $message;
        $this->username = $username;
        $this->avatar = $avatar;
        $this->sender = $sender;
        $this->url = $url;

        $this->onRun($url, $message, $username, $avatar, $sender);
    }

    /**
     * @param $message
     * @param $username
     * @param $avatar
     * @param $sender
     */
    public function onRun($url, $message, $username, $avatar, $sender) {

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POSTFIELDS => json_encode(array(
                "content" => $message,
                "username" => $username,
                "avatar_url" => $avatar
            ))
        ));

        $res = curl_exec($ch);
        $error = curl_error($ch);

        if ($res === false) {
            $sender->sendMessage("There is an error while executing this function!");
        } else {
            $sender->sendMessage("Successfully sent!");
        }

    }

}