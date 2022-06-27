<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Admin Area') }}
            </h2>
        </x-slot>
        <x-card>
            <div class="grid md:grid-cols-2 gap-4">
                <div id="machines-per-month" class="col-span-1"></div>
                <div id="users-per-month" class="col-span-1"></div>
            </div>
        </x-card>
        <x-card>
            <div class="flex">
                <div class="flex-1">
                    <div id="instances-per-image" class="col-span-2"></div>
                </div>
            </div>
        </x-card>
    </x-card>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Machines List') }}
            </h2>
        </x-slot>
        <x-table-list>
            <x-slot name="header">
                <th>{{__('Hashcode')}}</th>
                <th>{{__('User')}}</th>
                <th>{{__('CPU/RAM Available')}}</th>
                <th>{{__('Time Activity')}}</th>
                <th>{{__('Running')}}</th>
                <th>{{__('Options')}}</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($machines as $machine)
                    <tr>
                        <x-left-table-item >
                            {{substr($machine->hashcode, 0, 8)}}...
                        </x-left-table-item>
                        <x-table-item>
                            <div>{{$machine->user->name}}</div>
                        </x-table-item>
                        <x-table-item>
                            <div>{{$machine->cpu_utilizavel}}%</div>
                            <span>/</span>
                            <div>{{ $machine->ram_utilizavel }}MB</div>
                        </x-table-item>
                        <x-table-item>
                            <div>{{$machine->totalTimeActivity(2)}}</div>
                        </x-table-item>
                        <x-table-item>
                            @if($machine->disponivel)
                                <i class="fas fa-square"></i>
                            @else
                                <i class="far fa-square"></i>
                            @endif
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
        {!! $machines->links() !!}
    </x-card>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Users List') }}
            </h2>
        </x-slot>

        <x-table-list>
            <x-slot name="header">
                <th>{{__('#')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Email')}}</th>
                <th>{{__('Type')}}</th>
                <th>{{__('Machines')}}</th>
                <th>{{__('Created Containers')}}</th>
                <th>{{__('Access')}}</th>
                <th>{{__('Actions')}}</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($users as $user)
                    <tr>
                        <x-left-table-item>
                            <div>{{$user->id}}</div>
                        </x-left-table-item>
                        <x-table-item>
                            <div>{{$user->name}}</div>
                        </x-table-item>
                        <x-table-item>
                            <div>{{$user->email}}</div>
                        </x-table-item>
                        <x-table-item>
                            <div>{{$user->user_type}}</div>
                        </x-table-item>
                        <x-table-item>
                            <div>{{$user->machines()->count()}}</div>
                        </x-table-item>
                        <x-table-item>
                            <div>{{$user->containers()->count()}}</div>
                        </x-table-item>
                        <x-table-item>
                            @if($user->access)
                                <i class="fas fa-square"></i>
                            @else
                                <i class="far fa-square"></i>
                            @endif
                        </x-table-item>
                        <x-right-table-item>
                            <x-modal id="{{$user->id}}">
                                <x-slot name="showModalButton">
                                    <x-button :variant="'danger'" size="'sm'">{{__('Edit')}}</x-button>
                                </x-slot>
                                <x-slot name="content">
                                    <form action="{{ route('update.user', ["id" => $user->id]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="name" value="{{ $user->name }}">
                                        <input type="hidden" name="email" value="{{ $user->email }}">
                                        <input type="hidden" name="phone" value="{{ $user->phone }}">

                                        <select class="w-full dark:bg-bg-dark-eval-1" name="user_type">
                                            <option @if($user->user_type == 'basic') selected @endif value="basic">basic</option>
                                            <option @if($user->user_type == 'advanced') selected @endif value="advanced">advanced</option>
                                        </select>

                                        <div class="space-y-2">
                                            <x-label for="number_container" :value="__('Number of Containers')" />
                                            <x-input id="number_container" class="block w-full" type="number" name="number_container" required
                                                     autocomplete="containers" value="{{$user->containers}}" placeholder="{{ __('Number of Containers') }}" />
                                        </div>

                                        <div class="space-y-2">
                                            <label class="form-check-label text-body" for="exampleRadios{{$user->id}}">{{ __('Autorizar acesso.') }}
                                                <input class="form-check-input" type="checkbox" name="access" id="exampleRadios{{$user->id}}" value="true" @if($user->acess) checked @endif>
                                                <div class="form-check-sign mr-2" style="margin-top: 13px;">
                                                    <div class="check"></div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary" >Salvar</button>
                                        </div>
                                    </form>
                                </x-slot>
                            </x-modal>
                        </x-right-table-item>
                    </tr>
                @endforeach
            </x-slot>
        </x-table-list>
        {!! $users->links() !!}
    </x-card>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Images List') }}
            </h2>
        </x-slot>

        <x-table-list>
            <x-slot name="header">
                <th>{{__('#')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Description')}}</th>
                <th>{{__('Options')}}</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($images as $image)
                    <tr>
                        <x-left-table-item>
                            <div>{{$image->id}}</div>
                        </x-left-table-item>
                        <x-table-item>
                            <div>{{$image->name}}</div>
                        </x-table-item>
                        <x-table-item>
                            <div>{{substr($image->description, 0, 100)}}</div>
                        </x-table-item>
                        <x-right-table-item>
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <i class="fas fa-ellipsis-v"></i>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="flex justify-center items-center flex-col">
                                        <div>
                                            <a href="{{route('images.edit', $image->id)}}" class="py-1">
                                                <i class="fas fa-pen mr-2"></i>
                                                <span>{{__('Edit')}}</span>
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

                @endforeach
            </x-slot>
        </x-table-list>
        {!! $images->links() !!}
    </x-card>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Containers List') }}
            </h2>
        </x-slot>

        <x-table-list>
            <x-slot name="header">
                <th>{{__('#')}}</th>
                <th>{{__('Container ID')}}</th>
                <th>{{__('Nickname')}}</th>
                <th>{{__('User Email')}}</th>
                <th>{{__('Started at')}}</th>
                <th>{{__('Running')}}</th>
                <th>{{__('Options')}}</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($containers as $container)
                    <tr>
                        <x-left-table-item>
                            <div>{{$container->id}}</div>
                        </x-left-table-item>
                        <x-left-table-item>
                            <div>{{substr($container->docker_id, 0, 12)}}</div>
                        </x-left-table-item>
                        <x-table-item>
                            <div>{{$container->nickname}}</div>
                        </x-table-item>
                        <x-table-item>
                            <div>{{$container->user->email}}</div>
                        </x-table-item>
                        <x-table-item>
                            <div>{{$container->data_hora_instanciado}}</div>
                        </x-table-item>
                        <x-table-item>
                            @if ($container->data_hora_finalizado)
                                <a href="#" class="btn btn-danger" data-original-title="" title="">
                                    <i class=" material-icons">stop</i>
                                    Stop
                                </a>
                            @else
                                <div class="spinner-grow text-success" role="status">
                                    <span class="sr-only">Loading...</span>
                                    Running
                                </div>
                            @endif
                        </x-table-item>
                        <x-right-table-item>
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <i class="fas fa-ellipsis-v"></i>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="flex justify-center items-center flex-col">
                                        <form method="post" action="{{ route('toggleContainer', [ 'id' => $container->docker_id]) }}">
                                            @method("PUT")
                                            @csrf
                                            <button type="submit" title="Play/Pause the container.">
                                                @if($container->data_hora_finalizado)
                                                    <i class=" material-icons">play_circle_outline</i>
                                                @else
                                                    <i class=" material-icons">pause_circle_outline</i>
                                                @endif
                                            </button>
                                        </form>

                                        <a href="{{ route('container.terminalTab', $container->docker_id) }}" class="btn btn-info btn-link"
                                           target="_black" title="Open terminal.">
                                            <i class="fas fa-terminal"></i>
                                        </a>
                                        <a href="{{$docker_host}}/containers/{{$container->docker_id}}/export" class="btn btn-info btn-link"
                                           title="Download.">
                                            <i class=" material-icons">get_app</i>
                                        </a>
                                        <a href="{{$docker_host}}/containers/{{$container->docker_id}}/logs?timestamps=1&stdout=1&stderr=1"
                                           class="btn btn-info btn-link" target="_black" title="Logs.">
                                            <i class="fas fa-file-alt"></i>
                                        </a>
                                        <a href="{{ route('containers.show' , [$container->docker_id]) }}" class="btn btn-link"
                                           title="Details.">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="{{ route('containers.edit' , [$container->docker_id]) }}" class="btn btn-warning btn-link"
                                           title="Edit nickname.">
                                            <i class="material-icons">edit</i>
                                        </a>

                                        <form class="py-1" action="{{route('containers.destroy', $image->id)}}" method="post">
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

                @endforeach
            </x-slot>
        </x-table-list>
        {!! $images->links() !!}
    </x-card>
    <x-slot name="scripts">
        <script>
            $(document).ready(() => {
                let dataUsuarios = [{
                    x: ['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'],
                    y: [20, 54, 13, 5, 33, 78, 42, 43, 77, 20, 90, 56],
                    type: 'bar'
                }];

                let layout = {
                    title: '{{__('Users registered per month')}}',
                    paper_bgcolor: '#222738',
                    plot_bgcolor: '#222738',
                    font: {
                        color: '#fff'
                    },
                    line: {
                        color: '#fff'
                    },
                    yaxis: {
                        gridcolor: "#fff",
                        zerolinecolor: '#fff'
                    },
                    margin: {t: 25, l: 10, r: 0}
                };

                Plotly.newPlot('users-per-month', dataUsuarios, layout, {responsive: true});

                let dataMachines = [{
                    x: ['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'],
                    y: [23, 65, 19, 96, 38, 70, 73, 49, 60, 39, 110, 34],
                    type: 'bar'
                }];

                let layoutMachines = {
                    title: '{{__('Machines registered per month')}}',
                    paper_bgcolor: '#222738',
                    plot_bgcolor: '#222738',
                    font: {
                        color: '#fff'
                    },
                    line: {
                        color: '#fff'
                    },
                    yaxis: {
                        gridcolor: "#fff",
                        zerolinecolor: '#fff'
                    },
                    margin: {t: 25, l: 10, r: 0}
                };

                Plotly.newPlot('machines-per-month', dataMachines, layoutMachines, {responsive: true});

                let colors = ['#5DD4FF', '#FF4040', '#FF309E', '#FBEC2B', '#FFAC07', '#CD56FF', '#33FF56']

                let dataImages = [{
                    labels: ['Nginx', 'Drupal', 'Joomla!', 'Ubuntu', 'WordPress', 'MySQL'],
                    values: [20, 12, 8, 10, 30, 10],
                    type: 'pie',
                    marker: {
                        colors: colors //cores de cada gráfico
                    },
                }];



                let layoutImages = {
                    title: '{{__('Images used per month')}}',
                    paper_bgcolor: '#222738',
                    plot_bgcolor: '#222738',
                    font: {
                        color: '#fff'
                    },
                    line: {
                        color: '#fff'
                    },
                    yaxis: {
                        gridcolor: "#fff",
                        zerolinecolor: '#fff'
                    },
                    margin: {t: 25, l: 10, r: 0, b : 0}
                };

                Plotly.newPlot('instances-per-image', dataImages, layoutImages, {responsive: true});
            })
        </script>
    </x-slot>
</x-app-layout>
