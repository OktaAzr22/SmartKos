    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        const content = document.getElementById(modalId + '-content');
        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function hideModal(modalId) {
        const modal = document.getElementById(modalId);
        const content = document.getElementById(modalId + '-content');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    document.addEventListener('click', function (e) {
        if (e.target.closest('.close-modal')) {
            const id = e.target.closest('.close-modal').dataset.modal;
            hideModal(id);
        }
    }); -

    document.addEventListener('DOMContentLoaded', () => {
        const modalDelete = document.getElementById('modal-delete');
        const modalContent = document.getElementById('modal-delete-content');
        const cancelDelete = document.getElementById('cancel-delete');
        const deleteForm = document.getElementById('delete-form');

        function showModal(modal, content) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 50);
        }

        function hideModal(modal, content) {
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        cancelDelete?.addEventListener('click', () => hideModal(modalDelete, modalContent));

        modalDelete?.addEventListener('click', (e) => {
            if (e.target === modalDelete) hideModal(modalDelete, modalContent);
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const actionUrl = btn.getAttribute('data-action');
                if (actionUrl) {
                    deleteForm.action = actionUrl;
                    showModal(modalDelete, modalContent);
                }
            });
        });
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

    document.querySelectorAll('.submenu-btn').forEach(button => {
        button.addEventListener('click', function() {
            const submenuId = this.getAttribute('data-submenu');
            const submenu = document.getElementById(submenuId);
            const chevron = this.querySelector('.submenu-chevron');
                
            document.querySelectorAll('.submenu').forEach(sm => {
                if (sm.id !== submenuId) {
                    sm.classList.remove('max-h-96');
                    sm.classList.add('max-h-0', 'overflow-hidden');
                }
            });
                
            document.querySelectorAll('.submenu-chevron').forEach(ch => {
                if (ch !== chevron) {
                    ch.classList.remove('rotate-90');
                }
            });
                
            document.querySelectorAll('.submenu-btn').forEach(btn => {
                if (btn !== this) {
                    btn.classList.remove('bg-primary-50', 'text-primary-600');
                }
            });
                
            if (submenu.classList.contains('max-h-0')) {
                submenu.classList.remove('max-h-0', 'overflow-hidden');
                submenu.classList.add('max-h-96');
                chevron.classList.add('rotate-90');
                this.classList.add('bg-primary-50', 'text-primary-600');
            } else {
                submenu.classList.remove('max-h-96');
                submenu.classList.add('max-h-0', 'overflow-hidden');
                chevron.classList.remove('rotate-90');                   
                this.classList.remove('bg-primary-50', 'text-primary-600');
            }
        });
    });

    function openActiveSubmenu() {
        document.querySelectorAll('.menu-item').forEach(item => {
            if (item.classList.contains('text-primary-600') && 
                item.classList.contains('bg-primary-50')) {
                
                const submenu = item.closest('.submenu');
                if (submenu) {
                    submenu.classList.remove('max-h-0', 'overflow-hidden');
                    submenu.classList.add('max-h-96');
                        
                    const submenuId = submenu.id;
                    const toggleBtn = document.querySelector(`[data-submenu="${submenuId}"]`);
                    if (toggleBtn) {
                        const chevron = toggleBtn.querySelector('.submenu-chevron');
                        chevron.classList.add('rotate-90');
                            
                        toggleBtn.classList.add('bg-primary-50', 'text-primary-600');
                    }
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        openActiveSubmenu();
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