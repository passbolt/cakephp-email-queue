<?php
declare(strict_types=1);

namespace EmailQueue\Test\TestCase\Command;

use Cake\Console\TestSuite\ConsoleIntegrationTestTrait;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\EmailTrait;
use Cake\TestSuite\TestCase;
use EmailQueue\Model\Table\EmailQueueTable;
use EmailQueue\Test\Fixture\EmailQueueFixture;

/**
 * SenderCommand Test Case.
 */
class SenderCommandTest extends TestCase
{
    use ConsoleIntegrationTestTrait;
    use EmailTrait;

    /**
     * Fixtures.
     *
     * @var array
     */
    public array $fixtures = [
        EmailQueueFixture::class,
    ];

    /**
     * @var EmailQueueTable
     */
    protected $EmailQueue;

    /**
     * setUp method.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->EmailQueue = TableRegistry::getTableLocator()
            ->get('EmailQueue', ['className' => EmailQueueTable::class]);
    }

    public function testSenderCommand_AllWin()
    {
        $this->exec('sender');
        $this->assertExitSuccess();

        $emails = $this->EmailQueue
            ->find()
            ->where(['id IN' => [1, 2, 3]])
            ->all()
            ->toList();

        $this->assertEquals(1, $emails[0]['send_tries']);
        $this->assertEquals(2, $emails[1]['send_tries']);
        $this->assertEquals(3, $emails[2]['send_tries']);

        $this->assertFalse($emails[0]['locked']);
        $this->assertFalse($emails[1]['locked']);
        $this->assertFalse($emails[2]['locked']);

        $this->assertTrue($emails[0]['sent']);
        $this->assertTrue($emails[1]['sent']);
        $this->assertTrue($emails[2]['sent']);

        $this->assertMailCount(3);
        $this->assertOutputContains('<success>Email 1 was sent</success>');
        $this->assertOutputContains('<success>Email 2 was sent</success>');
        $this->assertOutputContains('<success>Email 3 was sent</success>');
    }
}
