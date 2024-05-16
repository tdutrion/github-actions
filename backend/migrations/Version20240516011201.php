<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Bridge\Doctrine\Types\UlidType;

final class Version20240516011201 extends AbstractMigration
{
    private const TABLE_NAME = 'movie';

    public function getDescription(): string
    {
        return 'Add a table for movie details';
    }

    public function up(Schema $schema): void
    {
        $moviesTable = $schema->createTable(self::TABLE_NAME);
        $moviesTable->addColumn('id', UlidType::NAME);
        $moviesTable->addColumn('title', Types::STRING, ['length' => 255]);
        $moviesTable->addColumn('description', Types::STRING, ['length' => 2_000]);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE_NAME);
    }
}
