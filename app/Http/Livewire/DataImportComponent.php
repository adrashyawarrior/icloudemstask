<?php

namespace App\Http\Livewire;

use App\Jobs\ImportData;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Throwable;

class DataImportComponent extends Component
{
    use WithFileUploads;

    public $file;
    public $processing;
    public $progress;

    public function mount()
    {
        $this->processing = false;
        $this->progress = 0;
    }

    public function import()
    {
        $this->validate([
            'file' => 'max:1024', // 1MB Max
        ]);

        $batch = Bus::batch([
            new ImportData($this->file)
        ])->then(function (Batch $batch) {
            // All jobs completed successfully...
        })->catch(function (Batch $batch, Throwable $e) {
            // First batch job failure detected...
        })->finally(function (Batch $batch) {
            return redirect('/import')->with('success', 'All good!');
        })->name('ImportAllData')->dispatch();

        $batch->progress();
        // ImportData::dispatchSync($this->file);
        return redirect('/import')->with('success', 'All good!');
    }

    public function batchProgress()
    {
        $batch = DB::table('job_batches')->where('name', 'ImportAllData')->first();
        if (!$batch)
            return response()->json('No batch Found!');
        else
            $this->processing = true;
            
        $batch = Bus::findBatch($batch->id);
        while (!$batch->finished()) {
            if ($batch->canceled())
                return response()->json(['success' => false, 'message' => 'Process failed!']);
            $batch = Bus::findBatch($batch->id);
            $this->progress = $batch->progress();
            sleep(2);
        }
        return response()->json(['success' => true, 'message' => 'Data Imported successfully!']);
    }

    public function render()
    {
        return view('livewire.data-import-component');
    }
}
