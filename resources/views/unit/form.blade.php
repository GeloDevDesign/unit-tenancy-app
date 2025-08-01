<x-entity-form :model="$property" :action="$action" :return-url="route('property.index')">

    <div class="row mt-3">

        <div class="col-12 col-md-4">
            <x-input-label class="label-" for="name" :value="__('Unit Number')" />
            <x-text-input id="unit_number" name="unit_number" class="block mt-1 w-full" :icon="'ph-buildings'" :value="optional($property)->unit_number ? optional($property)->name : old('unit_number')"
                :error="$errors->get('unit_number')" />
            <x-input-error :messages="$errors->get('unit_number')" class="mt-2" />
        </div>

        <div class="col-12 col-md-4">
            <x-input-label class="label-" for="name" :value="__('Floor')" />
            <x-text-input id="unit_number" name="unit_number" class="block mt-1 w-full" :icon="'ph-buildings'"
                :value="optional($property)->unit_number ? optional($property)->name : old('unit_number')" :error="$errors->get('unit_number')" />
            <x-input-error :messages="$errors->get('unit_number')" class="mt-2" />
        </div>

        <div class="col-12 col-md-4">
            <x-input-label class="label-" for="location" :value="__('Location')" />
            <x-text-input id="location" name="location" class="block mt-1 w-full" :icon="'ph-navigation-arrow'" :value="optional($property)->location ? optional($property)->location : old('location')"
                :error="$errors->get('location')" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

    </div>


    <div class="row mt-3">

        <div class="col-12 col-md-4">
            <x-input-label class="label-" for="name" :value="__('Capacity Count')" />
            <x-text-input id="unit_number" name="unit_number" class="block mt-1 w-full" :icon="'ph-buildings'"
                :value="optional($property)->unit_number ? optional($property)->name : old('unit_number')" :error="$errors->get('unit_number')" />
            <x-input-error :messages="$errors->get('unit_number')" class="mt-2" />
        </div>

        <div class="col-12 col-md-4">
            <x-input-label class="label-" for="name" :value="__('Square Meter')" />
            <x-text-input id="unit_number" name="unit_number" class="block mt-1 w-full" :icon="'ph-buildings'"
                :value="optional($property)->unit_number ? optional($property)->name : old('unit_number')" :error="$errors->get('unit_number')" />
            <x-input-error :messages="$errors->get('unit_number')" class="mt-2" />
        </div>

        <div class="col-12 col-md-4">
            <x-input-label class="label-" for="location" :value="__('Assigned Tenant')" />
            <x-text-input id="location" name="location" class="block mt-1 w-full" :icon="'ph-navigation-arrow'" :value="optional($property)->location ? optional($property)->location : old('location')"
                :error="$errors->get('location')" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>


    </div>


    <div class="row mt-3">

       

        

        <div class="col-12 col-md-12">
            <x-input-label class="label-" for="location" :value="__('Amenities')" />
            <x-text-input id="location" name="location" class="block mt-1 w-full" :icon="'ph-navigation-arrow'" :value="optional($property)->location ? optional($property)->location : old('location')"
                :error="$errors->get('location')" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>


    </div>

</x-entity-form>
