<?php
include __DIR__ . '/../vendor/autoload.php';
$app = include __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Check settings keys for exchange_rates
echo "=== SETTINGS KEYS (exchange_rates) ===\n";
$settings = DB::select("SELECT `key` FROM settings WHERE `key` LIKE 'exchange_rates_%'");
foreach ($settings as $s) {
    echo $s->key . "\n";
}

// Check contact messages table
echo "\n=== CONTACT MESSAGES COLUMNS ===\n";
$cols = DB::select("SHOW COLUMNS FROM contact_messages");
foreach ($cols as $col) {
    echo "{$col->Field}: {$col->Type} (null:{$col->Null})\n";
}

// Check audit_logs
echo "\n=== AUDIT LOGS COLUMNS ===\n";
$cols = DB::select("SHOW COLUMNS FROM audit_logs");
foreach ($cols as $col) {
    echo "{$col->Field}: {$col->Type} (null:{$col->Null})\n";
}

echo "\n=== DASHBOARD WIDGETS COLUMNS ===\n";
$cols = DB::select("SHOW COLUMNS FROM dashboard_widgets");
foreach ($cols as $col) {
    echo "{$col->Field}: {$col->Type} (null:{$col->Null})\n";
}

echo "\n=== USERS COLUMNS ===\n";
$cols = DB::select("SHOW COLUMNS FROM users");
foreach ($cols as $col) {
    echo "{$col->Field}: {$col->Type} (null:{$col->Null})\n";
}

echo "\n=== SECTIONS COLUMNS ===\n";
$cols = DB::select("SHOW COLUMNS FROM sections");
foreach ($cols as $col) {
    echo "{$col->Field}: {$col->Type} (null:{$col->Null})\n";
}

echo "\n=== NETWORK LOCATIONS COLUMNS ===\n";
$cols = DB::select("SHOW COLUMNS FROM network_locations");
foreach ($cols as $col) {
    echo "{$col->Field}: {$col->Type} (null:{$col->Null})\n";
}

echo "\n=== CERTIFICATIONS COLUMNS ===\n";
$cols = DB::select("SHOW COLUMNS FROM certifications");
foreach ($cols as $col) {
    echo "{$col->Field}: {$col->Type} (null:{$col->Null})\n";
}

echo "\n=== ANNOUNCEMENTS COLUMNS ===\n";
$cols = DB::select("SHOW COLUMNS FROM announcements");
foreach ($cols as $col) {
    echo "{$col->Field}: {$col->Type} (null:{$col->Null})\n";
}
