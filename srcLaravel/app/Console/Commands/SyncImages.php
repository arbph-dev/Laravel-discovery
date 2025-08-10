<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Image;

class SyncImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = public_path('img');
		$files = File::allFiles($directory); // CHANGÉ : allFiles au lieu de files()

		foreach ($files as $file) {
			$relativePath = Str::after($file->getRealPath(), public_path() . DIRECTORY_SEPARATOR);
			$filename = $file->getFilename();

			if (!Image::where('filename', $filename)->exists()) {
				[$width, $height] = getimagesize($file->getRealPath());

				Image::create([
					'filename' => $filename,
					'path' => $relativePath, // ex: images/sousdossier/photo.jpg
					'w' => $width,
					'h' => $height,
					'ext' => $file->getExtension(),
				]);

				$this->info("Ajouté : $relativePath");
			} else {
				$this->line("Déjà en base : $filename");
			}
		}
    }
}
