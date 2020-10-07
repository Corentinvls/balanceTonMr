<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201007115657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users_to_team_team DROP FOREIGN KEY FK_77E6A319709F4ACF');
        $this->addSql('ALTER TABLE users_to_team_users DROP FOREIGN KEY FK_FD5306D9709F4ACF');
        $this->addSql('DROP TABLE users_to_team');
        $this->addSql('DROP TABLE users_to_team_team');
        $this->addSql('DROP TABLE users_to_team_users');
        $this->addSql('ALTER TABLE team ADD project LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE users ADD team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9296CD8AE ON users (team_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_to_team (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE users_to_team_team (users_to_team_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_77E6A319709F4ACF (users_to_team_id), INDEX IDX_77E6A319296CD8AE (team_id), PRIMARY KEY(users_to_team_id, team_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE users_to_team_users (users_to_team_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_FD5306D9709F4ACF (users_to_team_id), INDEX IDX_FD5306D967B3B43D (users_id), PRIMARY KEY(users_to_team_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE users_to_team_team ADD CONSTRAINT FK_77E6A319296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_to_team_team ADD CONSTRAINT FK_77E6A319709F4ACF FOREIGN KEY (users_to_team_id) REFERENCES users_to_team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_to_team_users ADD CONSTRAINT FK_FD5306D967B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_to_team_users ADD CONSTRAINT FK_FD5306D9709F4ACF FOREIGN KEY (users_to_team_id) REFERENCES users_to_team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team DROP project');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9296CD8AE');
        $this->addSql('DROP INDEX IDX_1483A5E9296CD8AE ON users');
        $this->addSql('ALTER TABLE users DROP team_id');
    }
}
