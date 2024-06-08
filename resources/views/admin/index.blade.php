<!-- resources/views/commandes/index.blade.php -->
<x-layout>
    <div class="bg-white p-6 rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
        <h2 class="text-2xl font-bold mb-6">Liste des commandes</h2>
        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">Référence</th>
                    <th class="px-4 py-2">Client</th>
                    <th class="px-4 py-2">Montant Total</th>
                    <th class="px-4 py-2">Produits</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                    <tr>
                        <td class="border px-4 py-2">{{ $commande->reference }}</td>
                        <td class="border px-4 py-2">{{ $commande->client->prenom }} {{ $commande->client->nom }}</td>
                        <td class="border px-4 py-2">{{ number_format($commande->montant_total, 0, ',', '') }} Xof</td>
                        <td class="border px-4 py-2">
                            <ul>
                                @foreach ($commande->produits as $produitCommande)
                                    <li>{{ $produitCommande->designation }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="border px-4 py-2">{{ $commande->created_at->format('h:m  - d/m/Y  ') }}</td>
                        <td class="border text-center items-center justify-center py-2">
                            @if ($commande->etat_commande == 'encours')
                                <form action="{{ route('admin.commandes.valider', $commande) }}" method="POST"  class="inline center text-center items-center justify-center" onsubmit="return confirmAction('Voulez-vous vraiment valider cette commande ?', event)">
                                    @csrf
                                    <button type="submit" class="bg-blue-400 px-1 rounded text-white flex items-center  space-x-1">
                                        <i class="fas fa-check"></i> <span>Valider</span>
                                    </button>
                                </form>
                                <form action="{{ route('admin.commandes.annuler', $commande) }}" method="POST"  class="inline" onsubmit="return confirmAction('Voulez-vous vraiment annuler cette commande ?', event)">
                                    @csrf
                                    <button type="submit" class="bg-yellow-400 px-1 rounded text-white flex items-center space-x-1">
                                        <i class="fas fa-times"></i> <span>Annuler</span>
                                    </button>
                                </form>
                            @else
                                <span class="p-1 font-bold rounded {{ $commande->etat_commande == 'valide' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($commande->etat_commande) }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
