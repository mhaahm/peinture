<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329212918 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message CLOB NOT NULL, created_at DATETIME NOT NULL, is_sent BOOLEAN NOT NULL)');
        $this->addSql('DROP TABLE categorie_categorie');
        $this->addSql('DROP INDEX IDX_BA5AE01DA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__blog_post AS SELECT id, user_id, titre, contenu, slug, date FROM blog_post');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('CREATE TABLE blog_post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, titre VARCHAR(255) NOT NULL COLLATE BINARY, contenu CLOB NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL COLLATE BINARY, date DATETIME NOT NULL, CONSTRAINT FK_BA5AE01DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO blog_post (id, user_id, titre, contenu, slug, date) SELECT id, user_id, titre, contenu, slug, date FROM __temp__blog_post');
        $this->addSql('DROP TABLE __temp__blog_post');
        $this->addSql('CREATE INDEX IDX_BA5AE01DA76ED395 ON blog_post (user_id)');
        $this->addSql('DROP INDEX IDX_67F068BC27F5416E');
        $this->addSql('DROP INDEX IDX_67F068BCC2E869AB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, peinture_id, blogpost_id, auteur, email, contenu, date, created_at FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, peinture_id INTEGER DEFAULT NULL, blogpost_id INTEGER DEFAULT NULL, auteur VARCHAR(255) NOT NULL COLLATE BINARY, email VARCHAR(255) NOT NULL COLLATE BINARY, contenu CLOB NOT NULL COLLATE BINARY, date DATETIME NOT NULL, created_at DATETIME NOT NULL, CONSTRAINT FK_67F068BCC2E869AB FOREIGN KEY (peinture_id) REFERENCES peinture (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_67F068BC27F5416E FOREIGN KEY (blogpost_id) REFERENCES blog_post (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commentaire (id, peinture_id, blogpost_id, auteur, email, contenu, date, created_at) SELECT id, peinture_id, blogpost_id, auteur, email, contenu, date, created_at FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC27F5416E ON commentaire (blogpost_id)');
        $this->addSql('CREATE INDEX IDX_67F068BCC2E869AB ON commentaire (peinture_id)');
        $this->addSql('DROP INDEX IDX_8FB3A9D6BCF5E72D');
        $this->addSql('DROP INDEX IDX_8FB3A9D6A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__peinture AS SELECT id, user_id, categorie_id, nom, largeur, hauteur, en_vente, prix, date_realisation, created_at, description, portfolio, slug, file FROM peinture');
        $this->addSql('DROP TABLE peinture');
        $this->addSql('CREATE TABLE peinture (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, categorie_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL COLLATE BINARY, largeur NUMERIC(6, 2) NOT NULL, hauteur NUMERIC(6, 2) DEFAULT NULL, en_vente BOOLEAN NOT NULL, prix NUMERIC(6, 2) DEFAULT NULL, date_realisation DATETIME NOT NULL, created_at DATETIME NOT NULL, description CLOB NOT NULL COLLATE BINARY, portfolio BOOLEAN NOT NULL, slug VARCHAR(255) NOT NULL COLLATE BINARY, file VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_8FB3A9D6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8FB3A9D6BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO peinture (id, user_id, categorie_id, nom, largeur, hauteur, en_vente, prix, date_realisation, created_at, description, portfolio, slug, file) SELECT id, user_id, categorie_id, nom, largeur, hauteur, en_vente, prix, date_realisation, created_at, description, portfolio, slug, file FROM __temp__peinture');
        $this->addSql('DROP TABLE __temp__peinture');
        $this->addSql('CREATE INDEX IDX_8FB3A9D6BCF5E72D ON peinture (categorie_id)');
        $this->addSql('CREATE INDEX IDX_8FB3A9D6A76ED395 ON peinture (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_categorie (categorie_source INTEGER NOT NULL, categorie_target INTEGER NOT NULL, PRIMARY KEY(categorie_source, categorie_target))');
        $this->addSql('CREATE INDEX IDX_E422D933D9ACD54A ON categorie_categorie (categorie_source)');
        $this->addSql('CREATE INDEX IDX_E422D933C04985C5 ON categorie_categorie (categorie_target)');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP INDEX IDX_BA5AE01DA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__blog_post AS SELECT id, user_id, titre, contenu, slug, date FROM blog_post');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('CREATE TABLE blog_post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, titre VARCHAR(255) NOT NULL, contenu CLOB NOT NULL, slug VARCHAR(255) NOT NULL, date DATETIME NOT NULL)');
        $this->addSql('INSERT INTO blog_post (id, user_id, titre, contenu, slug, date) SELECT id, user_id, titre, contenu, slug, date FROM __temp__blog_post');
        $this->addSql('DROP TABLE __temp__blog_post');
        $this->addSql('CREATE INDEX IDX_BA5AE01DA76ED395 ON blog_post (user_id)');
        $this->addSql('DROP INDEX IDX_67F068BCC2E869AB');
        $this->addSql('DROP INDEX IDX_67F068BC27F5416E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, peinture_id, blogpost_id, auteur, email, contenu, date, created_at FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, peinture_id INTEGER DEFAULT NULL, blogpost_id INTEGER DEFAULT NULL, auteur VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, contenu CLOB NOT NULL, date DATETIME NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO commentaire (id, peinture_id, blogpost_id, auteur, email, contenu, date, created_at) SELECT id, peinture_id, blogpost_id, auteur, email, contenu, date, created_at FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BCC2E869AB ON commentaire (peinture_id)');
        $this->addSql('CREATE INDEX IDX_67F068BC27F5416E ON commentaire (blogpost_id)');
        $this->addSql('DROP INDEX IDX_8FB3A9D6A76ED395');
        $this->addSql('DROP INDEX IDX_8FB3A9D6BCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__peinture AS SELECT id, user_id, categorie_id, nom, largeur, hauteur, en_vente, prix, date_realisation, created_at, description, portfolio, slug, file FROM peinture');
        $this->addSql('DROP TABLE peinture');
        $this->addSql('CREATE TABLE peinture (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, categorie_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, largeur NUMERIC(6, 2) NOT NULL, hauteur NUMERIC(6, 2) DEFAULT NULL, en_vente BOOLEAN NOT NULL, prix NUMERIC(6, 2) DEFAULT NULL, date_realisation DATETIME NOT NULL, created_at DATETIME NOT NULL, description CLOB NOT NULL, portfolio BOOLEAN NOT NULL, slug VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO peinture (id, user_id, categorie_id, nom, largeur, hauteur, en_vente, prix, date_realisation, created_at, description, portfolio, slug, file) SELECT id, user_id, categorie_id, nom, largeur, hauteur, en_vente, prix, date_realisation, created_at, description, portfolio, slug, file FROM __temp__peinture');
        $this->addSql('DROP TABLE __temp__peinture');
        $this->addSql('CREATE INDEX IDX_8FB3A9D6A76ED395 ON peinture (user_id)');
        $this->addSql('CREATE INDEX IDX_8FB3A9D6BCF5E72D ON peinture (categorie_id)');
    }
}
