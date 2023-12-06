    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="form-group w-25">
                    <div class="input-group">
                        <input type="text" class="form-control" wire:model.live='search' placeholder="Search User Live"
                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
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
                                        <img src="{{ asset('admin/assets/images/faces-clipart/pic-1.png') }}"
                                            alt="image" />
                                    </td>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td> {{ $user->created_at }} </td>
                                    <td>
                                        <span wire:click='delete({{ $user->id }})'
                                            class="border-1 mx-1 p-2 rounded fs-1 btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
