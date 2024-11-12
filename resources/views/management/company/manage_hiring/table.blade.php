@foreach($hirings as $hiring)
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
@endforeach