<x-app-layout>
    <x-card>
        <x-slot name="title">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __(isset($image) ? 'Edit Image' : 'New Image') }}
            </h2>
            <p>{{__(isset($image) ? 'Create New Container Image' : '')}}</p>
        </x-slot>

        <form action="{{route('images.store')}}" method="post">
            @csrf
            <div class="grid gap-6">
                <div class="space-y-2">
                    <x-label for="name" :value="__('Name')"/>

                    <x-input id="name" type="text" class="block w-full" name="name"
                             :value="old('name', $image->name ?? null)" placeholder="{{ __('Image name') }}" required
                             autofocus/>
                </div>
                <div class="space-y-2">
                    <x-label for="description" :value="__('Description')"/>

                    <textarea name="description" id="description" class="rounded-md resize-y w-full dark:bg-dark-eval-1" placeholder="Enter a description." rows="5" required>{{old('description', $image->description ?? null)}}</textarea>
                </div>

                <div class="space-y-2">
                    <x-label for="from_image" :value="__('From Image')"/>

                    <x-input id="from_image" type="text" class="block w-full" name="from_image"
                             :value="old('from_image', $image->from_image ?? null)" placeholder="{{ __('Name of the image to pull.') }}" required
                             autofocus/>
                </div>

                <div class="space-y-2">
                    <x-label for="from_src" :value="__('From Source')"/>

                    <x-input id="from_src" type="text" class="block w-full" name="from_src"
                             :value="old('from_src', $image->from_src ?? null)" placeholder="{{ __('Source to import.') }}" autofocus/>
                </div>

                <div class="space-y-2">
                    <x-label for="repo" :value="__('Repository')"/>

                    <x-input id="repo" type="text" class="block w-full" name="repo"
                             :value="old('repo', $image->repo ?? null)" placeholder="{{ __('Repository name given to an image when it is imported.') }}" autofocus/>
                </div>

                <div class="space-y-2">
                    <x-label for="tag" :value="__('Tag')"/>

                    <x-input id="tag" type="text" class="block w-full" name="tag"
                             :value="old('tag', $image->tag ?? null)" placeholder="{{ __('Tag or digest.') }}" autofocus/>
                </div>

                <div class="space-y-2">
                    <x-label for="message" :value="__('Message')"/>

                    <x-input id="message" type="text" class="block w-full" name="message"
                             :value="old('message', $image->message ?? null)" placeholder="{{ __('Set commit message for imported image.') }}" autofocus/>
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
