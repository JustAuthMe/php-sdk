# JamSdk Class

## Constants

|Name            |Type    |Description                                          |
|----------------|--------|-----------------------------------------------------|
|`CORE_URL`      |`string`|URL to the core systems of JustAuthMe                |
|`API_URL`       |`string`|URL to the webroot of the API                        |
|`DEFAULT_BUTTON`|`string`|URL of the static storage containing the login button|

## Properties

|Name          |Type    |Description                                              |
|--------------|--------|---------------------------------------------------------|
|`app_id`      |`string`|Unique identifier of your App in the JustAuthMe ecosystem|
|`redirect_url`|`string`|Your callback URL we will redirect users to after login  |
|`api_secret`  |`string`|Top secret information used to authenticate your app     |

## Methods

### `generateLoginUrl`

#### Params

None

#### Return

`string`: A URL that your users need to be redirected to in order to login to your website
with their JustAuthMe account.

### `generateDefaultButtonHtml`

#### Params

|Name  |Type    |Required|Default|Description                                                        |
|------|--------|--------|-------|-------------------------------------------------------------------|
|`lang`|`string`|No      |`en`   |The language used to display the text inside the button: `fr`, `en`|
|`size`|`string`|No      |`x2`   |The size of the button, used for Retina displays: `x1`, `x2`, `x4` |

#### Return

`string`: A piece of HTML code that you can `echo` in your HTML page. It will display
the default "Login with JustAuthMe" button/badge, already linked to your very own login URL.

### `getUserInfos`

#### Params

|Name          |Type    |Required|Description                                           |
|--------------|--------|--------|------------------------------------------------------|
|`access_token`|`string`|Yes     |The token you get in the params of your `redirect_url`|

#### Return

`stdClass`: A standard object containing `jam_id` and, if this is the first login of the user,
all requested user data such as `email`, `firstname`, `lastname`, `birthdate` or `avatar`.

### `getAppId`

#### Return

`string`: `app_id`

### `setAppId`

#### Params

|Name    |Type    |Required|Description     |
|--------|--------|--------|----------------|
|`app_id`|`string`|Yes     |The new `app_id`|

#### Return

`void`

### `getRedirectUrl`

#### Return

`string`: `redirect_url`

### `setRedirecturl`

#### Params

|Name          |Type    |Required|Description           |
|--------------|--------|--------|----------------------|
|`redirect_url`|`string`|Yes     |The new `redirect_url`|

#### Return

`void`

### `getApiSecret`

#### Return

`string`: `api_secret`

### `setApiSecret`

#### Params

|Name        |Type    |Required|Description         |
|------------|--------|--------|--------------------|
|`api_secret`|`string`|Yes     |The new `api_secret`|

#### Return

`void`

# Exceptions

## Not JSON

`JamNotJsonException`: The API responded with an invalid JSON. This is an issue on our
side. If it happens, please contact [developers@justauth.me](mailto:developers@justauth.me).

## Missing ID

`JamMissingIdException`: The API returned a valid response (200 OK) but the JAM_ID is
not part of the response. Without this informaton, you cannot perform any login. This is
an issue on our side. If it happens, please contact
[developers@justauth.me](mailto:developers@justauth.me).

## Bad Request

`JamBadRequestException`: The `access_token` or the `api_secret` (or both) are missing.
This should not happens if you are using the official SDK. If it happens anyway, open an
issue on [Github](https://github.com/justauthme/php-sdk) or contact
[developers@justauth.me](mailto:developers@justauth.me).

## Unauthorized

`JamUnauthorizedException`: The `api_secret` you provided isn't valid

## Not Found

`JamNotFoundException`: The `access_token` you provided does not match any ongoing login

## Internal Server Error

`JamInternalServerErrorException`:  Something went badly wrong on our side. Please report
this issue at [developers@justauth.me](mailto:developers@justauth.me).

## Unknow Error

`JamUnknowErrorException`: Same as above, maybe even worse. Warn us fast.

# Troubleshooting

If anything goes wrong, feel free to open an issue on
[Github](https://github.com/justauthme/php-sdk), we will be pleased to help you.
