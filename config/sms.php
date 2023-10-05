<?php 

  return [
    "hubtel" => [
      "url" =>  env("SMS_BASE_URL", "https://smsc.hubtel.com/v1/messages/send"),
      "senderId" => "GGSSA",
      "username" => env("SMS_USERNAME"),
      "password" => env("SMS_PASSWORD"),
    ]
  ]
?>