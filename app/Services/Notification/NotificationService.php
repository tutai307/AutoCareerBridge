<?php

namespace App\Services\Notification;

use App\Repositories\Notification\NotificationRepositoryInterface;

class NotificationService
{
    protected $notificationRepository;

    public function __construct(NotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function getNotifications(array $filters)
    {
        return $this->notificationRepository->getNotifications($filters);
    }

}
