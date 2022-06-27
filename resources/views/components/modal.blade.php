<a onclick="toggleModal('modal-id-{{$attributes['id']}}')">
    {{$showModalButton ?? ''}}
</a>
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id-{{$attributes['id']}}">
    <div class="relative w-auto my-6 mx-6 p-6">
        <x-card>
            <x-slot name="title">
                {{__('Edit user')}}
            </x-slot>
            {{$content}}
            <x-slot name="footer">
                <div class="flex ">

                </div>
                <button class="bg-red-500 text-white-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id-{{$attributes['id']}}')">
                    {{$buttonToggle ?? __('Close')}}
                </button>
            </x-slot>
        </x-card>
    </div>
</div>
<div class="hidden opacity-25 fixed inset-0 z-40" id="modal-id-backdrop"></div>
<script type="text/javascript">
    function toggleModal(modalID){
        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        document.getElementById(modalID).classList.toggle("flex");
        document.getElementById(modalID + "-backdrop").classList.toggle("flex");
    }
</script>
