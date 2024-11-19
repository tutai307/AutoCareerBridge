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
                            <th>Tên đầy đủ</th>
                            <th>Tên đăng nhập</th>
                            <th>Email</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                  
                    <tbody id="customers">
                        @forelse($hirings as $hiring)
                        <tr class="btn-reveal-trigger">
                     
                            <td><img class="rounded-circle" width="45" height="45" src=" {{ asset('storage/' . $hiring->avatar_path) }}"
                            alt=""></td>
                           
                            <td class="py-2">{{$hiring->full_name}}</td>
                            <td class="py-2">{{$hiring->user->user_name}}</td>
                            <td class="py-2">{{$hiring->user->email}}</td>
                            <td class="py-2">{{$hiring->user->created_at}}</td>
                            <td class="py-2 text-end">
                                <div class="ms-auto">
                                    <a
                                        class="btn btn-primary btn-xs sharp me-1 editBtn" data-id="{{$hiring->user->id}}" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <button type="button" class="btn btn-danger btn-xs sharp" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{$hiring->user->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>

                            <!-- Modal Xác Nhận -->
                            <div class="modal fade" id="deleteConfirmationModal{{$hiring->user->id}}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteConfirmationModalLabel">Xác Nhận Xóa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn có chắc chắn muốn xóa bản ghi này không?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                            <form action="/company/delete-hiring/{{$hiring->user->id}}" id="" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <td colspan="6" class="text-center">Không có dữ liệu</td>           
                        @endforelse



                    </tbody>
                </table>
                <div id="pagination" class="mt-4 d-flex justify-content-between align-items-center">
        <p>Hiển thị từ {{ $hirings->firstItem() }} đến {{ $hirings->lastItem() }} trong tổng số {{ $hirings->total() }} bài viết.</p>
        {{ $hirings->links('pagination::bootstrap-4') }}
    </div>
            </div>

        </div>

    </div>

</div>