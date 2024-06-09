<div class="container">
    <h2>Passer une commande - {{ $produit->designation }}</h2>
    <form action="{{ route('produits.commandes.store', $produit->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <!-- Autres champs pour les informations de la commande -->
        <button type="submit" class="btn btn-primary">Passer la commande</button>
    </form>
</div>