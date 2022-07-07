<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __(isset($dockerfile) ? 'Edit dockerfile' : 'New dockerfile') }}
            </h2>
            <p>{{__(isset($image) ? 'Create New dockerfile' : '')}}</p>
        </x-slot>

        <form action="{{isset($image) ? route('dockerfiles.update', $dockerfile->id) : route('dockerfiles.store')}}" method="post" enctype="multipart/form-data">
            @if(isset($image))
                @method('PUT')
            @endif
            @csrf
            <div class="grid gap-6">
                <div class="space-y-2">
                    <x-label for="tag" :value="__('Tag')"/>

                    <x-input id="tag" type="text" class="block w-full" name="tag"
                             :value="old('tag', $dockerfile->tag ?? null)" placeholder="{{ __('Dockerfile tag') }}" required
                             autofocus/>
                </div>

                <div class="space-y-2">
                    <x-label for="file" :value="__('File')"/>
                    <x-input id="file" type="file" class="block w-full" name="file"
                             :value="old('file', $dockerfile->file ?? null)" placeholder="{{ __('Dockerfile file') }}" required
                             autofocus/>
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
