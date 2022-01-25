<ul class="bg-white dark:bg-dark-bg" id="{{$attributes['id']}}">
    <li class="flex justify-between">
        <div class="grid grid-cols-3 gap-4 content-center w-full rounded-lg bg-stripes-light-blue text-center h-56 bg-white dark:bg-dark-eval-2 rounded rounded-md px-8 py-4">
            {{$header}}
        </div>
    </li>
    {{$slot}}
</ul>
