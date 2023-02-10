@extends('app.layout')

@section('content')
    <div>
        <h1 class="text-3xl text-slate-800">{{ __('My files') }}</h1>
    </div>
    <div class="flex mt-6 gap-x-4">
        <div x-data="{ open: true }" class="relative">
            <button x-on:click="open = !open"
                class="flex items-center px-4 py-2 text-white rounded-sm bg-cyan-800 gap-x-2 hover:bg-cyan-600">
                <x-mdi-plus class="w-5 h-5"></x-mdi-plus>
                <span class="text-sm">{{ __('New file') }}</span>
            </button>
            <div x-show="open" class="absolute h-auto bg-white border border-gray-200 w-44 top-full">
                <div class="flex items-center justify-start p-4 cursor-pointer gap-x-4 hover:bg-gray-200">
                    <x-mdi-file-word class="w-5 h-5 text-blue-900"></x-mdi-file-word>
                    <span class="font-light text-slate-700">{{ __('Document') }}</span>
                </div>
                <div class="flex items-center justify-start p-4 cursor-pointer gap-x-4 hover:bg-gray-200">
                    <x-mdi-file-word class="w-5 h-5 text-blue-900"></x-mdi-file-word>
                    <span class="font-light text-slate-700">{{ __('Spreadshet') }}</span>
                </div>
            </div>
        </div>
        <button class="flex items-center px-5 py-2 text-white rounded-sm bg-cyan-800 gap-x-2 hover:bg-cyan-600">
            <x-mdi-folder-plus class="w-5 h-5"></x-mdi-folder-plus>
            <span class="text-sm">{{ __('New folder') }}</span>
        </button>
        <button class="flex items-center px-5 py-2 text-white rounded-sm bg-cyan-800 gap-x-2 hover:bg-cyan-600">
            <x-mdi-cloud-upload class="w-5 h-5"></x-mdi-cloud-upload>
            <span class="text-sm">{{ __('Upload file') }}</span>
        </button>

        <input type="text" class="px-2 ml-auto border border-gray-200" placeholder="{{ __('Type to search') }}">
    </div>
@endsection
