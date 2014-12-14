<?php
/* Webhook to update a repo for each push on GitHub.
 * Adapted from https://github.com/mozfr/firefoxosminisite/blob/master/web/github_hook.php
 */

date_default_timezone_set('Europe/Paris');

// app variables
$app_root = realpath(__DIR__ . '/');

// git variables
$branch = 'master';
$header = 'HTTP_X_HUB_SIGNATURE';
$secret = parse_ini_file($app_root . '/config/config.ini')['github_key'];

// Logging function to output content to /github_log.txt
function logHookResult($message , $success = false) {
    $log_headers = "$message\n";
    if (! $success) {
        foreach ($_SERVER as $header => $value) {
           $log_headers .= "$header: $value \n";
        }
    }
    file_put_contents(__DIR__ . '/github_log.txt', $log_headers);
}


if (isset($_SERVER[$header])) {
    $validation = hash_hmac(
        'sha1',
        file_get_contents("php://input"),
        $secret
    );

    if ($validation == explode('=', $_SERVER[$header])[1]) {
        // Pull latest changes
        exec("git checkout $branch ; git pull origin $branch");
    } else {
        logHookResult('Invalid GitHub secret');
    }
} else {
    logHookResult("{$header} header missing, define a secret key for your project in GitHub");
}
