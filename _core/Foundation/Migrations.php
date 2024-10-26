<?php
namespace Atova\Eshoper\Foundation;

use Atova\Eshoper\Abstract\Database;
class Migrations {

    private $db;
    private $migrationDir;

    public function __construct() {
        // Initialize the DatabaseHandler instance
        $this->db = new Database();

        // Set the directory where migration files are stored
        $this->migrationDir = __DIR__."/../../databases/migrations/";
    }

    // Method to run all migration files
    public function runMigrations() {
        

        // Get all .sql files in the migration directory
        $files = glob($this->migrationDir."*.sql");

        // Check if there are any migration files
        if (empty($files)) {
            return "No migration files found.".$this->migrationDir;
        }

        // Loop through each SQL file and execute
        foreach ($files as $file) {
            echo "". $file ." Migrating.........\n";
            $this->runMigrationFile($file);
            echo "". $file ." Migrated\n";
        }
    }

    // Method to run a single migration file
    private function runMigrationFile($file) {
        // Read SQL file content
        $sql = file_get_contents($file);

        if ($sql === false) {
            throw new \Exception("Failed to read migration file: $file");
        }

        // Execute the SQL using DatabaseHandler
        $this->db->query($sql);

        // Execute and check for success
        if (!$this->db->execute()) {
            throw new \Exception("Error executing $file: " . $this->db->getErrors() ."");
        }
    }
}
