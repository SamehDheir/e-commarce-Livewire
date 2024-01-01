<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    Welcome <span class="text-primary">{{ Auth::user()->name }}</span>

                </div>
            </div>

            {{-- Username --}}
            <div class="card mt-3">
                <div class="card-header">{{ __('UserName') }}</div>
                <div class="card-body" wire:poll.keep-alive-9s>
                    {{-- @if (session('successUserName'))
                    <div class="alert alert-success">
                        {{ session('successUserName') }}
                    </div>
                    @endif --}}
                    <form wire:submit.prevent='changeUserName' method="post">
                        <input type="text" wire:model='username' class="form-control" value="{{ Auth::user()->name }}">
                        @error('username')
                        <div class="text-danger my-1">
                            {{ $message }}
                        </div>
                        @enderror
                        <button type="submit" class="btn btn-primary mt-2">Change</button>
                    </form>

                </div>
            </div>
            {{-- Username --}}

            {{-- Email --}}
            <div class="card mt-3">
                <div class="card-header">{{ __('Email') }}</div>
                <div class="card-body" wire:poll.keep-alive-9s>
                    {{-- @if (session('successEmail'))
                    <div class="alert alert-success">
                        {{ session('successEmail') }}
                    </div>
                    @endif --}}
                    <form wire:submit.prevent='changeEmail' method="post">
                        <input type="email" wire:model='email' class="form-control" value="{{ Auth::user()->email }}">
                        @error('email')
                        <div class="text-danger my-1">
                            {{ $message }}
                        </div>
                        @enderror
                        <button type="submit" class="btn btn-primary mt-2">Change</button>
                    </form>

                </div>
            </div>
            {{-- Email --}}

            {{-- Password --}}
            <div class="card mt-3">
                <div class="card-header">{{ __('Password') }}</div>
                <div class="card-body">
                    {{-- @if (session('successPassword'))
                    <div class="alert alert-success">
                        {{ session('successPassword') }}
                    </div>
                    @endif --}}
                    <form wire:submit.prevent='changePassword' method="post">
                        <label>Current Password</label>
                        <input type="password" wire:model='currentPassword' class="form-control">
                        @error('currentPassword')
                        <div class="text-danger my-1">
                            {{ $message }}
                        </div>
                        @enderror

                        <label>New Password</label>
                        <input type="password" wire:model=newPassword' class="form-control">
                        @error('newPassword')
                        <div class="text-danger my-1">
                            {{ $message }}
                        </div>
                        @enderror
                        <label>Confirm Password</label>
                        <input type="password" wire:model='confirmPassword' class="form-control">
                        {{-- @error('confirmPassword')
                        <div class="text-danger my-1">
                            {{ $message }}
                        </div>
                        @enderror --}}
                        <button type="submit" class="btn btn-primary mt-2">Change</button>
                    </form>
                </div>
            </div>
            {{-- Password --}}

            {{-- Image --}}
            <div class="card mt-3">
                <div class="card-header">{{ __('Photo') }}</div>
                <div class="card-body" wire:poll.keep-alive-9s>
                    {{-- @if (session('successPhoto'))
                    <div class="alert alert-success">
                        {{ session('successPhoto') }}
                    </div>
                    @endif --}}
                    <form wire:submit.prevent='changePhoto' method="post">
                        @if ($avatar)
                        <img src="{{ $avatar->temporaryUrl() }}" class="my-4" width="200px">
                        @elseif (file_exists(public_path('storage/' . Auth::user()->avatar)))
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="my-4" width="200px">
                        @else
                        <img src="{{ Auth::user()->avatar }}" alt="Avatar" width="50" height="50">
                        @endif


                        <input type="file" wire:model='avatar' class="form-control">
                        @error('avatar')
                        <div class="text-danger my-1">
                            {{ $message }}
                        </div>
                        @enderror
                        <button type="submit" class="btn btn-primary mt-2">Change</button>
                    </form>

                </div>
            </div>
            {{-- Image --}}

            {{-- Image --}}
            <div class="card mt-3">
                <div class="card-header">Delete Acount</div>
                <div class="card-body">
                    <h5>{{ Auth::user()->email }}</h5>
                    <form wire:submit.prevent='deleteAcount({{ Auth::user()->id }})' method="post">
                        <button type="submit" class="btn btn-danger mt-2">DELETE</button>
                    </form>
                </div>
            </div>
            {{-- Image --}}


        </div>
    </div>
</div>