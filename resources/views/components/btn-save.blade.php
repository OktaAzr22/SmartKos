@props([
    'text' => 'Save',
    'id' => 'btnSubmit_' . uniqid(),
    'form' => null,
])

<button 
    type="submit"
    id="{{ $id }}"
    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 
           rounded-lg hover:bg-blue-700 focus:outline-none 
           focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
           flex items-center gap-2 transition disabled:opacity-70"
>

    {{-- ICON NORMAL (muncul ketika tidak loading) --}}
    <svg 
        id="{{ $id }}_icon"
        xmlns="http://www.w3.org/2000/svg"
        class="h-4 w-4 text-white"
        fill="currentColor"
        viewBox="0 0 20 20"
    >
        <path d="M17 3H3a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V4a1 1 0 00-1-1zm-5 12H8v-2h4v2zm3-6H5V5h10v4z" />
    </svg>

    {{-- SPINNER LOADING (hidden awalnya) --}}
    <svg 
        id="{{ $id }}_spinner"
        class="animate-spin h-4 w-4 text-white hidden"
        xmlns="http://www.w3.org/2000/svg" 
        fill="none" 
        viewBox="0 0 24 24"
    >
        <circle class="opacity-25" cx="12" cy="12" r="10"
                stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
              d="M4 12a8 8 0 018-8v4l3-3-3-3v4a12 12 0 00-12 12h4z">
        </path>
    </svg>

    <span id="{{ $id }}_text">{{ $text }}</span>
</button>

@if ($form)
<script>
document.addEventListener("DOMContentLoaded", function () {

    const form    = document.getElementById("{{ $form }}");
    if (!form) return;

    const btn     = document.getElementById("{{ $id }}");
    const txt     = document.getElementById("{{ $id }}_text");
    const icon    = document.getElementById("{{ $id }}_icon");
    const spinner = document.getElementById("{{ $id }}_spinner");

    form.addEventListener("submit", function () {

        icon.classList.add("hidden");

        spinner.classList.remove("hidden");

        txt.textContent = "Menyimpan...";

        btn.disabled = true;
    });

});
</script>
@endif
