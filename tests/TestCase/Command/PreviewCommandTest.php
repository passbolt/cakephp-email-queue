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
class PreviewCommandTest extends TestCase
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

    public function testPreviewCommand_Preview_One()
    {
        $this->exec('preview 1');
        $this->assertExitSuccess();

        $emails = $this->EmailQueue
            ->find()
            ->where(['id IN' => [1]])
            ->all()
            ->toList();

        $this->assertEquals(1, $emails[0]['send_tries']);
        $this->assertFalse($emails[0]['locked']);
        $this->assertMailCount(0);
        $this->assertOutputContains('From: foo@bar.com');
        $this->assertOutputContains('Return-Path: foo@bar.com');
        $this->assertOutputContains('To: example@example.com');
        $this->assertOutputContains('foo: bar');
    }
}
