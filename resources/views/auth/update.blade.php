<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit profile') }}
            </h2>
        </x-slot>
        <x-card>
            <x-slot name="title">
                <p>{{ __('User information') }}</p>
            </x-slot>
            <form method="post" action="{{ route('user.update') }}">
                @csrf
                @method('PUT')
                <div class="grid gap-6">
                    <div class="space-y-2">
                        <x-label for="name" :value="__('Name')"/>

                        <x-input id="name" type="text" class="block w-full" name="name"
                                 :value="old('name', $user->name)" placeholder="{{ __('Name') }}" required
                                 autofocus/>
                    </div>

                    <div class="space-y-2">
                        <x-label for="email" :value="__('Email')"/>

                        <x-input id="email" type="text" class="block w-full" name="email"
                                 :value="old('email', $user->email)" placeholder="{{ __('email') }}" required
                                 autofocus/>
                    </div>
                    <x-button type="submit" variant="success"
                              class="justify-center w-full gap-2">
                        <i class="fas fa-archive"></i>
                        <span>{{__('Confirm')}}</span>
                    </x-button>
                </div>
            </form>
        </x-card>
        <x-card>
            <x-slot name="title">
                <p>{{ __('User password') }}</p>
            </x-slot>
            <form action="{{route('user.update.password')}}" method="post">
                @csrf
                @method('PUT')
                <div class="grid gap-6">
                    <div class="space-y-2">
                        <x-label for="password" :value="__('Old password')"/>

                        <x-input id="password" type="password" class="block w-full" name="password"
                                 placeholder="{{ __('Old password') }}" autofocus/>
                    </div>
                    <div class="space-y-2">
                        <x-label for="new_password" :value="__('New password')"/>

                        <x-input id="new_password" type="password" class="block w-full" name="new_password"
                                 placeholder="{{ __('New password') }}" autofocus/>
                    </div>
                    <div class="space-y-2">
                        <x-label for="new_password_confirmation" :value="__('Confirm new password')"/>

                        <x-input id="new_password_confirmation" type="password" class="block w-full" name="new_password_confirmation"
                                 placeholder="{{ __('Password confirmation') }}" autofocus/>
                    </div>
                    <x-button type="submit" variant="success"
                              class="justify-center w-full gap-2">
                        <i class="fas fa-archive"></i>
                        <span>{{__('Confirm')}}</span>
                    </x-button>
                </div>
            </form>
        </x-card>
    </x-card>
</x-app-layout>
