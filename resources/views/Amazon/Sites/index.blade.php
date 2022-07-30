<x-app-layout>
    <x-slot name="header">
        {{-- <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Sites') }}
            </h2>
           
        </div> --}}

    </x-slot>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Amazon Sites') }}</h3>
                </div>
                <div class="card-body">
                    <!-- Button trigger modal -->
                    <button type="button"
                        class="btn btn-purple bg-purple-500 text-white hover:bg-purple-600 focus:ring-purple-500"
                        data-toggle="modal" data-target="#exampleModal">
                        {{ __('Add New') }}
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import File</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('amazon-sites.import') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="file"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Enter email">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                        class="btn btn-gray bg-gray-500 text-white hover:bg-gray-600 focus:ring-gray-500"
                                        data-dismiss="modal">Close</button>
                                    <button
                                        class="btn btn-green bg-green-500 text-white hover:bg-green-600 focus:ring-green-500">Upload</button>
                                </div>
                                </form>
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
                                        <th>{{ __('Region') }}</th>
                                        <th>{{ __('Location') }}</th>
                                        <th>{{ __('Address') }}</th>
                                        <th>{{ __('City') }}</th>
                                        <th>{{ __('State') }}</th>
                                        <th>{{ __('Zip') }}</th>
                                        <th>{{ __('Square Feet') }}</th>
                                        <th>{{ __('Labor Budget') }}</th>
                                        <th>{{ __('Labor Hours') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sites as $site)
                                        <tr>
                                            <td style="text-align:center">{{ $site->region }}</td>
                                            <td style="text-align:center">{{ $site->location }}</td>
                                            <td style="text-align:center; width:20%">{{ $site->address }}</td>
                                            <td style="text-align:center">{{ $site->city }}</td>
                                            <td style="text-align:center">{{ $site->state }}</td>
                                            <td style="text-align:center">{{ $site->zip }}</td>
                                            <td style="text-align:center">{{ $site->square_feet }}</td>
                                            <td style="text-align:center">${{ number_format($site->labor_budget, 2) }}</td>
                                            <td style="text-align:center">{{ $site->labor_hours }}</td>
                                            <td style="text-align:center">
                                                <a href="{{ route('amazon-sites.edit', $site->id) }}"
                                                    class="btn btn-sm btn-purple bg-purple-500 text-white hover:bg-purple-600 focus:ring-purple-500">{{ __('Edit') }}</a>
                                                <a href="{{ route('amazon-sites.destroy', $site->id) }}"
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

</x-app-layout>
