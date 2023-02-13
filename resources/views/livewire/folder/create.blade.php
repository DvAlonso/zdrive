<div x-data="{ open: false }" x-cloak x-show="open" @foo.window="open = true" @closeCreateFolder.window="alert(0)"
    class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
                    <div class="flex items-center">
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
                    <div class="my-6">
                        <div class="flex flex-col">
                            <label class="text-sm font-semibold text-slate-700" for="folder_name">
                                {{ __('Folder name') }}
                                @error('folder_name')
                                    <span class="ml-2 text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" id="folder_name" class="w-full px-2 py-1 mt-2 text-sm border-zinc-300"
                                wire:model='folder_name'>
                        </div>
                    </div>
                </div>
                <div class="px-4 pb-5 sm:flex sm:flex-row-reverse">
                    <button type="button" x-on:click="@this.submit()"
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

@push('scripts')
    <script>
        Livewire.on('refreshDrive', () => {
            window.dispatchEvent(new CustomEvent('closeCreateFolder'))
        })
    </script>
@endpush
