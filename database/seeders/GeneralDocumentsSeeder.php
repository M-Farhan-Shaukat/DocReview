<?php

namespace Database\Seeders;

use App\Models\GeneralDocuments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralDocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agreementDoc = DB::table('general_documents')->where(['type'=> 'agreement'])->first();
        if(!$agreementDoc){
            $data = [
                'name' => 'Agreement',
                'slug' => 'agreement',
                'type' => 'agreement',
                'is_active' => true,
                'sort_order' => '0',
                'created_by' => 1,

            ];
            GeneralDocuments::create($data);
            echo "Agreement Document entry created :) \r\n";
        }

        $challanDoc = DB::table('general_documents')->where(['type'=> 'challan'])->first();
        if(!$challanDoc){
            $data = [
                'name' => 'Challan',
                'slug' => 'challan',
                'type' => 'challan',
                'is_active' => true,
                'sort_order' => '1',
                'created_by' => 1,
            ];
            GeneralDocuments::create($data);
            echo "Challan Document entry created :) \r\n";
        }
    }
}
