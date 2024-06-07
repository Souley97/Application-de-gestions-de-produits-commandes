<!-- resources/views/commandes/index.blade.php -->
<x-layout>
    <div class="bg-white p-6 rounded-lg shadow-md hover-scale">
        <h2 class="text-2xl font-bold mb-6">Liste des commandes</h2>
        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">Référence</th>
                    <th class=" px-4 py-2">Client</th>
                    <th class=" px-4 py-2">Montant Total</th>
                    <th class=" px-4 py-2">État</th>
                    <th class=" px-4 py-2">Produits</th>
                    <th class=" px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                    <tr>
                        <td class="border px-4 py-2">{{ $commande->reference }}</td>
                        <td class="border px-4 py-2">{{ $commande->client->prenom }} {{ $commande->client->nom }}</td>
                        <td class="border px-4 py-2">{{ $commande->montant_total }} Xof</td>
                        <td class="border px-4 py-2">{{ ucfirst($commande->etat_commande) }}</td>
                        <td class="border px-4 py-2">
                            <ul>
                                @foreach($commande->produits as $produitCommande)
                                    <li>{{ $produitCommande->designation }}</li>
                                @endforeach
                            </ul>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
