<?php

namespace Database\Seeders;

use App\Models\Admin\AdminDocuments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attachment;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      /*  Attachment::create([
            'filename' => 'file1.pdf',
            'original_name' => 'Annual Report 2024.pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 2548032, // 2.4 MB
                   'type'  => 'agreement',

            'file_path' => 'public/attachments/file1.pdf',
            'is_active' => true,
        ]);

        Attachment::create([
            'filename' => 'file2.pdf',
            'original_name' => 'Q4 Presentation Slides.pptx',
            'mime_type' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'file_size' => 1887436, // 1.8 MB
                   'type'  => 'challan',

            'file_path' => 'public/attachments/file2.pdf',
            'is_active' => true,
        ]);*/



    }
}
