<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">
    <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <i class="fas fa-tachometer-alt"></i>
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link title="User Profile" href="{{ route('user.update') }}" :isActive="request()->routeIs('user.update')">
        <x-slot name="icon">
            <i class="fas fa-user-circle"></i>
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link title="Containers" href="{{ route('images.index') }}" :isActive="request()->routeIs('images.index')">
        <x-slot name="icon">
            <i class="fas fa-server"></i>
        </x-slot>
    </x-sidebar.link>
    @if(Auth::user()->isAdmin())
        <x-sidebar.link title="Admin area" href="{{ route('admin.area') }}" :isActive="request()->routeIs('admin.area')">
            <x-slot name="icon">
                <i class="fas fa-chart-bar"></i>
            </x-slot>
        </x-sidebar.link>
        <x-sidebar.link title="Solicitações" href="{{ route('dashboard') }}" :isActive="request()->routeIs('admin.area.requests')">
            <x-slot name="icon">
                <i class="fas fa-chart-bar"></i>
            </x-slot>
        </x-sidebar.link>
        <x-sidebar.link title="Machines" href="{{ route('dashboard') }}" :isActive="request()->routeIs('user.machines')">
            <x-slot name="icon">
                <i class="fas fa-desktop"></i>
            </x-slot>
        </x-sidebar.link>
        <x-sidebar.link title="Images" href="{{ route('dashboard') }}" :isActive="request()->routeIs('images.index')">
            <x-slot name="icon">
                <i class="fab fa-docker"></i>
            </x-slot>
        </x-sidebar.link>
        <x-sidebar.link title="My containers" href="{{ route('dashboard') }}" :isActive="request()->routeIs('instance.index')">
            <x-slot name="icon">
                <i class="fas fa-server"></i>
            </x-slot>
        </x-sidebar.link>
        <x-sidebar.link title="Dockerfiles" href="{{ route('dashboard') }}" :isActive="request()->routeIs('admin.area.dockerfiles')">
            <x-slot name="icon">
                <i class="fas fa-server"></i>
            </x-slot>
        </x-sidebar.link>
    @endif
    @if(Auth::user()->isBasic() || Auth::user()->isAdmin())
        <x-sidebar.link title="Basic" href="{{ route('dashboard') }}" :isActive="request()->routeIs('aluno.basic.index')">
            <x-slot name="icon">
                <i class="fas fa-star-half-alt"></i>
            </x-slot>
        </x-sidebar.link>
    @endif
    @if(Auth::user()->isAdvanced() || Auth::user()->isAdmin())
        <x-sidebar.link title="Advanced" href="{{ route('dashboard') }}" :isActive="request()->routeIs('aluno.advanced.index')">
            <x-slot name="icon">
                <i class="fas fa-star"></i>
            </x-slot>
        </x-sidebar.link>
    @endif

    <x-sidebar.dropdown title="Buttons" :active="Str::startsWith(request()->route()->uri(), 'buttons')">
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink title="Text button" href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')" />
        <x-sidebar.sublink title="Icon button" href="{{ route('buttons.icon') }}"
            :active="request()->routeIs('buttons.icon')" />
        <x-sidebar.sublink title="Text with icon" href="{{ route('buttons.text-icon') }}"
            :active="request()->routeIs('buttons.text-icon')" />
    </x-sidebar.dropdown>


</x-perfect-scrollbar>
