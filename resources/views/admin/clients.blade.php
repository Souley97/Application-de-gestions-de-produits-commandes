<!-- resources/views/clients/index.blade.php -->
<x-layout>
    <div class="bg-teal-400 min-h-screen p-8">
        <div class="bg-white p-6 rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
            <h2 class="text-2xl font-bold mb-6">Liste des clients</h2>
            <table class="min-w-full bg-white rounded-lg">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Nom</th>
                        <th class="px-4 py-2 text-left">Prénom</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Téléphone</th>
                        <th class="px-4 py-2 text-left">Montant Total</th>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr class="hover:bg-gray-100 transition-colors duration-200">
                            <td class="border-t px-4 py-2">{{ $client->nom }}</td>
                            <td class="border-t px-4 py-2">{{ $client->prenom }}</td>
                            <td class="border-t px-4 py-2">{{ $client->email }}</td>
                            <td class="border-t px-4 py-2">{{ $client->telephone }}</td>
                            <td class="border-t px-4 py-2">
                                <i class="fas fa-shopping-cart text-green-500"></i> : {{ $client->commandes->count() }}<br>
                                <i class="fas fa-money-bill-wave text-green-500"></i> : {{ number_format($client->commandes->where('etat_commande', 'valide')->sum('montant_total'), 0, ',', '') }} XOF
                            </td>
                            <td class="border-t px-4 py-2">{{ $client->created_at->format('H:i - d/m/Y') }}</td>
                            <td class="border-t text-center px-4 py-2">
                                <a href="{{ route('admin.clients.commandes', $client) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-eye text-red-600"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
