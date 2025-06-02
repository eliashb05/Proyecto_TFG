<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class VerificarCorreoPersonalizado extends Notification
{
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

   public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('¡Bienvenido! Confirma tu correo para empezar')
            ->greeting('¡Hola ' . $notifiable->name . '!')
            ->line('Gracias por unirte a nuestra plataforma. Solo falta un paso más:')
            ->line('Haz clic en el botón para confirmar tu dirección de correo electrónico.')
            ->action('Confirmar correo electrónico', $verificationUrl)
            ->line('Si no creaste una cuenta, puedes ignorar este mensaje sin problema.')
            ->salutation('Saludos, el equipo de HotelesHB')
            ->line('Si tienes problemas con el botón, copia y pega el siguiente enlace en tu navegador:')
            ->line($verificationUrl);
    }

    protected function verificationUrl($notifiable): string
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}