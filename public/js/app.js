    function showModalById(modalId) {
        const modal = document.getElementById(modalId);
        const content = document.getElementById(modalId + '-content');

        if (!modal || !content) return;

        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function hideModalById(modalId) {
        const modal = document.getElementById(modalId);
        const content = document.getElementById(modalId + '-content');

        if (!modal || !content) return;

        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    document.addEventListener('click', function (e) {
        if (e.target.closest('.close-modal')) {
            const id = e.target.closest('.close-modal').dataset.modal;
            hideModalById(id);
        }
    });

    document.getElementById('profile-dropdown-btn').addEventListener('click', function() {
        const dropdown = document.getElementById('profile-dropdown');
        const chevron = document.getElementById('profile-chevron');
            
        if (dropdown.classList.contains('opacity-0')) {
            dropdown.classList.remove('opacity-0', 'invisible', '-translate-y-2');
            dropdown.classList.add('opacity-100', 'visible', 'translate-y-0');
            chevron.classList.add('rotate-180');
        } else {
            dropdown.classList.remove('opacity-100', 'visible', 'translate-y-0');
            dropdown.classList.add('opacity-0', 'invisible', '-translate-y-2');
            chevron.classList.remove('rotate-180');
        }
    });

    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('profile-dropdown');
        const button = document.getElementById('profile-dropdown-btn');
            
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.remove('opacity-100', 'visible', 'translate-y-0');
            dropdown.classList.add('opacity-0', 'invisible', '-translate-y-2');
            document.getElementById('profile-chevron').classList.remove('rotate-180');
        }
    });

    document.addEventListener('DOMContentLoaded', function () {

        const submenuButtons = document.querySelectorAll('.submenu-btn');

        submenuButtons.forEach(button => {
            button.addEventListener('click', function () {

                const submenuId = this.dataset.submenu;
                const submenu = document.getElementById(submenuId);
                const chevron = this.querySelector('.submenu-chevron');

                const isOpen = submenu.classList.contains('max-h-96');

                document.querySelectorAll('.submenu').forEach(sm => {
                    sm.classList.remove('max-h-96', 'opacity-100');
                    sm.classList.add('max-h-0', 'opacity-0', 'overflow-hidden');
                });

                document.querySelectorAll('.submenu-chevron').forEach(ch => {
                    ch.classList.remove('rotate-90');
                });

                document.querySelectorAll('.submenu-btn').forEach(btn => {
                    btn.classList.remove('bg-primary-50', 'text-primary-600');
                });

                if (!isOpen) {
                    submenu.classList.remove('max-h-0', 'opacity-0', 'overflow-hidden');
                    submenu.classList.add('max-h-96', 'opacity-100');

                    chevron.classList.add('rotate-90');
                    this.classList.add('bg-primary-50', 'text-primary-600');
                }

            });
        });

    });

    document.addEventListener("DOMContentLoaded", function () {
        const html = document.documentElement;
        const toggle = document.getElementById("dark-mode-toggle");

        const savedTheme = localStorage.getItem("theme");

        if (savedTheme === "dark") {
            html.classList.add("dark");
            toggle.checked = true; 
        } else {
            html.classList.remove("dark");
            toggle.checked = false; 
        }

        toggle.addEventListener("change", function () {
            if (this.checked) {
                html.classList.add("dark");
                localStorage.setItem("theme", "dark");
            } else {
                html.classList.remove("dark");
                localStorage.setItem("theme", "light");
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {

                const action = this.dataset.action;
                const form = document.getElementById('delete-form');

                if (!action || !form) {
                    console.error('Delete form atau action tidak ditemukan');
                    return;
                }

                form.action = action;
                showModalById('modal-delete');
            });
        });

        document.getElementById('cancel-delete')?.addEventListener('click', function () {
            hideModalById('modal-delete');
        });
    });

    document.querySelectorAll('.format-rupiah').forEach(function(input) {

        input.addEventListener('input', function () {

            let angka = this.value.replace(/\D/g, '');

            if (!angka) {
                this.value = '';
                return;
            }

            this.value = new Intl.NumberFormat('id-ID').format(angka);
        });
        input.closest('form').addEventListener('submit', function() {
            input.value = input.value.replace(/\./g, '');
        });

    });

    const popover = document.getElementById('globalPopover');

    document.addEventListener('click', function(e){

        const trigger = e.target.closest('[data-popover]');

        if(trigger){

            const text = trigger.dataset.popover;

            popover.innerText = text;

            const rect = trigger.getBoundingClientRect();

            popover.style.top = rect.bottom + window.scrollY + 8 + "px";
            popover.style.left = rect.left + window.scrollX + "px";

            popover.classList.remove('hidden');

        } else {

            popover.classList.add('hidden');

        }

    });