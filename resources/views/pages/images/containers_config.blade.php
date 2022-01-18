<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Configure Your Container') }}
            </h2>
            <p class="card-category">Add parameters before initializing your container</p>
        </x-slot>

        <form action="{{route('containers.store')}}" method="post">
            <input type="hidden" value="{{ $image->id }}" name='image_id'>
            <input type="hidden" value="{{ $user_id }}" name='user_id'>
            <h4 class="card-title">Image Selected : {{ $image->name }}</h4>

            <div class="grid gap-6">
                <div class="space-y-2">
                    <x-label for="nickname" :value="__('Nickname')"/>

                    <x-input id="nickname" type="text" class="block w-full" name="nickname"
                             :value="old('nickname')" placeholder="{{ __('Nickname to container') }}" required
                             autofocus/>
                </div>

                <div class="space-y-2">
                    <x-label for="envvariables" :value="__('Env Variables')"/>
                    <x-input id="envvariables" class="block w-full" name="envvariables"
                             :value="old('envvariables')" type="text"
                             placeholder="{{ __('Environment variables (Optional) - Use ; (semicolon) to separate, Ex: PASSWORD=password;POSTGRES_USER=user;') }}"
                             autofocus/>
                </div>

                <div class="space-y-2">
                    <x-label for="labels" :value="__('Labels')"/>
                    <x-input id="labels" class="block w-full" name="labels"
                             :value="old('labels')" type="text"
                             placeholder="{{ __('Labels (Optional) - Use ; (semicolon) to separate, Ex: PASSWORD=password;POSTGRES_USER=user;') }}"
                             autofocus/>
                </div>

                <div class="space-y-2">
                    <x-label for="hostname" :value="__('Hostname')"/>

                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <i class="fas fa-network-wired"></i>
                        </x-slot>
                        <x-input withicon id="hostname" class="block w-full" name="hostname" type="text"
                                 :value="old('hostname')" placeholder="{{ __('Add a Hostname (optional)') }}"
                                 autofocus/>
                    </x-input-with-icon-wrapper>
                </div>

                <div class="space-y-2">
                    <x-label for="dns" :value="__('DNS')"/>

                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <i class="fas fa-wifi"></i>
                        </x-slot>
                        <x-input withicon id="dns" class="block w-full" name="dns" type="text"
                                 :value="old('dns')" placeholder="{{ __('Set custom DNS server (Optional)') }}"
                                 autofocus/>
                    </x-input-with-icon-wrapper>
                </div>

                <div class="space-y-2">
                    <x-label for="dnsoptions" :value="__('DSN Options')"/>

                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <i class="fas fa-wifi"></i>
                        </x-slot>
                        <x-input withicon id="dnsoptions" class="block w-full" name="dnsoptions" type="text"
                                 :value="old('dnsoptions')" placeholder="{{ __('DSN Options') }}" autofocus/>
                    </x-input-with-icon-wrapper>
                </div>

                <div class="space-y-2">
                    <x-label for="dnssearch" :value="__('DNS Search')"/>
                    <x-input id="dnssearch" class="block w-full" name="dnssearch" type="text"
                             :value="old('dnssearch')" placeholder="{{ __('Set custom DnsSearch(Optional)') }}"
                             autofocus/>
                </div>

                <div class="space-y-2">
                    <x-label for="ipaddress" :value="__('IP Adress')"/>

                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <i class="fas fa-server"></i>
                        </x-slot>
                        <x-input withicon id="ipaddress" class="block w-full" name="ipaddress" type="text"
                                 :value="old('ipaddress')" placeholder="{{ __('Add a IPv4 (Optional)') }}" autofocus/>
                    </x-input-with-icon-wrapper>
                </div>

                <div class="space-y-2 flex items-center justify-between">
                    <label for="external-port" class="inline-flex items-center">
                        <i class="fas fa-globe-americas"></i>
                        <input id="external-port" type="checkbox" value="1"
                               class="text-purple-500 border-gray-300 rounded focus:border-purple-300 focus:ring focus:ring-purple-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1"
                               name="external-port" checked>
                        <span
                            class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Add external communication port') }}</span>
                    </label>
                </div>

                <div class="space-y-2">
                    <x-label for="macaddress" :value="__('MAC Adress')"/>

                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <i class="fas fa-server"></i>
                        </x-slot>
                        <x-input withicon id="macaddress" class="block w-full" name="macaddress" type="text"
                                 :value="old('macaddress')" placeholder="{{ __('Add a MacAddress (Optional)') }}"
                                 autofocus/>
                    </x-input-with-icon-wrapper>
                </div>

                <div class="space-y-2">
                    <x-label for="memory" :value="__('MAC Adress')"/>

                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <i class="fas fa-server"></i>
                        </x-slot>
                        <x-input withicon id="memory" class="block w-full" name="memory" type="text"
                                 :value="old('memory')" placeholder="{{ __('Add a Memory limit (Optional)') }}"
                                 autofocus/>
                    </x-input-with-icon-wrapper>
                </div>

                <div class="space-y-2">
                    <x-label for="networkmode" :value="__('Network mode')"/>

                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <i class="fas fa-server"></i>
                        </x-slot>
                        <x-input withicon id="networkmode" class="block w-full" name="networkmode"
                                 :value="old('networkmode')" type="text"
                                 placeholder="{{ __('Network mode. Supported values are: bridge, host, none, and container:<name|id>.(Optional)') }}"
                                 autofocus/>
                    </x-input-with-icon-wrapper>
                </div>

                <x-button type="submit" variant="success"
                          class="justify-center w-full gap-2">
                    <i class="fas fa-archive"></i>
                    <span>{{__('Confirm')}}</span>
                </x-button>
            </div>
        </form>
    </x-card>
</x-app-layout>

