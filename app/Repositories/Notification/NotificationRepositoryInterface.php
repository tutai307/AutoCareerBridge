<?php

namespace App\Repositories\Notification;

use App\Repositories\Base\BaseRepositoryInterface;

interface NotificationRepositoryInterface extends BaseRepositoryInterface
{

    public function getNotifications();

    public function seen(array $args);

    public function getNotificationCount();

    public function getCountNotificationRealtime($companyId = null, $universityId = null);
}
