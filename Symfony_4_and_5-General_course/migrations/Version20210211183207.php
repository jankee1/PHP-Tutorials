<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210211183207 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pdf (id INT NOT NULL, pages_number INT NOT NULL, orientation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, format VARCHAR(255) NOT NULL, duration INT NOT NULL, INDEX IDX_7CC7DA2CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pdf ADD CONSTRAINT FK_EF0DB8CBF396750 FOREIGN KEY (id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CBF396750 FOREIGN KEY (id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610A76ED395');
        $this->addSql('DROP INDEX IDX_8C9F3610A76ED395 ON file');
        $this->addSql('ALTER TABLE file DROP user_id, DROP title, DROP format, DROP duration, DROP pages_number, DROP orientation');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pdf');
        $this->addSql('DROP TABLE video');
        $this->addSql('ALTER TABLE file ADD user_id INT DEFAULT NULL, ADD title VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD format VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD duration INT DEFAULT NULL, ADD pages_number INT DEFAULT NULL, ADD orientation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_8C9F3610A76ED395 ON file (user_id)');
    }
}
