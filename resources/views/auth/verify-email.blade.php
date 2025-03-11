<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success" role="alert">
                                {{ __('Enlace de verificación enviado.') }}
                            </div>
                        @endif

                        <p class="mb-0">
                            {{ __('Antes de proceder, busca el enlace de verificación en tu correo.') }}
                            {{ __('Si no has recibido el mail,') }}
                        </p>

                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('clica aquí para enviar otro') }}</button>.
                        </form>

                        <form class="d-inline" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline float-end">{{ __('Log Out') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
