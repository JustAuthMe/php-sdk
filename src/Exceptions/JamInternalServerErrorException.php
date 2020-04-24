<?php

/*
 * (c) 2020 JustAuthMe SAS <hello@justauth.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace JustAuthMe\SDK\Exceptions;

use Exception;

class JamInternalServerErrorException extends Exception
{

    /**
     * JamInternalServerErrorException constructor.
     * @param string $message
     */
    public function __construct(string $message = '')
    {
        parent::__construct($message);
    }
}