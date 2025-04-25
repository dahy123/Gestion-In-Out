<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations de l'étudiant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Informations de l'étudiant</h1>
        </div>
        <div class="content">
            <p><strong>ID :</strong> {{ $etudiant->id }}</p>
            <p><strong>Nom :</strong> {{ $etudiant->nom }}</p>
            <p><strong>Email :</strong> {{ $etudiant->email }}</p>
            @if ($etudiant->image)
                <p><strong>Image :</strong></p>
                <img src="{{ public_path('storage/' . $etudiant->image) }}" alt="Image de {{ $etudiant->nom }}" style="width: 150px; height: auto;">
            @else
                <p><strong>Image :</strong> Aucune image disponible</p>
            @endif
        </div>
    </div>
</body>
</html>