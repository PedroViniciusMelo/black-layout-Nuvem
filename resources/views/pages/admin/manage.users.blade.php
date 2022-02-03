<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Users List') }}
            </h2>
        </x-slot>

        <div class="" id="users">
            @include('pages/tables/users_table', ['users' => $users])
        </div>
        <div class="card-footer">
            <p class="card-category">Registered this Mouth: {{ $registeredMonth }}</p>
            <p class="card-category">Registered Today: {{ $registeredToday }}</p>
            <p class="card-category">Total: {{ $users->count() }}</p>
        </div>
    </x-card>
</x-app-layout>
