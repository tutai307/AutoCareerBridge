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

    public function getNotifications()
    {
        return $this->notificationRepository->getNotifications();
    }

    public function delete($id)
    {
        return $this->notificationRepository->delete($id);
    }

    public function seen(array $args)
    {
        return $this->notificationRepository->seen($args);
    }

}
