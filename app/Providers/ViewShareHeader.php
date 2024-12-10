<?php

namespace App\Providers;

use App\Repositories\Notification\NotificationRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewShareHeader extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }


    /**
     * Bootstrap services.
     */
    public function boot(NotificationRepository $notificationRepository)
    {
        // Inject NotificationRepository từ container
        $notificationRepository = app(NotificationRepository::class);

        View::composer(['management.partials.header'], function ($view) use ($notificationRepository) {
            $notificationsHeader = $notificationRepository->getNotifications();
            $view->with([
                'notificationsHeader' => $notificationsHeader, // Thêm notifications nếu cần
            ]);
        });
    }
}
