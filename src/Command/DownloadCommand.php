<?php

namespace FlyntWP\PremiumPluginDownloader\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use CaseHelper\CaseHelperFactory;
use Webmozart\PathUtil\Path;

class DownloadCommand extends Command
{
    protected function configure()
    {
        $this->setName("download")
                ->setDescription("Download a given premium plugin.")
                ->addArgument(
                    'pluginName',
                    InputArgument::REQUIRED,
                    'What do you wish to download?'
                )
                ->addArgument(
                    'destination',
                    InputArgument::OPTIONAL,
                    'Where do you want to save the download?',
                    ''
                )
                ->addOption(
                    'tag',
                    't',
                    InputOption::VALUE_REQUIRED,
                    'What version to download?',
                    null
                );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pluginName = $input->getArgument('pluginName');
        $destination = $input->getArgument('destination');
        $pluginVersion = $input->getOption('tag');

        $caseHelper = CaseHelperFactory::make(CaseHelperFactory::INPUT_TYPE_KEBAB_CASE);
        list($authorKebab, $pluginKebab) = explode('/', $pluginName);
        $author = $caseHelper->toPascalCase($authorKebab);
        $plugin = $caseHelper->toPascalCase($pluginKebab);

        $recipeClass = "\\FlyntWP\\PremiumPluginDownloader\\Recipes\\$author\\$plugin";

        $recipe = new $recipeClass();

        $destination = Path::makeAbsolute($destination, getcwd());

        if (!isset($pluginVersion)) {
            $pluginVersion = $recipe->getLatestVersion();
        }

        $destination = $destination . DIRECTORY_SEPARATOR . $pluginKebab . '.' . $pluginVersion . $recipe->getFileExtension();

        $url = $recipe->getDownloadUrl($pluginVersion);
        $recipe->download($pluginVersion, $destination);

        $output->writeln('Successfully downloaded ' . $url);
    }
}
