@extends('layouts.app')

@section('banner')
    <x-banner :current-page="$title"></x-banner>
@endsection

@section('content')
    <div class="text-end mb-4">
        <a href="{{ route('property.create') }}">
            <x-button type="button" class="btn-primary pull-right me-2" :action="'add'">
                Add New Property
            </x-button>
        </a>
    </div>

    <x-filters :action="route('property.index')" :users="$properties" :has-daterange="false" :has-user-type="false" :has-search="true" :search-placeholder="'Property Name'">
    </x-filters>

    <div class="row">
        <div class="col-md-12">
            <x-admin-panel :has-per-page="true" :per-page-route="route('property.index')" :filters="$filters">
                <div class="row">
                    <div class="col-md-12">
                        <x-table-container>
                            <thead class="table-head">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Building</th>
                                    <th>Occupied Units</th>
                                    <th>Number of Units</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($properties as $property)
                                    <tr class="{{ $loop->iteration % 2 == 0 ? 'odd' : 'even' }} table-tr">
                                        <td class="table-td">{{ $loop->iteration }}</td>

                                        <td class="table-td">
                                            <a href="{{ route('property.edit', $property->id) }}">
                                                {{ $property->name ?? 'N/A' }}
                                            </a>


                                        <td class="table-td">
                                            {{ $property->location ?? 'N/A' }}
                                        </td>



                                        </td>
                                        <td class="table-td">

                                            {{ $property->building ?? 'N/A' }}

                                        </td>
                                        <td class="table-td">
                                            {{ 0 }}
                                        </td>

                                        <td class="table-td">
                                            {{ $property->id }}
                                        </td>

                                        <td>
                                            <x-entity-actions :edit="route('property.edit', $property)" :entity-id="'property-' . $property->id" :delete="route('property.destroy', $property)"
                                                :name="$property->name" :show="route('property.edit', $property)">
                                            </x-entity-actions>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Property Available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </x-table-container>
                    </div>
                </div>
            </x-admin-panel>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.daterange-basic').daterangepicker({
            parentEl: '.content-inner',
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="date"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('input[name="date"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    </script>
@endsection
