<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __(!isset($machine) ? 'Create Machine' : 'New Machine') }}
            </h2>
            <p>{{__(!isset($machine) ? 'Create New Machine' : '')}}</p>
        </x-slot>

        <form action="{{isset($machine) ? route('machines.update', $machine->id) : route('machines.store')}}" method="post">
            @if(isset($machine))
                @method('PUT')
            @endif
            @csrf
            <div class="grid gap-6">
                <div class="space-y-2">
                    <x-label for="cpu_utilizavel" :value="__('CPU Usage Limit(%)')"/>

                    <select name="cpu_utilizavel">
                        @for ($i = 25; $i <= 100; $i+=5)
                            @if (isset($machine->cpu_utilizavel) && $i == $machine->cpu_utilizavel)
                                <option value="{{ $i }}" selected>{{ $i }}</option>
                            @else
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endif
                        @endfor
                    </select>
                </div>

                <div class="space-y-2">
                    <x-label for="ram_utilizavel" :value="__('Ram Usage Limit (MB)')"/>

                    <select name="ram_utilizavel">
                        @for ($i = 128; $i <= 1024; $i+=128)
                            @if (isset($machine->ram_utilizavel) && $i == $machine->ram_utilizavel)
                                <option value="{{ $i }}" selected>{{ $i }}</option>
                            @else
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endif
                        @endfor
                    </select>
                </div>

                <x-button type="submit" variant="success"
                          class="justify-center w-full gap-2">
                    <i class="fas fa-archive"></i>
                    <span>{{__('Confirm')}}</span>
                </x-button>
            </div>
        </form>
    </x-card>
</x-app-layout>
