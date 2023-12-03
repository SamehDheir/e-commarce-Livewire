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
                                <th>Price</th>
                                <th>Rate</th>
                                <th>Photo</th>
                                <th>Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr wire:key={{ $item->id }}>
                                    <td>{{ $i++ }}</td>
                                    @if ($productIdToEdit == $item->id)
                                        <td>
                                            <input class="form-control" type="text" wire:model="name">
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" wire:model="price">
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" wire:model="rate">
                                        </td>
                                        <td>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupFile01">Upload</label>
                                                <input type="file" wire:model="image" class="form-control"
                                                    id="inputGroupFile01">
                                            </div>
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
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->rate }}</td>
                                        <td>
                                            <img src="{{ asset('storage/images/' . $item->image) }}" alt="">
                                        </td>
                                        <td>{{ $item->category->name }}</td>
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
                {{ $products->links() }}
            </div>
        </div>
    </div>
