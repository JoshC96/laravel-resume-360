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

    /**
     * Execute the job.
     */
    public function handle(User $recipientUser, Entity $entity): void
    {
        $recipientName = $recipientUser->{User::FIELD_NAME};
        $entityName = $entity->{Entity::FIELD_NAME};
        $subject = $entityName . ' - Complete User Registration';

        Mail::to($recipientUser)
            ->send(new ProviderRegisterUserMail($recipientName, $entityName, $subject));
    }
}
