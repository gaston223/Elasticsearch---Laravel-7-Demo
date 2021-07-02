<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreatePunchlineIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('punchlines_index', function (Mapping $mapping, Settings $settings){
            $mapping->text('description');

            // you can also change the index settings
            $settings->index([
                'number_of_replicas' => 1
            ]);

            $settings->analysis([
                'analyzer' => [
                    'description' => [
                        'type' => 'custom',
                        'tokenizer' => 'whitespace'
                    ]
                ]
            ]);
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::drop('punchlines_index');
    }
}
