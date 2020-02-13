<?php

include_once("init.php");

$ch = curl_init();

$postData = array(
    'session_token' => $_GET['session_token'],
    'api_key' => $ini['api_key'],
);

// Call the API for a list of brothers
curl_setopt($ch, CURLOPT_URL, "http://broskies.gtdu.org/api/getBrothers.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
$server_output = json_decode(curl_exec($ch));

curl_close($ch);

// If the form has been submitted, send DMs
if (!empty($_POST)) {
    include_once("process.php");
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<h1 class="mt-2">Mail Bot</h1>
<div class="pl-4 pr-4 mb-4">
    <form method="post">
        <?php

        foreach ($server_output as $row) {
            echo '<div class="form-group">';
            echo '<input class="form-check-input" type="checkbox" name="' . $row->slack_id . '" id="' . $row->slack_id . '">';
            echo '<label class="form-check-label" for="' . $row->slack_id . '">' . $row->name . '</label>';
            echo '</input>';
            echo '</div>';
        }
        ?>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script></body>
</html>
