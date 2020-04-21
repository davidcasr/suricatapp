<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword;

class ResetPasswordNotification extends ResetPassword
{
   public function toMail($notifiable)
   {
       return (new MailMessage)
            ->subject('Recuperar contraseña')
            ->greeting('Hola '. $notifiable->first_name)
            ->line('Estás recibiendo este correo porque hiciste una solicitud de recuperación de contraseña para tu cuenta.')
            ->action('Reestablecer contraseña', route('password.reset', $this->token))
            ->line('Si no realizaste esta solicitud, no se requiere realizar ninguna otra acción.')
            ->salutation('Saludos, '. config('app.name'));
   }
}
