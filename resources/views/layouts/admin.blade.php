<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Admin Panel</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

        <style>
            ```css
body{
    margin:0;
    background:#f1f5f9;
    font-family:Arial,sans-serif;
}

/* Sidebar */

.sidebar{
    width:260px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;
    background:#0f172a;
    overflow-y:auto;
    transition:.3s;
    z-index:1050;
}

.sidebar h3{
    color:#fff;
    text-align:center;
    margin:25px 0 35px;
    font-weight:bold;
}

.sidebar a{
    display:block;
    color:#cbd5e1;
    text-decoration:none;
    padding:15px 25px;
    transition:.3s;
}

.sidebar a:hover{
    background:#1e293b;
    color:#fff;
}

.sidebar a i{
    margin-right:10px;
}

/* Main */

.main{
    margin-left:260px;
    padding:30px;
    transition:.3s;
}

/* Topbar */

.topbar{
    background:#fff;
    padding:18px 25px;
    border-radius:16px;
    box-shadow:0 5px 20px rgba(0,0,0,.05);
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

/* Cards */

.card-box{
    background:#fff;
    padding:30px;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.05);
    text-align:center;
}

/* Notification */

.notification-btn{
    width:52px;
    height:52px;
    border:none;
    border-radius:14px;
    background:#f8fafc;
    position:relative;
}

.notification-badge{
    position:absolute;
    top:-5px;
    right:-5px;
}

.notification-dropdown{
    width:360px;
    border:none;
    border-radius:16px;
    padding:10px;
}

.notification-item{
    padding:12px;
    border-bottom:1px solid #eee;
}

/* Overlay */

#sidebarOverlay{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.5);
    z-index:1040;
}

#sidebarOverlay.show{
    display:block;
}

/* Mobile */

@media(max-width:991px){

.sidebar{
    left:-260px;
}

.sidebar.show{
    left:0;
}

.main{
    margin-left:0;
    padding:15px;
}

.notification-dropdown{
    width:300px;
}

.topbar{
    padding:15px;
}

}

/* Tables */

.table-responsive{
    overflow-x:auto;
}
```
    

        </style>
    </head>

    <body>
        <!-- Sidebar -->

        <div class="sidebar" id="sidebar">
            <h3>Admin Panel</h3>

            <a href="/admin/dashboard">
                <i class="fa fa-home"></i>
                Dashboard
            </a>

            <a href="/admin/courses">
                <i class="fa fa-book"></i>
                Manage Courses
            </a>
            <a href="/admin/categories">
                <i class="fa fa-list"></i>
                Categories
            </a>

            <a href="/admin/course/create">
                <i class="fa fa-plus"></i>
                Add Course
            </a>

            <a href="/admin/students">
                <i class="fa fa-users"></i>
                Students
            </a>

            <a href="/admin/payments">
                <i class="fa fa-credit-card"></i>
                Payments
            </a>

            <a href="/admin/contacts">
                <i class="fa fa-envelope"></i>
                Contact Messages
            </a>

            <a href="/">
                <i class="fa fa-globe"></i>
                Visit Website
            </a>

            <form method="POST" action="{{ route('admin.logout') }}" class="px-3 mt-4">
                @csrf

                <button class="btn btn-danger w-100">
                    <i class="fa fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        </div>
        <div id="sidebarOverlay"></div>

        <!-- Main -->

        <div class="main">
            <!-- Topbar -->

            <div class="topbar">
                <div class="d-flex align-items-center">

    <button
        id="menuToggle"
        class="btn btn-dark d-lg-none me-3">

        <i class="fa fa-bars"></i>

    </button>

    <h5 class="mb-0">
        Welcome Admin
    </h5>

</div>

                <!-- Notifications -->

                <div class="dropdown">
                    <button id="notificationBtn" class="notification-btn" data-bs-toggle="dropdown">
                        <i class="fa fa-bell"></i>

                        @if($notifyCount > 0)

                        <span id="notifyCount" class="badge bg-danger notification-badge"> {{ $notifyCount }} </span>

                        @endif
                    </button>

                    <!-- Dropdown -->

                    <div class="dropdown-menu dropdown-menu-end notification-dropdown">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">Notifications</h6>

                            <div>
                                <a href="{{ route('notifications.read.all') }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-check"></i>
                                </a>

                                <a href="{{ route('notifications.clear') }}" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Notification List -->

                        <div id="notificationList">
                            @forelse($notifications as $note)

                            <div class="notification-item">
                                <a href="{{ route('notification.read',$note->id) }}" class="text-decoration-none">
                                    <div class="notification-title">{{ $note->title }}</div>

                                    <div class="notification-message">{{ $note->message }}</div>

                                    <div class="notification-time">{{ $note->created_at->diffForHumans() }}</div>
                                </a>
                            </div>

                            @empty

                            <p class="text-center text-muted m-3">No notifications</p>

                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->

            @yield('content')
        </div>

        <!-- Toast Alerts -->

        @if(session('success') || session('error'))

        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
            <div
                id="liveToast"
                class="toast align-items-center text-white border-0
{{ session('success') ? 'bg-success' : 'bg-danger' }}"
                role="alert"
            >
                <div class="d-flex">
                    <div class="toast-body">{{ session('success') ?? session('error') }}</div>

                    <button
                        type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"
                    ></button>
                </div>
            </div>
        </div>

        @endif

        <!-- Notification Sound -->

        <audio id="notifySound" src="/sounds/notify.mp3" preload="auto"></audio>

        <!-- Bootstrap -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <script>

            // Toast

            document.addEventListener("DOMContentLoaded", function () {

                const toastEl = document.getElementById('liveToast');

                if(toastEl){

                    const toast = new bootstrap.Toast(toastEl,{
                        delay:3000
                    });

                    toast.show();
                }

            });

            // Notification Sound + Live Count

            let lastCount = {{ $notifyCount ?? 0 }};

            function updateCount(){

                fetch('/admin/notifications/count')

                .then(res => res.json())

                .then(data => {

                    let badge = document.getElementById('notifyCount');

                    if(badge){
                        badge.innerText = data.count;
                    }

                    // New notification sound

                    if(data.count > lastCount){

                        let audio = document.getElementById('notifySound');

                        if(audio){
                            audio.play();
                        }
                    }

                    lastCount = data.count;

                });

            }

            // Load Notifications

            function loadNotifications(){

                fetch('/admin/notifications/data')

                .then(res => res.json())

                .then(data => {

                    let container =
                    document.getElementById('notificationList');

                    let html = '';

                    if(data.notifications.length > 0){

                        data.notifications.forEach(n => {

                            html += `

                            <div class="notification-item">

                            <a href="/admin/notification/read/${n.id}"
                            class="text-decoration-none">

                            <div class="notification-title">
                            ${n.title}
                            </div>

                            <div class="notification-message">
                            ${n.message}
                            </div>

                            </a>

                            </div>

                            `;
                        });

                    } else {

                        html = `
                        <p class="text-center text-muted m-3">
                        No notifications
                        </p>
                        `;
                    }

                    container.innerHTML = html;

                });

            }

            // Every 5 sec

            setInterval(updateCount,5000);

            // Load when open

            document.getElementById('notificationBtn')
            .addEventListener('click',loadNotifications);

        // ```javascript
const menuToggle =
document.getElementById('menuToggle');

const sidebar =
document.getElementById('sidebar');

const overlay =
document.getElementById('sidebarOverlay');

if(menuToggle){

menuToggle.addEventListener('click',()=>{

sidebar.classList.toggle('show');

overlay.classList.toggle('show');

});

overlay.addEventListener('click',()=>{

sidebar.classList.remove('show');

overlay.classList.remove('show');

});

}



        </script>
    </body>
</html>
