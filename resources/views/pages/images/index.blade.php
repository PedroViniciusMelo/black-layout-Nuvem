<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Containers') }}
            </h2>
        </x-slot>
        <x-slot name="button">
            <x-button href="{{route('images.create')}}" variant="info"
                      class="items-center max-w-xs gap-2">
                <i class="fab fa-docker"></i>
                <span>{{__('New container')}}</span>
            </x-button>
        </x-slot>
        <x-table-list>
            <x-slot name="header">
                <th>{{__('Image')}}</th>
                <th>{{__('Status')}}</th>
                <th>{{__('Actions')}}</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($images as $image)
                <tr>
                    <x-left-table-item>
                        <div>{{$image->name}}</div>
                    </x-left-table-item>
                    <x-table-item>
                        <div>{{$image->status}}</div>
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
                                        <a href="{{route('images.edit', $image->id)}}" class="py-1">
                                            <i class="fas fa-pen mr-2"></i>
                                            <span>{{__('Edit')}}</span>
                                        </a>
                                    </div>


                                    <div>
                                        <a href="{{route('instance.configure', $image->id)}}" class="py-1" >
                                            <i class="fas fa-play"></i>
                                            <span>{{__('Run')}}</span>
                                        </a>
                                    </div>

                                    <div class="py-1">
                                        <a href="#">
                                            <i class="fas fa-pause"></i>
                                            <span>{{__('Pause')}}</span>
                                        </a>
                                    </div>

                                    <hr class="w-full bg-black dark:bg-white">

                                    <form class="py-1" action="{{route('images.destroy', $image->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                            <span>{{__('Delete')}}</span>
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
        {!! $images->links() !!}
    </x-card>
</x-app-layout>
