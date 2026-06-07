<x-validation.error />
<table class="DataTable_activation">
    <thead>
    <tr>
        <th class="no-sort">
            <div class="mark-all-checkbox">
                <input type="checkbox" class="all-checkbox">
            </div>
        </th>
        <th>{{__('ID')}}</th>
        <th>{{__('Neighborhood')}}</th>
        <th>{{__('City')}}</th>
        <th>{{__('State')}}</th>
        <th>{{__('Country')}}</th>
        <th>{{__('Status')}}</th>
        <th>{{__('Action')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($all_neighborhoods as $neighborhood)
        <tr>
            <td>
                <x-bulk-action.bulk-delete-checkbox :id="$neighborhood->id"/>
            </td>
            <td>{{ $neighborhood->id }}</td>
            <td>{{ $neighborhood->name }}</td>
            <td>{{ optional($neighborhood->city)->city }}</td>
            <td>{{ optional($neighborhood->state)->state }}</td>
            <td>{{ optional($neighborhood->country)->country }}</td>
            <td>
                <x-status.table.active-inactive :status="$neighborhood->status"/>
            </td>
            <td>
                <x-status.table.select-action :title="__('Select Action')"/>
                <ul class="dropdown-menu status_dropdown__list">
                    @can('city-edit')
                    <li class="status_dropdown__item">
                        <a class="btn dropdown-item status_dropdown__list__link edit_neighborhood_modal"
                           data-bs-toggle="modal"
                           data-bs-target="#editNeighborhoodModal"
                           data-neighborhood="{{ $neighborhood->name }}"
                           data-neighborhood_id="{{ $neighborhood->id }}"
                           data-city_id="{{ $neighborhood->city_id }}"
                           data-state_id="{{ $neighborhood->state_id }}"
                           data-country_id="{{ $neighborhood->country_id }}">
                            {{ __('Edit Neighborhood') }}
                        </a>
                    </li>
                    @endcan
                    @can('city-delete')
                    <li class="status_dropdown__item">
                        <x-popup.delete-popup :title="__('Delete Neighborhood')" :url="route('admin.neighborhood.delete',$neighborhood->id)"/>
                    </li>
                    @endcan
                    @can('city-status-change')
                    <li class="status_dropdown__item">
                        <x-status.table.status-change :title="__('Change Status')" :url="route('admin.neighborhood.status',$neighborhood->id)"/>
                    </li>
                    @endcan
                </ul>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<x-pagination.laravel-paginate :allData="$all_neighborhoods"/>
