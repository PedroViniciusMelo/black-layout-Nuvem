<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('My Containers') }}
            </h2>
        </x-slot>
        <x-modal>
            <x-slot name="buttonToggle">
                gfdgdfgfd
            </x-slot>
            <x-slot name="modalHandler">
                $modalHandler
            </x-slot>
            <x-slot name="content">
                fsfdsfd
            </x-slot>
        </x-modal>
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
                @forelse($containers as $container)
                    <tr>
                        <x-left-table-item>
                            {{__($container->nickname)}}
                        </x-left-table-item>
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
                @empty
                    <tr>
                        <x-left-table-item/>
                        <x-table-item>Vazio</x-table-item>
                        <x-right-table-item/>
                    </tr>
                @endforelse
            </x-slot>
        </x-table-list>
    </x-card>
</x-app-layout>
