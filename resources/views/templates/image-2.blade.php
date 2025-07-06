@extends('layouts.pdf')
@section('content')
    <section class="bg-red-500 h-screen flex items-center justify-center">
        <div class=" w-full max-w-6xl h-[990px] bg-dark overflow-hidden" id="template">
            <div class="p-3 rounded-3xl">
                <div class="h-[480px] bg-red-500 border border-dark bg-cover bg-center w-full rounded-3xl mb-4 relative overflow-hidden"
                    style="background-image: url('{{ config('app.url') . '/storage/' . $data['drawing'] }}')">
                    <strong
                        class="absolute rounded-tr-full bg-dark text-white px-1 py-2 bottom-0 w-[130px] text-center text-lg z-10">Drawing</strong>
                </div>
                <div class="h-[470px] bg-red-500 border border-dark bg-cover bg-center w-full rounded-3xl relative overflow-hidden"
                    style="background-image: url('{{ config('app.url') . '/storage/' . $data['mockup'] }}')">
                    <strong
                        class="absolute rounded-tr-full bg-dark text-white px-1 py-2 bottom-0 w-[130px] text-center text-lg z-10">Mockup</strong>
                </div>
            </div>
        </div>
    </section>
@endsection