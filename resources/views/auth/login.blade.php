@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    /* Buat background full halaman dengan gradasi */
    html, body {
        height: 100%;
        margin: 0;
        background: linear-gradient(135deg, #f9fbfd, #e8f1fb);
        font-family: 'Poppins', sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .login-wrapper {
        width: 100%;
        max-width: 420px; /* Lebar maksimal untuk card */
        padding: 40px 20px;
        box-sizing: border-box;
    }

    .login-card {
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(53, 122, 189, 0.4);
        background: linear-gradient(135deg, #4a90e2, #357ABD);
        padding: 40px 30px;
        border: none;
        color: white;
    }

    .login-title {
        text-align: center;
        font-size: 28px;
        font-weight: 700;
        color: #e0e6f1;
        margin-bottom: 30px;
        letter-spacing: 1.2px;
    }

    .form-label {
        font-weight: 600;
        color: #dbe6f6;
    }

    .form-control {
        border-radius: 8px;
        border: none;
        background-color: #7ba9e7;
        color: #1b355f;
        font-weight: 600;
        padding: 12px 15px;
        box-shadow: inset 0 0 8px rgba(255, 255, 255, 0.3);
        transition: background-color 0.3s ease;
    }

    .form-control:focus {
        background-color: #a8c3f8;
        color: #122a54;
        box-shadow: 0 0 10px #eaf3ff;
        outline: none;
    }

    .is-invalid {
        border-color: #ff6b6b;
        background-color: #ffdede;
        color: #8b0000;
    }

    .invalid-feedback {
        color: #ffadad;
        font-weight: 600;
    }

    .btn-primary {
        background-color: #2c72d9;
        border: none;
        border-radius: 8px;
        padding: 12px 28px;
        font-weight: 700;
        letter-spacing: 0.8px;
        transition: background-color 0.3s ease;
        color: white;
    }

    .btn-primary:hover {
        background-color: #1e56a3;
    }

    .btn-link {
        color: #a8c3f8;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-link:hover {
        text-decoration: underline;
        color: #d0e0ff;
    }
</style>

<div class="login-wrapper">
    <div class="login-card">

        <div class="login-title">Welcome Aplikasi Inventaris</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password">

                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember"
                       {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember" style="color:#dbe6f6;">
                    Ingat Saya
                </label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary">
                    Masuk
                </button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
