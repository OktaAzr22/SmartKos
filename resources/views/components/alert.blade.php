
@if (session('success') || session('error') || session('info') || session('warning'))
    <div id="toast-container" class="fixed top-5 right-5 z-50"></div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const alerts = {
                success: {
                    bg: "bg-emerald-900 border border-emerald-700 text-emerald-400",
                    icon: "fa-check-circle"
                },
                error: {
                    bg: "bg-red-900 border border-red-700 text-red-400",
                    icon: "fa-times-circle"
                },
                info: {
                    bg: "bg-blue-900 border border-blue-700 text-blue-400",
                    icon: "fa-info-circle"
                },
                warning: {
                    bg: "bg-yellow-900 border border-yellow-700 text-yellow-400",
                    icon: "fa-exclamation-circle"
                }
            };

            const type = @json(session('success') ? 'success' :
                        (session('error') ? 'error' :
                        (session('info') ? 'info' : 'warning')));

            const message = @json(session('success') ?? session('error') ?? session('info') ?? session('warning'));

            const container = document.getElementById("toast-container");

            const toast = document.createElement("div");
            toast.className = `
                ${alerts[type].bg}
                flex items-center justify-between gap-3 px-4 py-3 rounded-lg shadow-lg mb-3
                transition-all duration-500 ease-out opacity-0 translate-y-4 scale-95
                min-w-[320px] max-w-[400px]
            `;

            toast.innerHTML = `
                <div class="flex items-center gap-3">
                    <i class="fa-solid ${alerts[type].icon} text-lg"></i>
                    <span class="text-sm font-medium">${message}</span>
                </div>
                <button class="text-${type}-400 hover:text-${type}-200 transition" onclick="this.parentElement.remove()">
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