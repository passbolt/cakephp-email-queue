<?php
declare(strict_types=1);

namespace EmailQueue\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Core\Configure;
use Cake\Mailer\Mailer;
use Cake\Mailer\Transport\DebugTransport;
use Cake\ORM\TableRegistry;
use EmailQueue\Model\Table\EmailQueueTable;

class PreviewCommand extends Command
{
    /**
     * @inheritDoc
     */
    public function execute(Arguments $args, ConsoleIo $io): ?int
    {
        Configure::write('App.baseUrl', '/');

        $conditions = [];
        if (!empty($args->getArguments())) {
            $conditions['id IN'] = $args->getArguments();
        }

        $emailQueue = TableRegistry::getTableLocator()->get('EmailQueue', ['className' => EmailQueueTable::class]);
        $emails = $emailQueue->find()->where($conditions)->disableHydration()->all()->toList();

        if (!$emails) {
            return $io->success('No emails found');
        }

//        $this->clear();
        foreach ($emails as $i => $email) {
            if ($i) {
                $io->ask('Hit a key to continue');
//                $this->clear();
            }
            $io->out('Email :' . $email['id']);
            $this->preview($email, $io);
        }

        return self::CODE_SUCCESS;
    }

    /**
     * Preview email
     *
     * @param array $e email data
     * @param \Cake\Console\ConsoleIo $io IO
     * @return void
     */
    public function preview(array $e, ConsoleIo $io): void
    {
        $configName = $e['config'];
        $template = $e['template'];
        $layout = $e['layout'];
        $headers = empty($e['headers']) ? [] : (array)$e['headers'];
        $theme = empty($e['theme']) ? '' : (string)$e['theme'];

        $email = new Mailer($configName);

        if (!empty($e['attachments'])) {
            $email->setAttachments($e['attachments']);
        }

        $email->setTransport(new DebugTransport())
            ->setTo($e['email'])
            ->setSubject($e['subject'])
            ->setEmailFormat($e['format'])
            ->addHeaders($headers)
            ->setMessageId(false)
            ->setReturnPath($email->getFrom())
            ->setViewVars($e['template_vars']);

        $email->viewBuilder()
            ->setTheme($theme)
            ->setTemplate($template)
            ->setLayout($layout);

        $return = $email->deliver();

        $io->out('Content:');
        $io->hr();
        $io->out($return['message']);
        $io->hr();
        $io->out('Headers:');
        $io->hr();
        $io->out($return['headers']);
        $io->hr();
        $io->out('Data:');
        $io->hr();
        debug($e['template_vars']);
        $io->hr();
        $io->out('');
    }
}
