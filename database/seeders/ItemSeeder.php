<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::create([
            // Data User
            'item_code' => 'G0000001',
            'inc' => '03476',
            'item_type' => 'Material General',
            'item_group' => 'Tools',
            'uom' => 'Pcs',
            'denotation' => '15 mm Chrome Vanadium Combinationspanner',
            'keyword' => 'WRENCH,SPANNER',
            'description' => 'WRENCH:TYPE:SPANNER;SIZE:15MM;POINT QUANTITY:6PT;MATERIAL:CHROMIUM-VANADIUM STEEL ;SURFACE TREATMENT: SATIN CHROME',
            'old_code' => 'TOOL-027-A',
            'cross_ref_1' => 'N/A',
            'cross_ref_2' => 'N/A',
            'cross_ref_3' => 'N/A',
            'functional_location' => 'Tools Box',

            // Data FAT
            'coa' => '1000045',
            'gl' => '71000045',

            // Data Procurement
            'unit_price' => 75000,
            'main_supplier' => 'PT Tekiro Global',

            // Data Logistik
            'storage_location' => 'Tools Warehouse',
            'max_stock_level' => 'N/A',
            'reorder_point' => 'N/A',

            // Status akhir
            'status' => 4,
        ]);

        Item::create([
            // Data User
            'item_code' => 'E0000001',
            'inc' => '10957',
            'item_type' => 'Material OEM',
            'item_group' => 'Spare Parts',
            'uom' => 'Pcs',
            'denotation' => 'Actuator RR / Actuator Belakang PN : 364100K020',
            'keyword' => 'ACTUATOR,ELECTRO-MECHANICAL,LINEAR',
            'description' => 'ACTUATOR,M/E:BRAND: CUMMINS;PARTS NUMBER: 364100K020',
            'old_code' => 'SP-014-P',
            'cross_ref_1' => 'N/A',
            'cross_ref_2' => 'N/A',
            'cross_ref_3' => 'N/A',
            'functional_location' => 'Genset 01',

            // Data FAT
            'coa' => '2000020',
            'gl' => '72000020',

            // Data Procurement
            'unit_price' => 3450000,
            'main_supplier' => 'PT Powergen Maju',

            // Data Logistik
            'storage_location' => 'Spare Parts Warehouse',
            'max_stock_level' => 8,
            'reorder_point' => 6,

            // Status akhir
            'status' => 4,
        ]);

        Item::create([
            // Data User
            'item_code' => 'S0000001',
            'inc' => 'N/A',
            'item_type' => 'Services',
            'item_group' => 'Barge Services',
            'uom' => 'MT',
            'denotation' => 'Sewa Tongkang',
            'keyword' => 'N/A',
            'description' => 'TRANSPORT,DOM BARGE : SERVICE TYPE: ORE BARGE ;ACTIVITY: SHIPMENT ;ORIGIN: JETTY ;DESTINATION: IWIP',
            'old_code' => '100008',
            'cross_ref_1' => 'N/A',
            'cross_ref_2' => 'N/A',
            'cross_ref_3' => 'N/A',
            'functional_location' => 'N/A',

            // Data FAT sudah diisi
            'coa' => '3000055',
            'gl' => '73000055',

            // Data Procurement
            'unit_price' => 450000000,
            'main_supplier' => 'PT Samudera Pasti',

            // Status saat ini: Proc sudah approve, lanjut ke logistik
            'status' => 3,
        ]);
    }
}
