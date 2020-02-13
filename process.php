<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


foreach (array_keys($_POST) as $person) {
    // Curl back to Slack using the returned code to get an access token
    curl_setopt($ch, CURLOPT_URL, "https://slack.com/api/chat.postMessage?token=" . $ini['slack_token'] . "&channel=" . $person . "&text=DU%20Mail%20Bot%3A%20You%27ve%20got%20mail%21");
    $output = json_decode(curl_exec($ch));
}

if (curl_error($ch)) {
    exit(curl_error($ch));
} else {
    echo "<script>alert('Success')</script>";
}

curl_close($ch);
