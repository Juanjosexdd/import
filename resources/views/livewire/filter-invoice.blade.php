<div>
    {{-- @dump($filters) --}}
    {{--  FILTROS  --}}
    <div class="bg-white rounded-[.95rem]  p-8 shadow border-dashed mb-6">
        <h2 class="text-2xl font-semibold mb-4">Generar reporte</h2>

        <div class="mb-4">
            Serie:
            <select wire:model="filters.serie" name="serie" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-32" wire:change="applyFilters">
                <option value="">Todas</option>
                <option value="F001">F001</option>
                <option value="B001">B001</option>
            </select>
        </div>

        <div class="flex space-x-4 mb-4">
            <div>
                Desde el N°:
                <x-input wire:model="filters.fromNumber" type="text" class="w-20" wire:change="applyFilters"/>
            </div>
            <div>
                Hasta el N°:
                <x-input wire:model="filters.toNumber" type="text" class="w-20" wire:change="applyFilters"/>
            </div>
        </div>

        <div class="flex space-x-4 mb-4">
            <div>
                Desde fecha:
                <x-input wire:model="filters.fromDate" type="date" class="w-36" wire:change="applyFilters"/>
            </div>
            <div>
                Hasta fecha:
                <x-input wire:model="filters.toDate" type="date" class="w-36" wire:change="applyFilters"/>
            </div>
        </div>

        <x-button wire:click="generateReport" >Generar</x-button>
    </div>
    {{--  TABLA  --}}
    <div class="flex flex-wrap  -mx-3 mb-2 text-sm">
        <div class="w-full max-w-full px-3 mb-4  mx-auto">
            <div
                class="relative shadow flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white">
                <div
                    class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
                    <!-- card header -->
                    <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                        <h3
                            class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl/tight text-dark">
                            <span class="mr-3 font-semibold text-dark">Listado de facturas</span>
                            <span class="mt-1 font-medium text-secondary-dark text-lg/normal"></span>
                        </h3>
                        <div class="relative flex flex-wrap items-center my-2">
                            <a href="javascript:void(0)"
                                class="inline-block text-[.925rem] font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-150 ease-in-out text-light-inverse bg-light-dark border-light shadow-none border-0 py-2 px-5 hover:bg-secondary active:bg-light focus:bg-light">
                                See other projects </a>
                        </div>
                    </div>
                    <!-- end card header -->
                    <!-- card body  -->
                    <div class="flex-auto block py-8 pt-6 px-9">
                        <div class="overflow-x-auto">
                            <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                <thead class="align-bottom">
                                    <tr class="font-semibold text-center text-[0.95rem] text-secondary">
                                        <th class="pb-3 text-center ">ID</th>
                                        <th class="pb-3 text-center ">Serie</th>
                                        <th class="pb-3 text-center ">Correlativo</th>
                                        <th class="pb-3 text-center ">Base</th>
                                        <th class="pb-3 text-center ">IVA</th>
                                        <th class="pb-3 text-center ">TOTAL</th>
                                        <th class="pb-3 text-center ">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr class="border-b border-dashed last:border-b-0">

                                            <td class="p-3 text-center">
                                                <span class="text-light-inverse text-md/normal">
                                                    {{ $invoice->id }}
                                                </span>
                                            </td>
                                            <td class="p-3 text-center">
                                                <span class="text-light-inverse text-md/normal">
                                                    {{ $invoice->serie }}

                                                </span>
                                            </td>
                                            <td class="p-3 text-center">
                                                <span class="text-light-inverse text-md/normal">
                                                    {{ $invoice->correlative }}
                                                </span>
                                            </td>
                                            <td class="p-3 text-center">
                                                <span class="text-light-inverse text-md/normal">
                                                    {{ $invoice->base }}
                                                </span>
                                            </td>
                                            <td class="p-3 text-center">
                                                <span class="text-light-inverse text-md/normal">
                                                    {{ $invoice->iva }}
                                                </span>
                                            </td>
                                            <td class="p-3 text-center">
                                                <span class="text-light-inverse text-md/normal">
                                                    {{ $invoice->total }}
                                                </span>
                                            </td>
                                            <td class="p-3 text-center">
                                                <span class="text-light-inverse text-md/normal">
                                                    {{ $invoice->created_at->format('d/m/y') }}
                                                </span>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>{{ $invoices->links() }}</div>
</div>
