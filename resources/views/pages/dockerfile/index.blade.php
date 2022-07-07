<x-app-layout>
    <x-card>
        <x-slot name="button">
            <x-button href="{{route('dockerfiles.create')}}" variant="info"
                      class="items-center max-w-xs gap-2">
                <i class="fas fa-desktop"></i>
                <span>{{__('New dockerfile')}}</span>
            </x-button>
        </x-slot>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dockerfile list') }}
            </h2>
            <p class="card-category">List of registered machines</p>
        </x-slot>
        <x-table-list>
            <x-slot name="header">
                <th>{{__('#')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Description')}}</th>
                <th>{{__('Options')}}</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($dockerfiles as $dockerfile)
                    <tr>
                        <x-left-table-item>
                            <i class="fas fa-desktop"></i>
                        </x-left-table-item>
                        <x-table-item>
                            {{ $dockerfile->tag }}
                        </x-table-item>
                        <x-table-item>
                            {{ $dockerfile->file }}
                        </x-table-item>

                        <x-right-table-item>
                            <form action="{{ route('dockerfiles.build') }}" method="post">
                                @method("PUT")
                                @csrf
                                <input type="hidden" name="tag" value="{{ $dockerfile->tag }}">
                                <x-button type="submit" :variant="'danger'" size="'sm'">{{__('Build')}}</x-button>
                            </form>
                        </x-right-table-item>
                    </tr>
                @endforeach
            </x-slot>
        </x-table-list>
    </x-card>
</x-app-layout>
