@extends('management.layout.main')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="page-titles">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Company</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List hiring</li>
                </ol>
            </nav>
        </div>

    </div>
    <div class="col-lg-12">
        <div>
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                Add Employee
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <label class="form-label">Name</label>
            <input type="text" class="form-control mb-xl-0 mb-3" id="searchName" placeholder="Name">
        </div>
        <div class="col-xl-3 col-sm-6">
            <label class="form-label">Email</label>
            <input type="text" class="form-control mb-xl-0 mb-3" id="searchEmail" placeholder="Email">
        </div>
        <div class="col-xl-3 col-sm-6 align-self-end">
            <div>
                <button class="btn btn-primary me-2" title="Click here to Search" type="button"><i class="fa-sharp fa-solid fa-filter me-2"></i>Filter</button>
                <button class="btn btn-danger light" title="Click here to remove filter" type="button" id="removeFilter">Remove Filter</button>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/company/create-hiring" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="Name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="First Name" value="{{ old('user_name') }}">
                            @if ($errors->has('user_name'))
                            <div class="text-danger">{{ $errors->first('user_name') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            @if ($errors->has('password'))
                            <div class="text-danger">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                            @if ($errors->has('password_confirmation'))
                            <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Add Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">UpdateEmployee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/company/update-hiring" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="Name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name_update" id="name_update" placeholder="First Name" value="{{ old('name_update') }}">
                        @error('name_update')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email_update" id="email_update" placeholder="name@example.com" value="{{ old('email_update') }}">
                        @error('email_update')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password_update" id="password_update" placeholder="Password">
                        @error('password_update')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_update_confirmation" id="password_update_confirmation" placeholder="Confirm Password">
                        @error('password_update_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update Employee</button>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
<div class="card-body">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0 table-striped order-table">
                        <thead>
                            <tr>
                                <th class=" pe-3">
                                    <div class="form-check custom-checkbox mx-2">
                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created_at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        @foreach($hirings as $hiring)
                        <tbody id="customers">
                            <tr class="btn-reveal-trigger">
                                <td class="py-2">
                                    <div class="form-check custom-checkbox mx-2">
                                        <input type="checkbox" class="form-check-input" id="checkbox1">
                                        <label class="form-check-label" for="checkbox1"></label>
                                    </div>
                                </td>
                                <td class="py-2">
                                    <a href="#">
                                        <div class="media d-flex align-items-center">
                                            <div class=" avatar-xl me-2">
                                                <div class=""><img class="rounded-circle img-fluid"
                                                        src="../images/avatar/5.png" width="30" alt="">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-0 fs--1">{{$hiring->user->user_name}}</h6>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                                <td class="py-2"><a href="mailto:ricky@example.com">{{$hiring->user->email}}</a></td>
                                <td class="py-2">{{$hiring->user->created_at}}</td>
                                <td class="py-2 text-end">
                                    <div class="ms-auto">

                                        <a
                                            class="btn btn-primary btn-xs sharp me-1 editBtn" data-id="{{$hiring->user->id}}" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        <form action="/company/delete-hiring/{{$hiring->user->id}}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs sharp">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        </tbody>
                        @endforeach
                    </table>
                    <div class="mt-4 d-flex justify-content-between align-items-center">
                        <p>Hiển thị từ {{ $hirings->firstItem() }} đến {{ $hirings->lastItem() }} trong tổng số {{ $hirings->total() }} nhân viên.</p>
                        {{ $hirings->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@if($errors->has('user_name') || $errors->has('email') || $errors->has('password'))
<script>
    $(document).ready(function() {
        $('#addEmployeeModal').modal('show');
    });
</script>
@endif

@if($errors->has('name_update') || $errors->has('email_update') || $errors->has('password_update'))
<script>
    $(document).ready(function() {
        $('#editEmployeeModal').modal('show');
    });
</script>
@endif
<script>
    $(document).ready(function() {
        $('.editBtn').on('click', function() {
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: '/company/edit-hiring/' + id,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#name_update').val(data.user_name);
                    $('#email_update').val(data.email);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

        $('#removeFilter').click(function() {
            $('#searchName').val('');
            $('#searchEmail').val('');
            $('#searchDate').val('');
            console.log('Removing Filter');

        });
    });
</script>
@endsection