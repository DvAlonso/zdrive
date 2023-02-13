<div class="mt-6" x-on:contextmenu="$event.stopPropagation()">
    <table class="min-w-full table-fixed">
        <thead class="mb-4">
            <tr class="mb-4">
                <th scope="col" class="text-sm font-bold text-left text-slate-500">{{ __('Name') }}</th>
                <th scope="col" class="text-sm font-bold text-left text-slate-500">{{ __('Last update') }}</th>
                <th scope="col" class="text-sm font-bold text-left text-slate-500">{{ __('Size') }}</th>
            </tr>
            @if ($currentFolder)
                <tr class="hover:cursor-pointer hover:bg-gray-200" x-data
                    @click='window.location.href = "{{ $currentFolder->getParentUrl() }}"'>
                    <th colspan="3" class="">
                        <div class="flex px-2 py-3 text-sm font-bold text-slate-500 gap-x-4">
                            <x-mdi-arrow-left-top class="w-5 h-5 text-slate-600"></x-mdi-arrow-left-top>
                            ...
                        </div>
                    </th>
                </tr>
            @endif
        </thead>
        <tbody class="mt-4">
            @foreach ($folders as $folder)
                <tr class="relative hover:cursor-pointer hover:bg-gray-200" x-data="folderContextMenu"
                    x-on:contextmenu="open = true"
                    @click='window.location.href = "{{ route('drive.folder', $folder->uuid) }}"'>
                    <td class="flex items-center px-2 py-3 gap-x-4">
                        <x-mdi-folder class="w-5 h-5 text-slate-600"></x-mdi-folder>
                        <span class="text-slate-800">{{ $folder->name }}</span>
                    </td>
                    <td>1
                        <span class="text-sm text-slate-800">{{ $folder->updated_at->diffForHumans() }}</span>
                    </td>
                    <td>

                    </td>
                    <div id="folder{{ $folder->id }}ContextMenu" x-transition x-show="open"
                        class="fixed flex flex-col w-64 bg-white border border-gray-300 divide-y divide-gray-300 rounded-md cursor-pointer">
                        <div class="flex items-center justify-start p-4 gap-x-4 hover:bg-gray-200"
                            @click="$dispatch('foo')">
                            <x-mdi-folder-plus class="w-5 h-5"></x-mdi-folder-plus>
                            <span class="text-sm">{{ __('New folder') }}</span>
                        </div>
                        <div class="flex items-center justify-start p-4 gap-x-4 hover:bg-gray-200">
                            <x-mdi-cloud-upload class="w-5 h-5"></x-mdi-cloud-upload>
                            <span class="text-sm">{{ __('Upload file') }}</span>
                        </div>
                    </div>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('folderContextMenu', () => ({
                open: false,
                // toggleFolder(event, folderId) {
                //     alert(0)
                //     event.preventDefault()

                //     var menu = document.getElementById('folder'.folderId.
                //         'ContextMenu')
                //     menu.style.left = event.pageX + "px"
                //     menu.style.top = event.pageY + "px"

                //     this.open = true
                // }
            }))
        })
    </script>
@endpush
