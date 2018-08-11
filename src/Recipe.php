<?php

namespace FlyntWP\PremiumPluginDownloader;

use FlyntWP\PremiumPluginDownloader\Exceptions\UndefinedRecipeConstantException;
use FlyntWP\PremiumPluginDownloader\Exceptions\MissingEnvVarException;
use GuzzleHttp\Client;

abstract class Recipe
{
    protected $fileExtension = '.zip';

    abstract public function getLatestVersion();

    abstract public function getDownloadUrl($version);

    public function download($version, $path = null)
    {
        if (!isset($path)) {
            $path = tmpfile();
        }
        $client = new Client();
        $client->request('GET', $this->getDownloadUrl($version), ['sink' => $path]);
        return $path;
    }

    public function getFileExtension()
    {
        return $this->fileExtension;
    }

    protected function getKeyFromEnv($envVar = null)
    {
        if (!isset($envVar)) {
            if (defined('static::KEY_ENV_VARIABLE')) {
                $envVar = static::KEY_ENV_VARIABLE;
            } else {
                throw new UndefinedRecipeConstantException('KEY_ENV_VARIABLE');
            }
        }
        $key = getenv($envVar);
        if (!$key) {
            throw new MissingEnvVarException($envVar);
        }
        return $key;
    }
}
