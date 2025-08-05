<x-entity-form :model="$unit" :action="$action" :return-url="route('unit.index')">

    <div class="row mt-3">

        <div class="col-12 col-md-6 flex items-start">
            <x-select :label="'Select Tenant or Owner'" :icon="'ph-user-circle'" name="occupant_id" id="occupant_id">
                <option value="" {{ old('occupant_id', optional($unit)->occupant_id) == '' ? 'selected' : '' }}>
                    No Occupant
                </option>

                @foreach ($ownersAndTenants as $occupant)
                    <option value="{{ $occupant->id }}"
                        {{ old('occupant_id', optional($unit)->occupant_id) == $occupant->id ? 'selected' : '' }}>
                        {{ ucwords("{$occupant->first_name} {$occupant->last_name}") }}
                        ({{ $occupant->roles->pluck('name')->implode(', ') }})
                    </option>
                @endforeach
            </x-select>

            <x-input-error :messages="$errors->get('occupant_id')" class="mt-2" />

        </div>



        {{-- Tenant Manager --}}
        <div class="col-12 col-md-6 flex items-start">
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
