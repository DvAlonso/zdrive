@extends('app.layout')

@section('content')
    <div class="relative min-h-screen p-10" x-data="contextMenu" x-on:click="open = false"
        x-on:contextmenu="open = false; toggle($event)">
        <div class="flex items-center mb-8 gap-x-1" x-on:contextmenu="$event.stopPropagation()">
            @if (isset($folder))
                @foreach ($folder->getBreadCrumbs() as $parent)
                    <a class="text-lg font-semibold hover:underline text-slate-700" href="{{ $parent['url'] }}">
                        {{ $parent['name'] }}
                    </a>
                    @if (!$loop->last)
                        <x-mdi-chevron-right class="w-5 h-5 text-slate-600"></x-mdi-chevron-right>
                    @endif
                @endforeach
            @else
                <a class="text-lg font-semibold hover:underline text-slate-700" href="{{ route('drive') }}">
                    {{ __('My drive') }}
                </a>
            @endif
        </div>
        <div class="flex gap-x-4" x-on:contextmenu="$event.stopPropagation()">
            <button x-data @click="$dispatch('foo')"
                class="flex items-center px-5 py-2 text-white rounded-sm bg-cyan-800 gap-x-2 hover:bg-cyan-600">
                <x-mdi-folder-plus class="w-5 h-5"></x-mdi-folder-plus>
                <span class="text-sm">{{ __('New folder') }}</span>
            </button>
            <button class="flex items-center px-5 py-2 text-white rounded-sm bg-cyan-800 gap-x-2 hover:bg-cyan-600">
                <x-mdi-cloud-upload class="w-5 h-5"></x-mdi-cloud-upload>
                <span class="text-sm">{{ __('Upload file') }}</span>
            </button>
        </div>
        @livewire('drive.index', ['currentFolder' => $folder ?? null])
        <div id="contextMenu" x-transition x-show="open"
            class="fixed flex flex-col w-64 bg-white border border-gray-300 divide-y divide-gray-300 rounded-md cursor-pointer">
            <div class="flex items-center justify-start p-4 gap-x-4 hover:bg-gray-200" @click="$dispatch('foo')">
                <x-mdi-folder-plus class="w-5 h-5"></x-mdi-folder-plus>
                <span class="text-sm">{{ __('New folder') }}</span>
            </div>
            <div class="flex items-center justify-start p-4 gap-x-4 hover:bg-gray-200">
                <x-mdi-cloud-upload class="w-5 h-5"></x-mdi-cloud-upload>
                <span class="text-sm">{{ __('Upload file') }}</span>
            </div>
        </div>
    </div>
    @livewire('folder.create', ['currentFolder' => $folder ?? null])
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('contextMenu', () => ({
                open: false,
                toggle(event) {
                    event.preventDefault()

                    var menu = document.getElementById('contextMenu')
                    menu.style.left = event.pageX + "px"
                    menu.style.top = event.pageY + "px"

                    this.open = true
                }
            }))
        })
    </script>
@endpush
