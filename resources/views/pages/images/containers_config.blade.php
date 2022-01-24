<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Configure Your Container') }}
            </h2>
            <p class="card-category">Add parameters before initializing your container</p>
        </x-slot>

        <form action="{{route('containers.store')}}" method="post">
            <input type="hidden" name="image_id" value="{{old('image_id', $image->id ?? null)}}">
            @csrf
            <h4 class="card-title">Image Selected : {{ $image->name }}</h4>

            <div class="grid gap-6">
                <div class="space-y-2">
                    <x-label for="nickname" :value="__('Nickname')"/>

                    <x-input id="nickname" type="text" class="block w-full" name="nickname"
                             :value="old('nickname')" placeholder="{{ __('Nickname to container') }}" required
                             autofocus/>
                </div>

                <div class="space-y-2">
                    <x-label for="env_variables" :value="__('Env Variables')"/>
                    <x-input id="env_variables" class="block w-full" name="env_variables"
                             :value="old('env_variables')" type="text"
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
                    <x-label for="dns_options" :value="__('DSN Options')"/>

                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <i class="fas fa-wifi"></i>
                        </x-slot>
                        <x-input withicon id="dns_options" class="block w-full" name="dns_options" type="text"
                                 :value="old('dns_options')" placeholder="{{ __('DSN Options') }}" autofocus/>
                    </x-input-with-icon-wrapper>
                </div>

                <div class="space-y-2">
                    <x-label for="dns_search" :value="__('DNS Search')"/>
                    <x-input id="dns_search" class="block w-full" name="dns_search" type="text"
                             :value="old('dns_search')" placeholder="{{ __('Set custom DnsSearch(Optional)') }}"
                             autofocus/>
                </div>

                <div class="space-y-2">
                    <x-label for="ip_address" :value="__('IP Adress')"/>

                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <i class="fas fa-server"></i>
                        </x-slot>
                        <x-input withicon id="ip_address" class="block w-full" name="ip_address" type="text"
                                 :value="old('ip_address')" placeholder="{{ __('Add a IPv4 (Optional)') }}" autofocus/>
                    </x-input-with-icon-wrapper>
                </div>

                <div class="space-y-2 flex items-center justify-between">
                    <label for="external_port" class="inline-flex items-center">
                        <i class="fas fa-globe-americas"></i>
                        <input id="external_port" type="checkbox" value="1"
                               class="text-purple-500 border-gray-300 rounded focus:border-purple-300 focus:ring focus:ring-purple-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1"
                               name="external_port" checked>
                        <span
                            class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Add external communication port') }}</span>
                    </label>
                </div>

                <div class="space-y-2">
                    <x-label for="mac_address" :value="__('MAC Adress')"/>

                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <i class="fas fa-server"></i>
                        </x-slot>
                        <x-input withicon id="mac_address" class="block w-full" name="mac_address" type="text"
                                 :value="old('mac_address')" placeholder="{{ __('Add a MacAddress (Optional)') }}"
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
                    <x-label for="network_mode" :value="__('Network mode')"/>

                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <i class="fas fa-server"></i>
                        </x-slot>
                        <x-input withicon id="network_mode" class="block w-full" name="network_mode"
                                 :value="old('network_mode')" type="text"
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

