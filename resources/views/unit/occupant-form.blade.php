<x-entity-form :model="$unit" :action="$action" :return-url="route('unit.index')">
    <div class="row mt-3">
        
        @if ($unit->occupied && !auth()->user()->hasRole('admin'))
            <div class="col-12 col-md-4">
                <x-input-label class="label-" for="occupant" :value="__('Occupant')" />
                <x-text-input id="occupant" name="occupant" class="block mt-1 w-full" :icon="'ph-user'" :value="old('occupant', optional($unit->occupied)->full_name ?? optional($unit->occupied)->name)"
                    disabled />
                <x-input-error :messages="$errors->get('occupant')" class="mt-2" />

            </div>
        @else
            {{-- Assigned Tenant or Owner to Unit --}}
            <div class="col-12 col-md-4 flex items-start">
                <x-select :label="'Select Tenant or Owner'" :icon="'ph-user-circle'" name="occupant_id" id="occupant_id">
                    <option value=""
                        {{ old('occupant_id', optional($unit)->occupant_id) == '' ? 'selected' : '' }}>
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
        @endif







        {{-- Move Status --}}
        <div class="col-12 col-md-4">
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
        <div class="col-12 col-md-4">
            <x-input-label for="move_date" :value="__('Move Date')" />
            <x-date-picker name="move_date" id="move_date" icon="ph-calendar"
                value="{{ old('move_date', optional($unit)->move_in_date ? optional($unit)->move_in_date->format('Y-m-d') : '') }}"
                :error="$errors->first('move_date')" />
            <x-input-error :messages="$errors->get('move_date')" class="mt-2" />
        </div>



    </div>




</x-entity-form>
