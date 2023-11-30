<?php

namespace App\Livewire;

use App\Exports\InvoiceExport;
use App\Models\Invoice;
use Livewire\withPagination;
use Livewire\Component;

class FilterInvoice extends Component
{
    use withPagination;

    public $filters = [
        'serie'=> '',
        'fromNumber'=> '',
        'toNumber'=> '',
        'fromDate'=> '',
        'toDate'=> '',
    ];

    public function applyFilters()
    {
        $this->resetPage(); // Para reiniciar la paginación a la página 1
        $this->render();    // Para volver a cargar los datos con los nuevos filtros
    }

    public function generateReport()
    {
        return new InvoiceExport($this->filters);
    }


    public function render()
    {
        $invoices = Invoice::filter($this->filters)->paginate(10);
        return view('livewire.filter-invoice', compact('invoices'));
    }
}
