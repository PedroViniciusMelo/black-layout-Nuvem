<x-app-layout>
    <x-card>
        <x-slot name="button">
            <x-button href="{{route('machines.create')}}" variant="info"
                      class="items-center max-w-xs gap-2">
                <i class="fas fa-desktop"></i>
                <span>{{__('New machine')}}</span>
            </x-button>
        </x-slot>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Machines List') }}
            </h2>
            <p class="card-category">List of registered machines</p>
        </x-slot>
        <x-table-list>
            <x-slot name="header">
                <th>{{__('#')}}</th>
                <th>{{__('Hashcode')}}</th>
                <th>{{__('User')}}</th>
                <th>{{__('CPU/RAM available')}}</th>
                <th>{{__('Time Activity')}}</th>
                <th>{{__('Available')}}</th>
                <th>{{__('Options')}}</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($machines as $machine)
                    <tr>
                        <x-left-table-item>
                            <i class="fas fa-desktop"></i>
                        </x-left-table-item>
                        <x-table-item>
                            {{substr($machine->hashcode , 0, 20)}}...
                        </x-table-item>
                        <x-table-item>
                            {{$machine->user->name }}
                        </x-table-item>
                        <x-table-item>
                            {{ $machine->cpu_utilizavel }}%
                            <span>/</span>
                            {{ $machine->ram_utilizavel }}MB
                        </x-table-item>
                        <x-table-item>
                            {{ $machine->totalTimeActivity(2) }} Hrs
                        </x-table-item>
                        <x-table-item>
                            @if($machine->disponivel)
                                <i class="fas fa-check-circle"></i>
                            @else
                                <i class="fas fa-times-circle"></i>
                            @endif
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
            </x-slot>
        </x-table-list>
        {!! $machines->links() !!}
    </x-card>
</x-app-layout>

<x-app-layout>

</x-app-layout>
