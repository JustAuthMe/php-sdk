# JustAuthMe PHP-SDK

## Contents

1. [Installation](#installation)
2. [Usage](#usage)
    1. [Instantiate the SDK](#1-instantiate-the-sdk)
    2. [Display the login link](#2-display-the-login-link)
        1. [Use the default button](#21-use-the-default-button)
        2. [Use a custom link](#22-use-a-custom-link)
    3. [Get user infos from your callback](#3-get-user-infos-from-your-callback-redirect_url)
3. [Troubleshooting](#troubleshooting)

## Installation

```shell script
composer require justauthme/php-sdk
```

## Usage

### 1. Instantiate the SDK

```php
<?php

use JustAuthMe\SDK\JamSdk;

/*
 * Params:
 * @string app_id The app_id provided by the developers console
 * @string redirect_url The callback URL your provided at your app creation
 * @string api_secret The secret delivered to you by the developers console
 */

$jamSdk = new JamSdk($app_id, $redirect_url, $api_secret);
```

### 2. Display the login link

#### 2.1 Use the default button

```php
<?php echo $jamSdk->generateDefaultButtonHtml(); ?>
```

#### 2.2 Use a custom link

```php
<a href="<?= $jamSdk->generateLoginUrl() ?>">Login with JustAuthMe</a>
```

### 3. Get user infos from your callback: `redirect_url`

```php
<?php

use JustAuthMe\SDK\JamSdk;

if (isset($_GET['access_token'])) {
    $jamSdk = new JamSdk($app_id, $redirect_url, $api_secret);
    try {
        $user_infos = $jamSdk->getUserInfos($_GET['access_token']);
    } catch (Exception $e) {
        error_log($e->getMessage());
        // Login fail, redirect to an error page and stop this script execution
        die;
    }

    /*
     * Everything is fine, you can now register or login the user,
     * depending on the presence in your Database of
     * the provided $user_infos->jam_id
     */
} else {
    /*
     * The callback URL wasn't called with the correct parameter
     * you should redirect to an error page
     */
}
```

## Complete documentation

For a complete documentation of this SDK, please see `DOCUMENTATION.md`

## Troubleshooting

If anything goes wrong, feel free to open an issue on this repo,
we will be pleased to help you.
