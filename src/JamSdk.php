<?php

/*
 * (c) 2020 JustAuthMe SAS <hello@justauth.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace JustAuthMe\SDK;

use JustAuthMe\SDK\Exceptions\JamBadRequestException;
use JustAuthMe\SDK\Exceptions\JamInternalServerErrorException;
use JustAuthMe\SDK\Exceptions\JamNotFoundException;
use JustAuthMe\SDK\Exceptions\JamUnauthorizedException;
use JustAuthMe\SDK\Exceptions\JamUnknowErrorException;
use stdClass;

class JamSdk
{
    const CORE_URL = 'https://core.justauth.me/';
    const API_URL = self::CORE_URL . 'api/';
    const DEFAULT_BUTTON = 'https://static.justauth.me/medias/button.png';

    private $app_id;
    private $redirect_url;
    private $api_secret;

    /**
     * JamSdk constructor.
     * @param string $app_id
     * @param string $redirect_url
     * @param string $api_secret
     */
    public function __construct(string $app_id, string $redirect_url, string $api_secret)
    {
        $this->app_id = $app_id;
        $this->redirect_url = $redirect_url;
        $this->api_secret = $api_secret;
    }

    /**
     * Generate the login URL associated with the provided app_id and redirect_url
     * @return string
     */
    public function generateLoginUrl(): string
    {
        return self::CORE_URL . 'auth?app_id=' . $this->app_id . '&redirect_url=' . urlencode($this->redirect_url);
    }

    /**
     * Generate a piece of HTML that include the default login button
     * @return string
     */
    public function generateDefaultButtonHtml(): string
    {
        return '<a href="' . $this->generateLoginUrl() . '">' .
            '<img src="' . self::DEFAULT_BUTTON . '" alt="Login with JustAuthMe" />' .
            '</a>';
    }

    /**
     * Return user infos associated with provided access_token
     * @param string $access_token
     * @return stdClass
     * @throws JamBadRequestException
     * @throws JamUnauthorizedException
     * @throws JamNotFoundException
     * @throws JamInternalServerErrorException
     * @throws JamUnknowErrorException
     */
    public function getUserInfos(string $access_token): stdClass
    {
        $opts = ['http' => [
            'ignore_errors' => true
        ]];
        $context = stream_context_create($opts);

        /** @var stdClass $response */
        $response = json_decode(
            file_get_contents(
                self::API_URL . 'data?access_token=' . $access_token . '&secret=' . $this->api_secret,
                false,
                $context
            )
        );

        $status_code = substr($http_response_header[0], 9, 3);

        switch ($status_code) {
            case 200:
                $to_return = clone $response;
                unset($to_return['status']);
                return $to_return;

            case 400:
                throw new JamBadRequestException('Access-Token and API Secret are required. Please contact support@justauth.me');
                break;

            case 401:
                throw new JamUnauthorizedException('Api Secret is invalid');
                break;

            case 404:
                throw new JamNotFoundException('No such Access-Token');
                break;

            case 500:
                throw new JamInternalServerErrorException('Wrong data format. Please contact support@justauth.me');
                break;

            default:
                throw new JamUnknowErrorException('Unknow error. Please contact support@justauth.me');
        }
    }

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->app_id;
    }

    /**
     * @param string $app_id
     */
    public function setAppId(string $app_id): void
    {
        $this->app_id = $app_id;
    }

    /**
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return $this->redirect_url;
    }

    /**
     * @param string $redirect_url
     */
    public function setRedirectUrl(string $redirect_url): void
    {
        $this->redirect_url = $redirect_url;
    }

    /**
     * @return string
     */
    public function getApiSecret(): string
    {
        return $this->api_secret;
    }

    /**
     * @param string $api_secret
     */
    public function setApiSecret(string $api_secret): void
    {
        $this->api_secret = $api_secret;
    }
}
