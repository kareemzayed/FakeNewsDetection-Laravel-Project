<div class="pd-20">
    <h4 class="text-blue h4">{{ $user->name }}</h4>
</div>

<table class="data-table table hover multiple-select-row nowrap">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Number of processes</th>
            <th>jop title</th>
            <th>Data of birth</th>
            <th>Gender</th>
            <th>Phone number</th>
            <th>Address</th>
            <th>Joined at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="table-plus">{{ $user->id }}</td>
            <td class="table-plus">{{ $user->name }}</td>
            <td class="table-plus">{{ $user->email }}</td>
            <td>
                @if ($user->admin === 0)
                    <span class="badge badge-success">User</span>
                @else
                    <span class="badge badge-danger">Admin</span>
                @endif
            </td>
            <td class="table-plus"><a href="#" style="text-decoration: underline; color:blue"
                    onclick="loadProcesses(event, {{ $user->id }})">
                    {{ $user->processes_count }} </a>
            </td>
            <td class="table-plus">{{ $user->jop_title }}</td>
            <td class="table-plus">{{ date('d/ m/ Y', strtotime($user->data_of_birth)) }}
            </td>

            <td class="table-plus">
                @if ($user->gender === 'm')
                    Male
                @elseif($user->gender === 'f')
                    Female
                @endif
            </td>

            <td class="table-plus">{{ $user->phone_number }}</td>
            <td class="processText" data-fulltext="{{ $user->address }}">
                {{ $user->address }}</td>
            <td>{{ date('d/ m/ Y', strtotime($user->created_at)) }}</td>
            <td>
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                        role="button" data-toggle="dropdown">
                        <i class="dw dw-more"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">

                        <form action="{{ route('delete-user', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item"><i class="dw dw-delete-3"></i> Delete</button>
                        </form>

                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
