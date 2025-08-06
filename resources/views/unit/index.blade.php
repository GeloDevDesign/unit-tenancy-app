@extends('layouts.app')

@section('banner')
    <x-banner :current-page="$title"></x-banner>
@endsection

@section('content')
    <div class="text-end mb-4">
        <a href="{{ route('unit.create') }}">
            <x-button type=" button" class="btn-primary pull-right me-2" :action="'add'">
                Register New Unit
            </x-button>
        </a>
    </div>

    <x-filters :action="route('unit.index')" :has-search="true" :has-filters="true" :search-placeholder="'Property Name'">
    </x-filters>

    <div class="row">
        <div class="col-md-12">
            <x-admin-panel :has-per-page="true" :per-page-route="route('unit.index')" :filters="$filters">
                <div class="row">
                    <div class="col-md-12">
                        <x-table-container>
                            <thead class="table-head">
                                <tr>
                                    <th>#</th>
                                    <th>Unit Number</th>
                                    <th>Floor</th>
                                    <th>Capacity Count</th>
                                    <th>Square Meter</th>
                                    <th>Occupant Type</th>
                                    <th>Occupant</th>
                                    <th>Status</th>
                                    <th>Tenant Manager</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($units as $unit)
                                    <tr class="{{ $loop->iteration % 2 == 0 ? 'odd' : 'even' }} table-tr">
                                        <td class="table-td">{{ $loop->iteration }}</td>

                                        <td class="table-td">
                                            <a href="{{ route('unit.edit', $unit->id) }}">
                                                {{ $unit->unit_number }}
                                            </a>
                                        </td>

                                        <td class="table-td">
                                            {{ $unit->floor }}
                                        </td>

                                        <td class="table-td">
                                            {{ $unit->capacity_count }}
                                        </td>

                                        <td class="table-td">
                                            {{ $unit->sqm_size }}
                                        </td>

                                        <td class="table-td">
                                            {{ $unit->occupant_type }}
                                        </td>

                                        <td>
                                            {{ optional($unit->occupant)->first_name && optional($unit->occupant)->last_name
                                                ? optional($unit->occupant)->first_name . ' ' . optional($unit->occupant)->last_name
                                                : 'N/A' }}
                                        </td>


                                        <td class="table-td">

                                            @if ($unit->status === 'available')
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success">{{ $unit->status }}</span>
                                            @else
                                                <span
                                                    class="badge bg-secondary bg-opacity-10 text-secondary">{{ $unit->status }}</span>
                                            @endif

                                        </td>



                                        <td class="table-td">
                                            {{ $unit->tenantManager->first_name . ' ' . $unit->tenantManager->last_name }}
                                        </td>

                                        <td>
                                            <x-entity-actions :assign-occupant="true" :edit="route('unit.edit', $unit)" :occupant="route('unit.occupant', $unit)"
                                                :entity-id="'unit-' . $unit->id" :delete="route('unit.destroy', $unit)" :name="$unit->name" :show="route('unit.edit', $unit)">
                                            </x-entity-actions>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No Unit Available</td>
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
