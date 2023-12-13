    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="d-flex w-50 justify-content-between">
                        @if ($showTable)
                            <button wire:click="showForm" class="btn btn-primary">Add Product</button>
                            <div class=" w-75">
                                <div class="input-group">
                                    <input type="text" class="form-control" wire:model.live='search'
                                        placeholder="Search Product Live" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                </div>
                            </div>
                        @else
                            <button wire:click="$set('showTable', true)" class="btn btn-danger">Cancle</button>
                        @endif
                    </div>
                    <span>{{ $countProduct }}</span>
                </div>

            </div>
            <div class="card-body" wire:poll.keep-alive-4s>

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- Success Message --}}
                @if ($showTable)
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
                                @if ($countProduct > 0)
                                    @foreach ($products as $index => $item)
                                        <tr wire:key={{ $index }}>
                                            <td>{{ $i++ }}</td>

                                            @if ($productIdToEdit == $item->id)
                                                <td>
                                                    <input class="form-control mb-2" type="text" wire:model="name">
                                                    @error('name')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="form-control mb-2" type="text" wire:model="price">
                                                    @error('price')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="form-control mb-2" type="number" wire:model="rate">
                                                    @error('rate')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input multiple type="file" class="mb-2" wire:model='image'>
                                                    @error('image')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <div class="form-group mb-1 mt-4">
                                                        <select class="form-control" wire:model='category_id'
                                                            id="exampleFormControlSelect2">
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('category_id')
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
                                                <td>{{ $item->price }}</td>
                                                <td>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span
                                                            class="bi bi-star-fill{{ $i <= $item->rate ? ' checked' : '' }}"></span>
                                                    @endfor
                                                </td>
                                                {{-- <td>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <a
                                                            href="{{ route('products.rate', ['product' => $product, 'rating' => $i]) }}">
                                                            <span
                                                                class="fa fa-star{{ $i <= $product->rating ? ' checked' : '' }}"></span>
                                                        </a>
                                                    @endfor
                                                </td> --}}
                                                <td>
                                                    <img src="{{ asset('storage/' . $item->image) }}" alt="">
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
                                @else
                                    <tr class="text-center">
                                        <td colspan="6">No Data Yet 🌝</td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>
                    @else
                        {{-- Add Product --}}
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Product</h4>
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
                                            <label for="exampleInputEmail3">Price</label>
                                            <input type="number" wire:model='price' class="form-control"
                                                id="exampleInputEmail3" placeholder="Number">
                                        </div>
                                        @error('price')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div class="form-group mb-1 mt-4">
                                            <label for="exampleInputPassword4">Rate</label>
                                            <input type="number" wire:model='rate' class="form-control"
                                                id="exampleInputPassword4" placeholder="Rate">
                                        </div>
                                        @error('rate')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div class="form-group mb-1 mt-4">
                                            <label for="exampleFormControlSelect2">Default select</label>
                                            <select class="form-control" wire:model='category_id'
                                                id="exampleFormControlSelect2">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-2 mt-4">
                                            <label for="exampleFormControlSelect2">Image</label>
                                            <input multiple type="file" wire:model='image' class="form-control">
                                        </div>
                                        @if ($image)
                                            @foreach ($image as $item)
                                                <img src="{{ $item->temporaryUrl() }}" class="my-4" width="200px"
                                                    height="200px" alt="Uploaded Image">
                                            @endforeach
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
                        {{-- Add Product --}}
                    </div>

                @endif

                @if ($showTable)
                    <br />
                    {{ $products->links() }}
                @endif

            </div>
        </div>
    </div>
