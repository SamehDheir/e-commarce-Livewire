    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        @if ($showTable)
                            <button wire:click="showForm" class="btn btn-primary">Add Category</button>
                        @else
                            <button wire:click="$set('showTable', true)" class="btn btn-danger">Cancle</button>
                        @endif
                    </div>
                    <span>{{ $countCategory }}</span>
                </div>
            </div>
            <div class="card-body" wire:poll.keep-alive-4s>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($showTable)
                    <div class="table-responsive">

                        <table class="table" wire:poll-4s>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Photo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($countCategory > 0)
                                    @foreach ($categories as $item)
                                        <tr wire:key={{ $item->id }}>
                                            <td>{{ $i++ }}</td>
                                            @if ($categoryIdToEdit == $item->id)
                                                <td>
                                                    <input class="form-control mb-2" type="text" wire:model="name">
                                                    @error('name')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="form-control mb-2" type="text"
                                                        wire:model="description">
                                                    @error('description')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="file" class="mb-2" wire:model='image'>
                                                    @error('image')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <button wire:click='update({{ $item->id }})' class="btn">
                                                        <i class="bi bi-check-circle-fill text-success"
                                                            style="font-size: 20px"></i>
                                                    </button>
                                                    <button wire:click='cancleEdit' class="btn">
                                                        <i class="bi bi-x-circle text-danger"
                                                            style="font-size: 20px"></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $item->image) }}" alt="">
                                                </td>
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
                                @else
                                    <tr class="text-center">
                                        <td colspan="6">No Data Yet 🌝</td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>
                    @else
                        {{-- Add Category --}}
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Category</h4>
                                    <form wire:submit.prevent='create' class="forms-sample">
                                        <div class="form-group mb-1 mt-4">
                                            <label for="exampleInputName1">Name</label>
                                            <input type="text" wire:model='name' class="form-control"
                                                id="exampleInputName1" placeholder="Name">
                                        </div>
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div class="form-group mb-1 mt-4">
                                            <label for="exampleInputName1">Description</label>
                                            <input type="text" wire:model='description' class="form-control"
                                                id="exampleInputName1" placeholder="Name">
                                        </div>
                                        @error('description')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div class="form-group mb-2 mt-4">
                                            <label for="exampleFormControlSelect2">Image</label>
                                            <input type="file" wire:model='image' class="form-control">
                                        </div>
                                        @if ($image)
                                            <img src="{{ $image->temporaryUrl() }}" class="my-4" width="200px"
                                                height="200px" alt="Uploaded Image">
                                        @endif

                                        <br>
                                        @error('image')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- Add Category --}}
                    </div>

                @endif

                @if ($showTable)
                    <br />
                    {{ $categories->links() }}
                @endif
            </div>
        </div>
    </div>
