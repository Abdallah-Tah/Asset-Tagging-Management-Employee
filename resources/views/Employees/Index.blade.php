<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Sites') }}
            </h2>
        </div>

    </x-slot>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Employees') }}</h3>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Employees</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('employees.store') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ __('Name') }}</label>
                                            <input type="text" class="form-control" name="name"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Enter name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ __('Email') }}</label>
                                            <input type="email" class="form-control" name="email"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ __('Phone') }}</label>
                                            <input type="text" class="form-control" name="phone"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Enter phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ __('Address') }}</label>
                                            <input type="text" class="form-control" name="address"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Enter address">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ __('Amazon Sites') }}</label>
                                            <select class="select2 select2-hidden-accessible" multiple="multiple"
                                                name="amazon_site_id[]" id="myselect" data-placeholder="Assign Sites"
                                                style="width: 100%;">
                                                @foreach ($sites as $site)
                                                    <option value="{{ $site->id }}">{{ $site->location }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-gray" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary">Save</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-body table-responsive">
                        <div style="clear: both;margin-top: 18px;">
                            <table id="dataTable" class="table-bordered table-striped table-hover" cellspacing="0"
                                width="100%"
                                data-export-title="Exported data on {{ \carbon\carbon::now()->format('d/m/Y') }}">
                                <thead class="p-3 mb-2 text-dark">
                                    <tr class="text-center">
                                    <tr>
                                        <th style="width:20%; text-align:center">{{ __('Name') }}</th>
                                        <th style="width:20%; text-align:center">{{ __('Email') }}</th>
                                        <th style="width:20%; text-align:center">{{ __('Phone') }}</th>
                                        <th style="width:20%; text-align:center">{{ __('Address') }}</th>
                                        <th style="text-align:center">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr style="text-align:center">
                                            <td><a
                                                    href="{{ route('employees.show', $employee->id) }}">{{ $employee->name }}</a>
                                            </td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->phone }}</td>
                                            <td>{{ $employee->address }}</td>
                                            <td style="text-align:center">
                                                <button type="button"
                                                    class="btn btn-purple bg-purple-500 text-white hover:bg-purple-600 focus:ring-purple-500"
                                                    data-toggle="modal" data-target="#editModal">
                                                    {{ __('Edit') }}
                                                </button>
                                                <button type="button"
                                                    class="btn btn-danger bg-red-500 text-white hover:bg-red-600 focus:ring-red-500"
                                                    data-toggle="modal" data-target="#deleteModal">
                                                    {{ __('Delete') }}
                                                </button>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employees.update', $employee->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ $employee->name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Email') }}</label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ $employee->email }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Phone') }}</label>
                            <input type="text" class="form-control" name="phone" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ $employee->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Address') }}</label>
                            <input type="text" class="form-control" name="address" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ $employee->address }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Amazon Sites') }}</label>
                            <select class="select2 select2-hidden-accessible" multiple="multiple"
                                name="amazon_site_id[]" id="myselectedit" data-placeholder="Assign Sites"
                                style="width: 100%;">
                                @foreach ($sites as $site)
                                    <option value="{{  $site->id}}" {{ $employee->amazonSite()->first()->amazon_site_id  == $site->id ? 'selected' : '' }}>{{ $site->location }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gray" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <label
                                for="exampleInputEmail1">{{ __('Are you sure you want to delete this employee ' . $employee->name . '?') }}</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gray" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Delete</button>
                </div>
                </form>
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

        <script>
            var values = $('#myselectedit option[selected="true"]').map(function() {
                return $(this).val();
            }).get();
            $('#myselectedit').select2({
                placeholder: "Please select"
            });
        </script>

</x-app-layout>
