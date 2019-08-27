<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $json = '[
		{
		  "name"  : "short trouers",
		  "nameV" : "Quần sooc",
		  "laundry" : "35000",
		  "dry" : "45000",
		  "Presssing" : "25000"
		},
		{
		  "name"  : "Shirt",
		  "nameV" : "Áo sơ mi",
		  "laundry" : "35000",
		  "dry" : "45000",
		  "Presssing" : "25000"
		},
		{
		  "name"  : "T-shirt (short)",
		  "nameV" : "Áo phông",
		  "laundry" : "35000",
		  "dry" : "45000",
		  "Presssing" : "25000"
		},
		{
		  "name"  : "T-shirt (long)",
		  "nameV" : "Áo phông dài tay",
		  "laundry" : "38000",
		  "dry" : "48000",
		  "Presssing" : "28000"
		},
		{
		  "name"  : "Blouse (no decoration)",
		  "nameV" : "Áo sơ mi (không phụ kiện)",
		  "laundry" : "35000",
		  "dry" : "45000",
		  "Presssing" : "25000"
		},
		{
		  "name"  : "Vest",
		  "nameV" : "Áo gi lê",
		  "laundry" : "35000",
		  "dry" : "45000",
		  "Presssing" : "25000"
		},
		{
		  "name"  : "Pyjamas set (normal)",
		  "nameV" : "Bộ pyjama (loại thường)",
		  "laundry" : "45000",
		  "dry" : "55000",
		  "Presssing" : "31000"
		},
		{
		  "name"  : "Pyjamas set (delicate)",
		  "nameV" : "Bộ pyjama (loại cao cấp )",
		  "laundry" : "",
		  "dry" : "95000",
		  "Presssing" : "55000"
		},
		{
		  "name"  : "Trousers",
		  "nameV" : "Quần (dài ,jeans)",
		  "laundry" : "45000",
		  "dry" : "55000",
		  "Presssing" : "31000"
		},
		{
		  "name"  : "Skirt (short)",
		  "nameV" : "Chân váy ngắn",
		  "laundry" : "45000",
		  "dry" : "55000",
		  "Presssing" : "31000"
		},
		{
		  "name"  : "Skirt (long)",
		  "nameV" : "Chân váy dài",
		  "laundry" : "55000",
		  "dry" : "65000",
		  "Presssing" : "31000"
		},
		{
		  "name"  : "Blouse (with decoration)",
		  "nameV" : "Áo sơ mi nữ (có phụ kiện)",
		  "laundry" : "45000",
		  "dry" : "55000",
		  "Presssing" : "31000"
		},
		{
		  "name"  : "Cardigan (summer)",
		  "nameV" : "Áo len hè (loại mỏng)",
		  "laundry" : "55000",
		  "dry" : "65000",
		  "Presssing" : "31000"
		},
		{
		  "name"  : "Jacket",
		  "nameV" : "Áo khoác",
		  "laundry" : "65000",
		  "dry" : "75000",
		  "Presssing" : "45000"
		},
		{
		  "name"  : "Sportswear set (Normal  Garde)",
		  "nameV" : "Bộ thể thao (loại thường)",
		  "laundry" : "65000",
		  "dry" : "75000",
		  "Presssing" : "45000"
		},
		{
		  "name"  : "One - Piece (short)",
		  "nameV" : "Váy liền thân (ngắn )",
		  "laundry" : "65000",
		  "dry" : "75000",
		  "Presssing" : "45000"
		},
		{
		  "name"  : "Dress (long)",
		  "nameV" : "Váy liền thân dài",
		  "laundry" : "90000",
		  "dry" : "100000",
		  "Presssing" : "55000"
		},
		{
		  "name"  : "Workwear set",
		  "nameV" : "Bộ công nhân",
		  "laundry" : "65000",
		  "dry" : "75000",
		  "Presssing" : "45000"
		},
		{
		  "name"  : "Sweater ( Winter)",
		  "nameV" : "Áo len ( dày)",
		  "laundry" : "75000",
		  "dry" : "85000",
		  "Presssing" : "45000"
		},
		{
		  "name"  : "Half Coat (Winter)",
		  "nameV" : "Áo khoác ngắn",
		  "laundry" : "75000",
		  "dry" : "85000",
		  "Presssing" : "45000"
		},
		{
		  "name"  : "(Nomal grade)",
		  "nameV" : "Áo dài (loại thường)",
		  "laundry" : "75000",
		  "dry" : "85000",
		  "Presssing" : "45000"
		},
		{
		  "name"  : "Delicate",
		  "nameV" : "Áo dài (cao cấp )",
		  "laundry" : "",
		  "dry" : "120000",
		  "Presssing" : "75000"
		},
		{
		  "name"  : "Long coat winter",
		  "nameV" : "Áo khoác dạ dài",
		  "laundry" : "100000",
		  "dry" : "110000",
		  "Presssing" : "55000"
		},
		{
		  "name"  : "Fuu coat (long)",
		  "nameV" : "Áo lông vũ dài",
		  "laundry" : "",
		  "dry" : "200000",
		  "Presssing" : ""
		},
		{
		  "name"  : "Fuu coat ( short)",
		  "nameV" : "Áo lông vũ ngắn",
		  "laundry" : "",
		  "dry" : "150000",
		  "Presssing" : ""
		},
		{
		  "name"  : "Woollen",
		  "nameV" : "Áo dạ",
		  "laundry" : "95000",
		  "dry" : "105000",
		  "Presssing" : "50000"
		},
		{
		  "name"  : "Ao long ( Fur Coat)",
		  "nameV" : "Áo bông",
		  "laundry" : "90000",
		  "dry" : "100000",
		  "Presssing" : "55000"
		},
		{
		  "name"  : "Wedding dress",
		  "nameV" : "Váy cưới (dạ hội)",
		  "laundry" : "",
		  "dry" : "150000",
		  "Presssing" : "80000"
		},
		{
		  "name"  : "2P. Hanbok",
		  "nameV" : "Hanbok (2 chiếc)",
		  "laundry" : "",
		  "dry" : "85000",
		  "Presssing" : "40000"
		},
		{
		  "name"  : "3P. Hanbok",
		  "nameV" : "Hanbok (3 chiếc)",
		  "laundry" : "",
		  "dry" : "95000",
		  "Presssing" : "45000"
		},
		{
		  "name"  : "Leather coat",
		  "nameV" : "Áo da",
		  "laundry" : "",
		  "dry" : "500000",
		  "Presssing" : ""
		},
		{
		  "name"  : "Tie",
		  "nameV" : "Cà vạt",
		  "laundry" : "",
		  "dry" : "21000",
		  "Presssing" : "15000"
		},
		{
		  "name"  : "Scaft (small)",
		  "nameV" : "Khăn quàng cổ (loại nhỏ)",
		  "laundry" : "",
		  "dry" : "33000",
		  "Presssing" : "15000"
		},
		{
		  "name"  : "Mufler , scarf (big)",
		  "nameV" : "Khăn quàng cổ (loại to)",
		  "laundry" : "",
		  "dry" : "43000",
		  "Presssing" : "25000"
		},
		{
		  "name"  : "2 - Layer half Coat",
		  "nameV" : "Áo khoác 2 lớp ",
		  "laundry" : "",
		  "dry" : "125,000",
		  "Presssing" : "75,000"
		},
		{
		  "name"  : "2p. Suit",
		  "nameV" : "Bộ vest ( 2 chiếc)",
		  "laundry" : "",
		  "dry" : "95,000",
		  "Presssing" : "55,000"
		},
		{
		  "name"  : "3p. Suit",
		  "nameV" : "Bộ vest ( 3 chiếc)",
		  "laundry" : "",
		  "dry" : "125,000",
		  "Presssing" : "75,000"
		},
		{
		  "name"  : "Handkerchief",
		  "nameV" : "Khăn tay",
		  "laundry" : "10,000",
		  "dry" : "",
		  "Presssing" : "7,000"
		},
		{
		  "name"  : "Socks",
		  "nameV" : "Tất ",
		  "laundry" : "10,000",
		  "dry" : "",
		  "Presssing" : "7,000"
		},
		{
		  "name"  : "Underwear",
		  "nameV" : "Quần lót",
		  "laundry" : "10,000",
		  "dry" : "",
		  "Presssing" : "7,000"
		},
		{
		  "name"  : "Gloves",
		  "nameV" : "Găng tay",
		  "laundry" : "20,000",
		  "dry" : "",
		  "Presssing" : "15,000"
		},
		{
		  "name"  : "Undershirt",
		  "nameV" : "Áo lót",
		  "laundry" : "20,000",
		  "dry" : "",
		  "Presssing" : "15,000"
		},
		{
		  "name"  : "Pillow cover",
		  "nameV" : "Vỏ gối",
		  "laundry" : "20000",
		  "dry" : "",
		  "Presssing" : "15000"
		},
		{
		  "name"  : "Sport shoes",
		  "nameV" : "giầy thể thao",
		  "laundry" : "75000",
		  "dry" : "80000",
		  "Presssing" : ""
		},
		{
		  "name"  : "Bath towel",
		  "nameV" : "Khăn tắm",
		  "laundry" : "20000",
		  "dry" : "",
		  "Presssing" : "15000"
		},
		{
		  "name"  : "Summer blanket",
		  "nameV" : "Chăn hè",
		  "laundry" : "120000",
		  "dry" : "",
		  "Presssing" : "25000"
		},
		{
		  "name"  : "Woolen Blanket",
		  "nameV" : "Chăn len",
		  "laundry" : "145000",
		  "dry" : "",
		  "Presssing" : ""
		},
		{
		  "name"  : "Winter Blanket",
		  "nameV" : "Chăn đông",
		  "laundry" : "155000",
		  "dry" : "",
		  "Presssing" : ""
		},
		{
		  "name"  : "Blanket cover",
		  "nameV" : "Vỏ chăn",
		  "laundry" : "75000",
		  "dry" : "",
		  "Presssing" : "40000"
		},
		{
		  "name"  : "Bed sheet",
		  "nameV" : "Ga giường to",
		  "laundry" : "45000",
		  "dry" : "",
		  "Presssing" : "50000"
		},
		{
		  "name"  : "Gut pillow",
		  "nameV" : "Ruột gối",
		  "laundry" : "125000",
		  "dry" : "135000",
		  "Presssing" : ""
		},
		{
		  "name"  : "Curtain",
		  "nameV" : "Rèm",
		  "laundry" : "220000",
		  "dry" : "",
		  "Presssing" : ""
		}
		]';

		$list = json_decode($json);
	    foreach ($list as $key => $value) {
	    	if(strlen($value->laundry) > 0){
		        DB::table('packages')->insert([
		            'name' => $value->nameV,
		            'price' => $value->laundry,
		            'image' => '',
		            'service_id' => 2,
		        ]);
		    }

	        if(strlen($value->dry) > 0){
		        DB::table('packages')->insert([
		            'name' => $value->nameV,
		            'price' => $value->dry,
		            'image' => '',
		            'service_id' => 3,
		        ]);
	        }
	    }
    }
}
