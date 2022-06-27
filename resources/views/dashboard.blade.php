
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
                    {{__('Type')}}
                </th>
                <th>
                    {{__('Item')}}
                </th>
                <th>
                    {{__('Status')}}
                </th>
                <th>
                    {{__('Actions')}}
                </th>
            </x-slot>
            <x-slot name="body">
                @foreach($machines as $machine)
                    <tr>
                        <x-left-table-item>
                            {{__('Machine')}}
                        </x-left-table-item>

                        <x-table-item>
                            <i class="fas fa-desktop"></i>
                        </x-table-item>

                        <x-table-item>
                            <div>{{$machine->disponivel ? 'Unavailable' : 'Available'}}</div>
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
                @endforeach
                @foreach($containers as $container)
                        <tr>
                            <x-left-table-item>
                                {{__($container->nickname)}}
                            </x-left-table-item>
                            <x-table-item>
                                <i class="fas fa-server"></i>
                            </x-table-item>
                            <x-table-item>
                                <div class="{{$container->isRunning() ? 'text-green-600' : 'text-red-600'}}">{{$container->status}}</div>
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
                @endforeach
            </x-slot>
        </x-table-list>
    </x-card>
</x-app-layout>
