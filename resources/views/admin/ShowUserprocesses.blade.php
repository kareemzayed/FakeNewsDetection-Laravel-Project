<div class="pd-20">
    <h4 class="text-blue h4">{{ $userName }}'s Processes</h4>
</div>

<table class="data-table table hover multiple-select-row nowrap">
    <thead>
        <tr>
            <th>ID</th>
            <th>Process text</th>
            <th>Result</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($processes as $process)
            <tr>
                <td>{{ $process->id }}</td>
                <td class="processText" data-fulltext="{{ $process->processText }}">
                    {{ $process->processText }}
                </td>
                <td>
                    @if ($process->result === 1)
                        <span class="badge badge-success">Real</span>
                    @else
                        <span class="badge badge-danger">Fake</span>
                    @endif
                </td>
                <td>{{ date('d/ m/ Y', strtotime($process->created_at)) }}</td>
                <td>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                            role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">

                            <form action="{{ route('delete-process', ['id' => $process->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item"><i class="dw dw-delete-3"></i>
                                    Delete</button>
                            </form>

                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    const processTextElements = document.querySelectorAll('.processText');

    processTextElements.forEach(element => {
        element.addEventListener('click', () => {
            element.classList.toggle('full');
        });
    });
</script>
