<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderStatusNotification extends Notification
{
    use Queueable;

    public $order;
    public $message;
    public $type;

    /**
     * Create a new notification instance.
     */
    public function __construct($order, $message, $type = 'info')
    {
        $this->order = $order;
        $this->message = $message;
        $this->type = $type; // info, success, warning, error
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'message' => $this->message,
            'type' => $this->type,
            'amount' => $this->order->total,
            'status' => $this->order->status,
        ];
    }
}
