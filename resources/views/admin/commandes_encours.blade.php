<!-- resources/views/admin/commandes_en-cours.blade.php -->
<x-layout>
    <div class="bg-teal-400 min-h-screen p-8">
        <div class="bg-white p-6 rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
            <h2 class="text-2xl font-bold mb-6">Commandes en Cours</h2>
            
            @if($commandesEnCours->isEmpty())
                <p class="text-gray-700">Aucune commande en cours.</p>
            @else
                <table class="min-w-full bg-white rounded-lg">
                    <thead class="bg-green-500 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">Référence</th>
                            <th class="px-4 py-2 text-left">Client</th>
                            <th class="px-4 py-2 text-left">Montant Total</th>
                            <th class="px-4 py-2 text-left">Produits</th>
                            <th class="px-4 py-2 text-left">Date de Création</th>
                            <th class="px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commandesEnCours as $commande)
                            <tr class="hover:bg-gray-100 transition-colors duration-200">
                                <td class="border-t px-4 py-2">{{ $commande->reference }}</td>
                                <td class="border-t px-4 py-2 flex items-center">
                                    <img src="https://w7.pngwing.com/pngs/866/254/png-transparent-naruto-uzumaki-sasuke-uchiha-naruto-head-sasuke-uchiha-cartoon-thumbnail.png" alt="Avatar de {{ $commande->client->prenom }}" class="w-10 h-10 rounded-full mr-3">
                                    <span>{{ $commande->client->prenom }} {{ $commande->client->nom }}</span>
                                </td>
                                <td class="border-t px-4 py-2">{{ number_format($commande->montant_total, 0, ',', '') }} XOF</td>
                                <td class="border-t px-4 py-2">
                                    <ul class="list-disc list-inside">
                                        @foreach($commande->produits as $produit)
                                            <li>{{ $produit->designation }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="border-t px-4 py-2">{{ $commande->created_at->format('H:i - d/m/Y') }}</td>
                                <td class="border-t text-center px-4 py-2">
                                    <form action="{{ route('admin.commandes.valider', $commande) }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment valider cette commande ?')">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">
                                            <i class="fas fa-check"></i> Valider
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.commandes.annuler', $commande) }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment annuler cette commande ?')">
                                        @csrf
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-300">
                                            <i class="fas fa-times"></i> Annuler
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-layout>
