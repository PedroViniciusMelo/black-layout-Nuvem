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
                <div>{{__('Image')}}</div>
                <div>{{__('Status')}}</div>
                <div>{{__('Actions')}}</div>
            </x-slot>
            @foreach ($images as $image)
                <li class="flex justify-between p-2">
                    <div class="grid grid-cols-3 gap-4 content-center w-full rounded-lg bg-stripes-light-blue text-center h-56 bg-white dark:bg-dark-eval-2 rounded rounded-md px-8 py-4">
                        <div>{{$image->name}}</div>
                        <div>{{$image->status}}</div>
                        <x-dropdown>
                            <x-slot name="trigger">
                                <i class="fas fa-ellipsis-v dark:bg-white"></i>
                            </x-slot>
                            <x-slot name="content">
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

                                <hr>

                                <form class="py-1" action="{{route('images.destroy', $image->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                        <span>{{__('Delete')}}</span>
                                    </button>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </li>
            @endforeach
        </x-table-list>
        {!! $images->links() !!}
    </x-card>
</x-app-layout>
