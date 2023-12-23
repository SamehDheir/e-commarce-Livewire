    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        @if ($showTable)
                            @if ($showCartProduct)
                                <button wire:click="$set('showCartProduct', false)" class="btn btn-danger">Cancle</button>
                            @endif
                        @else
                            <button wire:click="$set('showTable', true)" class="btn btn-danger">Cancle</button>
                        @endif
                    </div>
                    {{-- @if (!$showCartProduct)
                        <span>{{ $countblogs }}</span>
                    @else
                        <span>{{ $count_blog_comment }}</span>
                    @endif --}}
                </div>
            </div>
            <div class="card-body" wire:poll.keep-alive-4s>
                {{-- @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif --}}
                @if ($showTable)
                    @if ($showCartProduct)
                        <div class="card-body">
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> Photo </th>
                                            <th> Name Product </th>
                                            <th> Quantity </th>
                                            <th> Price </th>
                                            <th> Total </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($userCart as $item)
                                            <tr>
                                                <th>{{ $i++ }}</th>
                                                <td class="py-1">
                                                    <img src="{{ asset('storage/' . $item->products->image) }}"
                                                        alt="image" />
                                                </td>
                                                <td> {{ $item->products->name }} </td>
                                                <td> {{ $item->quantity }} </td>
                                                <td> {{ $item->products->price }} </td>
                                                <td>
                                                    {{ $item->quantity * $item->products->price }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <table class="table table-striped" wire:poll.keep-alive-4s>
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> User </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Registeration </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td class="py-1">
                                            <img src="{{$user->avatar}}"
                                                alt="image" />
                                        </td>
                                        <td> {{ $user->name }} </td>
                                        <td> {{ $user->email }} </td>
                                        <td> {{ $user->created_at }} </td>
                                        <td>
                                            <span wire:click='showCart({{ $user->id }})'
                                                class="border-1 mx-1 p-2 rounded fs-1 btn-info">
                                                <i class="bi bi-cart"></i>
                                            </span>
                                            <span wire:click='delete({{ $user->id }})'
                                                class="border-1 mx-1 p-2 rounded fs-1 btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @endif
                @endif
            </div>
        </div>
    </div>
