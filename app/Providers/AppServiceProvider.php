<?php

namespace App\Providers;

use App\Models\Organizer;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Generate correct verification URLs per guard/model
        VerifyEmail::createUrlUsing(function ($notifiable) {
            $expiration = (int) config('auth.verification.expire', 60);

            if ($notifiable instanceof Organizer) {
                return URL::temporarySignedRoute(
                    'admin.verification.verify',
                    now()->addMinutes($expiration),
                    [
                        'id' => $notifiable->getKey(),
                        'hash' => sha1($notifiable->getEmailForVerification()),
                    ]
                );
            }

            // Default (e.g., regular users)
            return URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes($expiration),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );
        });
    }
}
