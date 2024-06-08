<!-- resources/views/clients/commandes.blade.php -->
<!-- resources/views/clients/commandes.blade.php -->
<x-layout>
    <div class="bg-teal-400 min-h-screen p-8">
        <div class="bg-white p-8 rounded-lg shadow-lg hover:scale-105 transition-transform duration-300">
            <h2 class="text-3xl font-semibold mb-6">
                Commandes de <span class="font-bold text-red-700">{{ $client->prenom }} {{ $client->nom }}</span>
            </h2>

            @if ($commandes->isEmpty())
                <p class="text-gray-700">Aucune commande trouvée pour ce client.</p>
            @else
                <table class="min-w-full bg-white rounded-lg">
                    <thead class="bg-green-500 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">Référence</th>
                            <th class="px-4 py-2 text-left">Montant Total</th>
                            <th class="px-4 py-2 text-left">État</th>
                            <th class="px-4 py-2 text-left">Produits</th>
                            <th class="px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commandes as $commande)
                            <tr class="hover:bg-gray-100 transition-colors duration-200">
                                <td class="border-t px-4 py-2">{{ $commande->reference }}</td>
                                <td class="border-t px-4 py-2">{{ number_format($commande->montant_total, 0, ',', '') }} XOF</td>
                                <td class="border-t px-4 py-2">{{ ucfirst($commande->etat_commande) }}</td>
                                <td class="border-t px-4 py-2">
                                    <ul>
                                        @foreach ($commande->produits as $produit)
                                            <li>{{ $produit->designation }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="border-t text-center px-4 py-2">
                                    @if ($commande->etat_commande == 'encours')
                                        <form action="{{ route('admin.commandes.valider', $commande) }}" method="POST"
                                              style="display:inline;"
                                              onsubmit="return confirm('Voulez-vous vraiment valider cette commande ?')">
                                            @csrf
                                            <button type="submit"
                                                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">
                                                <i class="fas fa-check"></i> Valider
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.commandes.annuler', $commande) }}" method="POST"
                                              style="display:inline;"
                                              onsubmit="return confirm('Voulez-vous vraiment annuler cette commande ?')">
                                            @csrf
                                            <button type="submit"
                                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-300">
                                                <i class="fas fa-times"></i> Annuler
                                            </button>
                                        </form>
                                    @else
                                        <span class="px-2 py-1 font-bold rounded bg-{{ $commande->etat_commande == 'valide' ? 'green-100 text-green-700' : 'red-100 text-red-700' }}">
                                            {{ ucfirst($commande->etat_commande) }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left">Total</th>
                            <td class="px-4 py-2 text-red-800 font-extrabold">{{ number_format($commandes->sum('montant_total'), 0, ',', '') }} XOF</td>
                            <td colspan="3"></td>
                        </tr>
                    </tfoot>
                </table>
            @endif
        </div>
    </div>
</x-layout>

