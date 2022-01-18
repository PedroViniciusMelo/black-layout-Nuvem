<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
        <ul class="bg-white dark:bg-dark-bg">
            <li class="flex justify-between">
                <div class="grid grid-cols-3 gap-4 content-center w-full rounded-lg bg-stripes-light-blue text-center h-56 bg-white dark:bg-dark-eval-2 rounded rounded-md px-8 py-4">
                    <div>{{__('Container')}}</div>
                    <div>{{__('Status')}}</div>
                    <div>{{__('Actions')}}</div>
                </div>
            </li>
            <li class="flex justify-between p-2">
                <div class="grid grid-cols-3 gap-4 content-center w-full rounded-lg bg-stripes-light-blue text-center h-56 bg-white dark:bg-dark-eval-2 rounded rounded-md px-8 py-4">
                    <div>{{__('Container')}}</div>
                    <div>{{__('Status')}}</div>
                    <x-dropdown>
                        <x-slot name="trigger">
                            <i class="fas fa-ellipsis-v dark:bg-white"></i>
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
                </div>
            </li>
        </ul>
    </x-card>
</x-app-layout>
