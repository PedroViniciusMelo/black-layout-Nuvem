<div class="p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
    <div class="flex justify-between items-center pb-1">
        <div>
            {{$title}}
        </div>
        <div>
            {{$button ?? null}}
        </div>
    </div>
    <hr class="pb-3">
    {{$slot}}
</div>
