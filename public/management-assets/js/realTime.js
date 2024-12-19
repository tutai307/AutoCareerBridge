let notificationElement = document.getElementById('notificationsHeader');
let idChanel = notificationElement.getAttribute('data-id-chanel');
let countNotificationUnSeen = document.getElementById('countNotificationUnSeen');
Echo.private(`company.${idChanel}`)
    .listen('NotifyJobChangeStatusEvent', (e) => {
        console.log(e);
        if (e.countNotificationUnSeen > 1) {
            notificationElement.insertAdjacentHTML('afterbegin', e.notification);
            countNotificationUnSeen.innerHTML = e.countNotificationUnSeen;
            countNotificationUnSeen.classList.remove('d-none');
        } else if (e.countNotificationUnSeen == 1) {
            notificationElement.innerHTML = e.notification
            countNotificationUnSeen.innerHTML = e.countNotificationUnSeen;
            countNotificationUnSeen.classList.remove('d-none');
        } else {
            countNotificationUnSeen.classList.add('d-none');
        }
    });
