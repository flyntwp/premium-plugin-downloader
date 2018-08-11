<?php

namespace FlyntWP\PremiumPluginDownloader\Recipes\AdvancedCustomFields;

use FlyntWP\PremiumPluginDownloader\Recipe;
use GuzzleHttp\Client;

class AdvancedCustomFieldsPro extends Recipe
{
    const KEY_ENV_VARIABLE = 'ACF_PRO_KEY';

    protected $url = 'https://connect.advancedcustomfields.com/';

    protected $fileExtension = '.zip';

    public function getLatestVersion()
    {
        $client = new Client();
        $query = 'v2/plugins/get-info?p=pro';
        $response = $client->request('GET', $this->url . $query);
        $info = json_decode($response->getBody());
        return $info->version;
    }

    public function getDownloadUrl($version)
    {
        $key = self::getKeyFromEnv();
        $query = "index.php?p=pro&a=download&k=${key}&t=${version}";
        return $this->url . $query;
    }
}
