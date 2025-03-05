<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\SolicitudVisita;

class SolicitudVisitaEstadoChanged extends Notification
{
    use Queueable;

    protected $solicitud;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(SolicitudVisita $solicitud)
    {
        $this->solicitud = $solicitud;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('El estado de su solicitud de visita ha cambiado.')
                    ->action('Ver Solicitud', url('/solicitudes/' . $this->solicitud->id))
                    ->line('Gracias por usar nuestra aplicación!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->solicitud->id,
            'estado' => $this->solicitud->estado,
        ];
    }
}