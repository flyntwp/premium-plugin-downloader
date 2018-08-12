<?php

namespace FlyntWP\PremiumPluginDownloader\Recipes\Wpml;

class WpViews extends BaseRecipe
{
    protected $downloadId = '2453603';

    protected $latestVersion = '2.6.3';

    public function getDownloadUrl($version)
    {
        $versionString = $version . '-lite';
        return parent::getDownloadUrl($versionString);
    }
}
