@props(['message' => 'Loading...'])
<div class="border-main bg-main/10 border p-4 flex items-center justify-center animate-pulse mb-4 rounded-lg">
    <div class="flex items-center ">
        <img src="https://api.iconify.design/eos-icons:loading.svg?color=%23ffffff" alt="Loading" width="35px">
        <strong class="text-white ml-3">{{ $message }}</strong>
    </div>
</div>