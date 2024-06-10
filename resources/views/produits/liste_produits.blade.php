<!-- resources/views/produits/index.blade.php -->
<x-layout>
    <div class="bg-teal-400 min-h-screen p-8">
        <div class="bg-white p-6 rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
           <div class=" justify-between "> 
           <h2 class="text-2xl font-bold mb-6">Liste des produits</h2>
            <button 
            class="  text-green-500 px-4 py-2 my-8  rounded hover:text-white hover:bg-green-700"> <a href="{{ route('produits.create') }} ">Ajouter </a></button>
            </div>
            <table class="min-w-full bg-white rounded-lg">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Image</th>
                        <th class="px-4 py-2 text-left">Reference</th>
                        <th class="px-4 py-2 text-left">Designation</th>
                        <th class="px-4 py-2 text-left">Prix unitaire</th>
                        <th class="px-4 py-2 text-left">Etat</th>
                        <th class="px-4 py-2 text-left">Categorie</th>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produits as $produit)
                        <tr class="hover:bg-gray-100 transition-colors duration-200">

                            <td class="border-t px-4 py-2">
                                <img src="{{ asset('storage/produit/'.$produit->image) }}" alt="Image du produit" class="  w-14  bg-no-repeat cover bg-cover object-cover">
                            </td>
                            <td class="border-t px-4 py-2">{{ $produit->reference }}</td>
                            <td class="border-t px-4 py-2">{{ $produit->designation }}</td>
                            <td class="border-t px-4 py-2">{{ $produit->prix_unitaire }}</td>
                            <td class="border-t px-4 py-2">{{ $produit->etat }}</td>
                            <td class="border-t px-4 py-2">{{ $produit->categorie->libelle}}</td>                           
                            <td class="border-t px-4 py-2">{{ $produit->created_at->format('H:i - d/m/Y') }}</td>
                            <td class="border-t text-center px-4 py-2">
                                    <a href="{{ route('produit.edit', $produit->id) }}" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-1 px-2 rounded">Éditer</a>
                        <form action="{{ route('produit.destroy', $produit->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-400 text-white font-bold py-1 px-2 rounded">Supprimer</button>
                        </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
