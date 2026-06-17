<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Leaves;

class LeaveNotification extends Notification
{
    use Queueable;
    public $leave;
    public $type;

    /**
     * Create a new notification instance.
     */
    public function __construct(Leaves $leave, $type = 'created')
    {
        $this->leave = $leave;
        $this->type = $type;
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

    public function toDatabase($notifiable)
    {
        return [
            'leave_id' => $this->leave->id,
            'user_name' => $this->leave->user->name ?? null,
            'type' => $this->type, // created / approved / rejected
            'message' => $this->getMessage(),
        ];
    }

    private function getMessage()
    {
        return match ($this->type) {
            'created' => 'درخواست مرخصی جدید ثبت شد',
            'approved' => 'درخواست مرخصی تایید شد',
            'rejected' => 'درخواست مرخصی رد شد',
        };
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
