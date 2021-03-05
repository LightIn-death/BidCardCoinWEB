<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210305132149 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE adresse_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categorie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commissaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE enchere_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE lot_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ordre_achat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE paiement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pays_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE produit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE stock_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vente_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE adresse (id INT NOT NULL, commissaire_id INT DEFAULT NULL, pays VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, adresse_number VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C35F0816F7EA9D21 ON adresse (commissaire_id)');
        $this->addSql('CREATE TABLE adresse_user (adresse_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(adresse_id, user_id))');
        $this->addSql('CREATE INDEX IDX_7D95019F4DE7DC5C ON adresse_user (adresse_id)');
        $this->addSql('CREATE INDEX IDX_7D95019FA76ED395 ON adresse_user (user_id)');
        $this->addSql('CREATE TABLE categorie (id INT NOT NULL, liste_categorie_enfant_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_497DD634C96EA73 ON categorie (liste_categorie_enfant_id)');
        $this->addSql('CREATE TABLE commissaire (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, email VARCHAR(255) NOT NULL, telephone_m VARCHAR(255) DEFAULT NULL, telephone_f VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE enchere (id INT NOT NULL, utilistateur_id INT NOT NULL, lot_id INT DEFAULT NULL, commissaire_id INT DEFAULT NULL, ordre_achat_id INT DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, adjuger BOOLEAN NOT NULL, date_heure_vente TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_38D1870F1B067F20 ON enchere (utilistateur_id)');
        $this->addSql('CREATE INDEX IDX_38D1870FA8CBA5F7 ON enchere (lot_id)');
        $this->addSql('CREATE INDEX IDX_38D1870FF7EA9D21 ON enchere (commissaire_id)');
        $this->addSql('CREATE INDEX IDX_38D1870F5DD2787F ON enchere (ordre_achat_id)');
        $this->addSql('CREATE TABLE lot (id INT NOT NULL, vente_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B81291B7DC7170A ON lot (vente_id)');
        $this->addSql('CREATE TABLE ordre_achat (id INT NOT NULL, utilistateur_id INT NOT NULL, lot_id INT NOT NULL, automatique BOOLEAN NOT NULL, montant_max DOUBLE PRECISION NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_71306AD91B067F20 ON ordre_achat (utilistateur_id)');
        $this->addSql('CREATE INDEX IDX_71306AD9A8CBA5F7 ON ordre_achat (lot_id)');
        $this->addSql('CREATE TABLE paiement (id INT NOT NULL, lot_id INT NOT NULL, utilisateur_id INT NOT NULL, type VARCHAR(255) NOT NULL, validation BOOLEAN NOT NULL, montant DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B1DC7A1EA8CBA5F7 ON paiement (lot_id)');
        $this->addSql('CREATE INDEX IDX_B1DC7A1EFB88E14F ON paiement (utilisateur_id)');
        $this->addSql('CREATE TABLE pays (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE produit (id INT NOT NULL, lot_id INT DEFAULT NULL, vendeur_id INT NOT NULL, enchere_gagnante_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, nom_auteur VARCHAR(255) DEFAULT NULL, nom_style VARCHAR(255) DEFAULT NULL, prix_reserve DOUBLE PRECISION DEFAULT NULL, reference_catalogue VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, is_send BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_29A5EC27A8CBA5F7 ON produit (lot_id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27858C065E ON produit (vendeur_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29A5EC2772FCB4 ON produit (enchere_gagnante_id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27BCF5E72D ON produit (categorie_id)');
        $this->addSql('CREATE TABLE stock (id INT NOT NULL, adresse_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4B3656604DE7DC5C ON stock (adresse_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, numero VARCHAR(255) DEFAULT NULL, solvable VARCHAR(255) DEFAULT NULL, liste_mot_clef VARCHAR(255) DEFAULT NULL, verif_solvable BOOLEAN NOT NULL, verif_identity BOOLEAN NOT NULL, verif_ressortissants BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE vente (id INT NOT NULL, adresse_id INT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_888A2A4C4DE7DC5C ON vente (adresse_id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816F7EA9D21 FOREIGN KEY (commissaire_id) REFERENCES commissaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE adresse_user ADD CONSTRAINT FK_7D95019F4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE adresse_user ADD CONSTRAINT FK_7D95019FA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634C96EA73 FOREIGN KEY (liste_categorie_enfant_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870F1B067F20 FOREIGN KEY (utilistateur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870FA8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870FF7EA9D21 FOREIGN KEY (commissaire_id) REFERENCES commissaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870F5DD2787F FOREIGN KEY (ordre_achat_id) REFERENCES ordre_achat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lot ADD CONSTRAINT FK_B81291B7DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ordre_achat ADD CONSTRAINT FK_71306AD91B067F20 FOREIGN KEY (utilistateur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ordre_achat ADD CONSTRAINT FK_71306AD9A8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EA8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27858C065E FOREIGN KEY (vendeur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2772FCB4 FOREIGN KEY (enchere_gagnante_id) REFERENCES enchere (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656604DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE adresse_user DROP CONSTRAINT FK_7D95019F4DE7DC5C');
        $this->addSql('ALTER TABLE stock DROP CONSTRAINT FK_4B3656604DE7DC5C');
        $this->addSql('ALTER TABLE vente DROP CONSTRAINT FK_888A2A4C4DE7DC5C');
        $this->addSql('ALTER TABLE categorie DROP CONSTRAINT FK_497DD634C96EA73');
        $this->addSql('ALTER TABLE produit DROP CONSTRAINT FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE adresse DROP CONSTRAINT FK_C35F0816F7EA9D21');
        $this->addSql('ALTER TABLE enchere DROP CONSTRAINT FK_38D1870FF7EA9D21');
        $this->addSql('ALTER TABLE produit DROP CONSTRAINT FK_29A5EC2772FCB4');
        $this->addSql('ALTER TABLE enchere DROP CONSTRAINT FK_38D1870FA8CBA5F7');
        $this->addSql('ALTER TABLE ordre_achat DROP CONSTRAINT FK_71306AD9A8CBA5F7');
        $this->addSql('ALTER TABLE paiement DROP CONSTRAINT FK_B1DC7A1EA8CBA5F7');
        $this->addSql('ALTER TABLE produit DROP CONSTRAINT FK_29A5EC27A8CBA5F7');
        $this->addSql('ALTER TABLE enchere DROP CONSTRAINT FK_38D1870F5DD2787F');
        $this->addSql('ALTER TABLE adresse_user DROP CONSTRAINT FK_7D95019FA76ED395');
        $this->addSql('ALTER TABLE enchere DROP CONSTRAINT FK_38D1870F1B067F20');
        $this->addSql('ALTER TABLE ordre_achat DROP CONSTRAINT FK_71306AD91B067F20');
        $this->addSql('ALTER TABLE paiement DROP CONSTRAINT FK_B1DC7A1EFB88E14F');
        $this->addSql('ALTER TABLE produit DROP CONSTRAINT FK_29A5EC27858C065E');
        $this->addSql('ALTER TABLE lot DROP CONSTRAINT FK_B81291B7DC7170A');
        $this->addSql('DROP SEQUENCE adresse_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categorie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commissaire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE enchere_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE lot_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ordre_achat_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE paiement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pays_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE produit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE stock_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE vente_id_seq CASCADE');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE adresse_user');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commissaire');
        $this->addSql('DROP TABLE enchere');
        $this->addSql('DROP TABLE lot');
        $this->addSql('DROP TABLE ordre_achat');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE vente');
    }
}
