<?php

namespace FlyntWP\PremiumPluginDownloader\Recipes\Wpml;

use FlyntWP\PremiumPluginDownloader\Recipe;

abstract class BaseRecipe extends Recipe
{
    const KEY_ENV_VARIABLE = 'WPML_KEY';
    const USER_ENV_VARIABLE = 'WPML_USER_ID';

    protected $url = 'https://wpml.org/';
    protected $downloadId;

    protected $latestVersion;

    public function getLatestVersion()
    {
        return $this->latestVersion;
    }

    public function getDownloadUrl($version)
    {
        $key = $this->getKeyFromEnv();
        $user = $this->getKeyFromEnv(self::USER_ENV_VARIABLE);
        $downloadId = $this->downloadId;
        $query = "?download=${downloadId}&user_id=${user}&subscription_key=${key}&version=${version}";
        return $this->url . $query;
    }
}
