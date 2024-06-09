{{-- navbar --}}
<x-layout>
{{-- navbar --}}
<div class="center justify-center  items-center">
    <div class="grid grid-cols-2 gap-6">
        <button  class="ml-2 bg-red-500 w-1/2  text-white h-10 px-4 py-2 rounded hover:bg-red-700"><a href="{{ route('admin.categories') }}">Annuler</a></button>

    <div class="bg-white p-6 rounded-lg shadow-md  ">
        <h1 class="text-xl font-bold text-gray-900 mb-5">Modifier une catégorie</h1>
        <form action="{{ route('categories.update', $categorie->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="libelle" class="w-full p-2 border-gray-300 rounded">Libelle</label>
                <input type="text" name="libelle" class="w-full p-2 border border-gray-300 rounded"
                    id="libelle" value="{{ $categorie->libelle }}" required>
            </div>
            
            <div class="text-right mt-4">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Envoyer</button>
            </div>
        </form>
    </div>

</div>
</div>
</x-layout>

