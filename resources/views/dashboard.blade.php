
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
                    {{__('#')}}
                </th>
                <th>
                    {{__('Data')}}
                </th>
                <th>
                    {{__('Name/Hashcode')}}
                </th>
                <th>
                    {{__('Available/Running')}}
                </th>
                <th>
                    {{__('Actions')}}
                </th>
            </x-slot>
            <x-slot name="body">
                @foreach($machines as $machine)
                    <tr>
                        <x-left-table-item>
                            <i class="fas fa-desktop"></i>
                        </x-left-table-item>
                        <x-table-item>
                            <h3 class="card-title">
                                {{ $machine->ram_utilizavel }} MB
                                <i class="fas fa-memory" title='Avaiable RAM'></i>
                            </h3>
                            <h3 class="card-title">
                                {{ $machine->cpu_utilizavel }}%
                                <i class="fas fa-microchip" title='Avaiable CPU'></i>
                            </h3>
                            <h3 class="card-title">
                                {{ $machine->ip }}
                                <i class="fas fa-network-wired" title='IP Address'></i>
                            </h3>
                        </x-table-item>
                        <x-table-item>
                            {{substr($machine->hashcode , 0, 20)}}...
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
                                    <div class="flex justify-center items-center flex-col">
                                        <a href="{{route('machines.show', ['machine' => $machine->id])}}">
                                            <button class="py-1">
                                                <i class="fas fa-eye mr-2"></i>
                                                <span>{{__('View')}}</span>
                                            </button>
                                        </a>

                                        <div>
                                            <a href="{{route('machines.edit', $machine->id)}}" class="py-1">
                                                <i class="fas fa-pen mr-2"></i>
                                                <span>{{__('Edit')}}</span>
                                            </a>
                                        </div>

                                        <hr class="w-full bg-black dark:bg-white">

                                        <form class="py-1" action="{{route('machines.destroy', $machine->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash" style="color: red"></i>
                                                <span class="text-red-600">{{__('Delete')}}</span>
                                            </button>
                                        </form>
                                    </div>
                                </x-slot>
                            </x-dropdown>
                        </x-right-table-item>
                    </tr>
                @endforeach
                @foreach($containers as $container)
                        <tr>
                            <x-left-table-item>
                                <i class="fas fa-server"></i>
                            </x-left-table-item>
                            <x-table-item>
                                <h3 class="card-title">
                                    {{ $container->image->name }}
                                    <i class="fab fa-docker" title="Docker Image Used"></i>
                                </h3>
                            </x-table-item>
                            <x-table-item>
                                {{$container->nickname}}
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
                                        <div class="flex justify-center items-center flex-col">
                                            <a href="#">
                                                <button class="py-1">
                                                    <i class="fas fa-eye mr-2"></i>
                                                    <span>{{__('View')}}</span>
                                                </button>
                                            </a>

                                            <div>
                                                <a href="{{route('containers.edit', ['container' => $container->id])}}" class="py-1">
                                                    <i class="fas fa-pen mr-2"></i>
                                                    <span>{{__('Edit')}}</span>
                                                </a>
                                            </div>

                                            @if($container->isRunning())
                                                <form action="{{route('container.toggle', ['id' => $container->id])}}" class="py-1" method="post">
                                                    @method('PUT')
                                                    <button type="submit">
                                                        <i class="fas fa-pause"></i>
                                                        <span>{{__('Pause')}}</span>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{route('container.toggle', ['id' => $container->id])}}" class="py-1" method="post">
                                                    @method('PUT')
                                                    <button class="py-1" >
                                                        <i class="fas fa-play"></i>
                                                        <span>{{__('Run')}}</span>
                                                    </button>
                                                </form>
                                            @endif

                                            <hr class="w-full bg-black dark:bg-white">

                                            <form class="py-1" action="{{route('containers.destroy', ['container' => $container->id])}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash" style="color: red"></i>
                                                    <span class="text-red-600">{{__('Delete')}}</span>
                                                </button>
                                            </form>
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                            </x-right-table-item>
                        </tr>
                @endforeach
            </x-slot>
        </x-table-list>
    </x-card>
</x-app-layout>
