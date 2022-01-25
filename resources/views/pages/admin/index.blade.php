<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Admin Area') }}
            </h2>
        </x-slot>
        <x-card>
            <x-slot name="title">
                <i class="fas fa-chart-bar"></i>
            </x-slot>
            <canvas id="chartMachines"></canvas>
        </x-card>
        <x-card>
            <x-slot name="title">
                <i class="fas fa-chart-bar"></i>
            </x-slot>
            <canvas id="chartUsers"></canvas>
        </x-card>
        <x-card>
            <x-slot name="title">
                <i class="fas fa-chart-bar"></i>
            </x-slot>
            <canvas id="chartImages"></canvas>
        </x-card>
        <x-card>
            <x-slot name="title">
                <i class="fas fa-laptop"></i>
                <span>{{__('Machines List')}}</span>
            </x-slot>
            <x-table-list id="machines">
                <x-slot name="header">
                    <div>#</div>
                    <div>{{__('Hashcode')}}</div>
                    <div>{{__('User')}}</div>
                    <div>{{__('CPU/RAM Available')}}</div>
                    <div>{{__('Time Activity')}}</div>
                    <div>{{__('Running')}}</div>
                    <div>{{__('Options')}}</div>
                </x-slot>

                @foreach ($machines as $machine)
                    <li class="flex justify-between p-2">
                        <div
                            class="grid grid-cols-3 gap-4 content-center w-full rounded-lg bg-stripes-light-blue text-center h-56 bg-white dark:bg-dark-eval-2 rounded rounded-md px-8 py-4">
                            <div><i class="fas fa-laptop"></i></div>

                            <div>{{ $machine->hashcode }}</div>
                            <div>{{ $machine->user->name }}</div>
                            <div>
                                {{ $machine->cpu_utilizavel }}%
                                <span>/</span>
                                {{ $machine->ram_utilizavel }}MB
                            </div>
                            <div>{{ $machine->totalTimeActivity(2) }} Hrs</div>
                            <div>
                                @if($machine->disponivel)
                                    <div class="text-lime-600">
                                        <i class="fas fa-square"></i>
                                    </div>
                                @else
                                    <div class="text-red-600">
                                        <i class="far fa-square"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <i class="fas fa-info-circle dark:bg-white"></i>
                                    </x-slot>
                                    <x-slot name="content">
                                        <div class="collapse" id="{{ $machine->id }}">
                                            <p><b>Id: </b>{{ $machine->id }}</p>
                                            <p><b>Hash: </b>{{ $machine->hashcode }}</p>
                                            <p><b>CPU/RAM Limite: </b>{{ $machine->cpu_utilizavel }}% / {{ $machine->ram_utilizavel }}MB</p>
                                            <p><b>In Activity: </b>{{ $machine->disponivel? 'Yes' : 'No' }}</p>
                                            <p><b>Created At: </b>{{ $machine->created_at }}</p>
                                            <p><b>Updated At: </b>{{ $machine->updated_at }}</p>
                                            <a href="{{ route('machines.show', $machine) }}"
                                               class="btn btn-sm btn-outline-info">
                                                More
                                            </a>
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                                <div>
                                    <a href="{{ route('machines.edit', $machine) }}" class="py-1">
                                        <i class="fas fa-pen mr-2"></i>
                                        <span>{{__('Edit')}}</span>
                                    </a>
                                </div>
                                <div>
                                    <form class="py-1" action="{{route('machines.destroy', $machine->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                            <span>{{__('Delete')}}</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </x-table-list>
            <div class="card-footer">
                <p class="card-category">In Activity: {{ $inActivity }}</p>
                <p class="card-category">Total: {{ $numberOfMach }}</p>
                <p class="card-category"></p>
            </div>
        </x-card>
    </x-card>
    <x-slot name="scripts">
        <link href="{{asset('charts/demo.css')}}">
        <script src="{{asset('charts/demo.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

        <script>
            $(document).ready(function () {
                md.initDashboardPageCharts();
            });
            let ctx = document.getElementById('chartImages').getContext('2d');
            let myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($imagesLabel),
                    datasets: [{
                        label: 'Instances per Image',
                        data: @json($graficDataImages),
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>

        <script>
            let ctx = document.getElementById('chartMachines').getContext('2d');
            let myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'],
                    datasets: [{
                        label: 'Machines registration per month',
                        data: @json($graficDataMachines),
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>

        <script>
            let ctx = document.getElementById('chartUsers').getContext('2d');
            let myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'],
                    datasets: [{
                        label: 'Users registration per month',
                        data: @json($graficDataUsers),
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
    </x-slot>
</x-app-layout>
