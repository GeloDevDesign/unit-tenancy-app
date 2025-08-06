<x-entity-form :model="$unit" :action="$action" :return-url="route('unit.index')">

    <div class="row mt-3">
        {{-- Assigned Tenant or Owner to Unit --}}
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


    {{-- MOVE IN / MOVE OUT SECTION --}}
    <div class="row mt-3">
        {{-- Move Status --}}
        <div class="col-12 col-md-6">
            <x-input-label for="move_status" :value="__('Move Status')" />
            <x-select name="status" id="status" :icon="'ph-info'">
                <option value="move_in"
                    {{ old('move_status', $unit->move_status ?? '') == 'moved_in' ? 'selected' : '' }}>
                    Moved In</option>
                <option value="move_in"
                    {{ old('move_status', $unit->move_status ?? '') == 'moved_out' ? 'selected' : '' }}>
                    Moved Out</option>
            </x-select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        {{-- Move In Date --}}
        <div class="col-12 col-md-6">
            <x-input-label for="move_date" :value="__('Move Date')" />
            <x-date-picker name="move_date" id="move_date" icon="ph-calendar"
                value="{{ old('move_date', optional($unit)->move_in_date ? optional($unit)->move_in_date->format('Y-m-d') : '') }}"
                :error="$errors->first('move_date')" />
            <x-input-error :messages="$errors->get('move_date')" class="mt-2" />
        </div>

    </div>




</x-entity-form>
