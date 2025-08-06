@extends('layouts.app')

@section('banner')
    <x-banner :current-page="$title"></x-banner>
@endsection

@section('content')
    <x-filters :action="route('property.index')" :users="null" :has-daterange="false" :has-user-type="false" :has-search="true" :search-placeholder="'Property Name'">
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
                                    <th>Floor</th>
                                    <th>Status</th>
                                    <th>Number of Units</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($units->count() > 0)
                                    @foreach ($units as $index => $unit)
                                        <tr>
                                            <td>{{ $units->firstItem() + $index }}</td>
                                            <td>{{ $unit->property->name ?? 'N/A' }}</td>

                                            <td>{{ $unit->property->location ?? 'N/A' }}</td>
                                            <td>{{ $unit->property->building ?? 'N/A' }}</td>

                                            <td>
                                                {{ $unit->floor }}
                                            </td>

                                            <td>
                                                @if ($unit->status === 'occupied')
                                                    <span class="badge bg-success bg-opacity-10 text-success">owned</span>
                                                @else
                                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">not
                                                        owned</span>
                                                @endif

                                            </td>

                                            <td>{{ $unit->property->units_count ?? 'N/A' }}</td>
                                            <td>
                                                <x-entity-actions :edit="false" :view-route="route('occupant.show', $unit)" :no-edit="true"
                                                    :edit-id="$unit->id" :entity-id="$unit->id" :view-unit="true">
                                                </x-entity-actions>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">No Units Available</td>
                                    </tr>
                                @endif


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
