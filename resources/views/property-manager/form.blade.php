<x-entity-form :model="$property" :action="$action" :return-url="route('property.index')">

    <div class="row mt-3">
        <!-- Property Name -->
        <div class="col-12 col-md-4">
            <x-input-label class="label-" for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" class="block mt-1 w-full" :icon="'ph-buildings'" :value="optional($property)->name ? optional($property)->name : old('name')"
                :error="$errors->get('name')" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Property Location -->
        <div class="col-12 col-md-4">
            <x-input-label class="label-" for="location" :value="__('Location')" />
            <x-text-input id="location" name="location" class="block mt-1 w-full" :icon="'ph-navigation-arrow'" :value="optional($property)->location ? optional($property)->location : old('location')"
                :error="$errors->get('location')" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <div class="col-12 col-md-4">
            <x-input-label class="label-" for="building" :value="__('Building')" />
            <x-text-input id="location" name="building" class="block mt-1 w-full" :icon="'ph-buildings'" :value="optional($property)->building ? optional($property)->building : old('building')"
                :error="$errors->get('building')" />
            <x-input-error :messages="$errors->get('building')" class="mt-2" />
        </div>

    </div>

</x-entity-form>
