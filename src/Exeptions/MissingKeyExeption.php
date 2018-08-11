<?php

namespace FlyntWP\PremiumPluginDownloader;

use Exception;

/**
 * Exception thrown if the ACF PRO key is not available in the environment
 */
class MissingKeyException extends Exception
{
    public function __construct(
        $envVar = '',
        $code = 0,
        Exception $previous = null
    ) {
        $trace = debug_backtrace();
        $class = $trace[1]['class'];
        parent::__construct(
            "Could not find a key for recipe ${class}" .
            'Please make it available via the environment variable ' .
            $envVar,
            $code,
            $previous
        );
    }
}
