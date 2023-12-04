    <div class="contact__form">
        <h5>SEND MESSAGE</h5>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form wire:submit.prevent='create'>
            <input type="text" wire:model='name' placeholder="Name" />
            @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

            <input type="email" wire:model='email' placeholder="Email"/>
            @error('email')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

            <input type="text" wire:model='subject' placeholder="Subject" />
            @error('subject')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

            <textarea wire:model='message' placeholder="Message"></textarea>
            @error('message')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
            <button type="submit" class="site-btn site-btn-contact">Send Message</button>
        </form>
    </div>
