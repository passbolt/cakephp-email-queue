<?php
declare(strict_types=1);

namespace EmailQueue\Test\TestCase\Command;

use Cake\Console\TestSuite\ConsoleIntegrationTestTrait;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EmailQueue\Model\Table\EmailQueueTable;
use EmailQueue\Test\Fixture\EmailQueueFixture;

/**
 * ClearLocksCommand Test Case.
 */
class ClearLocksCommandTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    /**
     * Fixtures.
     *
     * @var array
     */
    protected array $fixtures = [
        EmailQueueFixture::class,
    ];

    /**
     * @var EmailQueueTable
     */
    protected $EmailQueue;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->EmailQueue = TableRegistry::getTableLocator()
            ->get('EmailQueue', ['className' => EmailQueueTable::class]);
    }

    public function testClearLocksCommand()
    {
        $this->assertNotEmpty($this->EmailQueue->findByLocked(true)->toArray());
        $this->exec('clear_locks');
        $this->assertExitSuccess();
        $this->assertEmpty($this->EmailQueue->findByLocked(true)->toArray());
    }
}
