@extends('app.layout')

@section('content')
    <div x-data="contextMenu" x-on:click="open = false" class="relative min-h-screen p-10"
        x-on:contextmenu="open = false; toggle($event)">
        <div id="contextMenu" x-transition x-show="open"
            class="fixed flex flex-col w-64 bg-white border border-gray-300 divide-y divide-gray-300 rounded-md cursor-pointer">
            <div class="flex items-center justify-start p-4 gap-x-4 hover:bg-gray-200">
                <x-mdi-folder-plus class="w-5 h-5"></x-mdi-folder-plus>
                <span class="text-sm">{{ __('New folder') }}</span>
            </div>
            <div class="flex items-center justify-start p-4 gap-x-4 hover:bg-gray-200">
                <x-mdi-cloud-upload class="w-5 h-5"></x-mdi-cloud-upload>
                <span class="text-sm">{{ __('Upload file') }}</span>
            </div>
        </div>
        <div>
            <h1 class="text-3xl text-slate-800">{{ __('My drive') }}</h1>
        </div>
        <div class="flex mt-6 gap-x-4">
            <div x-data="{ open: true }">
                <button x-on:click="open = true"
                    class="flex items-center px-5 py-2 text-white rounded-sm bg-cyan-800 gap-x-2 hover:bg-cyan-600">
                    <x-mdi-folder-plus class="w-5 h-5"></x-mdi-folder-plus>
                    <span class="text-sm">{{ __('New folder') }}</span>
                </button>
                <div x-show="open" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

                    <div class="fixed inset-0 z-10 overflow-y-auto">
                        <div class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0">
                            <div x-show="open" x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-lg">
                                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                                    <div class="flex items-center sm:flex sm:items-start">
                                        <div
                                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto rounded-full bg-cyan-100 sm:mx-0 sm:h-10 sm:w-10">
                                            <x-mdi-folder class="w-6 h-6 text-cyan-700"></x-mdi-folder>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                                                {{ __('New folder') }}
                                            </h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                    <button type="button"
                                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white border border-transparent rounded-md shadow-sm bg-cyan-800 hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                                        {{ __('Create') }}

                                    </button>
                                    <button type="button" x-on:click="open = false"
                                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        {{ __('Cancel') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div>
                <button class="flex items-center px-5 py-2 text-white rounded-sm bg-cyan-800 gap-x-2 hover:bg-cyan-600">
                    <x-mdi-cloud-upload class="w-5 h-5"></x-mdi-cloud-upload>
                    <span class="text-sm">{{ __('Upload file') }}</span>
                </button>
            </div>

            <input type="text" class="px-2 ml-auto border border-gray-200" placeholder="{{ __('Type to search') }}">
        </div>
        <div class="mt-6">
            <table class="w-full">
                <thead>
                    <tr class="flex justify-between mb-4">
                        <th class="text-sm font-bold text-slate-500">{{ __('Name') }}</th>
                        <th class="text-sm font-bold text-slate-500">{{ __('Last update') }}</th>
                        <th class="text-sm font-bold text-slate-500">{{ __('Size') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class=" hover:cursor-pointer hover:bg-gray-200">
                        <td class="flex items-center px-2 py-3 gap-x-4">
                            <x-mdi-folder class="w-5 h-5 text-slate-600"></x-mdi-folder>
                            <span class="text-slate-800">{{ __('My folder') }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
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
