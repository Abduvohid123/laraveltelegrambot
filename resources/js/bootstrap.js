window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


//
// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';
//
// window.Pusher = Pusher;
// const token = window.localStorage.getItem('access_token');
//
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: '8a39d37cc392dafae3d4',
//     cluster: 'app2',
//     encrypted: true,
//     auth:{
//         headers:{
//             Authorization: `Bearer ${token}`
//         }
//     }
// });
//
// window.Echo.channel('usercreated')
//     .listen('UserCreatedListener', (e) => {
//         alert(1)
//     });
