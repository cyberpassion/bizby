<?php

namespace Modules\Note\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Modules\Note\Models\NoteThread;
use Modules\Note\Models\Note;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NoteThread::factory()
    ->count(5)
    ->create()
    ->each(function ($thread) {
        Note::factory()
            ->count(10)
            ->create([
                'note_thread_id' => $thread->id,
            ]);
    });

    }
}
