<x-app-layout>
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
                <th>{{__('Created containers')}}</th>
                <th>{{__('Access')}}</th>
                <th>{{__('Edit')}}</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($users as $user)
                    <tr>
                        <x-left-table-item >
                            {{$user->id }}
                        </x-left-table-item>
                        <x-table-item>
                            {{$user->name }}
                        </x-table-item>
                        <x-table-item>
                            {{$user->email }}
                        </x-table-item>
                        <x-table-item>
                            {{$user->user_type }}
                        </x-table-item>
                        <x-table-item>
                            {{$user->machines()->count()}}
                        </x-table-item>
                        <x-table-item>
                            {{$user->containers()->count() }}
                        </x-table-item>
                        <x-table-item>
                            @if($user->access)
                                <i class="fas fa-check-circle"></i>
                            @else
                                <i class="fas fa-times-circle"></i>
                            @endif
                        </x-table-item>
                        <x-right-table-item>
                            <x-modal>
                                <x-slot name="showModalButton">
                                    <i class="fas fa-ellipsis-v"></i>
                                </x-slot>
                                <x-slot name="content">
                                    <form action="{{ route('manage.access', ['id' => $user->id]) }}" method="post">
                                        @csrf()
                                        @method('put')

                                        <select name="user_type">
                                            <option @if($user->user_type == 'basic') selected @endif value="basic">basic</option>
                                            <option @if($user->user_type == 'advanced') selected @endif value="advanced">advanced</option>
                                            <option @if($user->user_type == 'admin') selected @endif value="admin">admin</option>
                                        </select>


                                        <label >Number Containers</label>
                                        <input type="number" value="{{$user->containers}}">

                                        <label class="form-check-label text-body" for="exampleRadios{{$user->id}}">{{ __('Autorizar acesso.') }}
                                            <input type="checkbox" value="1" name="access" @if($user->acess) checked @endif>
                                            <div class="form-check-sign mr-2">
                                                <div class="check"></div>
                                            </div>
                                        </label>
                                        <button type="submit" class="btn btn-primary" >Salvar</button>
                                    </form>
                                </x-slot>
                            </x-modal>
                        </x-right-table-item>
                    </tr>
                @endforeach
            </x-slot>
        </x-table-list>
        {!! $users->links() !!}
        <div class="card-footer">
            <p class="card-category">Registered this Mouth: {{ $registered_this_month }}</p>
            <p class="card-category">Registered Today: {{ $registered_today }}</p>
            <p class="card-category">Total: {{ $users->count() }}</p>
        </div>
    </x-card>
</x-app-layout>
