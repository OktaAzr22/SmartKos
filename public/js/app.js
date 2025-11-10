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
    });

    document.getElementById('profile-dropdown-btn').addEventListener('click', function() {
        const dropdown = document.getElementById('profile-dropdown');
        const chevron = document.getElementById('profile-chevron');
            
        dropdown.classList.toggle('show');
        chevron.classList.toggle('rotate-180');
    });

    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('profile-dropdown');
        const button = document.getElementById('profile-dropdown-btn');
        const chevron = document.getElementById('profile-chevron');
            
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.remove('show');
            chevron.classList.remove('rotate-180');
        }
    });

    document.querySelectorAll('.sidebar-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const submenu = this.nextElementSibling;
            const icon = this.querySelector('.fa-chevron-right');

            submenu.classList.toggle('open');
            icon.classList.toggle('rotate-90');
        });
    });

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