<!-- Asegúrate de tener Tailwind CSS y Font Awesome incluidos en tu proyecto -->
<div class="w-full mt-6">
  <div class="flex items-center bg-yellow-100 text-yellow-800 text-sm px-4 py-3 rounded-md shadow-sm" role="alert">
    <i class="fas fa-exclamation-circle mr-2 text-yellow-600"></i>
    <span>
        {{$slot}}
    </span>
  </div>
</div>
