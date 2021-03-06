<?php
/**
 * @author Marcos Redondo <kusflo@gmail.com>
 */

namespace Longman\TelegramBot\Commands\UserCommands;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\File;
use Longman\TelegramBot\Entities\PhotoSize;
use Longman\TelegramBot\Entities\UserProfilePhotos;
use Longman\TelegramBot\Request;
/**
 * User "/comandos" command
 *
 * Comando que devuelve los comandos habilitados
 */
class ComandosCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'comandos';
    /**
     * @var string
     */
    protected $description = 'Muestra información de los de los comandos.';
    /**
     * @var string
     */
    protected $usage = '/comandos';
    /**
     * @var string
     */
    protected $version = '1.1.0';
    /**
     * @var bool
     */
    protected $private_only = true;
    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $from       = $message->getFrom();
        $user_id    = $from->getId();
        $chat_id    = $message->getChat()->getId();
        $message_id = $message->getMessageId();
        $data = [
            'chat_id'             => $chat_id,
            'reply_to_message_id' => $message_id,
        ];
        //Send chat action
        Request::sendChatAction([
            'chat_id' => $chat_id,
            'action'  => 'typing',
        ]);
        $caption = sprintf(
            '/comandos | Información de los comandos disponibles.' . PHP_EOL .
            '/empleados | Información de los empleados de la empresa.' . PHP_EOL .
            '/yo | Información de quien soy en telegram.' . PHP_EOL);

        $data['text'] = $caption;
        return Request::sendMessage($data);
    }
}