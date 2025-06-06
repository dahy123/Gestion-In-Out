<x-head></x-head>

<form class="container-fluid py-5 px-5" action="/toLogin" method="post">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
            value="{{ old('email') }}" placeholder="Entrez votre email" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
            name="password" placeholder="Entrez votre mot de passe" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>

</form>