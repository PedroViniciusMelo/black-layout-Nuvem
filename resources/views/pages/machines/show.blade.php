<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Show machine') }}
            </h2>
            <p class="card-category">Machine details</p>
        </x-slot>
        <div>
            <p><b>Id: </b>{{ $machine->id }}</p>
            <p><b>Hash: </b>{{ $machine->hashcode }}</p>
            <p><b>CPU/RAM Limite: </b>{{ $machine->cpu_utilizavel }}% / {{ $machine->ram_utilizavel }}MB</p>
            <p><b>In Activity: </b>{{ $machine->disponivel?'Yes':'No' }}</p>
            <p><b>Created At: </b>{{ $machine->created_at }}</p>
            <p><b>Updated At: </b>{{ $machine->updated_at }}</p>
        </div>
    </x-card>

    <x-card>
        <h4 class="card-title ">Total Time In Activity {{ $machine->totalTimeActivity(2)}} hours</h4>
        <br>
        <h4 class="card-title ">Latest activity records</h4>
        <x-table-list>
            <x-slot name="header">
                <th>{{__('Id')}}</th>
                <th>{{__('Datetime started')}}</th>
                <th>{{__('DateTime ended')}}</th>
                <th>{{__('Time in activity')}}</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($activities as $activity)
                    <x-left-table-item>
                        {{ $activity->id }}
                    </x-left-table-item>
                    <x-table-item>
                        {{ $activity->data_hora_inicio }}
                    </x-table-item>
                    <x-table-item>
                        @if ($activity->data_hora_fim)
                            {{ $activity->data_hora_fim }}
                        @else
                            X
                        @endif
                    </x-table-item>
                    <x-right-table-item>
                        {{ $activity->activityTime(2)}} hours
                    </x-right-table-item>
                @endforeach
            </x-slot>
        </x-table-list>
        {!!$activities->links()!!}
    </x-card>
</x-app-layout>
