<x-dynamic-component :component="WireUi::component('text-field')" x-ref="container" :config="$config" x-data="wireui_select"
    class="!h-auto flex flex-col items-stretch [&_.wireui-label]:!h-auto" :attributes="$wrapper->class([
        'cursor-pointer' => !$disabled && !$readonly,
    ])" :x-props="WireUi::toJs([
        'asyncData' => $asyncData,
        'optionValue' => $optionValue,
        'optionLabel' => $optionLabel,
        'optionDescription' => $optionDescription,
        'hasSlot' => $slot->isNotEmpty(),
        'small' => $small,
        'multiselect' => $multiselect,
        'searchable' => $searchable,
        'clearable' => $clearable,
        'readonly' => $readonly || $disabled,
        'placeholder' => $placeholder,
        'template' => $template,
        'wireModel' => WireUi::wireModel(isset($__livewire) ? $this : null, $attributes),
        'alpineModel' => WireUi::alpineModel($attributes),
    ])"
    x-bind:class="{
        'ring-2 ring-primary-600': positionable.isOpen(),
    }" x-on:click="openIfClosed"
    x-on:keydown.enter.stop.prevent="openIfClosed" x-on:keydown.space.stop.prevent="openIfClosed"
    x-on:keydown.arrow-down.prevent="positionable.open()" tabindex="0">
    <div class="hidden" hidden>
        <div hidden x-ref="json">{{ WireUi::toJs($optionsToArray()) }}</div>
        <div hidden x-ref="slot">{{ $slot }}</div>

        <x-wireui-wrapper::hidden :id="$id" :name="$name" x-ref="input" :value="$value"
            x-bind:value="getSelectedValue" />
    </div>

    @if ($label)
        <x-slot:label class="cursor-pointer select-none flex !py-2 !my-0 leading-none label" x-on:click="toggle">
            {{ $label }}
        </x-slot:label>
    @endif

    {{-- Wrapper for layout fixing --}}
    <div class="{{ $small ? 'max-h-32' : '' }} flex flex-col items-stretch w-full gap-1">
        <div role="button" class="cursor-pointer flex flex-wrap items-start w-full border-0 outline-0" tabindex="-1">
            <span class="text-sm text-gray-400 select-none" x-show="isEmpty()" x-text="getPlaceholder"></span>

            <span class="text-sm text-secondary-600 dark:text-secondary-400"
                x-show="!config.multiselect && isNotEmpty()" x-html="getSelectedDisplayText()"></span>

            <div class="w-full flex flex-wrap items-start" x-show="config.multiselect && isNotEmpty()">
                <div class="flex flex-wrap items-start w-full gap-2 hide-scrollbar">
                    @unless ($withoutItemsCount)
                        <span class="inline-flex text-sm select-none text-secondary-700 dark:text-secondary-400"
                            x-show="selectedOptions.length" x-text="selectedOptions.length"></span>
                    @endunless

                    <div wire:ignore class="flex items-start w-full gap-1"
                        :class="{
                            'flex-col': selectedOptions.length === 1,
                            'flex-wrap': selectedOptions.length > 1
                        }">
                        <template x-for="(option, index) in selectedOptions"
                            :key="`selected.${index}.${option.value}.${option.label}`">
                            <div class="w-full">
                                <span
                                    class="w-full inline-flex justify-between items-center py-0.5 px-2 rounded-full text-xs font-medium truncate
                                bg-primary-100 text-primary-700 dark:bg-primary-700 dark:text-white shadow">

                                    <span style="max-width: 6rem" class="select-none " x-text="option.label"></span>

                                    <button
                                        class="mx-2 text-xs flex items-center justify-center text-primary-500 hover:text-primary-700"
                                        x-on:click.stop="unSelect(option)" tabindex="-1" type="button"
                                        x-show="config.clearable && !(config.readonly || config.disabled)">
                                        <x-dynamic-component :component="WireUi::component('icon')" class="w-3 h-3" name="x-mark" />
                                    </button>
                                </span>
                            </div>
                        </template>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="append" class="flex items-center pr-2.5 gap-x-1">
        @if ($clearable && !$readonly && !$disabled)
            <button class="cursor-pointer" x-show="isNotEmpty()" x-on:click.stop="clear" tabindex="-1" type="button"
                x-cloak>
                <x-dynamic-component :component="WireUi::component('icon')" class="w-4 h-4 text-secondary-400 hover:text-negative-400"
                    name="x-mark" />
            </button>
        @endif

        <button class="cursor-pointer" tabindex="-1" type="button">
            <x-dynamic-component :component="WireUi::component('icon')" class="w-5 h-5 text-secondary-400" :name="$rightIcon" />
        </button>
    </x-slot>

    <x-slot:after>
        <x-dynamic-component :component="WireUi::component('popover')" :margin="(bool) $label" class="w-full overflow-visible select-none"
            x-ref="optionsContainer" tabindex="-1">
            <div class="px-2 my-2" wire:key="search.options.{{ $name }}"
                x-show="asyncData.api || (config.searchable && options.length >= @js($minItemsForSearch))">
                <x-dynamic-component :component="WireUi::component('input')" class="bg-slate-100" x-ref="search"
                    x-model.debounce.500ms="search" shadowless right-icon="magnifying-glass" :placeholder="trans('wireui::messages.search_here')"
                    type="search" />
            </div>

            <div class="overflow-y-auto select-none max-h-60 snap-y  overscroll-auto soft-scrollbar" tabindex="-1"
                name="wireui.select.options.{{ $name }}">
                <ul x-ref="listing" wire:ignore>
                    <template x-for="(option, index) in displayOptions" :key="`${index}.${option.value}`">
                        <li tabindex="-1" :index="index"
                            class="px-2 py-2 cursor-pointer rounded-md transition-all duration-150 text-sm"
                            x-on:click="toggleOption(option)">
                            <span x-text="option.label"></span>
                        </li>
                    </template>
                </ul>

                @unless ($hideEmptyMessage)
                    <div class="px-3 py-12 text-center sm:py-2 sm:px-3 sm:text-left text-secondary-500 cursor-pointer"
                        x-show="displayOptions.length === 0" x-on:click="search ? resetSearch() : positionable.close()">
                        {{ $emptyMessage ?? trans('wireui::messages.empty_options') }}
                    </div>
                @endunless
            </div>
        </x-dynamic-component>
    </x-slot:after>
</x-dynamic-component>
