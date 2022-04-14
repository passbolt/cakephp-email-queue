<?php

namespace EmailQueue\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmailQueueFixture.
 */
class EmailQueueFixture extends TestFixture
{
    public $table = 'email_queue';

    /**
     * Records.
     *
     * @var array
     */
    public $records = [
        [
            'id' => '1',
            'email' => 'example@example.com',
            'from_name' => null,
            'from_email' => null,
            'subject' => 'Free dealz',
            'config' => 'default',
            'template' => 'default',
            'layout' => 'default',
            'theme' => 'default',
            'format' => 'both',
            'template_vars' => '{"a":1,"b":2}',
            'headers' => '{"foo":"bar"}',
            'sent' => 0,
            'locked' => 0,
            'send_tries' => 1,
            'send_at' => '2011-06-20 13:50:48',
            'created' => '2011-06-20 13:50:48',
            'modified' => '2011-06-20 13:50:48',
        ],
        [
            'id' => 2,
            'email' => 'example2@example.com',
            'from_name' => null,
            'from_email' => null,
            'subject' => 'Free dealz',
            'config' => 'default',
            'template' => 'default',
            'layout' => 'default',
            'theme' => 'default',
            'format' => 'both',
            'template_vars' => '{"a":1,"b":2}',
            'headers' => '{"foo":"bar"}',
            'sent' => 0,
            'locked' => 0,
            'send_tries' => 2,
            'send_at' => '2011-06-20 13:50:48',
            'created' => '2011-06-20 13:50:48',
            'modified' => '2011-06-20 13:50:48',
        ],
        [
            'id' => 3,
            'email' => 'example3@example.com',
            'from_name' => null,
            'from_email' => null,
            'subject' => 'Free dealz',
            'config' => 'default',
            'template' => 'default',
            'layout' => 'default',
            'theme' => 'default',
            'format' => 'both',
            'template_vars' => '{"a":1,"b":2}',
            'headers' => '{"foo":"bar"}',
            'sent' => 0,
            'locked' => 0,
            'send_tries' => 3,
            'send_at' => '2011-06-20 13:50:48',
            'created' => '2011-06-20 13:50:48',
            'modified' => '2011-06-20 13:50:48',
        ],
        [
            'id' => 4,
            'email' => 'example@example.com',
            'from_name' => null,
            'from_email' => null,
            'subject' => 'Free dealz',
            'config' => 'default',
            'template' => 'default',
            'layout' => 'default',
            'theme' => 'default',
            'format' => 'both',
            'template_vars' => '{"a":1,"b":2}',
            'headers' => '{"foo":"bar"}',
            'sent' => 1,
            'locked' => 0,
            'send_tries' => 0,
            'send_at' => '2011-06-20 13:50:48',
            'created' => '2011-06-20 13:50:48',
            'modified' => '2011-06-20 13:50:48',
        ],
        [
            'id' => 5,
            'email' => 'example@example.com',
            'from_name' => null,
            'from_email' => null,
            'subject' => 'Free dealz',
            'config' => 'default',
            'template' => 'default',
            'layout' => 'default',
            'theme' => 'default',
            'format' => 'both',
            'template_vars' => '{"a":1,"b":2}',
            'headers' => '{"foo":"bar"}',
            'sent' => 0,
            'locked' => 1,
            'send_tries' => 0,
            'send_at' => '2011-06-20 13:50:48',
            'created' => '2011-06-20 13:50:48',
            'modified' => '2011-06-20 13:50:48',
        ],
        [
            'id' => 6,
            'email' => 'example@example.com',
            'from_name' => null,
            'from_email' => null,
            'subject' => 'Free dealz',
            'config' => 'default',
            'template' => 'default',
            'layout' => 'default',
            'theme' => 'default',
            'format' => 'both',
            'template_vars' => '{"a":1,"b":2}',
            'headers' => '{"foo":"bar"}',
            'sent' => 0,
            'locked' => 0,
            'send_tries' => 0,
            'send_at' => '2115-06-20 13:50:48',
            'created' => '2011-06-20 13:50:48',
            'modified' => '2011-06-20 13:50:48',
        ],
    ];
}
