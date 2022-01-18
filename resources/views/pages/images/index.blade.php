<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Containers') }}
            </h2>
        </x-slot>
        <x-slot name="button">
            <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="info"
                      class="items-center max-w-xs gap-2">
                <i class="fab fa-docker"></i>
                <span>{{__('New container')}}</span>
            </x-button>
        </x-slot>
        <ul class="bg-white dark:bg-dark-bg">
            <li class="flex justify-between">
                <div
                    class="grid grid-cols-3 gap-4 content-center w-full rounded-lg bg-stripes-light-blue text-center h-56 bg-white dark:bg-dark-eval-2 rounded rounded-md px-8 py-4">
                    <div>{{__('Image')}}</div>
                    <div>{{__('Status')}}</div>
                    <div>{{__('Actions')}}</div>
                </div>
            </li>
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
                                <form action="{{route('instance.configure')}}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $image->id }}" name='image_id'>
                                    <input type="hidden" value="{{ $user_id }}" name='user_id'>
                                    <button class="py-1">
                                        <i class="fas fa-eye mr-2"></i>
                                        <span>{{__('View')}}</span>
                                    </button>
                                </form>

                                <div class="py-1">
                                    <a href="#">
                                        <i class="fas fa-pen mr-2"></i>
                                        <span>{{__('Edit')}}</span>
                                    </a>
                                </div>
                                <div class="py-1">
                                    <a href="#">
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

                                <div class="py-1">
                                    <a href="#">
                                        <i class="fas fa-trash"></i>
                                        <span>{{__('Delete')}}</span>
                                    </a>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </li>
            @endforeach
        </ul>
        {!! $images->links() !!}
    </x-card>
</x-app-layout>
