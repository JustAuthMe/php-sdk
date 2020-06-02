<?php
require_once '../src/JamSdk.php';

$jam_sdk = new \JustAuthMe\SDK\JamSdk('jam_demo', 'https://demo.justauth.me/auth/jam', 'xxxxx');
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <?= $jam_sdk->generateDefaultButtonHtml() ?>
        <br /><br />
        <a href="<?= $jam_sdk->generateLoginUrl() ?>">
            <button style="background-color: #3498db; border: none; width: 350px; height: 30px; font-size: 16px; color: white;">
                Se connecter avec JustAuthMe
            </button>
        </a>
    </body>
</html>
