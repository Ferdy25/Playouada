<x-app-layout>
   <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('STORE') }}
        </h2>
    </x-slot>
    -->

    <div class=" flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
                  <!-- {{ __("You're logged in!") }} -->
                     @include('products.list')
    </div>
</x-app-layout>
