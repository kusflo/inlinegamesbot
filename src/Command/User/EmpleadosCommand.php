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
 * User "/empleados" command
 *
 * Comando que devuelve información sobre los empleados
 */
class EmpleadosCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'empleados';
    /**
     * @var string
     */
    protected $description = 'Muestra información de los empleados de la empresa.';
    /**
     * @var string
     */
    protected $usage = '/empleados';
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
            'CEO: Paco Salgueiro' . PHP_EOL .
            'CTO: Jorge García' . PHP_EOL .
            'Empleado 1: Diego' . PHP_EOL .
            'Empleado 2: Sergio' . PHP_EOL .
            'Empleado 3: Maria' . PHP_EOL .
            'Empleado 4: Estibaliz' . PHP_EOL .
            'Empleado 5: Sonia' . PHP_EOL .
            'Empleado 6: Vicente' . PHP_EOL .
            'Empleado 7: Marcos' . PHP_EOL);

        $data['text'] = $caption;

        return Request::sendMessage($data);
    }
}