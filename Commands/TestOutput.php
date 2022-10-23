#!/usr/bin/env php
<?php

namespace Ronnie\Commands;

use Ronnie\TRA\Crawler;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:test-output',
    description: 'Test the output of the package',
    hidden: false
)]
class TestOutput extends Command
{
    protected function configure(): void
    {
        $this->addOption(
            'input',
            '-i',
            InputOption::VALUE_REQUIRED,
            'The type of resource provided (i.e. URL or receipt code)',
            'url',
            ['url', 'code']
        )->addOption(
            'url',
            '-u',
            InputOption::VALUE_OPTIONAL,
            'The URL of the receipt'
        )->addOption('code', '-c', InputOption::VALUE_OPTIONAL, 'The receipt code');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input->getOption('input') === 'url') {
            $output->writeln([
                "Crawling url: {$input->getOption('url')}",
                '========',
                ''
            ]);
        } elseif ($input->getOption('input') === 'code') {
            $output->writeln([
                "Crawling TRA code: {$input->getOption('code')}",
                '========',
                ''
            ]);
        }

        $crawler = new Crawler();

        $output->write($crawler->crawl($input->getOption('url'), $input->getOption('code')));

        return Command::SUCCESS;
    }
}
