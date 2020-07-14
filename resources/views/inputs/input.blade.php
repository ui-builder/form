<input wire:model.lazy="{{ $name }}" id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" {{ $attributes }}
    class="rounded-md shadow-sm appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error($name) border-red-300 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror disabled:cursor-not-allowed disabled:bg-gray-100" />