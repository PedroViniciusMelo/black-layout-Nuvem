<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
        <x-table-list>
            <x-slot name="header">
                <th>
                    {{__('Container')}}
                </th>
                <th>
                    {{__('Status')}}
                </th>
                <th>
                    {{__('Actions')}}
                </th>
            </x-slot>
            <x-slot name="body">
                <tr>
                    <x-left-table-item>
                        {{__('Container')}}
                    </x-left-table-item>
                    <x-table-item>
                        {{__('Status')}}
                    </x-table-item>
                    <x-right-table-item>
                        <x-dropdown>
                            <x-slot name="trigger">
                                <i class="fas fa-ellipsis-v"></i>
                            </x-slot>
                            <x-slot name="content">
                                <div>
                                    <a href="#">
                                        <i class="fas fa-eye mr-2"></i>
                                        <span>{{__('View')}}</span>
                                    </a>
                                </div>
                                <div class="py-1">
                                    <a href="#">
                                        <i class="fas fa-pen mr-2"></i>
                                        <span>{{__('Edit')}}</span>
                                    </a>
                                </div>
                                <hr>
                            </x-slot>
                        </x-dropdown>
                    </x-right-table-item>
                </tr>

                <tr>
                    <x-left-table-item>
                        {{__('Container')}}
                    </x-left-table-item>
                    <x-table-item>
                        {{__('Status')}}
                    </x-table-item>
                    <x-right-table-item>
                        <x-dropdown>
                            <x-slot name="trigger">
                                <i class="fas fa-ellipsis-v"></i>
                            </x-slot>
                            <x-slot name="content">
                                <div>
                                    <a href="#">
                                        <i class="fas fa-eye mr-2"></i>
                                        <span>{{__('View')}}</span>
                                    </a>
                                </div>
                                <div class="py-1">
                                    <a href="#">
                                        <i class="fas fa-pen mr-2"></i>
                                        <span>{{__('Edit')}}</span>
                                    </a>
                                </div>
                                <hr>
                            </x-slot>
                        </x-dropdown>
                    </x-right-table-item>
                </tr>
            </x-slot>
        </x-table-list>
    </x-card>
</x-app-layout>
