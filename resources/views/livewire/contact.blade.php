    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex w-50 justify-content-between">
                    <div class="w-50 mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" wire:model.live='search'
                                placeholder="Search Contact Live" aria-label="Recipient's username"
                                aria-describedby="basic-addon2">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" wire:poll.keep-alive-4s>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th style="width: 30px">Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contact as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->subject }}</td>
                                    <td>
                                        {{ $item->message }}</td>
                                    <td>
                                        <span wire:click.prevent='delete({{ $item->id }})'
                                            class="border-1 mx-1 p-2 rounded fs-1 btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
                <br />
                {{ $contact->links() }}
            </div>
        </div>
    </div>
