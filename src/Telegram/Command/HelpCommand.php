<?php

namespace App\Telegram\Command;

use BoShurik\TelegramBotBundle\Telegram\Command\AbstractCommand;
use BoShurik\TelegramBotBundle\Telegram\Command\PublicCommandInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Exception;
use TelegramBot\Api\InvalidArgumentException;
use TelegramBot\Api\Types\Update;

/**
 * Class HelpCommand
 *
 * @package App\Telegram\Command
 */
class HelpCommand extends AbstractCommand implements PublicCommandInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return '/help';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Example Help World Command';
    }

    /**
     * @param BotApi $api
     * @param Update $update
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function execute(BotApi $api, Update $update): void
    {
        preg_match(self::REGEXP, $update->getMessage()->getText(), $matches);
        // $text = sprintf('Hello *%s*', $who);
        $api->sendMessage($update->getMessage()->getChat()->getId(), 'Help information', 'markdown');
    }
}