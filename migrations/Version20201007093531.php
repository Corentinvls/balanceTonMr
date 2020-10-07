<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201007093531 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_to_team_users (users_to_team_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_FD5306D9709F4ACF (users_to_team_id), INDEX IDX_FD5306D967B3B43D (users_id), PRIMARY KEY(users_to_team_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_to_team_team (users_to_team_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_77E6A319709F4ACF (users_to_team_id), INDEX IDX_77E6A319296CD8AE (team_id), PRIMARY KEY(users_to_team_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_to_team_users ADD CONSTRAINT FK_FD5306D9709F4ACF FOREIGN KEY (users_to_team_id) REFERENCES users_to_team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_to_team_users ADD CONSTRAINT FK_FD5306D967B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_to_team_team ADD CONSTRAINT FK_77E6A319709F4ACF FOREIGN KEY (users_to_team_id) REFERENCES users_to_team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_to_team_team ADD CONSTRAINT FK_77E6A319296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F709F4ACF');
        $this->addSql('DROP INDEX IDX_C4E0A61F709F4ACF ON team');
        $this->addSql('ALTER TABLE team DROP users_to_team_id');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9709F4ACF');
        $this->addSql('DROP INDEX IDX_1483A5E9709F4ACF ON users');
        $this->addSql('ALTER TABLE users DROP users_to_team_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE users_to_team_users');
        $this->addSql('DROP TABLE users_to_team_team');
        $this->addSql('ALTER TABLE team ADD users_to_team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F709F4ACF FOREIGN KEY (users_to_team_id) REFERENCES users_to_team (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61F709F4ACF ON team (users_to_team_id)');
        $this->addSql('ALTER TABLE users ADD users_to_team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9709F4ACF FOREIGN KEY (users_to_team_id) REFERENCES users_to_team (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9709F4ACF ON users (users_to_team_id)');
    }
}
