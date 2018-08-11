<?php

namespace FlyntWP\PremiumPluginDownloader\Exceptions;

use Exception;

class UndefinedRecipeConstantException extends Exception
{
    public function __construct(
        $constant = '',
        $code = 0,
        Exception $previous = null
    ) {
        $trace = debug_backtrace();
        $class = $trace[1]['class'];
        parent::__construct(
            "The constant ${constant} was not defined in recipe ${class}" .
            'Please set it to a suitable environment variable',
            $code,
            $previous
        );
    }
}
