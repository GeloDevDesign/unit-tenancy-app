<x-entity-form :model="$unit" :action="$action" :return-url="route('unit.index')">

    <div class="row mt-3">

        {{-- Unit Number --}}
        <div class="col-12 col-md-3">
            <x-input-label class="label-" for="unit_number" :value="__('Unit Number')" />
            <x-text-input id="unit_number" name="unit_number" class="block mt-1 w-full" :icon="'ph-buildings'" :value="old('unit_number', optional($unit)->unformattedId ?? $nextUnitNumber)"
                :error="$errors->get('unit_number')" />
            <x-input-error :messages="$errors->get('unit_number')" class="mt-2" />
        </div>

        {{-- Floor --}}
        <div class="col-12 col-md-3">
            <x-input-label class="label-" for="floor" :value="__('Floor')" />
            <x-text-input id="floor" name="floor" class="block mt-1 w-full" :icon="'ph-buildings'" :value="old('floor', optional($unit)->floor)"
                :error="$errors->get('floor')" />
            <x-input-error :messages="$errors->get('floor')" class="mt-2" />
        </div>

        {{-- Property --}}
        <div class="col-12 col-md-3 flex items-start">
            <x-select :label="'Property'" :icon="'ph-buildings'" name="property_id" id="property_id">
                @foreach ($properties as $property)
                    <option value="{{ $property->id }}"
                        {{ old('property_id', optional($unit)->property_id) == $property->id ? 'selected' : '' }}>
                        {{ ucwords($property->name) }} - {{ ucwords($property->building) }}
                    </option>
                @endforeach
            </x-select>
            <x-input-error :messages="$errors->get('property_id')" class="mt-2" />
        </div>

        {{-- Building --}}
        <div class="col-12 col-md-3 flex items-start">
            <x-select :label="'Building'" :icon="'ph-buildings'" name="building" id="building">
                @foreach ($buildingNumber as $building)
                    <option value="{{ $building->building }}">
                        {{ ucwords($building->building) }}
                    </option>
                @endforeach
            </x-select>
            <x-input-error :messages="$errors->get('building')" class="mt-2" />
        </div>
    </div>

    <div class="row mt-3">

        {{-- Capacity Count --}}
        <div class="col-12 col-md-4">
            <x-input-label class="label-" for="capacity_count" :value="__('Capacity Count')" />
            <x-text-input id="capacity_count" name="capacity_count" class="block mt-1 w-full" :icon="'ph-buildings'"
                :value="old('capacity_count', optional($unit)->capacity_count)" :error="$errors->get('capacity_count')" />
            <x-input-error :messages="$errors->get('capacity_count')" class="mt-2" />
        </div>

        {{-- SQM Size --}}
        <div class="col-12 col-md-4">
            <x-input-label class="label-" for="sqm_size" :value="__('Square Meter')" />
            <x-text-input id="sqm_size" name="sqm_size" class="block mt-1 w-full" :icon="'ph-buildings'" :value="old('sqm_size', optional($unit)->sqm_size)"
                :error="$errors->get('sqm_size')" />
            <x-input-error :messages="$errors->get('sqm_size')" class="mt-2" />
        </div>

        {{-- Tenant Manager --}}
        <div class="col-12 col-md-4 flex items-start">
            <x-select :label="'Assigned Tenant Manager'" :icon="'ph-user-circle'" name="tenant_manager" id="tenant_manager">
                @foreach ($tenantManagers as $manager)
                    <option value="{{ $manager->id }}"
                        {{ old('tenant_manager', optional($unit)->tenant_manager_id) == $manager->id ? 'selected' : '' }}>
                        {{ ucwords("{$manager->first_name} {$manager->last_name}") }} ({{ $manager->email }})
                    </option>
                @endforeach
            </x-select>
            <x-input-error :messages="$errors->get('tenant_manager')" class="mt-2" />
        </div>

    </div>

</x-entity-form>
