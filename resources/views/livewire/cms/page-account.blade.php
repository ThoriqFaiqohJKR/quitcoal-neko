<div>

    <div class="py-12 mx-auto max-w-5xl flex flex-col min-h-screen">

        <h1 class="text-2xl font-semibold mb-6">Manajemen Account</h1>

        <div class="flex justify-between items-center mb-4">
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   placeholder="Cari nama atau email..."
                   class="border px-3 py-2 w-64">

            <button wire:click="create"
                    class="px-4 py-2 border hover:bg-black hover:text-white">
                + Tambah Account
            </button>
        </div>

        <div class="border">

            <div class="grid grid-cols-12 bg-gray-100 border-b text-sm font-semibold">
                <div class="col-span-3 px-4 py-3">Nama</div>
                <div class="col-span-3 px-4 py-3">Email</div>
                <div class="col-span-2 px-4 py-3">Role</div>
                <div class="col-span-2 px-4 py-3">Status</div>
                <div class="col-span-2 px-4 py-3 text-right">Detail</div>
            </div>

            @foreach($accounts as $item)
                <div wire:key="account-{{ $item->id }}"
                     wire:click="view({{ $item->id }})"
                     class="grid grid-cols-12 border-b text-sm items-center cursor-pointer hover:bg-gray-50">

                    <div class="col-span-3 px-4 py-3">
                        {{ $item->nama }}
                    </div>

                    <div class="col-span-3 px-4 py-3">
                        {{ $item->email }}
                    </div>

                    <div class="col-span-2 px-4 py-3">
                        {{ $item->role }}
                    </div>

                    <div class="col-span-2 px-4 py-3">
                        {{ $item->status }}
                    </div>

                    <div class="col-span-2 px-4 py-3 text-right">
                        Lihat
                    </div>

                </div>
            @endforeach

        </div>

        <div class="mt-auto pt-6">
            @include('components.pagination', [
                'page' => $page,
                'lastPage' => $lastPage
            ])
        </div>

    </div>



    
   @if($showModal)
    <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
         wire:click="$set('showModal', false)">

        <div class="bg-white w-full max-w-lg border p-6 space-y-4"
             wire:click.stop>

            <h2 class="text-lg font-semibold">
                {{ $modalType === 'create' ? 'Tambah Account' : 'Detail Account' }}
            </h2>

            <input type="text"
                   wire:model="nama"
                   class="w-full border px-3 py-2"
                   @disabled($modalType === 'view')>

            <input type="email"
                   wire:model="email"
                   class="w-full border px-3 py-2"
                   @disabled($modalType === 'view')>

            @if($modalType !== 'view')
                <input type="password"
                       wire:model="password"
                       placeholder="Password"
                       class="w-full border px-3 py-2">
            @endif

            <select wire:model="role"
                    class="border px-3 py-2 w-full"
                    @disabled($modalType === 'view')>
                <option value="super_admin">Super Admin</option>
                <option value="admin">Admin</option>
            </select>

            <select wire:model="status"
                    class="border px-3 py-2 w-full"
                    @disabled($modalType === 'view')>
                <option value="Y">Aktif</option>
                <option value="N">Nonaktif</option>
            </select>

            <div class="flex justify-between pt-4">

                <div>
                    @if($modalType === 'view')
                        <button wire:click="enableEdit"
                                class="px-4 py-2 border">
                            Edit
                        </button>
                    @endif
                </div>

                <div class="space-x-2">

                    @if($modalType === 'edit' || $modalType === 'create')
                        <button wire:click="save"
                                class="px-4 py-2 border hover:bg-black hover:text-white">
                            Simpan
                        </button>
                    @endif

                    <button wire:click="$set('showModal', false)"
                            class="px-4 py-2 border">
                        Tutup
                    </button>

                </div>

            </div>

        </div>

    </div>
@endif

</div>