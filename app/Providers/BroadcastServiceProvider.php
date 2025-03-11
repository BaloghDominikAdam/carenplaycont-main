<?php


// app/Providers/BroadcastServiceProvider.php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any broadcast services.
     *
     * @return void
     */
    public function boot()
    {
        // Automatically discover channels
        Broadcast::routes();

        // Here you can define your broadcasting authorization logic
        Broadcast::channel('chat.{id}', function ($user, $id) {
            return (int) $user->id === (int) $id;
        });
    }
}
