<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-md bg-white shadow p-8">

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold">CMS Login</h2>
        </div>

        <form wire:submit.prevent="login" class="space-y-5">

            <div>
                <input type="email"
                       wire:model.defer="email"
                       placeholder="Email"
                       class="w-full border px-4 py-2">
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <input type="password"
                       wire:model.defer="password"
                       placeholder="Password"
                       class="w-full border px-4 py-2">
                @error('password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2">
                Login
            </button>

        </form>

    </div>

</div>