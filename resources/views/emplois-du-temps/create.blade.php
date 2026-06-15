<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un Créneau') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('emplois-du-temps.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="jour" class="block text-sm font-medium text-gray-700">Jour</label>
                            <select name="jour" id="jour" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Sélectionner</option>
                                <option value="lundi" {{ old('jour') == 'lundi' ? 'selected' : '' }}>Lundi</option>
                                <option value="mardi" {{ old('jour') == 'mardi' ? 'selected' : '' }}>Mardi</option>
                                <option value="mercredi" {{ old('jour') == 'mercredi' ? 'selected' : '' }}>Mercredi</option>
                                <option value="jeudi" {{ old('jour') == 'jeudi' ? 'selected' : '' }}>Jeudi</option>
                                <option value="vendredi" {{ old('jour') == 'vendredi' ? 'selected' : '' }}>Vendredi</option>
                                <option value="samedi" {{ old('jour') == 'samedi' ? 'selected' : '' }}>Samedi</option>
                            </select>
                            @error('jour')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="heure_debut" class="block text-sm font-medium text-gray-700">Heure Début</label>
                                <input type="time" name="heure_debut" id="heure_debut" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('heure_debut') }}" required>
                                @error('heure_debut')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="heure_fin" class="block text-sm font-medium text-gray-700">Heure Fin</label>
                                <input type="time" name="heure_fin" id="heure_fin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('heure_fin') }}" required>
                                @error('heure_fin')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="salle" class="block text-sm font-medium text-gray-700">Salle</label>
                            <input type="text" name="salle" id="salle" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('salle') }}" required>
                            @error('salle')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="semestre" class="block text-sm font-medium text-gray-700">Semestre</label>
                                <select name="semestre" id="semestre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Sélectionner</option>
                                    <option value="S1" {{ old('semestre') == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('semestre') == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('semestre') == 'S3' ? 'selected' : '' }}>S3</option>
                                    <option value="S4" {{ old('semestre') == 'S4' ? 'selected' : '' }}>S4</option>
                                    <option value="S5" {{ old('semestre') == 'S5' ? 'selected' : '' }}>S5</option>
                                    <option value="S6" {{ old('semestre') == 'S6' ? 'selected' : '' }}>S6</option>
                                </select>
                                @error('semestre')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="type_cours" class="block text-sm font-medium text-gray-700">Type de Cours</label>
                                <select name="type_cours" id="type_cours" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Sélectionner</option>
                                    <option value="Cours" {{ old('type_cours') == 'Cours' ? 'selected' : '' }}>Cours</option>
                                    <option value="TP" {{ old('type_cours') == 'TP' ? 'selected' : '' }}>TP</option>
                                    <option value="TD" {{ old('type_cours') == 'TD' ? 'selected' : '' }}>TD</option>
                                </select>
                                @error('type_cours')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="filiere_id" class="block text-sm font-medium text-gray-700">Filière</label>
                            <select name="filiere_id" id="filiere_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Sélectionner</option>
                                @foreach ($filieres as $filiere)
                                    <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>
                                        {{ $filiere->nom_filiere }}
                                    </option>
                                @endforeach
                            </select>
                            @error('filiere_id')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="matiere_id" class="block text-sm font-medium text-gray-700">Matière</label>
                            <select name="matiere_id" id="matiere_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Sélectionner</option>
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->id }}" {{ old('matiere_id') == $matiere->id ? 'selected' : '' }}>
                                        {{ $matiere->nom_matiere }}
                                    </option>
                                @endforeach
                            </select>
                            @error('matiere_id')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="enseignant_id" class="block text-sm font-medium text-gray-700">Enseignant</label>
                            <select name="enseignant_id" id="enseignant_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Sélectionner</option>
                                @foreach ($enseignants as $enseignant)
                                    <option value="{{ $enseignant->id }}" {{ old('enseignant_id') == $enseignant->id ? 'selected' : '' }}>
                                        {{ $enseignant->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('enseignant_id')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('emplois-du-temps.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Annuler</a>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
