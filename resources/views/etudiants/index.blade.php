<!DOCTYPE html>
<html lang="en">

<x-head></x-head>

<body>
    <div class="container py-5">
        <!-- Message de succès -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Bouton de déconnexion -->
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-secondary mb-3">Se déconnecter</button>
        </form>

        <!-- Titre et bouton d'ajout -->
        <h1>Liste des étudiants</h1>
        <a href="{{ route('etudiants.create') }}" class="btn btn-primary mb-3">Ajouter un nouvel étudiant</a>

        <!-- Tableau des étudiants -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($etudiants as $etudiant)
                    <tr>
                        <td>{{ $etudiant->id }}</td>
                        <td>{{ $etudiant->nom }}</td>
                        <td>{{ $etudiant->email }}</td>
                        <td>
                            @if ($etudiant->image)
                                <img src="{{ asset('storage/' . $etudiant->image) }}" 
                                     alt="Image de {{ $etudiant->nom }}" 
                                     class="img-thumbnail" 
                                     style="width: 100px; height: auto;">
                            @else
                                <span>Aucune image</span>
                            @endif
                        </td>
                        <td>
                            <!-- Bouton Modifier -->
                            <a href="{{ route('etudiants.edit', $etudiant->id) }}" 
                               class="btn btn-warning btn-sm">Modifier</a>
                            
                            <!-- Formulaire Supprimer -->
                            <form action="{{ route('etudiants.destroy', $etudiant->id) }}" 
                                  method="POST" 
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucun étudiant trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- JS Bootstrap -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>