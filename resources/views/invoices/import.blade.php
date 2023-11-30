<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Importar Tablas') }}
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{route('invoices.importStore')}}" method="post" class="bg-white p-8 shadow rounded" enctype="multipart/form-data">
                @csrf
                <x-validation-errors class="mb-4"  />
                <div>
                    <h1>Seleccione el archivo que desee importar</h1>
                    <input type="file" name="file" id="file"
                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                        class="form-control">
                </div>
                <x-button class="mt-4">
                    Importar
                </x-button>
            </form>
        </div>
    </div>


</x-app-layout>
