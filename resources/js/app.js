require('./bootstrap');

console.log('jsjss');
Echo.private('notification')
    .listen('UserSessionChanged', (e) =>{
        const notificationElement = document.getElementById('notification');

        notificationElement.innerText = e.message;

        notificationElement.classList.remove('invisible');
        notificationElement.classList.remove('alert-success');
        notificationElement.classList.remove('alert-danger');

        notificationElement.classList.add('alert-' + e.type);
    });
