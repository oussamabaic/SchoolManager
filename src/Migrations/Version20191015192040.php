<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191015192040 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE controle (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, date_controle DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cycle (id INT AUTO_INCREMENT NOT NULL, nom_cycle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, date_examen DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, nom_matiere VARCHAR(255) NOT NULL, coef INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, cycles_id INT NOT NULL, nom_niveau VARCHAR(255) NOT NULL, INDEX IDX_4BDFF36B44C85140 (cycles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_controle (id INT AUTO_INCREMENT NOT NULL, matiers_id INT NOT NULL, controles_id INT NOT NULL, eleves_id INT NOT NULL, note DOUBLE PRECISION NOT NULL, INDEX IDX_1E62E5F0811EDA1B (matiers_id), UNIQUE INDEX UNIQ_1E62E5F0D8B132DE (controles_id), INDEX IDX_1E62E5F0C2140342 (eleves_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_examen (id INT AUTO_INCREMENT NOT NULL, exemens_id INT NOT NULL, matieres_id INT NOT NULL, eleves_id INT NOT NULL, note DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_499ED83873E401E0 (exemens_id), INDEX IDX_499ED83882350831 (matieres_id), INDEX IDX_499ED838C2140342 (eleves_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parents (id INT AUTO_INCREMENT NOT NULL, cin VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, tele VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36B44C85140 FOREIGN KEY (cycles_id) REFERENCES cycle (id)');
        $this->addSql('ALTER TABLE note_controle ADD CONSTRAINT FK_1E62E5F0811EDA1B FOREIGN KEY (matiers_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE note_controle ADD CONSTRAINT FK_1E62E5F0D8B132DE FOREIGN KEY (controles_id) REFERENCES controle (id)');
        $this->addSql('ALTER TABLE note_controle ADD CONSTRAINT FK_1E62E5F0C2140342 FOREIGN KEY (eleves_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE note_examen ADD CONSTRAINT FK_499ED83873E401E0 FOREIGN KEY (exemens_id) REFERENCES examen (id)');
        $this->addSql('ALTER TABLE note_examen ADD CONSTRAINT FK_499ED83882350831 FOREIGN KEY (matieres_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE note_examen ADD CONSTRAINT FK_499ED838C2140342 FOREIGN KEY (eleves_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE classe ADD niveau_id INT NOT NULL');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('CREATE INDEX IDX_8F87BF96B3E9C81 ON classe (niveau_id)');
        $this->addSql('ALTER TABLE eleve ADD parents_id INT NOT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7B706B6D3 FOREIGN KEY (parents_id) REFERENCES parents (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7B706B6D3 ON eleve (parents_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE note_controle DROP FOREIGN KEY FK_1E62E5F0D8B132DE');
        $this->addSql('ALTER TABLE niveau DROP FOREIGN KEY FK_4BDFF36B44C85140');
        $this->addSql('ALTER TABLE note_examen DROP FOREIGN KEY FK_499ED83873E401E0');
        $this->addSql('ALTER TABLE note_controle DROP FOREIGN KEY FK_1E62E5F0811EDA1B');
        $this->addSql('ALTER TABLE note_examen DROP FOREIGN KEY FK_499ED83882350831');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96B3E9C81');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7B706B6D3');
        $this->addSql('DROP TABLE controle');
        $this->addSql('DROP TABLE cycle');
        $this->addSql('DROP TABLE examen');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE note_controle');
        $this->addSql('DROP TABLE note_examen');
        $this->addSql('DROP TABLE parents');
        $this->addSql('DROP INDEX IDX_8F87BF96B3E9C81 ON classe');
        $this->addSql('ALTER TABLE classe DROP niveau_id');
        $this->addSql('DROP INDEX IDX_ECA105F7B706B6D3 ON eleve');
        $this->addSql('ALTER TABLE eleve DROP parents_id');
    }
}
