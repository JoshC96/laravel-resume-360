<?php

namespace App\Jobs;

use App\Mail\ProviderRegisterUserMail;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProviderRegisterUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected User $recipientUser,
        protected Entity $entity
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $recipientName = $this->recipientUser->{User::FIELD_NAME};
        $entityName = $this->entity->{Entity::FIELD_NAME};
        $subject = $entityName . ' - Complete User Registration';

        Mail::to($this->recipientUser)
            ->send(new ProviderRegisterUserMail($recipientName, $entityName, $subject));
    }
}
