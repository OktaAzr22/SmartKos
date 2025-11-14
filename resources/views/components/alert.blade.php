@if (session('success') || session('error') || session('info') || session('warning'))
    <div id="toast-container" class="fixed top-5 right-5 z-50 space-y-3"></div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const types = {
                success: {
                    bg: "bg-emerald-100 border border-emerald-300 text-emerald-800 dark:bg-emerald-900 dark:border-emerald-700 dark:text-emerald-300",
                    icon: "fa-check-circle",
                    close: "text-emerald-800 dark:text-emerald-300 hover:text-emerald-600 dark:hover:text-emerald-200"
                },
                error: {
                    bg: "bg-red-100 border border-red-300 text-red-800 dark:bg-red-900 dark:border-red-700 dark:text-red-300",
                    icon: "fa-times-circle",
                    close: "text-red-800 dark:text-red-300 hover:text-red-600 dark:hover:text-red-200"
                },
                info: {
                    bg: "bg-blue-100 border border-blue-300 text-blue-800 dark:bg-blue-900 dark:border-blue-700 dark:text-blue-300",
                    icon: "fa-info-circle",
                    close: "text-blue-800 dark:text-blue-300 hover:text-blue-600 dark:hover:text-blue-200"
                },
                warning: {
                    bg: "bg-yellow-100 border border-yellow-300 text-yellow-800 dark:bg-yellow-900 dark:border-yellow-700 dark:text-yellow-300",
                    icon: "fa-exclamation-circle",
                    close: "text-yellow-800 dark:text-yellow-300 hover:text-yellow-600 dark:hover:text-yellow-200"
                }
            };

            const type = @json(session('success') ? 'success' :
                              (session('error') ? 'error' :
                              (session('info') ? 'info' : 'warning')));

            const message = @json(session('success') ??
                                  session('error') ??
                                  session('info') ??
                                  session('warning'));

            const container = document.getElementById("toast-container");

            const toast = document.createElement("div");
            toast.className = `
                ${types[type].bg}
                flex items-center justify-between gap-3 px-4 py-3 rounded-lg shadow-lg
                transition-all duration-500 ease-out
                opacity-0 translate-y-4 scale-95
                min-w-[320px] max-w-[420px]
            `;

            toast.innerHTML = `
                <div class="flex items-center gap-3">
                    <i class="fa-solid ${types[type].icon} text-lg"></i>
                    <span class="text-sm font-medium">${message}</span>
                </div>

                <button class="${types[type].close}"
                        onclick="this.parentElement.remove()">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove("opacity-0", "translate-y-4", "scale-95");
                toast.classList.add("opacity-100", "translate-y-0", "scale-100");
            }, 50);

            setTimeout(() => {
                toast.classList.remove("opacity-100", "translate-y-0", "scale-100");
                toast.classList.add("opacity-0", "-translate-y-2", "scale-95");
                setTimeout(() => toast.remove(), 500);
            }, 4000);
        });
    </script>
@endif
