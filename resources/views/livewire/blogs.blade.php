    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        @if ($showTable)
                            <button wire:click="showForm" class="btn btn-primary">Add Blog</button>
                        @else
                            <button wire:click="$set('showTable', true)" class="btn btn-danger">Cancle</button>
                        @endif
                    </div>
                    <span>{{ $countblogs }}</span>
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
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Auhter</th>
                                    <th>Photo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($countblogs > 0)
                                    @foreach ($blogs as $blog)
                                        <tr wire:key={{ $blog->id }}>
                                            <td>{{ $i++ }}</td>
                                            @if ($blogIdToEdit == $blog->id)
                                                <td>
                                                    <input class="form-control mb-2" type="text" wire:model="title">
                                                    @error('title')
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
                                                    <input class="form-control mb-2" type="text" wire:model="auther">
                                                    @error('auther')
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
                                                    <button wire:click='update({{ $blog->id }})' class="btn">
                                                        <i class="bi bi-check-circle-fill text-success"
                                                            style="font-size: 20px"></i>
                                                    </button>
                                                    <button wire:click='cancleEdit' class="btn">
                                                        <i class="bi bi-x-circle text-danger"
                                                            style="font-size: 20px"></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td>{{ $blog->title }}</td>
                                                <td>{{ $blog->description }}</td>
                                                <td>{{ $blog->auther }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="">
                                                </td>
                                                <td>
                                                    <span wire:click='showComment({{ $blog->id }})'
                                                        class="border-1 mx-1 p-2 rounded fs-1 btn-warning "
                                                        style="cursor: pointer">
                                                        Comments
                                                    </span>
                                                </td>
                                                <td>
                                                    <span wire:click='delete({{ $blog->id }})'
                                                        class="border-1 mx-1 p-2 rounded fs-1 btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </span>
                                                    <span wire:click.prevent='edit({{ $blog->id }})'
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
                    </div>
                @else
                    {{-- Add Auther --}}
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Auther</h4>
                                <form wire:submit.prevent='create' class="forms-sample">
                                    <div class="form-group mb-1 mt-4">
                                        <label for="exampleInputName1">Title</label>
                                        <input type="text" wire:model='title' class="form-control"
                                            id="exampleInputName1" placeholder="Title">
                                    </div>
                                    @error('title')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <div class="form-group mb-1 mt-4">
                                        <label for="exampleInputName1">Description</label>
                                        <input type="text" wire:model='description' class="form-control"
                                            id="exampleInputName1" placeholder="Description">
                                    </div>
                                    @error('description')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <div class="form-group mb-1 mt-4">
                                        <label for="exampleInputName1">Auther</label>
                                        <input type="text" wire:model='auther' class="form-control"
                                            id="exampleInputName1" placeholder="Auther">
                                    </div>
                                    @error('auther')
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
                    {{-- Add Auther --}}

                @endif

                @if ($showTable)
                    <br />
                    {{ $blogs->links() }}
                @endif
            </div>
        </div>
    </div>
