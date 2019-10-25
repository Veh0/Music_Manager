<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191025065710 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE album_abstract_medium DROP FOREIGN KEY FK_9530759937C25A65');
        $this->addSql('DROP TABLE abstract_medium');
        $this->addSql('DROP TABLE album_abstract_medium');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE abstract_medium (id INT NOT NULL, type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE album_abstract_medium (album_id INT NOT NULL, abstract_medium_id INT NOT NULL, INDEX IDX_953075991137ABCF (album_id), INDEX IDX_9530759937C25A65 (abstract_medium_id), PRIMARY KEY(album_id, abstract_medium_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE album_abstract_medium ADD CONSTRAINT FK_953075991137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_abstract_medium ADD CONSTRAINT FK_9530759937C25A65 FOREIGN KEY (abstract_medium_id) REFERENCES abstract_medium (id) ON DELETE CASCADE');
    }
}
