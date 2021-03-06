<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211016113955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE monster (id INT AUTO_INCREMENT NOT NULL, featured_image_id INT NOT NULL, featured_movie_id INT DEFAULT NULL, category_id INT NOT NULL, name VARCHAR(128) NOT NULL, slug VARCHAR(128) NOT NULL, gender VARCHAR(255) DEFAULT NULL, nicknames LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', birth_day DATETIME DEFAULT NULL, arrival_date DATETIME DEFAULT NULL, leaving_date DATETIME DEFAULT NULL, reason_for_leaving VARCHAR(255) DEFAULT NULL, cossard TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_245EC6F45E237E06 (name), UNIQUE INDEX UNIQ_245EC6F4989D9B62 (slug), UNIQUE INDEX UNIQ_245EC6F43569D950 (featured_image_id), UNIQUE INDEX UNIQ_245EC6F4875F4AC1 (featured_movie_id), INDEX IDX_245EC6F412469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monster_monster (monster_source INT NOT NULL, monster_target INT NOT NULL, INDEX IDX_863F77CB594A3250 (monster_source), INDEX IDX_863F77CB40AF62DF (monster_target), PRIMARY KEY(monster_source, monster_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monster_image (monster_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_B3C5381AC5FF1223 (monster_id), INDEX IDX_B3C5381A3DA5256D (image_id), PRIMARY KEY(monster_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monster_movie (monster_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_6BA6CE2AC5FF1223 (monster_id), INDEX IDX_6BA6CE2A8F93B6FC (movie_id), PRIMARY KEY(monster_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE monster ADD CONSTRAINT FK_245EC6F43569D950 FOREIGN KEY (featured_image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE monster ADD CONSTRAINT FK_245EC6F4875F4AC1 FOREIGN KEY (featured_movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE monster ADD CONSTRAINT FK_245EC6F412469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE monster_monster ADD CONSTRAINT FK_863F77CB594A3250 FOREIGN KEY (monster_source) REFERENCES monster (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE monster_monster ADD CONSTRAINT FK_863F77CB40AF62DF FOREIGN KEY (monster_target) REFERENCES monster (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE monster_image ADD CONSTRAINT FK_B3C5381AC5FF1223 FOREIGN KEY (monster_id) REFERENCES monster (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE monster_image ADD CONSTRAINT FK_B3C5381A3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE monster_movie ADD CONSTRAINT FK_6BA6CE2AC5FF1223 FOREIGN KEY (monster_id) REFERENCES monster (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE monster_movie ADD CONSTRAINT FK_6BA6CE2A8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE monster_monster DROP FOREIGN KEY FK_863F77CB594A3250');
        $this->addSql('ALTER TABLE monster_monster DROP FOREIGN KEY FK_863F77CB40AF62DF');
        $this->addSql('ALTER TABLE monster_image DROP FOREIGN KEY FK_B3C5381AC5FF1223');
        $this->addSql('ALTER TABLE monster_movie DROP FOREIGN KEY FK_6BA6CE2AC5FF1223');
        $this->addSql('DROP TABLE monster');
        $this->addSql('DROP TABLE monster_monster');
        $this->addSql('DROP TABLE monster_image');
        $this->addSql('DROP TABLE monster_movie');
    }
}
