@extends('layouts.appauth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Получение доступа к личному кабинету</div>

                    <div class="card-body">
                        @if (session('credentials'))
                            <div class="alert alert-warning">
                                Внимание! Сохраните эти данные. В случае утери пароля, обратитесь в техподдержку.
                                <div class="credentials-container" style="margin-top: 10px; font-weight: bold;">
                                    Логин: {{ session('credentials')['login'] }} <br>
                                    Пароль: {{ session('credentials')['password'] }}
                                </div>
                                <div style="margin-top: 10px;">
                                    <button onclick="window.print()" class="btn btn-primary">Распечатать</button>
                                </div>
                            </div>
                        @else
                            <form method="POST" action="{{ route('credentials.post') }}">
                                @csrf

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="row mb-3">
                                    <label for="phone" class="col-md-4 col-form-label text-md-end">Номер телефона</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="+7 (___) ___-____" required autocomplete="phone" autofocus>

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Получить доступ
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#phone').mask('+7 (000) 000-0000');
        });
    </script>

@endsection
