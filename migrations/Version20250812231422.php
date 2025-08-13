<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250812231422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recept (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, recept LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recept_alcohol (recept_id INT NOT NULL, alcohol_id INT NOT NULL, INDEX IDX_A5C572ABC6BF5295 (recept_id), INDEX IDX_A5C572ABB15DEC82 (alcohol_id), PRIMARY KEY(recept_id, alcohol_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recept_alcohol ADD CONSTRAINT FK_A5C572ABC6BF5295 FOREIGN KEY (recept_id) REFERENCES recept (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recept_alcohol ADD CONSTRAINT FK_A5C572ABB15DEC82 FOREIGN KEY (alcohol_id) REFERENCES alcohol (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recept_alcohol DROP FOREIGN KEY FK_A5C572ABC6BF5295');
        $this->addSql('ALTER TABLE recept_alcohol DROP FOREIGN KEY FK_A5C572ABB15DEC82');
        $this->addSql('DROP TABLE recept');
        $this->addSql('DROP TABLE recept_alcohol');
    }
}
