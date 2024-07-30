import './bootstrap';

// Navbar
window.addEventListener('livewire:navigated', () => {
    // open
    const burger = document.querySelector('.navbar-burger');
    const menu = document.querySelector('.navbar-menu');

    if (burger && menu) {
        burger.addEventListener('click', function () {
            menu.classList.remove('hidden');
            menu.querySelector('nav').classList.add('animate-[slideLeft_.5s_linear_both]');
            menu.querySelector('nav').classList.remove('animate-[slideRight_.5s_ease-in_both]');
        });
    }

    // close
    const close = document.querySelector('.navbar-close');
    const backdrop = document.querySelector('.navbar-backdrop');

    if (close) {
        close.addEventListener('click', function () {
            menu.querySelector('nav').classList.remove('animate-[slideLeft_.5s_linear_both]');
            menu.querySelector('nav').classList.add('animate-[slideRight_.5s_ease-in_both]');
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 500);
        });
    }

    if (backdrop) {
        backdrop.addEventListener('click', function () {
            menu.classList.toggle('hidden');
        });
    }
});


// author
window.addEventListener("author_denied", (e) => {
    Swal.fire({
        icon: "error",
        title: "Action Denied",
        showConfirmButton: false,
        text: "This author has at least one book",
        position: "center"
    })
});

window.addEventListener("author_deleted", (e) => {
    Swal.fire({
        icon: "success",
        title: "Deleted",
        position: "center",
        showConfirmButton: false,
    })
});


// book
window.addEventListener("book_denied", (e) => {
    Swal.fire({
        icon: "error",
        title: "Action Denied",
        showConfirmButton: false,
        text: "This book has been issued at least once",
        position: "center"
    })
});

window.addEventListener("book_deleted", (e) => {
    Swal.fire({
        icon: "success",
        title: "Deleted",
        position: "center",
        showConfirmButton: false,
    })
});


// auth
window.addEventListener("not_authorized", (e) => {
    Swal.fire({
        icon: "error",
        title: "Not Authorized",
        position: "center",
        showConfirmButton: false,
    });
});


// profile
window.addEventListener("empty_fields", (e) => {
    Swal.fire({
        icon: "warning",
        title: "Nothing changed",
        position: "center",
        timer: 2500,
        showConfirmButton: false,
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            document.addEventListener('livewire:init', () => {
                Livewire.on('refreshing', (event) => {
                    //
                });
            });
        }
    });
});

window.addEventListener("name_updated", (e) => {
    Swal.fire({
        icon: "success",
        title: "Name updated",
        position: "center",
        timer: 2500,
        showConfirmButton: false,
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            document.addEventListener('livewire:init', () => {
                Livewire.on('refreshing', (event) => {
                    //
                });
            });
        }
    });
});

window.addEventListener("email_updated", (e) => {
    Swal.fire({
        icon: "success",
        title: "Email updated",
        position: "center",
        timer: 2500,
        showConfirmButton: false,
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            document.addEventListener('livewire:init', () => {
                Livewire.on('refreshing', (event) => {
                    //
                });
            });
        }
    });
});

window.addEventListener("password_updated", (e) => {
    Swal.fire({
        icon: "success",
        title: "Password updated",
        position: "center",
        timer: 2500,
        showConfirmButton: false,
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            document.addEventListener('livewire:init', () => {
                Livewire.on('refreshing', (event) => {
                    //
                });
            });
        }
    });
});


