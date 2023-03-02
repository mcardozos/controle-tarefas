<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class RedefinirSenhaNotification extends Notification
{
    use Queueable;
    public $token;
    public $email;
    public $name;

    /**
     * Create a new notification instance.
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        $url = 'http://controle-tarefas.local/password/reset/'.$this->token.'?email='.$this->email;

        return (new MailMessage)
            ->subject(Lang::get('Atualização de senha'))
            ->greeting(Lang::get('Olá ' . $this->name))
            ->line(Lang::get('Você recebeu esta mensagem porque nós recebemos uma requisição de alteração de senha.'))
            ->action(Lang::get('Resetar senha'), $url)
            ->line(Lang::get('Esta alteração tem um limite de tempo de :count minutos.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
            ->line(Lang::get('Se você não solicitou nenhuma alteração de senha, nenhuma ação é requerida.'))
            ->salutation(Lang::get('Até breve!'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
