<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$text = 'আপনার দক্ষতাই হোক আপনার সাফল্যের চাবিকাঠি';
$tables = DB::select('SHOW TABLES');
foreach ($tables as $tableObj) {
    $table = array_values((array)$tableObj)[0];
    $columns = Schema::getColumnListing($table);
    foreach ($columns as $column) {
        try {
            if (DB::table($table)->where($column, 'LIKE', '%' . $text . '%')->exists()) {
                echo 'Found in table: ' . $table . ', column: ' . $column . PHP_EOL;
            }
        } catch (\Exception $e) {}
    }
}
