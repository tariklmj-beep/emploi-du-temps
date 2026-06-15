<?php
try {
    $filiere = App\Models\Filiere::first();
    if ($filiere) {
        $filiere->delete();
        echo "SUCCESS: Filiere deleted.\n";
    } else {
        echo "No filiere found.\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
