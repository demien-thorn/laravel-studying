<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    /**
     * Contains information about basic product's properties and property options
     *
     * @var array|array[]
     */
    private array $properties = [
        [
            'name' => 'Color',
            'name_ru' => 'Цвет',
            'options' => [
                [
                    'name' => 'Black',
                    'name_ru' => 'Чёрный',
                ],
                [
                    'name' => 'White',
                    'name_ru' => 'Белый',
                ],
                [
                    'name' => 'Silver',
                    'name_ru' => 'Серебристый',
                ],
                [
                    'name' => 'Steel',
                    'name_ru' => 'Стальной',
                ],
                [
                    'name' => 'Dark Blue',
                    'name_ru' => 'Тёмный синий',
                ],
                [
                    'name' => 'Cosimic Red',
                    'name_ru' => 'Космический красный',
                ],
            ],
        ],
        [
            'name' => 'Memory size',
            'name_ru' => 'Объём памяти',
            'options' => [
                [
                    'name' => '16 GB',
                    'name_ru' => '16 ГБ',
                ],
                [
                    'name' => '32 GB',
                    'name_ru' => '32 ГБ',
                ],
                [
                    'name' => '64 GB',
                    'name_ru' => '64 ГБ',
                ],
                [
                    'name' => '128 GB',
                    'name_ru' => '128 ГБ',
                ],
                [
                    'name' => '256 GB',
                    'name_ru' => '256 ГБ',
                ],
                [
                    'name' => '512 GB',
                    'name_ru' => '512 ГБ',
                ],
            ],
        ],
    ];

    /**
     * Contains information about basic products and categories
     *
     * @var array|array[]
     */
    private array $categories = [
        [
            'name' => 'iPhone',
            'name_ru' => 'Айфон',
            'code' => 'iphone',
            'description' => 'Here you can take a look at all Apple iPhones presented at our website',
            'description_ru' => 'Здесь вы можете взглянуть на все Apple iPhone, представленные на нашем сайте',
            'image' => 'categories/iphone_14_pro_ max.jpg',
            'products' => [
                [
                    'name' => 'iPhone X',
                    'name_ru' => 'Айфон X',
                    'code' => 'iphone_x',
                    'description' => 'First non-button Apple smartphone',
                    'description_ru' => 'Первый смартфон Apple без кнопок',
                    'price' => 25000,
                    'image' => 'products/iphone_x.jpg',
                    'new' => 0,
                    'properties' => [
                        1, 2,
                    ],
                    'options' => [
                        [
                            2, 9,
                        ],
                        [
                            2, 10,
                        ],
                        [
                            4, 9,
                        ],
                        [
                            4, 10,
                        ],
                    ],
                ],
                [
                    'name' => 'iPhone 12 PRO',
                    'name_ru' => 'Айфон 12 PRO',
                    'code' => 'iphone_12_pro',
                    'description' => 'First Apple smartphone with Lidar function',
                    'description_ru' => 'Первый смартфон Apple с функцией Lidar',
                    'price' => 38500,
                    'image' => 'products/iphone_12_pro.jpeg',
                    'new' => 0,
                    'properties' => [
                        1, 2,
                    ],
                    'options' => [
                        [
                            1, 11,
                        ],
                        [
                            1, 12,
                        ],
                        [
                            5, 11,
                        ],
                        [
                            5, 12,
                        ],
                        [
                            6, 11,
                        ],
                        [
                            6, 12,
                        ],
                    ],
                ],
                [
                    'name' => 'iPhone 14 PRO MAX',
                    'name_ru' => 'Айфон 14 PRO MAX',
                    'code' => 'iphone_14_pro_max',
                    'description' => 'Best Apple smartphone at the moment',
                    'description_ru' => 'Лучший смартфон Apple на данный момент',
                    'price' => 65700,
                    'image' => 'products/iphone_14_pro_ max.jpg',
                    'new' => 1,
                    'properties' => [
                        1, 2,
                    ],
                    'options' => [
                        [
                            1, 11,
                        ],
                        [
                            1, 12,
                        ],
                        [
                            2, 11,
                        ],
                        [
                            2, 12,
                        ],
                        [
                            3, 11,
                        ],
                        [
                            3, 12,
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Apple Watch',
            'name_ru' => 'Эпл Вотч',
            'code' => 'apple_watch',
            'description' => 'Here you can take a look at all Apple Watch presented at our website',
            'description_ru' => 'Здесь вы можете взглянуть на все Apple Watch, представленные на нашем сайте.',
            'image' => 'categories/apple_watch_5.jpg',
            'products' => [
                [
                    'name' => 'Apple Watch 5',
                    'name_ru' => 'Эпл Вотч 5',
                    'code' => 'apple_watch_5',
                    'description' => 'Very good smart-watch from Apple',
                    'description_ru' => 'Отличные смарт-часы от компании Apple',
                    'price' => 9600,
                    'image' => 'products/apple_watch_5.jpg',
                    'new' => 0,
                    'properties' => [
                        1, 2,
                    ],
                    'options' => [
                        [
                            2, 7,
                        ],
                        [
                            2, 8,
                        ],
                        [
                            4, 7,
                        ],
                        [
                            4, 8,
                        ],
                    ],
                ],
                [
                    'name' => 'Apple Watch SE',
                    'name_ru' => 'Эпл Вотч SE',
                    'code' => 'apple_watch_se',
                    'description' => 'First budget Apple smart-watch',
                    'description_ru' => 'Первые бюджетные смарт-часы от компании Apple',
                    'price' => 7100,
                    'image' => 'products/apple_watch_se.jpg',
                    'new' => 1,
                    'properties' => [
                        1, 2,
                    ],
                    'options' => [
                        [
                            1, 7,
                        ],
                        [
                            5, 7,
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'AirPods',
            'name_ru' => 'ЭйрПодс',
            'code' => 'airpods',
            'description' => 'Here you can take a look at all Apple AirPods presented at our website',
            'description_ru' => 'Здесь вы можете взглянуть на все Apple AirPods, представленные на нашем сайте.',
            'image' => 'categories/airpods_pro_1.jpg',
            'products' => [
                [
                    'name' => 'AirPods 1',
                    'name_ru' => 'ЭйрПодс 1',
                    'code' => 'airpods_1',
                    'description' => 'First wireless Apple earpods',
                    'description_ru' => 'Первые беспроводные наушники Apple',
                    'price' => 3400,
                    'image' => 'products/airpods_1.jpg',
                    'new' => 0,
                ],
                [
                    'name' => 'AirPods Pro',
                    'name_ru' => 'ЭйрПодс Pro',
                    'code' => 'airpods_pro',
                    'description' => 'First vacuum wireless Apple earpods',
                    'description_ru' => 'Первые вакуумные беспровобные наушники Apple',
                    'price' => 7800,
                    'image' => 'products/airpods_pro_1.jpg',
                    'new' => 0,
                ],
            ],
        ],
    ];

//TODO: check IDE's warnings about function below
    /**
     * Run the database seeds.
     * Generates basic categories, products, product properties and property options
     *
     * @return void
     */
    public function run(): void
    {
        foreach ($this->properties as $property) {
            $property['created_at'] = Carbon::now();
            $property['updated_at'] = Carbon::now();

            $options = $property['options'];
            unset($property['options']);

            $propertyId = DB::table(table: 'properties')->insertGetId(values: $property);

            foreach ($options as $option) {
                $option['created_at'] = Carbon::now();
                $option['updated_at'] = Carbon::now();
                $option['property_id'] = $propertyId;

                DB::table(table: 'property_options')->insert(values: $option);
            }
        }

        foreach ($this->categories as $category) {
            $category['created_at'] = Carbon::now();
            $category['updated_at'] = Carbon::now();

            $products = $category['products'];
            unset($category['products']);

            $categoryId = DB::table(table: 'categories')->insertGetId(values: $category);

            foreach ($products as $product) {
                $product['created_at'] = Carbon::now();
                $product['updated_at'] = Carbon::now();
                $product['hit'] = !boolval(value: rand(min: 0, max: 4));
                $product['recommend'] = !boolval(value: rand(min: 0, max: 2));
                $product['category_id'] = $categoryId;

                if (isset($product['properties'])) {
                    $properties = $product['properties'];
                    unset($product['properties']);
                    $skusOptions = $product['options'];
                    unset($product['options']);
                }
                $price = $product['price'];
                unset($product['price']);

                $productId = DB::table(table: 'products')->insertGetId(values: $product);

                if (isset($properties)) {
                    foreach ($properties as $propertyId) {
                        $productData['product_id'] = $productId;
                        $productData['property_id'] = $propertyId;
                        $productData['created_at'] = Carbon::now();
                        $productData['updated_at'] = Carbon::now();

                        DB::table(table: 'property_product')->insert(values: $productData);
                    }

                    foreach ($skusOptions as $skuOptions) {
                        $skusData['product_id'] = $productId;
                        $skusData['count'] = rand(min: 1, max: 100);
                        $skusData['price'] = $price;
                        $skusData['created_at'] = Carbon::now();
                        $skusData['updated_at'] = Carbon::now();

                        $skuId = DB::table(table: 'skus')->insertGetId(values: $skusData);

                        foreach ($skuOptions as $skuOption) {
                            $skuData['sku_id'] = $skuId;
                            $skuData['property_option_id'] = $skuOption;
                            $skuData['created_at'] = Carbon::now();
                            $skuData['updated_at'] = Carbon::now();

                            DB::table(table: 'sku_property_option')->insert(values: $skuData);
                        }
                    }

                    unset($properties);
                } else {
                    $skusData['product_id'] = $productId;
                    $skusData['count'] = rand(min: 1, max: 100);
                    $skusData['price'] = $price;
                    $skusData['created_at'] = Carbon::now();
                    $skusData['updated_at'] = Carbon::now();

                    DB::table(table: 'skus')->insert(values: $skusData);
                }
            }
        }
    }
}
