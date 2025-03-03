<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class CentreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $centres = [
            ['name'=>'AGANANG', 'slug'=>'aganang'],
            ['name'=>'ARETSOGENG', 'slug'=>'aretsogeng'],
            ['name'=>'BLAAUBOSH', 'slug'=>'blaaubosh'],
            ['name'=>'BOFALA', 'slug'=>'bofala'],
            ['name'=>'BOGALATLADI', 'slug'=>'bogalatladi'],
            ['name'=>'BOTHA', 'slug'=>'botha'],
            ['name'=>'BUHLEBUYEZA', 'slug'=>'buhlebuyeza'],
            ['name'=>'DICHOUENG', 'slug'=>'dichoueng'],
            ['name'=>'DICKS', 'slug'=>'dicks'],
            ['name'=>'DIHLAKANENG', 'slug'=>'dihlakaneng'],
            ['name'=>'DRIEFONTEIN', 'slug'=>'driefontein'],
            ['name'=>'DUBAI', 'slug'=>'dubai'],
            ['name'=>'EMFUNDWENI', 'slug'=>'emfundweni'],
            ['name'=>'EMHLANGENI', 'slug'=>'emhlangeni'],
            ['name'=>'FAIRBREEZE', 'slug'=>'fairbreeze'],
            ['name'=>'GA RANTO', 'slug'=>'ga-ranto'],
            ['name'=>'GA-RANTO', 'slug'=>'ga-ranto'],
            ['name'=>'GLOBAL', 'slug'=>'global'],
            ['name'=>'HILLTOP', 'slug'=>'hilltop'],
            ['name'=>'HLANGANANI', 'slug'=>'hlanganani'],
            ['name'=>'HOFFELNTAIL', 'slug'=>'hoffelntail'],
            ['name'=>'IKAGENG', 'slug'=>'ikageng'],
            ['name'=>'INQUBEKO', 'slug'=>'inqubeko'],
            ['name'=>'ITSOSENG', 'slug'=>'itsoseng'],
            ['name'=>'JACKILAND', 'slug'=>'jackiland'],
            ['name'=>'KHETHUKTHULA', 'slug'=>'khethukthula'],
            ['name'=>'KILKEEL2', 'slug'=>'kilkeel2'],
            ['name'=>'KILLKEEL1', 'slug'=>'killkeel1'],
            ['name'=>'KOPARASI', 'slug'=>'koparasi'],
            ['name'=>'KUTLWANO', 'slug'=>'kutlwano'],
            ['name'=>'LEFISO', 'slug'=>'lefiso'],
            ['name'=>'LENTING', 'slug'=>'lenting'],
            ['name'=>'LONG HOME', 'slug'=>'long-home'],
            ['name'=>'LONG HOMES', 'slug'=>'long-homes'],
            ['name'=>'MABULELA', 'slug'=>'mabulela'],
            ['name'=>'MADITHAME', 'slug'=>'madithame'],
            ['name'=>'MAKGAREBE', 'slug'=>'makgarebe'],
            ['name'=>'MAKGOBA', 'slug'=>'makgoba'],
            ['name'=>'MAKGWATHANE', 'slug'=>'makgwathane'],
            ['name'=>'MARIKANA', 'slug'=>'marikana'],
            ['name'=>'MARULANENG', 'slug'=>'marulaneng'],
            ['name'=>'MATHANGENI', 'slug'=>'mathangeni'],
            ['name'=>'MATLEREKENG', 'slug'=>'matlerekeng'],
            ['name'=>'MATSHELAMPATA', 'slug'=>'matshelampata'],
            ['name'=>'MNDOZO', 'slug'=>'mndozo'],
            ['name'=>'MOGOLANENG', 'slug'=>'mogolaneng'],
            ['name'=>'MOHLAHLANENG', 'slug'=>'mohlahlaneng'],
            ['name'=>'MOKOKOTLONG', 'slug'=>'mokokotlong'],
            ['name'=>'MOOPONG', 'slug'=>'moopong'],
            ['name'=>'MORETSELA', 'slug'=>'moretsela'],
            ['name'=>'MPHANAMA', 'slug'=>'mphanama'],
            ['name'=>'MSOMI', 'slug'=>'msomi'],
            ['name'=>'MURULENG', 'slug'=>'muruleng'],
            ['name'=>'MXHASHONI', 'slug'=>'mxhashoni'],
            ['name'=>'NDLANGAMANDLA', 'slug'=>'ndlangamandla'],
            ['name'=>'NHLALAKAHLE', 'slug'=>'nhlalakahle'],
            ['name'=>'NKONGOLWANA 2', 'slug'=>'nkongolwana-2'],
            ['name'=>'NKONGOLWANA', 'slug'=>'nkongolwana'],
            ['name'=>'NTABABOMVU', 'slug'=>'ntababomvu'],
            ['name'=>'NTSIMBINI', 'slug'=>'ntsimbini'],
            ['name'=>'NYONINI', 'slug'=>'nyonini'],
            ['name'=>'OGADE', 'slug'=>'ogade'],
            ['name'=>'PELANGWE', 'slug'=>'pelangwe'],
            ['name'=>'PHUMLANI', 'slug'=>'phumlani'],
            ['name'=>'QUEQUE2', 'slug'=>'queque-2'],
            ['name'=>'QUEQUE1', 'slug'=>'queque1'],
            ['name'=>'RATHOKE', 'slug'=>'rathoke'],
            ['name'=>'RETLABONA', 'slug'=>'retlabona'],
            ['name'=>'SECTION 7', 'slug'=>'section-7'],
            ['name'=>'SEKHUKHUNE', 'slug'=>'sekhukhune'],
            ['name'=>'SENOTLELO', 'slug'=>'senotlelo'],
            ['name'=>'SENZOKUHLE', 'slug'=>'senzokuhle'],
            ['name'=>'SGODIPHOLA', 'slug'=>'sgodiphola'],
            ['name'=>'SHUSHUMELA', 'slug'=>'shushumela'],
            ['name'=>'SIYAPHAMBILI', 'slug'=>'siyaphambili'],
            ['name'=>'SIZANANI', 'slug'=>'sizanani'],
            ['name'=>'SIZANOKUHLE', 'slug'=>'sizanokuhle'],
            ['name'=>'SKOPALLEN 1', 'slug'=>'skopallen-1'],
            ['name'=>'SKOPALLEN 2', 'slug'=>'skopallen-2'],
            ['name'=>'SOPHIA', 'slug'=>'sophia'],
            ['name'=>'SPHUMELELE', 'slug'=>'sphumelele'],
            ['name'=>'SUKUMANI', 'slug'=>'sukumani'],
            ['name'=>'THUBELIHLE', 'slug'=>'thubelihle'],
            ['name'=>'TLAKALENCHABELENG', 'slug'=>'tlakalenchabeleng'],
            ['name'=>'TOLSKRAAL', 'slug'=>'tolskraal'],
            ['name'=>'TOOSENG', 'slug'=>'tooseng'],
            ['name'=>'TSHIKANOSI', 'slug'=>'tshikanosi'],
            ['name'=>'TSOSANANG', 'slug'=>'tsosanang'],
            ['name'=>'UMBUMBANO', 'slug'=>'umbumbano'],
            ['name'=>'Unit F', 'slug'=>'unit-f'],
            ['name'=>'UNIT S', 'slug'=>'unit-s'],
            ['name'=>'VAALBANK', 'slug'=>'vaalbank'],
            ['name'=>'VIEDRIET', 'slug'=>'viedriet'],
            ['name'=>'VILAMAHLO', 'slug'=>'vilamahlo'],
            ['name'=>'VULAMEHLO', 'slug'=>'vulamehlo'],
            ['name'=>'VULINDLELA', 'slug'=>'vulindlela'],
            ['name'=>'ZAMOKUHLE', 'slug'=>'zamokuhle'],
            ['name'=>'ZAMOKUNZEZELA', 'slug'=>'zamokunzezela'],
            ['name'=>'ZICOLE', 'slug'=>'zicole'],
        ];

        foreach ($centres as $centre) {
            DB::table('centres')->insert([
                'name' => $centre['name'],
                'slug' => $centre['slug'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

    }
}
