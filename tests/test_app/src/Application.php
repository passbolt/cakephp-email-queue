<?php
declare(strict_types=1);

namespace TestApp;

use Cake\Console\CommandCollection;
use Cake\Http\BaseApplication;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\RouteBuilder;
use EmailQueue\Command\ClearLocksCommand;
use EmailQueue\Command\PreviewCommand;
use EmailQueue\Command\SenderCommand;

class Application extends BaseApplication
{
    public function middleware(MiddlewareQueue $middleware): MiddlewareQueue
    {
        return $middleware;
    }

    public function routes(RouteBuilder $routes): void
    {
    }

    public function bootstrap(): void
    {
    }

    /**
     * @inheritDoc
     */
    public function console(CommandCollection $commands): CommandCollection
    {
        return $commands
            ->add('sender', SenderCommand::class)
            ->add('preview', PreviewCommand::class)
            ->add('clear_locks', ClearLocksCommand::class);
    }
}
