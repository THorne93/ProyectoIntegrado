<div @attributes([
    'with-validation-colors' => $withValidationColors,
    'group-invalidated' => $invalidated,
    'aria-disabled' => $disabled,
    'aria-readonly' => $readonly,
])
    {{ $attributes->only(['class', 'wire:key', 'form-wrapper', 'x-data', 'x-props'])->merge(['form-wrapper' => $id ?: 'true'])->class([
            'aria-disabled:pointer-events-none aria-disabled:select-none aria-disabled:opacity-60',
            'aria-readonly:pointer-events-none aria-readonly:select-none',
            'w-full relative',
        ]) }}>
    @if ($label || $corner)
        <div @class([
            'flex mb-1',
            'justify-end' => !$label,
            'justify-between items-end' => $label,
        ]) name="form.wrapper.header">
            @if ($label)
                <x-dynamic-component :component="WireUi::component('label')" :attributes="WireUi::extractAttributes($label)" :for="$id">
                    {{ $label }}
                </x-dynamic-component>
            @endif

            @if ($corner)
                <x-dynamic-component :component="WireUi::component('label')" :attributes="WireUi::extractAttributes($corner)" :for="$id">
                    {{ $corner }}
                </x-dynamic-component>
            @endif
        </div>
    @endif

    <label
        {{ $attributes->whereStartsWith(['x-ref', 'x-on:', 'x-bind:', 'tabindex'])->merge(['for' => $id])->class([
                data_get($roundedClasses, 'input', ''),
                data_get($colorClasses, 'input', ''),
                $shadowClasses => !$shadowless,
        
                'bg-background-white dark:bg-background-dark',
                'relative flex justify-between gap-x-2 items-start',
                'transition-all ease-in-out duration-150',
                'ring-1 ring-inset ring-gray-300 focus-within:ring-2',
                'outline-0',
        
                '!bg-gray-100 bg-gray-100!' => $disabled && !$invalidated,
        
                $padding => $padding,
                'pl-3' => !$padding && !isset($prepend),
                'pr-3' => !$padding && !isset($append),
                'py-2',
                'scrollbar-thin',
                'overflow-y-auto',
                'max-h-[200px]', // Set to a reasonable height (adjust this to fit your design)
                'min-h-12',
        
                'invalidated:bg-negative-50 invalidated:ring-negative-500 dark:invalidated:ring-negative-700',
                'dark:invalidated:bg-negative-700/10 dark:invalidated:ring-negative-600',
            ]) }}
        name="form.wrapper.container">
        <!-- Prepend, Slot and Append logic goes here -->

        {{ $slot }}
    </label>


    @if ($description && !$invalidated)
        <x-dynamic-component :component="WireUi::component('description')" :for="$id" class="mt-2" name="form.wrapper.description">
            {{ $description }}
        </x-dynamic-component>
    @elseif (!$errorless && $invalidated)
        <x-dynamic-component :component="WireUi::component('error')" :for="$id" class="mt-2" :name="$name">
            {{ $error }}
        </x-dynamic-component>
    @endif

    @isset($after)
        <div {{ $after->attributes }}>
            {{ $after }}
        </div>
    @endisset
</div>
