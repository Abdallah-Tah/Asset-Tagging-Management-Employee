<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Setting Sites') }}
            </h2>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Setting Sites') }}</h3>
                </div>
                <div class="card-body">
                    <!-- Button trigger manage sites modal -->
                    <button type="button"
                        class="btn btn-purple bg-purple-500 text-white hover:bg-purple-600 focus:ring-purple-500"
                        data-toggle="modal" data-target="#manageSitesModal">
                        {{ __('Manage Sites') }}
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="manageSitesModal" tabindex="-1" role="dialog"
                        aria-labelledby="manageSitesModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="manageSitesModalLabel">Manage Sites</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('setting-sites.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ __('Select Sites') }}</label>
                                            <select class="select2 select2-hidden-accessible" multiple="multiple"
                                                name="amazon_site_id[]" id="myselect" data-placeholder="Assign Sites"
                                                style="width: 100%;">
                                                @foreach ($amazonSite_select as $site)
                                                    <option value="{{ $site->id }}">{{ $site->location }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">{{ __('Status') }}</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="1">{{ __('Completed') }}</option>
                                                <option value="2">{{ __('Pending') }}</option>
                                                <option value="3">{{ __('In Progress') }}</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button"
                                                class="btn btn-gray bg-gray-500 text-white hover:bg-gray-600 focus:ring-gray-500"
                                                data-dismiss="modal">Close</button>
                                            <button
                                                class="btn btn-green bg-green-500 text-white hover:bg-green-600 focus:ring-green-500">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <div style="clear: both;margin-top: 18px;">
                            <table id="dataTable" class="table-bordered table-striped table-hover" cellspacing="0"
                                width="100%"
                                data-export-title="Exported data on {{ \carbon\carbon::now()->format('d/m/Y') }}">
                                <thead class="p-3 mb-2 text-dark">
                                    <tr class="text-center">
                                        <th>{{ __('Location') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($amazonSites as $value)
                                        <tr class="text-center">
                                            <?php
                                            $amazon_site_id = json_decode($value->amazon_site_id);
                                            $items = DB::table('amazon_sites')
                                                ->whereIn('id', $amazon_site_id)
                                                ->get();
                                            ?>
                                            <td>
                                                @foreach ($items as $item)
                                                    {{ $item->location }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($value->status == 'completed')
                                                    <span class="badge badge-success">{{ __('Completed') }}</span>
                                                @elseif ($value->status == 'pending')
                                                    <span class="badge badge-warning">{{ __('Pending') }}</span>
                                                @elseif ($value->status == 'in-progress')
                                                    <span class="badge badge-info">{{ __('In Progress') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('setting-sites.edit', $value->id) }}"
                                                    class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                                                <a href="{{ route('setting-sites.destroy', $value->id) }}"
                                                    class="btn btn-sm btn-danger">{{ __('Delete') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var values = $('#myselect option[selected="true"]').map(function() {
            return $(this).val();
        }).get();
        $('#myselect').select2({
            placeholder: "Please select"
        });
    </script>
</x-app-layout>
