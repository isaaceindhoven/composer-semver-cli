<?php

declare(strict_types=1);

namespace ComposerSemverCli\Application\ConsoleCommand\Semver;

use Composer\Semver\Semver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UnexpectedValueException;

use function is_array;

class RsortCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('semver:rsort');
        $this->setDescription('Reverse sort versions according to Composer SemVer.');
        $this->addArgument('version', InputArgument::IS_ARRAY, 'a list of versions');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $versions = $input->getArgument('version');
        if (!is_array($versions)) {
            throw new UnexpectedValueException('the value of \'version\' should be an array');
        }
        $sortedVersions = Semver::rsort($versions);
        $output->writeln($sortedVersions);
        return 0;
    }
}
