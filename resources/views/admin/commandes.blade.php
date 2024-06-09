<!-- resources/views/commandes/validees.blade.php -->
<x-layout>
   <div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">{{ $title }}</h2>
<div class="flex items-center justify-center space-x-4 mb-6">
    <a href="{{ route('admin.commandes.validees') }}" class="text-green-700 hover:bg-green-200 hover:text-green-900 px-4 py-2 rounded-md transition-colors duration-300 border border-green-300">Commandes Validées</a>
    <a href="{{ route('admin.commandes.annulees') }}" class="text-red-700 hover:bg-red-200 hover:text-red-900 px-4 py-2 rounded-md transition-colors duration-300 border border-red-300">Commandes Annulées</a>
</div>


    @if($commandes->isEmpty())
        <p class="text-gray-700">Aucune commande disponible.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class=" bg-green-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left  ">Référence</th>
                        <th class="px-6 py-3 text-left  ">Client</th>
                        <th class="px-6 py-3 text-left  ">Montant Total</th>
                        <th class="px-6 py-3 text-left  ">Produits</th>
                        <th class="px-6 py-3 text-left  ">Date de Création</th>
                        <th class="px-6 py-3 text-left  ">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($commandes as $commande)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $commande->reference }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $commande->client->prenom }} {{ $commande->client->nom }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $commande->montant_total }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <ul>
                                    @foreach($commande->produits as $produit)
                                        <li>{{ $produit->designation }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $commande->created_at->format('h:m - d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($commande->etat_commande == 'encours')
                                    <form action="{{ route('admin.commandes.valider', $commande) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="btn-success">Valider</button>
                                    </form>
                                    <form action="{{ route('admin.commandes.annuler', $commande) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="btn-danger">Annuler</button>
                                    </form>
                                @else
                                    <span class="badge badge-secondary">{{ ucfirst($commande->etat_commande) }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
             <div class="mt-4">
            {{ $commandes->links() }}
        </div>
        </div>
    @endif
</div>

</x-layout>
