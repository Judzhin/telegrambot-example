<?php

namespace App\Telegram\Command;

use BoShurik\TelegramBotBundle\Telegram\Command\AbstractCommand;
use BoShurik\TelegramBotBundle\Telegram\Command\PublicCommandInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Exception;
use TelegramBot\Api\InvalidArgumentException;
use TelegramBot\Api\Types\Update;

/**
 * Class HelloWorldCommand
 *
 * @package App\Telegram\Command
 */
class HelloWorldCommand extends AbstractCommand implements PublicCommandInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return '/helloworld';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Example Hello World Command';
    }

    /**
     * @param BotApi $api
     * @param Update $update
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function execute(BotApi $api, Update $update): void
    {
        dump($update);
        // preg_match(self::REGEXP, $update->getMessage()->getText(), $matches);
        // $who = !empty($matches[3]) ? $matches[3] : 'World';
        //
        // $text = sprintf('Hello *%s*', $who);
        // $api->sendMessage($update->getMessage()->getChat()->getId(), $text, 'markdown');
        $api->sendMessage($update->getMessage()->getChat()->getId(), 'Some Response Text', 'markdown');
    }
}