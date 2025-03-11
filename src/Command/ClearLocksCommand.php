<?php
declare(strict_types=1);

namespace EmailQueue\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\ORM\TableRegistry;
use EmailQueue\Model\Table\EmailQueueTable;

class ClearLocksCommand extends Command
{
    /**
     * @inheritDoc
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);
        $parser->setDescription('Clears all locked emails in the queue, useful for recovering from crashes');

        return $parser;
    }

    /**
     * @inheritDoc
     */
    public function execute(Arguments $args, ConsoleIo $io): ?int
    {
        TableRegistry::getTableLocator()
            ->get('EmailQueue', ['className' => EmailQueueTable::class])
            ->clearLocks();

        return self::CODE_SUCCESS;
    }
}
