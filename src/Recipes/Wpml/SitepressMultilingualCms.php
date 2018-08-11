<?php

namespace FlyntWP\PremiumPluginDownloader\Recipes\Wpml;

use FlyntWP\PremiumPluginDownloader\Recipe;

class SitepressMultilingualCms extends Recipe
{
    const KEY_ENV_VARIABLE = 'WPML_KEY';
    const USER_ENV_VARIABLE = 'WPML_USER_ID';

    protected $fileExtension = '.zip';

    protected $url = 'https://wpml.org/';
    protected $downloadId = '6088';

    protected $latestVersion = '3.7.1';

    public function getLatestVersion()
    {
        return $this->latestVersion;
    }

    public function getDownloadUrl($version)
    {
        $key = self::getKeyFromEnv(self::KEY_ENV_VARIABLE);
        $user = self::getKeyFromEnv(self::USER_ENV_VARIABLE);
        $downloadId = $this->downloadId;
        $query = "?download=${downloadId}&user_id=${user}&subscription_key=${key}&version=${version}";
        return $this->url . $query;
    }
}
