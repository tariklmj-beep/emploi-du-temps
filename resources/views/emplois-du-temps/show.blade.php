<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du Créneau') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <h4 class="font-semibold text-gray-700">Jour</h4>
                            <p class="text-gray-600">{{ $emploiDuTemps->jour }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700">Créneau Horaire</h4>
                            <p class="text-gray-600">{{ $emploiDuTemps->heure_debut }} à {{ $emploiDuTemps->heure_fin }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700">Salle</h4>
                            <p class="text-gray-600">{{ $emploiDuTemps->salle }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700">Type de Cours</h4>
                            <p class="text-gray-600">{{ $emploiDuTemps->type_cours }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700">Semestre</h4>
                            <p class="text-gray-600">{{ $emploiDuTemps->semestre }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700">Filière</h4>
                            <p class="text-gray-600">{{ $emploiDuTemps->filiere->nom_filiere }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700">Matière</h4>
                            <p class="text-gray-600">{{ $emploiDuTemps->matiere->nom_matiere }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700">Enseignant</h4>
                            <p class="text-gray-600">{{ $emploiDuTemps->enseignant->name }}</p>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('emplois-du-temps.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Retour</a>
                        <a href="{{ route('emplois-du-temps.edit', $emploiDuTemps->id) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700">Éditer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
