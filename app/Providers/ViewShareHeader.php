<?php

namespace App\Providers;

use App\Repositories\Notification\NotificationRepositoryInterface;
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
    public function boot(NotificationRepositoryInterface $notificationRepository): void
    {
        $notificationRepository = app(NotificationRepositoryInterface::class);

        View::composer(['management.partials.header'], function ($view) use ($notificationRepository) {
            $notificationsHeader = $notificationRepository->getNotifications();

            $user = auth()->guard('admin')->user();
            $valueId = [];
            if (in_array($user->role, [ROLE_UNIVERSITY, ROLE_SUB_UNIVERSITY])) {
                $valueId['university'] = $user->university->id ?? $user->academicAffair->university_id ?? null;
            } elseif (in_array($user->role, [ROLE_COMPANY, ROLE_HIRING])) {
                $valueId['company'] = $user->company->id ?? $user->hiring->company_id ?? null;
            }

            $view->with([
                'valueId' => !empty($valueId) ? $valueId : 0,
                'user' => auth()->guard('admin')->user(),
                'notificationsHeader' => $notificationsHeader,
                'notificationCount' => $notificationRepository->getNotificationCount()
            ]);
        });
    }
}
