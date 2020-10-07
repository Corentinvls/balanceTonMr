<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201007092748 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_to_team (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team ADD users_to_team_id INT DEFAULT NULL, DROP users, DROP project');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F709F4ACF FOREIGN KEY (users_to_team_id) REFERENCES users_to_team (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61F709F4ACF ON team (users_to_team_id)');
        $this->addSql('ALTER TABLE users ADD users_to_team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9709F4ACF FOREIGN KEY (users_to_team_id) REFERENCES users_to_team (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9709F4ACF ON users (users_to_team_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F709F4ACF');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9709F4ACF');
        $this->addSql('DROP TABLE users_to_team');
        $this->addSql('DROP INDEX IDX_C4E0A61F709F4ACF ON team');
        $this->addSql('ALTER TABLE team ADD users LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', ADD project LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', DROP users_to_team_id');
        $this->addSql('DROP INDEX IDX_1483A5E9709F4ACF ON users');
        $this->addSql('ALTER TABLE users DROP users_to_team_id');
    }
}
