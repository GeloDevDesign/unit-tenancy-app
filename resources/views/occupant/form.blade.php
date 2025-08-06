<x-entity-form :show-action="false" :model="$unit" :action="$action" :return-url="route('occupant.index')">

    <div class="row mt-3">
        <!-- Property Name -->
        <div class="col-12 col-md-3">
            <x-input-label class="label-" for="name" :value="__('Name')" />
            <x-text-input readonly id="name" name="name" class="block mt-1 w-full" :icon="'ph-buildings'"
                :value="optional($unit)->property->name ? optional($unit)->property->name : old('name')" :error="$errors->get('name')" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Property Location -->
        <div class="col-12 col-md-3">
            <x-input-label class="label-" for="location" :value="__('Location')" />
            <x-text-input readonly id="location" name="location" class="block mt-1 w-full" :icon="'ph-navigation-arrow'"
                :value="optional($unit)->property->location ? optional($unit)->property->location : old('location')" :error="$errors->get('location')" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        {{-- Building --}}
        <div class="col-12 col-md-3">
            <x-input-label class="label-" for="building" :value="__('Building')" />
            <x-text-input readonly id="location" name="building" class="block mt-1 w-full" :icon="'ph-buildings'"
                :value="optional($unit)->property->building ? optional($unit)->property->building : old('building')" :error="$errors->get('building')" />
            <x-input-error :messages="$errors->get('building')" class="mt-2" />
        </div>

        {{-- Status --}}
        <div class="col-12 col-md-3">
            <x-input-label class="label-" for="status" :value="__('Status')" />
            <div class="block mt-1 w-full py-2" style="min-height: 42px;">
                @php
                    $status = optional($unit)->status ?? 'N/A';
                @endphp

                @if ($unit->status === 'occupied')
                    <span class="badge bg-success bg-opacity-10 text-success">owned</span>
                @else
                    <span class="badge bg-secondary bg-opacity-10 text-secondary">not owned</span>
                @endif
            </div>
        </div>


    </div>

</x-entity-form>
