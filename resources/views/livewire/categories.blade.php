    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                       {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr wire:key={{ $item->id }}>
                                    <td>{{ $i++ }}</td>
                                    @if ($categoryIdToEdit == $item->id)
                                        <td>
                                            <input class="form-control" type="text" wire:model="name">
                                        </td>
                                        <td>
                                            <textarea class="form-control" wire:model="description" rows="3"></textarea>

                                        </td>
                                        <td>
                                            <button wire:click='update({{ $item->id }})' class="btn">
                                                <i class="bi bi-check-circle-fill text-success"
                                                    style="font-size: 20px"></i>
                                            </button>
                                            <button wire:click='cancleEdit' class="btn">
                                                <i class="bi bi-x-circle text-danger" style="font-size: 20px"></i>
                                            </button>
                                        </td>
                                    @else
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <span wire:click='delete({{ $item->id }})'
                                                class="border-1 mx-1 p-2 rounded fs-1 btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </span>
                                            <span wire:click.prevent='edit({{ $item->id }})'
                                                class="border-1 mx-1 p-2 rounded fs-1 btn-primary">
                                                <i class="bi bi-pencil-square"></i>
                                            </span>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <br />
                {{ $categories->links() }}
            </div>
        </div>
    </div>
