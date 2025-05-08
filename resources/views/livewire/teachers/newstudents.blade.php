<div x-cloak x-data="{ open: @entangle('isOpen').live }">
    <!-- Overlay (Prevents clicking on background) -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-40" x-transition.opacity @click="open = false">
    </div>


    <!-- Modal (Interactive) -->
    <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50" x-transition>
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
            <h2 class="text-lg font-semibold mb-4">New Student</h2>
            @if ($success)
                <div x-data="{ show: true }" x-init="setTimeout(() => {
                    show = false;
                    $wire.set('success', false);
                }, 5000)" x-show="show" x-transition.duration.500ms
                    class="mb-6">
                    <div
                        class="bg-green-100 border border-green-400 text-green-800 px-6 py-4 rounded-lg shadow flex items-center gap-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-base font-medium">
                            User added successfully
                        </span>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form wire:submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-sm font-medium">Name</label>
                    <input type="text" wire:model="name" class="w-full p-2 border rounded">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Surname</label>
                    <input type="text" wire:model="surname" class="w-full p-2 border rounded">
                    @error('surname')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" wire:model="email" class="w-full p-2 border rounded">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div wire:loading>
                    <div style="display: inline-flex; align-items: center; gap: 5px;">
                        <img width="16" height="16"
                            src="https://media.tenor.com/G7LfW0O5qb8AAAAi/loading-gif.gif" alt="">
                    </div>
                </div>

                <div class="flex justify-center gap-8 mt-2">
                    <button type="button" wire:click="close"
                        class="flex-1 px-4 py-2 bg-gray-300  border border-gray-400 rounded hover:bg-red-400 text-black transition-colors">
                        Close
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-gray-300 border border-gray-400 rounded hover:bg-green-400 text-black transition-colors">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
