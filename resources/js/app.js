import './bootstrap';
if (role == "user") {

    window.Echo.private('App.Models.User.' + UserId)
        .notification((event) => {

            $('#pusherrr_notification').prepend(`
                                            <div class="dropdown-item d-flex justify-content-between align-items-center">
                                                <span>${event.user_name} comment on ${event.post_title} </span>
                                                <a href="${event.link}?notifica=${event.id}"><i class="fas fa-eye"></i></a>
                                            </div>`);
            count = Number($('#count_notification').text());
            count++;
            $('#count_notification').text(count);
        });
}

// Admin
if (role == "admin") {

    window.Echo.private('App.Models.Admin.' + AdminId)
        .notification((event) => {
            $('#notifiy_push').prepend(` <a class="dropdown-item d-flex align-items-center" href="${event.link}?notifiy_admin=${event.id}">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">${event.date}</div>
                                <span class="font-weight-bold">${event.title}</span>
                            </div>
                        </a>`);
            count = Number($('#count_notifiy').text());
            count++;
            $('#count_notifiy').text(count);
        });
}