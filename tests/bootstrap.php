<?php
declare(strict_types=1);

use Cake\Core\Configure;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\TestSuite\ConnectionHelper;
use Migrations\TestSuite\Migrator;

$findRoot = function ($root) {
    do {
        $lastRoot = $root;
        $root = dirname($root);
        if (is_dir($root . '/vendor/cakephp/cakephp')) {
            return $root;
        }
    } while ($root !== $lastRoot);
    throw new Exception('Cannot find the root of the application, unable to run tests');
};

$root = $findRoot(__FILE__);
unset($findRoot);
chdir($root);

require $root . '/vendor/cakephp/cakephp/tests/bootstrap.php';

Configure::write('EmailQueue.serialization_type', 'email_queue.json');
TransportFactory::setConfig(['default' => ['className' => 'Debug', 'additionalParameters' => true]]);
Mailer::setConfig(['default' => ['transport' => 'default', 'from' => 'foo@bar.com']]);
Configure::write('App', [
    'namespace' => 'TestApp',
    'base' => 'email-queue.test',
    'encoding' => 'UTF-8',
    'paths' => [
        'templates' => [dirname(__DIR__) . DS . 'tests' . DS . 'test_app' . DS . 'templates' . DS],
    ],
]);

$cakeVendorPath = $root . '/vendor/cakephp/cakephp';
if (! file_exists($cakeVendorPath . '/tests/test_app/config')) {
    mkdir($cakeVendorPath . '/tests/test_app/config', 0744, true);
}

$source = '..' . DS . '..' . DS . '..' . DS . '..' . DS . '..' . DS . '..' . DS . 'config' . DS . 'Migrations';
(new ConnectionHelper())->addTestAliases();
(new Migrator())->run(compact('source'));
